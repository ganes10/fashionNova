<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About Us</title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/about.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
    crossorigin="anonymous" referrerpolicy="no-referrer">

</head>

<body>
  <?php $page = "about";
  include('header.php') ?>

  <div class="section">
    <div style="margin-top: 50px;">
      <h2> Embracing Fashion, Empowering Individuals </h2>
      <p>At FashionNOVA, Established with a passion for redefining the online shopping experience,
        FashionNOVA has swiftly become a global destination for trendsetters,
        visionaries, and those who seek to express their individuality through fashion.</p>
      <div>
        <a style="background-color: #7065D4;color:white;padding: 15px; border-radius: 10px;" href="./products.php">Get
          Started Today</a>
      </div>
    </div>

    <div>
      <img alt="Violin" src="./images/about_img.jpg" />
    </div>
  </div>


  <section class="about">

    <section class="about">
      <div class="containers">
        <div class="content">
          <h2>Why Choose FashionNOVA?</h2>
          <p>Discover the epitome of high-quality branded and promotional clothing at FashionNOVA. We guarantee the best
            products, top-notch quality, and unparalleled service, making your experience truly exceptional.</p>
          <p>At FashionNOVA, we seamlessly merge the convenience of online selection with personalized and attentive
            customer care. Our commitment to excellence ensures a flourishing reputation, leaving every customer
            satisfied!</p>
          <a style="background-color: #7065D4;color:white;padding: 10px; border-radius: 10px; margin-top:8px; text-center"
            href="./contact.php">Contact Us</a>

        </div>
      </div>
    </section>
  </section>

  <section class="bg-white">
    <div class="container">
      <h2 class="text-center heading">
        Read trusted reviews from our customers
      </h2>

      <div class="reviews-grid">
        <div class="review-card">
          <div class="flex items-center gap-4">
            <img alt="Man" src="./images/ganesh.jpg" class="avatar" />

            <div>
            <p class="reviewer-name">Ganesh Basnet
              </p>
              <div class="star-rating">
                <span class="star">&#9733;</span>
                <span class="star">&#9733;</span>
                <span class="star">&#9733;</span>
                <span class="star">&#9733;</span>
                <span class="star">&#9733;</span>
              </div>

              
            </div>
          </div>

          <p class="review-text">
            This is my very first order through the site, and I am totally and completely satisfied! The fit is great
            and so are the prices. I will definitely return again and again....
          </p>
        </div>

        <div class="review-card">
          <div class="flex items-center gap-4">
            <img alt="Man" src="./images/rajiv.jpg" class="avatar" />

            <div>
            <p class="reviewer-name">Rajiv Silwal</p>
              <div class="star-rating">
                <span class="star">&#9733;</span>
                <span class="star">&#9733;</span>
                <span class="star">&#9733;</span>
                <span class="star">&#9733;</span>
                <span class="star">&#9733;</span>
              </div>

              
            </div>
          </div>

          <p class="review-text">
            I love the clothes from this website!! I am so glad I found them.....everything has been spot on, fits
            wonderfully, styles are trendy and lots to choose from!! Thanks for being here for us!!!
          </p>
        </div>

        <div class="review-card">
          <div class="flex items-center gap-4">
            <img alt="Man" src="./images/chuel.jpg" class="avatar" />

            <div>
            <p class="reviewer-name">Rohan Chudal</p>
              <div class="star-rating">
                <span class="star">&#9733;</span>
                <span class="star">&#9733;</span>
                <span class="star">&#9733;</span>
                <span class="star">&#9733;</span>
                <span class="star">&#9733;</span>
              </div>

              
            </div>
          </div>

          <p class="review-text">
            Just received my order & am thrilled with everything I purchased! and the shipping was awesome it took 3
            days best yet! I will shop again thanks you.


          </p>
        </div>


      </div>
    </div>
  </section>


  <?php include('footer.php') ?>
  <script src="js/script.js"></script>
</body>

</html>