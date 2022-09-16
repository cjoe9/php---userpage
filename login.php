<?php
session_start();
if(isset($_POST['login'])){
$id = $_POST['id'];
$_SESSION['id'] = $id;
header('Location: user.php');
}
?>
<html>
    <body>
        <form method='post' action='login.php'/>
            <input type='text' name='id' />
            <input type='submit' value='SUBMIT' name='login'/>
        </form>
    </body>
</html>



