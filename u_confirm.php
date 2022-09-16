<style>
    .status{
        margin-top:10px;
        width:100%;
        display:flex;
        flex-direction:column;
        align-items:center;
        text-align:center;
        font-family:Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
    }
    .tick{
        width:300px;
        position:relative;
        top:-30px;
    }
    .a{
        font-size:26px;
        font-weight:bold;
        text-align:center;
        color:green;
        letter-spacing:2px;
    }
    .b{
        font-size:20px;
    }
    .c{
        color:#34C542;
        line-height:1.6em;
        letter-spacing:1px;
    }
    .d{
        font-style:italic;
    }
    .e{
        color:red;
        position:relative;
        top:-15px;
        font-size:20px;
    }
    .back,.home{
        display: block;
        width:100px;
        cursor: pointer;
        text-decoration: none;
        color: black;
        border:2px solid black;
        cursor: pointer;
        padding: 10px 0;
    }
    .back:hover, .home:hover{
        background-color: black;
        color:white;
        transition: 0.2s;
    }
</style>
<?php 
    require_once('mysqli_connect.php');
    DEFINE('db_name', 'user');   
    mysqli_select_db($dbc, db_name);
    
function detectInputError(){
    global $name,$email,$phone,$address,$num;
    $error=array();
    if ($name == NULL){
        $error['name']="Please enter your first name.";
    }
    else if (strlen($name)>50){
        $error['name']="Your name is too long. It must be within 50 characters.";
    }
    else if (!preg_match('/^[A-Za-z @,\'\.\-\/]+$/',$name)){
        $error['name']="There are invalid characters in your name.";
    }
    if ($email == NULL){
        $error['email']="Please enter your email.";
    }
    else if($num > 0){
        $error['email']="Email address has already been used.";
    }
    if (!filter_var($email,FILTER_VALIDATE_EMAIL)){
        $error['email']="Invalid email format.";
    }
    if ($phone == NULL){
        $error['phone']="Please enter your phone.";
    }
    else if (!preg_match('/^01\d-\d{7}$/',$phone)){
        $error['phone']="Your mobile phone number is invalid. FORMAT (01X-XXXXXXX)";
    }
    if ($address == NULL){
        $error['address']="Please enter your address.";
    }
 
    return $error;
}

    if (isset($_POST['save'])){
        /* session_start();                uncomment this when combine the file             
        $_SESSION['id']= $student_id;
        */
        $student_id = '2';/* <--------------------  delete this row aswell         */


        $name=trim($_POST['name']);
        $email=$_POST['email'];
        $phone=$_POST['ph'];
        $address=$_POST['address'];
        
        $em = "SELECT * FROM user_info WHERE u_email = '$email' AND NOT u_id = '$student_id'";
        $result = @mysqli_query($dbc, $em);
        $num = mysqli_num_rows($result);
    
        setcookie('name', $name);
        setcookie('email', $email);
        setcookie('phone', $phone);
        setcookie('address', $address);

        $error=detectInputError();

        if(empty($error)){
            $q = "UPDATE user_info SET u_name = '$name', u_email = '$email', u_phone = '$phone',
                u_address = '$address' where u_id = '$student_id'";
            $result = @mysqli_query($dbc, $q);
            if($result){
                print('
                <div class="status">
                    <p class="a">Change Successfully</p>
                    <img src="photo/correct.gif" class="tick"/>
                    <a href="u_info.php" class="home">HOME</a>
                </div>
                ');
            }else{
                echo '<h1>404 NOT FOUND, SYSTEM ERROR</h1>';
                echo '<a href="u_info.php" class="home">HOME</a>';
            }
        }
        else{
            printf('
            <div class="status">
                <h1>OOPS... There are input errors</h1>
                <ul style="color:red">
                   <li>%s</li>
                </ul>
                <p>click the back button to edit the form</p>
                <a href="u_edit.php" class="back">BACK</a>
            </div>
            ',implode('</li><li>',$error));
        }
    }
?>


