 
 <!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title></title>
       <link rel="stylesheet" href="./css/style.css">
 </head>
  <style>
     body {
  background: linear-gradient(rgba(0, 0, 50, 0.5), rgba(0, 0, 50, 0.5)),
    url(./images/imagecar3.webp);
  background-size: cover;
  background-position: center;

}
h3{
    color:whitesmoke;
}
p{
    color:whitesmoke;
    font-size: 1.2rem;
}

 </style>
 <body>
     
 <?php  session_start();?>
<?php
$page_title="ABOUT";
include_once './tpl/header.php';
?>

    

    <main class="container flex-fill">

        <!-- PAGE HEADER -->
        <section id="main-top-content">
            <div class="row">
                <div class="col-12 mt-5 text-center">
                    <h1 class="display-3 text-primary">
                        About <?=LOGO?>
                    </h1>
                  <h3>We know everyone loves their car</h3>
                  <p>Car Lovers is a family operated valeting and detailing Navan Ltd company run by Michael and Naoimh O’Brien (CD – PV) Certified Detailer & Professional Valetor.

Our Passion is cars & we strive to bring great service & an unbelievable Standard every time. Our team at Car Lovers is fully trained in transforming even the most tired vehicles to the showroom condition it
once was, from our new purpose-built workshop.</p>

                    </div>
                  
                  
                </div>
            </div>
        </section>

        <!-- PAGE CONTENT -->
        <!-- <section class="main-content container mt-5">

            <div class="row mb-2">
                <div class="col-md-6">
                    <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                        <div class="col p-4 d-flex flex-column position-static">
                            <strong class="d-inline-block mb-2 text-primary">
                                Highlights
                            </strong>
                            <h3 class="mb-0">
                                Highlighted Cars
                            </h3>
                            <div class="mb-1 text-muted">
                                Nov 12
                            </div>
                            <p class="card-text mb-auto">
                                The most amazing cars you had ever whitest
                            </p>
                            <a href="#" class="stretched-link">
                                Continue reading <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                        <div class="col-auto d-none d-lg-block">
                            <img src="./images//pexels-photo-337909.jpeg" width="300px" height="300px" class="img-fluid img-thumbnail" alt="highlighted cars">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                        <div class="col p-4 d-flex flex-column position-static">
                            <strong class="d-inline-block mb-2 text-primary">
                                Priceless
                            </strong>
                            <h3 class="mb-0">
                                The most priceless cars
                            </h3>
                            <div class="mb-1 text-muted">
                                Nov 11
                            </div>
                            <p class="card-text mb-auto">
                                The most priceless cars
                            </p>
                            <a href="#" class="stretched-link">
                                Continue reading <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                        <div class="col-auto d-none d-lg-block">
                            <img src="./images/pexels-photo-919073.jpeg" width="300px" height="300px" class=" img-thumbnail "  alt="priceless cars">
                        </div>
                    </div>
                </div>
            </div>

        </section> -->
    </main>
<?php
include_once './tpl/footer.php';
?>
 </body>
 </html>
 


   