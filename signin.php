 <link rel="stylesheet" href="./css/styleLogIn.css">
 
 
 <?php 
 require_once 'app/helpers.php';
 session_start();
 redirect_unauthorized(true);
 if(user_auth()){
     header('location:./');
     exit();
 }
  $errors=[
     'email'=>'',
     'password'=>'',
     'submit'=>''
 ];
   
    if(validate_csrf()&& isset($_POST['submit'])){
        $email= filter_input(INPUT_POST,'email',FILTER_SANITIZE_EMAIL);
        $password=filter_input(INPUT_POST,'password',FILTER_SANITIZE_STRING);
        if(!$email){
            $errors['email']='A valid email is required';
        }elseif(!$password){
            $errors['password']='* plese enter your password';
        }else{
          $link=mysqli_connect(MYSQL_HOST,MYSQL_USER,MYSQL_PWD,MYSQL_DB);

          $email=mysqli_real_escape_string($link,$email);
          $password=mysqli_real_escape_string($link,$password);
          $sql="SELECT * FROM users WHERE email='$email'";
          $result=mysqli_query($link,$sql);

          if($result && mysqli_num_rows($result)===1) {
              $user=mysqli_fetch_assoc($result);

             if(password_verify($password,$user['password'])){
                 login_user($user['id'],$user['name'],'./');
             }
           
          }else{
              $errors['submit']='*Wrong email or password ';
          }
        }
    }
 
 
 
 
 
 
 $page_title='SIGN IN';
include_once './tpl/header.php';

?>
 
    <main class="container flex-fill container-image">

        <!-- PAGE HEADER -->
        <section id="main-top-content">
            <div class="row">
                <div class="col-12 mt-5 text-center">
                    <h1 class="display-3 text-primary">
                      Sign in with your accont
                    </h1>
                    <p>
                        Lorem ipsum dolor sit amet consectetur
                    </p>
                   
        </section>

        <!-- PAGE CONTENT -->
        <section class="main-content container mt-5">
             
            <div class="row mb-2">
                <div class="col-8 col-md-3 mx-auto">
                   <form action='' method="POST" novalidate='novalidate' autocomplete="='off">
                       <input type="hidden" name="<?=csrf_name();?>" value="<?=csrf()?>">
                       <div class="form-group mt-3">
                           <label for="email">
                               <span class="text-danger">*</span>
                              Email
                           </label>
                           <input type="email" name='email' id='email' class="form-control">
                           <?php if ($errors['email']) :?>
                            <span class="text-danger">
                                <?=$errors['email'];?>
                            </span>
                            <?php endif?>
                       </div>
                         <div class="form-group mt-3">
                           <label for="password">
                               <span class="text-danger">*</span>
                             Password
                           </label>
                           <input type="password" name='password' id='password' class="form-control">
                            <?php if ($errors['password']) :?>
                            <span class="text-danger">
                                <?=$errors['password'];?>
                            </span>
                            <?php endif?>
                       </div>
                       <input type="submit" value='Sign-in' name='submit' class="btn btn-primary mt-3">
                   </form>
                </div>
              

        </section>
    </main>
  

 <?php
include_once './tpl/footer.php';
?>