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
        display: block;
        width:80px;
        padding: 15px;
        margin: auto;
        cursor: pointer;
        color:white;
        background-color: red;
        position:relative;
        font-size:20px;
        text-decoration: none;
        vertical-align: middle;
        border-radius: 15px;
    }
    .e:hover{
    background-color: brown;
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
    if (isset($_POST['submit'])){
        require_once('mysqli_connect.php');
        DEFINE('db_name', 'event');
        mysqli_select_db($dbc, db_name);
        
        $error=array();
        
        $student_id=$_POST['u_id'];
        $ev_id=$_POST['ev_id'];
        $q = "SELECT ev_id FROM ev_book where u_id = '$student_id'";
        $result = @mysqli_query($dbc, $q);
        
        if(!isset($_POST['checked'])){
            $error['check'] = 'Please tick the agreement to proceed.';
        }
        while ($row = mysqli_fetch_array($result)){
            if($ev_id == $row['ev_id']){
                $error['registered']= "Sorry! You have already registered for this event.";
            }
        } 

        if(empty($error)){
            $q = "INSERT INTO ev_book (u_id, ev_id)
                  VALUES('$student_id', '$ev_id')";
            $result = @mysqli_query($dbc, $q);
            if($result){
            print('
            <div class="status">
                <p class="a">YOUR APPLY HAVE BEEN CONFIRMED</p>
                <img src="photo/correct.gif" class="tick"/>
                <p class="b">Participant Information</p> 
                <p class="d">Kindly shows the participant information to the event reception counter.</p>
                <a href="event.php" class="e">HOME</a> 
            </div>');
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
                <button onclick="history.go(-1);" class="back">Back </button>
            </div>
            ',implode('</li><li>',$error));
        }
    }
    ?>



