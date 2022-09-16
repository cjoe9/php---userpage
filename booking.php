<?php
/* session_start();                uncomment this when combine the file             
   $_SESSION['id']= $student_id;
*/
$student_id = '2';/* <--------------------  delete this row aswell         */
?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8"/>
        <link href="booking.css" rel="stylesheet"/>
        <link href="header.css" rel="stylesheet"/>
        <link href="footer.css" rel="stylesheet"/>
    </head>
    <body>
        <?php include 'header.php';?>
        <div class="container">
            <img src="photo/promo.png" alt="promotion_picture" class="promo"/>
            <?php include 'b_form.php'; ?> 
        </div>
        <?php include 'footer.php';?>
    </body>
</html>