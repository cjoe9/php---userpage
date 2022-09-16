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
    
    require_once('mysqli_connect.php');
    DEFINE('db_name', 'user');
    mysqli_select_db($dbc, db_name);
    $q = "SELECT * from user_info where u_id='$student_id'";
    $result = @mysqli_query($dbc, $q);
    while ($row = mysqli_fetch_array($result)) {
        $name=$row['u_name'];
        $email=$row['u_email'];
        $phone=$row['u_phone'];
        $address = $row['u_address'];
    }
    
?>
<div class="b-bar">
    <div class="con">
        <form method="post" action="u_confirm.php">
            <h1>USER EDIT FORM</h1>
            <div class="z">
                <p class="b">USER ID  : </p>
                <input type="text" class="a" name="id" placeholder="<?php echo $student_id ?>" disabled/>
            </div>
            <div class="z">
                <p class="b">NAME     :</p>
                <input type="text" class="a" name="name" placeholder="<?php echo $name ?>" 
                       value="<?php if(isset($_COOKIE['name'])){ echo $_COOKIE['name']; } ?>"/>
            </div>
            <div class="z">
                <p class="b">EMAIL    :</p>
                <input type="text" class="a" name="email" placeholder="<?php echo $email ?>"
                       value="<?php if(isset($_COOKIE['email'])){ echo $_COOKIE['email']; } ?>"/>
            </div>
            <div class="z">
                <p class="b">HANDPHONE :</p>
                <input type="text" class="a" name="ph" placeholder="<?php echo $phone ?>"
                       value="<?php if(isset($_COOKIE['phone'])){ echo $_COOKIE['phone']; } ?>"/>
            </div>
            <div class="z">
                <p class="b">ADDRESS    :</p>
                <input type="text" class="a" name="address" placeholder="<?php echo $address ?>"
                       value="<?php if(isset($_COOKIE['address'])){ echo $_COOKIE['address']; } ?>"/>
            </div>
            <div class="cc">
                <input type="submit" class="sbtn" name="save" value="SAVE"/>
                <input type="button" class="sbtn" value="CANCEL" onclick="location='u_info.php'"/>
            </div>
        </form>
    </div>
</div>