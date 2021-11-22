 
 <link rel="stylesheet" href="./css/styleLogIn.css">
 <?php  
 require_once('./app/helpers.php');
 session_start();
 redirect_unauthorized(false,'./signin.php');

//    $sql="SELECT u.name, p.*, DATE_FORMAT(p.created_at, \'%d/%m/%Y %H:%i\') pdate FROM post p JOIN users u ON u.id=p.user_id ORDER BY p.created_at DESC";
//     $result=mysqli_query($link,$sql);
$errors=[
    'title'=>'',
    'article'=>''
];
if(validate_csrf()&& isset($_POST['submit'])){
    $title=filter_input(INPUT_POST,'title',FILTER_SANITIZE_STRING);
    $article=filter_input(INPUT_POST,'article',FILTER_SANITIZE_STRING);

    $is_form_valid=true;

    if(!$title || mb_strlen($title)<2){
      $is_form_valid=false;
      $errors['title']='* Title is required from minimum of 2 chracters.';  
    }
     if(!$article || mb_strlen($article)<2){
      $is_form_valid=false;
      $errors['article']='* Article is required from minimum of 2 chracters.';  
    }
    if($is_form_valid){
    $uid=$_SESSION['user_id'];

 $link=mysqli_connect(MYSQL_HOST,MYSQL_USER,MYSQL_PWD,MYSQL_DB);

 $title=mysqli_real_escape_string($link,$title);
 $article=mysqli_real_escape_string($link,$article);

 $sql="INSERT INTO post(user_id, title ,article,created_at) VALUES ('$uid','$title','$article',NOW())";
 $result=mysqli_query($link,$sql);

 if($result && mysqli_affected_rows($link)===1){
     header('location: ./blog.php');
     exit();
 }
}
}

 
 ?>
<?php
$page_title='Add Post';
include_once './tpl/header.php';
?>

    <main class="container flex-fill">

        <!-- PAGE HEADER -->
        <section id="main-top-content">
            <div class="row">
                <div class="col-12 mt-5 text-center">
                    <h1 class="display-3 text-primary">
                      Add a New Post 
                    </h1>
                  
                   
                </div>
            </div>
        </section>

        <!-- PAGE CONTENT -->
        <section class="main-content container mt-3">
            <div class="row">
                <div class="col-12 col-md-6 mx-auto">
     <form action="" method="POST" novalidate='novalidate' autocomplete="off">
         <input type="hidden" name="<?=csrf_name();?>" value="<?=csrf();?>" class="text-white">
           <div class="form-group">
               <label for="title">
                   <span class="text-danger">*</span>
                   Title
               </label>
               <input type="text" id="title" name='title' class="form-control text-white" >
                <?=field_error('title');?>
           </div>
           <div class="form-group mt-2">
               <label for="article">
                   <span class="text-danger">*</span>
                   Article
               </label>
               <textarea name="article" id="article" cols='30' rows="10" class="form-control text-white"></textarea>
               <?=field_error('article');?>
           </div>
           <div class="d-flex my-3">
               <input type="submit" name='submit' value="Save post" class="btn btn-primary">
               <a href="./blog.php" class="btn btn-secondary ms-2">Cansel</a>
           </div>

       </form>
                </div>
            </div>
        </section>
    </main>
    <?php include_once './tpl/footer.php';?>