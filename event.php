<?php
$ev_id = 'EV0001'; /*   delete this row when combine   */
$student_id = '2'; /*   delete this row when combine   */
$_SESSION['ev_id'] = $ev_id;  /*  the session name is depend on the variable u define in home page */
$_SESSION['u_id'] = $student_id;  /*  the session name is depend on the variable u get in login page */

require_once('mysqli_connect.php');
DEFINE('db_name', 'event');
mysqli_select_db($dbc, db_name);


$q = "SELECT ev_name, ev_organizer, ev_date, ev_start, ev_end, ev_venue, ev_price, ev_desc from ev_info where ev_id='$ev_id'";
$result = @mysqli_query($dbc, $q);

while ($row = mysqli_fetch_array($result)) {
    $ev_name=$row['ev_name'];
    $ev_organizer=$row['ev_organizer'];
    $ev_date=$row['ev_date'];
    $dt = date('l, F d, Y', strtotime($ev_date));
    $ev_start=$row['ev_start'];
    $ev_end=$row['ev_end'];
    $ev_venue=$row['ev_venue'];
    $ev_price=$row['ev_price'];
    $ev_desc=$row['ev_desc'];
}

?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8"/>
        <link href="event.css" rel="stylesheet"/>
        <link href="header.css" rel="stylesheet"/>
        <link href="footer.css" rel="stylesheet"/>
    </head>
    <body>
        <?php include 'header.php';?>
        <div class="container">
            <div class="event">
                <img src="photo/ev1.png" class="ev_pic"/>
                <table class="ev_des">
                    <tr>
                        <td colspan="2" class="tt"><?php echo $ev_name ?></td>
                    </tr>
                    <tr>
                        <td>ORGANIZER</td>
                        <td><?php echo $ev_organizer ?></td>
                    </tr>
                    <tr>
                        <td>DATE</td>
                        <td><?php echo $ev_date ?></td>
                    </tr>
                    <tr>
                        <td>TIME</td>
                        <td><?php echo $ev_start.' - '.$ev_end ?></td>
                    </tr>
                    <tr>
                        <td>VENUE</td>
                        <td><?php echo $ev_venue ?></td>
                    </tr>
                    <tr>
                        <td>REGISTER FEES</td>
                        <td><?php echo 'RM'.$ev_price ?> ( Pay at the event reception counter )</td>
                    </tr>
                    <tr>
                        <td>DESCRIPTION</td>
                        <td><?php echo $ev_desc ?></td>
                    </tr>
                </table>
            </div>
            <?php $linking= "e_form.php";
            include $linking; 
            ?>
        </div>
        <?php include 'footer.php';?>
    </body>
</html>