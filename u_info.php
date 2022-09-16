<?php
/* session_start();                uncomment this when combine the file             
   $_SESSION['id']= $student_id;
*/
$student_id = '2';/* <--------------------  delete this row aswell         */

require_once('mysqli_connect.php');
DEFINE('db_name', 'user');
mysqli_select_db($dbc, db_name);
$q = "SELECT bg_pic, id_pic from user_info where u_id='$student_id'";
$result = @mysqli_query($dbc, $q);

while ($row = mysqli_fetch_array($result)) {
    if(is_null($row['bg_pic'])){
        $bg_pic = "photo/u_bg.jpg";
    }else{
        $bg_pic = "profile_pic/".$row['bg_pic'];
    }
    if(is_null($row['id_pic'])){
        $id_pic = "photo/user.png";
    }else{
        $id_pic = "profile_pic/".$row['id_pic'];
    }

    setcookie('bg_pic', $bg_pic);
    setcookie('id_pic', $id_pic);
}

if (isset($_POST['submit'])) {
    $student_id = $_POST['id'];
    
    //GET THE BACKGROUND IMAGE AND STORE INTO THE DATABASE
    if (isset($_FILES['bg'])) {
        if ($_FILES['bg']['size']!=0) {
            $target_dir = "profile_pic/";
            $target_file = $target_dir . basename($_FILES["bg"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $extension = array("png","jpg","jpeg","gif");
            if (!in_array($imageFileType,$extension) ) {
                echo '<script>alert("Upload Failed, only png , jpg , jpeg & gif is allowed.")</script>';
            } else {
                if (move_uploaded_file($_FILES['bg']['tmp_name'], $target_file)) {
                    $image = $_FILES['bg']['name'];
                    $q = "UPDATE user_info SET bg_pic = '$image' where u_id='$student_id'";
                    $result = @mysqli_query($dbc, $q);
                    if($result){
                        echo 'wddwedewwwwww';
                        header('Location: u_info.php');
                    }else{
                        echo '<script>alert("Upload Failed Due To System Error. Please try again later")</script>';
                    }
                } else {
                    echo '<script>alert("Upload Failed. Please try again later.")</script>';
                }
            }
        }
    }
    //GET THE USER PROFILE IMAGE AND STORE INTO THE DATABASE
    if (isset($_FILES['us'])) {
        if ($_FILES['us']['size']!=0) {
        $target_dir = "profile_pic/";
        $target_file = $target_dir . basename($_FILES["us"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                echo '<script>alert("Upload Failed, only png , jpg , jpeg & gif is allowed.")</script>';
            }
            else{
                if (move_uploaded_file($_FILES['us']['tmp_name'], $target_file)) {
                    $image = $_FILES['us']['name'];
                    $q = "UPDATE user_info SET id_pic = '$image' where u_id='$student_id'";
                    $result = @mysqli_query($dbc, $q);
                    if($result){
                        header('Location: u_info.php');
                    }else{
                        echo '<script>alert("Upload Failed Due To System Error. Please try again later")</script>';
                    }
                } else {
                    echo '<script>alert("Upload Failed. Please try again later.")</script>';
                }
            }
        }
    }
}
if (isset($_COOKIE['name']) || isset($_COOKIE['email']) || isset($_COOKIE['phone']) || isset($_COOKIE['address'])) {
    unset($_COOKIE['name']);
    unset($_COOKIE['email']);
    unset($_COOKIE['phone']);
    unset($_COOKIE['address']);
    setcookie('name', '', time() - 3600); 
    setcookie('email', '', time() - 3600); 
    setcookie('phone', '', time() - 3600); 
    setcookie('address', '', time() - 3600); 
}

?>
<html>
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="user.css" rel="stylesheet"/>
        <link href="header.css" rel="stylesheet"/>
        <link href="footer.css" rel="stylesheet"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <script type="text/JavaScript">
        var loadbg = function (event) {
        var image = document.getElementById("bg_pic");
        image.src = URL.createObjectURL(event.target.files[0]);
        };
    </script>
    <body>
        <?php include 'header.php'; ?>
        <form enctype="multipart/form-data" method="post" action="u_info.php" >
            <div class="container">
                <div class="bg">
                    <div class="in">
                        <label for="bg" class="chg">
                            <span class="fa fa-camera"></span>
                            <span>change background</span>
                        </label>
                        <input type="file" class="bg_pic" id="bg" name="bg" onchange="loadbg(event)"/>
                    </div>
                    <img src="<?php echo $bg_pic; ?>" id="bg_pic" alt="blank background"/>
                </div>
                <div class="all">
                    <?php include 'user.php'; ?>
                    <div class="b_content">
                        <div class="con">
                            <?php
                            $q = "SELECT u_name, u_email, u_phone, u_address from user_info where u_id= '$student_id'";
                            $result = @mysqli_query($dbc, $q);
                            while ($row = mysqli_fetch_array($result)) {
                                $name = $row['u_name'];
                                $email = $row['u_email'];
                                $ph = $row['u_phone'];
                                $add = $row['u_address'];
                            }

                            printf('
                <table class="c-bar">
                    <tr>
                        <td class="b">USER ID : </td>
                        <td class="a">%s</td>
                    </tr>
                    <tr>
                        <td class="b">NAME    :</td>
                        <td class="a">%s</td>
                    </tr>
                    <tr>
                        <td class="b">EMAIL   :</td>
                        <td class="a">%s</td>
                    </tr>
                    <tr>
                        <td class="b">HANDPHONE:</td>
                        <td class="a">%s</td>
                    </tr>
                    <tr>
                        <td class="b">ADDRESS  :</td>
                        <td class="a">%s</td>
                    </tr>
                </table>
                ', $student_id, $name, $email, $ph, $add);
                            ?>
                            <div class="btn-area">
                                <input type="hidden" value="<?php echo $student_id;?>" name="id"/>
                                <input type="submit" value="SAVE PHOTO" name="submit" class="ebtn"/>
                                <a href="u_edit.php" class="ebtn" id="godown">EDIT</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <?php include 'footer.php'; ?>
    </body>
</html>