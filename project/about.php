<?php

include 'db_connection.php';

session_start();

// $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>About</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="style.css">
<style>
   .heading{
   min-height: 30vh;
   display: flex;
   flex-flow: column;
   align-items: center;
   justify-content: center;
   gap:1rem;
   background: url(images/background1.png) no-repeat;
   background-size: cover;
   background-position: center;
   text-align: center;
 
}
</style>
</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>about us</h3>
   <p> <a href="home.php">HOME</a> / ABOUT </p>
</div>

<section class="about">

   <div class="flex">

      <div class="image">
         <img src="images/about_img.jpg" alt="">
      </div>

      <div class="content">
         <h3>why choose us?</h3>
         <p>If you're looking for branded and promotional clothing, it's worth choosing your supplier with care. With FashionNOVA you'll enjoy the best possible products, quality, service and support – guaranteed!</p>
         <p>At FashionNOVA we combine all the convenience of online selection and ordering with the best in personal, attentive customer care. Why wouldn't we? By being the best, our reputation grows and grows. Everyone’s happy!</p>
         <a href="contact.php" class="btn">contact us</a>
      </div>

   </div>

</section>

<section class="reviews">

   <h1 class="title">client's reviews</h1>

   <div class="box-container">

      <div class="box">
         <img src="images/ganesh.jpg" alt="">
         <p>This is my very first order through site, and I am totally and completely satisfied! The fit is great and so are the prices. I will definitely return again and again....</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Ganesh Basnet</h3>
      </div>

      <div class="box">
         <img src="images/rajiv.jpg" alt="">
         <p>I love the clothes from this website!! I am so glad I found them.....everything has been spot on, fits wonderfully, styles are trendy and lots to choose from!! Thanks for being here for us!!!</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Rajiv Silwal</h3>
      </div>

      <div class="box">
         <img src="images/chuel.jpg" alt="">
         <p>Just received my order & am thrilled with everything I purchased! and the shipping was awesome it took 3 days best yet! i will shop again thanks you.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Rohan Chudal</h3>
      </div>
</section>

<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>