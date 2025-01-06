<?php
require('db_connection.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $fullname = filter_input(INPUT_POST, "fullname", FILTER_SANITIZE_SPECIAL_CHARS);
  $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_SPECIAL_CHARS);
  $message = filter_input(INPUT_POST, "message", FILTER_SANITIZE_SPECIAL_CHARS);

  $sql = "INSERT INTO `messages`(`fullname`, `email`, `message`, `message_date`) VALUES ('$fullname','$email','$message',current_timestamp())";
  $result = mysqli_query($conn, $sql);

  if ($result) {
    $_SESSION['success_msg'] = "Your message has been sent!";
    header("location: contact.php");
  } else {
    $_SESSION['message'] = "Failed to send message.";
  }

}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Contact</title>
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
  <?php $page = "contact";
  include('header.php') ?>
  <!-- Contact Section -->
  <div class="contact">

    <div id="alertContainer">
      <?php include('message.php') ?>
    </div>


    <div class="contact-form ">

      <div class="message-form">
        <div class="contact-title">
          <h1 style="text-align: center;">Contact Us</h1>
        </div>


        <form action="<?php htmlspecialchars('contact.php') ?>" id="contact-us" method="POST" novalidate>


          <input type="text" name="fullname" id="name" placeholder="Your Full Name">
          <div class="name-error"></div>

          <input type="email" name="email" id="email" placeholder="Your Email">
          <div class="email-error"></div>

          <textarea name="message" id="message" cols="30" rows="10" placeholder="Your Message"
            maxlength="250"></textarea>
          <div class="message-error"></div>

          <button type="submit">Send Message</button>
        </form>

      </div>
    </div>
  </div>
  <?php include('footer.php') ?>
  <script>


    document.getElementById('contact-us').addEventListener('submit', function (event) {
      let name = document.getElementById('name').value.trim();
      let email = document.getElementById('email').value.trim();
      let message = document.getElementById('message').value.trim();

      // Reset error messages
      document.querySelector('.name-error').textContent = '';
      document.querySelector('.email-error').textContent = '';
      document.querySelector('.message-error').textContent = '';

      // Validate name
      if (!name) {
        document.querySelector('.name-error').textContent = 'Full name cannot be empty.';
        event.preventDefault(); // prevent form submission
        return;
      }

      // Validate email
      if (!email) {
        document.querySelector('.email-error').textContent = 'Email cannot be empty.';
        event.preventDefault();
        return;
      } else {
        // Simple regex to validate email format
        let emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
        if (!emailPattern.test(email)) {
          document.querySelector('.email-error').textContent = 'Enter a valid email address.';
          event.preventDefault();
          return;
        }
      }

      // Validate message
      if (!message) {
        document.querySelector('.message-error').textContent = 'Message cannot be empty.';
        event.preventDefault();
        return;
      }
    });

  </script>


  <script src="js/script.js"></script>
</body>

</html>