 <?php  
 require_once('./app/helpers.php');
 session_start();
  $link=mysqli_connect(MYSQL_HOST,MYSQL_USER,MYSQL_PWD,MYSQL_DB);
   $sql='SELECT u.name, p.*, DATE_FORMAT(p.created_at, \'%d/%m/%Y %H:%i\') pdate FROM post p JOIN users u ON u.id=p.user_id ORDER BY p.created_at DESC';
    $result=mysqli_query($link,$sql);
 
 ?>
<?php
$page_title='Blog';
include_once './tpl/header.php';
?>

    <main class="container flex-fill">

        <!-- PAGE HEADER -->
        <section id="main-top-content">
            <div class="row">
                <div class="col-12 mt-5 text-center">
                    <h1 class="display-3 text-primary">
                       <?=LOGO;?>Blog
                    </h1>
                    <p>
                        <?php
                        if(user_auth())
                        :?>
                        <a href="./add_post.php" class="btn btn-primary">
                    <i class="bi bi-plus-circle-fill me-2">Add new</i></a>
                    <?php else :?>
                        To Add A Post <a href="./signup.php">Create User</a>
                        Or <a href="./signin.php"> Sign in</a>
                        <?php endif;?>
                    </p>
                   
                </div>
            </div>
        </section>

        <!-- PAGE CONTENT -->
        <section class="main-content container mt-5">
            <div class="row">
                <div class="col-12">
                    <h3><?=LOGO?>Posts</h3>
                </div>
            </div>
            <?php if ($result && mysqli_num_rows($result)>0): ?>
                <?php while ($post=mysqli_fetch_assoc($result)):?>
            <div class="row">
                <div class="col-12 my-2">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <span><?= $post['name'];?></span>
                            <span><?=$post['pdate'];?></span>
                        </div>
                        <div class="card-body">
                            
                            <h4><?=htmlentities($post['title']);?></h4>
                            <p>
                              <?=nl2br(htmlentities($post['article']));?>
                            </p>
                              <?php if (user_auth() && $_SESSION['user_id'] === $post['user_id']) : ?>

                                        <div class="d-flex justify-content-end">
                                            <div class="dropdown">
                                                <a class="dropdown-toggle text-dark dropdown-toggle-no-arrow" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="bi bi-three-dots"></i>
                                                </a>

                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                    <li>
                                                        <a class="dropdown-item" href="./edit_post.php?pid=<?= $post['id']; ?>&<?= csrf_name(); ?>=<?= csrf(); ?>">
                                                            <i class="bi bi-pencil me-2"></i>
                                                            <span>Edit</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="./delete_post.php?pid=<?= $post['id']; ?>">
                                                            <i class="bi bi-trash-fill me-2"></i>
                                                            <span>Delete</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>

                                        </div>
                                    <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
           <?php endwhile;?>
           <?php else : ?>
              <div class="row">
                  <div class="col-12 text-center mt-5">
                      <h3>No post yet, be the first to post on our site</h3>
                  </div>
              </div>
              <?php endif;?>
        </section>
    </main>
    <?php include_once './tpl/footer.php';?>