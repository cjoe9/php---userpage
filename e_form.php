<style>
.apply{
    width: 60%;
    height:650px;
    margin: auto;
    background-color: white;
    font-family:Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
}
.apply .head{
    font-weight: bold;
    letter-spacing: 2px;
    text-align: center;
    color: red;
    margin-top: 60px;
}
.form{
    width: 100%;
    display: block;
    margin: auto;
    margin-top: 50px;
}
.form-field{
    width: 100%;
    height: 30px;
    display: flex;
    justify-content: space-evenly;
    margin-bottom: 30px;
}
.a1{
    color: red;
    width: 50%;
}
.w{
    width: 50%;
}
.rbtn{
    width: 280px;
    height: 40px;
    background-color: red;
    color: white;
    display: block;
    margin: 10px auto 0px;
    font-size: 16px;
    border-radius: 15px;
    font-weight: bold;
    border: none;
    box-shadow: 4px 4px 3px lightgrey;
    cursor: pointer;
}
.rbtn:hover{
    background-color: brown;
    transform: translate(2px,2px);
    transition: 0.5s;
}
td{
    text-align: center;
}
.t{
    padding-top: 50px;
    letter-spacing: 5px;
    text-decoration: underline;
    font-size: 16px;
}
.v{
    padding-top: 30px;
}
.z{
    border-collapse: collapse;
    box-shadow: 3px 3px 3px grey;
    padding: 5px;
}
.z td{
    padding: 8px;
}
.ck{
    font-size: 14px;
    font-style: oblique;
    color: grey;
}
.agree{

}
@media screen and (max-width: 450px){
    body{
        font-size: 10px;
    }
    .apply{
        position: relative;
        top: -50px;
        height: 600px;
        width: 100%;
    }
    .apply p{
        font-size: 14px;
    }
    .form{
        position: relative;
        top: 20px;
    }
    .apply .head{
        position: relative;
        top: 20px;
    }
    .rbtn{
        width:180px;
    }
    .ck{
    font-size: 10px;
    }
}
</style>
<?php
DEFINE('db_name2', 'user');
mysqli_select_db($dbc, db_name2);

$q = "SELECT u_name, u_email, u_phone from user_info where u_id='$student_id'";
$result = @mysqli_query($dbc, $q);

while ($row = mysqli_fetch_array($result)) {
    $u_name=$row['u_name'];
    $u_email=$row['u_email'];
    $u_phone=$row['u_phone'];
}

mysqli_free_result($result);
mysqli_close($dbc);
?>
<div class="apply">
    <h1 class="head">ONLINE EVENT REGISTRATION</h1>
    <form action="e_confirm.php" method="post" class="form">
        <table class="form-field">
            <tr class='z'>
                <td class='w'>NAME  :</td>
                <td class="a1"><?php echo $u_name ?></td>
            </tr>
            <tr class='z'>
                <td class='w'>EMAIL :</td>
                <td class="a1"><?php echo $u_email ?></td>
            </tr>
            <tr class='z'>
                <td class='w'>HANDPHONE :</td>
                <td class="a1"><?php echo $u_phone ?></td>
            </tr>
            <tr>
                <td colspan="2" class='t'>EVENT</td>
            </tr>
            <tr>
                <td colspan="2"><?php echo $ev_name ?></td>
            </tr>
            <tr>
                <td colspan="2"><?php echo $dt ?></td>
            </tr>
            <tr>
                <td colspan="2"><?php echo $ev_start.' - '.$ev_end ?></td>
            </tr>
            <tr>
                <td colspan="2">Register fees: RM<?php echo $ev_price ?></td>
            </tr>
            <tr>
                <td colspan="2" class='v'>
                    <input type='checkbox' name='checked[]' value='sure'>
                    <span class='ck'>I have read and agree to the privacy policy and term and conditions.</span>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type='hidden' value='<?php echo $student_id; ?>' name='u_id'/>
                    <input type='hidden' value='<?php echo $ev_id; ?>' name='ev_id'/>
                    <input type="submit" class="rbtn" name="submit" value='REGISTER'/>
                </td>
            </tr>
        </table>   
    </form>
</div>