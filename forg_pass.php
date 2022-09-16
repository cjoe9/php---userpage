<style>
.b-bar{
    width:100%;
    display: flex;
    justify-content: center;
    align-items: center;
    font-family:Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
}
.con{
    width: 60%;
    text-align: center;
}
.sbtn{
    display: block;
    height:35px;
    font-family:Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
    font-size:16px;
    width:100px;
    margin: 0 10px;
    position:relative;
    top:23px;
    padding:3px 10px 3px 10px;
    background-color:white;
}
.sbtn:hover{
    background-color: black;
    color:white;
    transition: 0.2s;
    cursor: pointer;
}
form{
    display:flex;
    flex-direction:column;
}
.z{
    display:flex;
    width:80%;
    justify-content:space-between;
    align-items:center;
}
.z input{
    height:28px;
    width:70%;
}
.a{
    padding-left: 10px;
}
.b{
    color:red;
}
.cc{
    width: 100%;
    display: flex;
    justify-content: center;
}
.g{
    color:green;
}
.f{
    text-decoration: none;
    color:gray;
}
.f:hover{
    color: blue;
}
@media screen and (min-width:300px) and (max-width:550px){
    .sbtn{
        top:10px;
    }
    .con{
        width: 100%;
    }
}
</style>
<?php 
/* session_start();                uncomment this when combine the file             
   $_SESSION['id']= $student_id;
*/
$student_id = '2';/* <--------------------  delete this row aswell         */
$ok = "";
$error = array();

    require_once('mysqli_connect.php');
    DEFINE('db_name', 'user');
    mysqli_select_db($dbc, db_name);
    $q = "SELECT * from user_info where u_id='$student_id'";
    $result = @mysqli_query($dbc, $q);
    while ($row = mysqli_fetch_array($result)) {
        $email=$row['u_email'];
    }
    
    function check_pass(){
        $error = array();
        global $ck_email, $new_pass, $con_pass, $email;
        if($ck_email == NULL){
            $error['email'] = "Please enter your email.";
        }
        else if($ck_email != $email){
            $error['email'] = "Wrong email has been entered.";
        }
        if($new_pass == NULL || $con_pass == NULL){
            $error['pass'] = "Please enter your password.";
        }
        else if($new_pass != $con_pass){
            $error['pass'] = "Wrong confirm password entered.";
        }
        return $error;
    }
    
    if(isset($_POST['save'])){
        $ck_email = $_POST['email'];
        $new_pass = $_POST['new_pass'];
        $con_pass = $_POST['con_pass'];
        $error = check_pass();
        
        if(empty($error)){
            $q = "UPDATE user_info SET u_pass = sha1('$new_pass') where u_id='$student_id'";
            $result = @mysqli_query($dbc, $q);
            if($result){
                $ok = "Password has been successfully changed";
            }
            else{
                $error = "Password change failed due to system error. Try again later";
            }
        }
    }
?>
<div class="b-bar">
    <div class="con">
        <form method="post" action="forg_pass.php">
            <h1>FORGET PASSWORD</h1>
            <?php echo "<p class='g'>$ok</p>"; ?>
            <?php
            foreach($error as $value){
                echo "<p class='b'>$value</p>"; 
            }
            ?>
            <div class="z">
                <p class="b">USER ID  : </p>
                <input type="text" class="a" name="id" placeholder="<?php echo $student_id ?>" disabled/>
            </div>
            <div class="z">
            <p class="b">EMAIL  :</p>
                <input type="text" class="a" name="email" value=""/>
            </div>
            <div class="z">
                <p class="b">NEW PASSWORD  :</p>
                <input type="password" class="a" name="new_pass" value=""/>
            </div>
            <div class="z">
                <p class="b">CONFIRM PASSWORD  :</p>
                <input type="password" class="a" name="con_pass" value=""/>
            </div>
            <div class="cc">
                <input type="submit" class="sbtn" name="save" value="SAVE"/>
                <input type="button" class="sbtn" value="CANCEL" onclick="location='u_info.php'"/>
            </div>
        </form>
    </div>
</div>