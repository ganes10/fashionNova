<?php

include 'db_connection.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
   header('location:login.php');
}

if (isset($_GET['delete'])) {
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `message` WHERE id = '$delete_id'") or die('query failed');
   header('location:admin_contacts.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Messages</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="admin_style.css">

</head>

<body>

   <?php include 'admin_header.php'; ?>

   <section class="messages">

      <h1 class="title"> Messages </h1>

      <div class="box-container">
         <?php
         $select_message = mysqli_query($conn, "SELECT * FROM `message`") or die('query failed');
         if (mysqli_num_rows($select_message) > 0) {
            ?>
            <table>
               <tr>
                  <th>ID</th>
                  <th>User ID</th>
                  <th>Name</th>
                  <th>Number</th>
                  <th>Email</th>
                  <th>Message</th>
                  <th>Action</th>
               </tr>
               <?php
               while ($fetch_message = mysqli_fetch_assoc($select_message)) {
               ?>
                  <tr>
                     <td><?php echo $fetch_message['id']; ?></td>
                     <td><?php echo $fetch_message['user_id']; ?></td>
                     <td><?php echo $fetch_message['name']; ?></td>
                     <td><?php echo $fetch_message['number']; ?></td>
                     <td><?php echo $fetch_message['email']; ?></td>
                     <td><?php echo $fetch_message['message']; ?></td>
                     <td>
                        <a href="admin_contacts.php?delete=<?php echo $fetch_message['id']; ?>" onclick="return confirm('Delete this message?');" class="delete-btn">Delete</a>
                     </td>
                  </tr>
               <?php
               }
               ?>
            </table>
         <?php
         } else {
            echo '<p class="empty">You have no messages!</p>';
         }
         ?>
      </div>

   </section>

   <!-- custom admin js file link  -->
   <script src="js/admin_script.js"></script>

</body>

</html>
