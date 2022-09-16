<?php
/* session_start();                uncomment this when combine the file             
   $_SESSION['id']= $student_id;
*/
$student_id = '2';/* <--------------------  delete this row aswell         */

$error = "";
require_once('mysqli_connect.php');
DEFINE('db_name2', 'booking');
mysqli_select_db($dbc, db_name2);
if (isset($_POST['submit'])) {
    if (isset($_POST['checked'])) {
        $gym_del = $_POST['checked'];
        $q = "DELETE FROM book_info WHERE gym_book_id IN ('" . implode("','", $gym_del) . "')";
        $r = @mysqli_query($dbc, $q);
        header('Location: u_booking.php');
    }
    
}

if (isset($_COOKIE['bg_pic'])) {
    $bg_pic = $_COOKIE['bg_pic'];
}
if (isset($_COOKIE['id_pic'])) {
    $id_pic = $_COOKIE['id_pic'];
}
?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="user.css" rel="stylesheet"/>
        <link href="header.css" rel="stylesheet"/>
        <link href="footer.css" rel="stylesheet"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        <script type="text/JavaScript">
            var loadbg = function (event) {
                var image = document.getElementById("bg_pic");
                image.src = URL.createObjectURL(event.target.files[0]);
            };

            function myFunction() {
                if(confirm("This will delete all checked records.\nAre you sure?") === true){
                    return true;
                }else{
                    return false;
                }
            }
        </script>
        <?php include 'header.php'; ?>
        <div class="container">
            <div class="bg">
                <div class="in">
                    <label for="bg" class="chg">
                        <span class="fa fa-camera"></span>
                        <span>change background</span>
                    </label>
                    <input type="file" class="bg_pic" id="bg" onchange="loadbg(event)"/>
                </div>
                <img src="<?php echo $bg_pic; ?>" id="bg_pic" alt="blank background"/>
            </div>
            <div class="all">
                <?php include 'user.php'; ?>
                <div class="b_content">
                    <p class='title'>GYM BOOKING RECORD</p>
                    <table class="a_table">
                        <?php
                        DEFINE('db_name', 'user');
                        mysqli_select_db($dbc, db_name);
                        $q = "SELECT u_name from user_info where u_id= '$student_id'";
                        $r = @mysqli_query($dbc, $q);
                        while ($row = mysqli_fetch_array($r)) {
                            $name = $row['u_name'];
                        }
                        echo '
                        <tr>
                            <td class="r">ID:</td>
                            <td class="t">' . $student_id . '</td>
                        </tr>
                        <tr>
                            <td class="r">NAME:</td>
                            <td class="t">' . $name . '</td>
                        </tr>';
                        ?>
                    </table>
                    <form method='post' action='u_booking.php'>
                        <table class="b_table">
                            <?php
                            mysqli_select_db($dbc, db_name2);
                            $q = "SELECT * from book_info where u_id= '$student_id'";
                            $result = @mysqli_query($dbc, $q);
                            $num = mysqli_num_rows($result);
                            if ($num > 0) {
                                echo'
                            <tr>
                                <td class="f">&nbsp;</td>
                                <td class="f">DATE</td>
                                <td class="f">DAY</td>
                                <td class="f">TIME</td>
                                <td class="f">PAX</td>
                            </tr>'; 
                            } else {
                                echo '<td class="g">There are 0 record found.</td>';
                                echo '<script type="text/JavaScript">
                                        document.getElementsById("godown").style.visibility="hidden";
                                      </script>';
                            } 
                            while ($row = mysqli_fetch_array($result)) {
                                    echo '<tr>
                                <td>
                                    <input type="checkbox" name="checked[]" value="' . $row['gym_book_id'] . '"/>
                                </td>
                                <td class="g">' . $row['b_date'] . '</td>
                                <td class="g">' . date('l', strtotime($row['b_date'])) . '</td>
                                <td class="g">' . $row['b_start'] . ' - ' . $row['b_end'] . '</td>
                                <td class="g">' . $row['b_pax'] . '</td>
                            </tr>';
                                }
                            ?>
                        </table>
                        <input type="submit" value="Delete Checked" name="submit" onclick="return myFunction();" class="ebtn" id="godown"/>
                    </form>
                </div>
            </div>
        </div>
        <?php include 'footer.php'; ?>
    </body>
</html>