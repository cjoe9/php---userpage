<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Project/PHP/PHPProject.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        // put your code here
        date_default_timezone_set('Asia/Kuala_Lumpur');
        $today=date("Y/m/d");
        echo $today;
        
        if (isset($_POST['submit'])){
            $dt = $_POST['dt'];
            echo $dt;
        }
        ?>
        <form action="index.php" method="post">
            <input type="date" name="dt"/>
            <input type="submit" name="submit" value="ok"/>
        </form>
    </body>
</html>
