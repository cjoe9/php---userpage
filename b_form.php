<style>
.form{
    width: 100%;
    font-family:Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
    margin-top:50px;
}
.form-field{
    display: flexbox;
    width: 304px;
    margin: auto;
    justify-content: space-between;
}
.info{
    display: flex;
    width: 304px;
    margin: auto;
    justify-content: space-between;
}
.info input{
    border:none;
    font-weight:bold;
    font-size:14px;
}
.form-field input{
    width: 300px;
    height: 30px;
    text-align: center;
}
.star{
    color: red;
}
.form-field .op{
    color: lightslategray;
    letter-spacing: 1px;
    font-style: italic;
}
.form-field select{
    width: 149px;
    height: 30px;
    text-align: center;
}
.form-field p{
    font-size: 14px;
}
.rev{
    text-align: center;
    font-weight: bold;
    font-size: 24px;
    letter-spacing: 5px;
    color: red;
}
.tnc{
    font-size: 12px;
    color: lightslategray;
    font-style: italic;
}
.tnc a{
    color: rgb(35, 136, 244);
    text-decoration: none;
}
.btn{
    width: 100px;
    height: 40px;
    margin: 25px auto 0;
    display: block;
    cursor: pointer;
}
</style>
<?php 
require_once('mysqli_connect.php');
DEFINE('db_name', 'user');
mysqli_select_db($dbc, db_name);

$q = "SELECT u_id as id,u_name as name,u_email as email from user_info where u_id='$student_id'";
$result = @mysqli_query($dbc, $q);

while ($row = mysqli_fetch_array($result)) {
    $name=$row['name'];
    $email=$row['email'];
}
?>
            <form action="b_confirm.php" method="post" class="form">
                <p class="rev">Online Reservation</p>
                <div class="info">
                    <p class="star">USER ID : </p>
                    <input type="text" name="id" value="<?php echo $student_id; ?>" readonly/>
                    <input type='hidden' value="<?php echo $student_id ?>" name='id'/>
                </div>
                <div class="info">
                    <p class="star">NAME : </p>
                    <input type="text" name="name" id="name" value="<?php echo $name; ?>" readonly/>
                </div>
                <div class="info">
                    <p class="star">EMAIL : </p>
                    <input type="text" name="email" value="<?php echo $email; ?>" readonly/>
                </div>
                <div class="form-field">
                    <p>DATE <span class="star">*</span></p>
                    <input type="date" name="date" placeholder="YYYY-MM-DD"/>
                </div>
                <div class="form-field">
                    <p>TIME DURATION <span class="star">*</span></p>
                    <select name="st_time" id="st_time">
                        <option value="" disabled selected hidden>Start-time</option>
                        <option value="9">9.00am</option>
                        <option value="10">10.00am</option>
                        <option value="11">11.00am</option>
                        <option value="12">12.00pm</option>
                        <option value="13">1.00pm</option>
                        <option value="14">2.00pm</option>
                        <option value="15">3.00pm</option>
                        <option value="16">4.00pm</option>
                        <option value="17">5.00pm</option>
                        <option value="18">6.00pm</option>
                        <option value="19">7.00pm</option>
                        <option value="20">8.00pm</option>
                        <option value="21">9.00pm</option>
                    </select>
                    <select name="en_time" id="en_time">
                        <option value="" disabled selected hidden>End-time</option>
                        <option value="10">10.00am</option>
                        <option value="11">11.00am</option>
                        <option value="12">12.00pm</option>
                        <option value="13">1.00pm</option>
                        <option value="14">2.00pm</option>
                        <option value="15">3.00pm</option>
                        <option value="16">4.00pm</option>
                        <option value="17">5.00pm</option>
                        <option value="18">6.00pm</option>
                        <option value="19">7.00pm</option>
                        <option value="20">8.00pm</option>
                        <option value="21">9.00pm</option>
                        <option value="22">10.00pm</option>
                    </select>
                </div>
                <div class="form-field">
                    <p>NUMBER OF PAX <span class="star">*</span></p>
                    <input type="text" name="numpax" placeholder="maximun 9 person at once"/>
                </div>
                <div class="form-field">
                    <p class="tnc">by clicking the submit button will be considered as the user accepted the <a href="#">terms and conditions</a>.</p>
                </div>
                <button type="submit" name="submit" class="btn">SUBMIT</button>
            </form>