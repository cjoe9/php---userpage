<style>
    .status{
        margin-top:50px;
        width:100%;
        display:flex;
        flex-direction:column;
        align-items:center;
        text-align:center;
        font-family:Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
    }
    .tick{
        width:300px;
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
        font-size:20px;
        text-decoration: none;
        padding: 5px;
        border: 1px solid grey;
        background-color: lightgrey;
        color: black;
        border-radius: 5px;
        box-shadow: 3px 3px 3px lightgrey;
    }
    .e:hover{
        background-color: gray;
        transform: translate(2px,2px);
        transition: 0.5s;
    }
    .back{
        width:80px;
        height:50px;
        cursor: pointer;
    }
</style>
<?php
$student_id = $_POST['id'];

function detectInputError() {
    date_default_timezone_set('Asia/Kuala_Lumpur');
    global $date, $st_time, $en_time, $numpax;
    $today = date("Y-m-d");
    $now_hour = date("H");

    $error = array();

    if ($date == NULL) {
        $error['date'] = "Please select the date.";
    } else if ($date < $today) {
        $error['date'] = "Selected day must be greater or equal to today.";
    } else if (!preg_match('/^[0-9]{4}-[0-1][0-9]-[0-3][0-9]$/', $date)) {
        $error['date'] = "Please follow the date format (YYYY-MM-DD).";
    }
    if ($st_time == NULL) {
        $error['st_time'] = "Please select the starting time.";
    } else if ($st_time < $now_hour) {
        $error['st_time'] = "The hour selected cannot be earlier than now.";
    }
    if ($en_time == NULL) {
        $error['en_time'] = "Please select the ending time.";
    }
    if ($numpax == "") {
        $error['numpax'] = "Please select number of person booking.";
    } else if (!preg_match('/^\d$/', $numpax)) {
        $error['numpax'] = "Please choose a number in the range [1 - 9].";
    }
    if ($st_time != NULL && $en_time != NULL) {
        if ($st_time >= $en_time) {
            $error['time'] = "Start-time cannot be late than and same with end-time.";
        }
    }
    return $error;
}

if (isset($_POST['submit'])) {
    $date = $_POST['date'];
    $dt = str_replace('/', '-', $date);
    $dt = date('l, F d, Y', strtotime($date));
    if(isset($_POST['st_time'])){
        $st_time = $_POST['st_time'];
    }
    if(isset($_POST['en_time'])){
        $en_time = $_POST['en_time'];
    }
    $numpax = $_POST['numpax'];

    $error = detectInputError();

    if (empty($error)) {
        $st_time = (int) $st_time;
        if ($st_time > 12) {
            $st_time -= 12;
            $st_time = (string) $st_time;
            $st_time .= ".00PM";
        } else {
            $st_time = (string) $st_time;
            $st_time .= ".00AM";
        }
        $en_time = (int) $en_time;
        if ($en_time > 12) {
            $en_time -= 12;
            $en_time = (string) $en_time;
            $en_time .= ".00PM";
        } else {
            $en_time = (string) $en_time;
            $en_time .= ".00AM";
        }
        require_once('mysqli_connect.php');
        DEFINE('db_name', 'booking');
        mysqli_select_db($dbc, db_name);

        $q = "INSERT INTO book_info (u_id, b_date, b_start, b_end, b_pax)
                  VALUES('$student_id', '$date', '$st_time', '$en_time', '$numpax')";
        $result = @mysqli_query($dbc, $q);

        if ($result) {
            printf('
            <div class="status">
                <p class="a">YOUR BOOKING HAVE BEEN CONFIRMED</p>
                <img src="photo/correct.gif" class="tick"/>
                <p class="b">Your have scheduled the time as following</p> 
                <p class="c">%s - %s<br>
                %s<br>
                Number(s) of person : %s</p>    
                <p class="d">Kindly shows the booking record to make payment at the gym counter.</p>
                <a href="booking.php" class="e">Back to Home</a> 
            </div>
            ', $st_time, $en_time, $dt, $numpax);
        } else {
            echo 'failed to booking due to system error.';
        }
    } else {
        printf('
            <div class="status">
                <h1>OOPS... There are input errors</h1>
                <ul style="color:red">
                   <li>%s</li>
                </ul>
                <p>click the back button to edit the form</p>
                <button onclick="history.go(-1);" class="back">Back </button>
            </div>
            ', implode('</li><li>', $error));
    }
}



