<?php
$ok = "";
$no = "";
/* session_start();                uncomment this when combine the file             
   $_SESSION['id']= $student_id;
*/
$student_id = '2';/* <--------------------  delete this row aswell         */
if(isset($_POST['submit'])){
require_once('mysqli_connect.php');
DEFINE('db_name', 'feedback');
mysqli_select_db($dbc, db_name);
$subject = $_POST['subject'];
$feedback = $_POST['feedback'];
if($subject == NULL || $feedback == NULL){
    $no = "The subject and feedback area cannot be empty.<br>";
}
else{
    $q = "INSERT INTO message (u_id, subject, message) 
                VALUES ('$student_id', '$subject', '$feedback')";
            $r = @mysqli_query($dbc, $q);
            
            if ($r) {
                $ok = "Feedback has send successfully.<br>";
            } else {
                $no = "Feedback failed to send out due to system error. Please try again later.<br>";
    		}
}
		
		mysqli_close($dbc);
}
?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8"/>
        <link href="faq.css" rel="stylesheet"/>
        <link href="header.css" rel="stylesheet"/>
        <link href="footer.css" rel="stylesheet"/>
    </head>
    <body>
        <?php include 'header.php';?>
            <section class="container1">
                <p class="title">Frequently Asked Questions</p>
                <ul class="faq">
                    <li>
                        <details>
                            <summary class="q">
                                <span class="ar"></span>
                                <span>How to register as a member ?</span>
                            </summary>
                            <div class="a">
                                <p>Click on the user icon at the top right of the website header to
                                    navigate to the membership register page and create a user account.</p>
                            </div>
                        </details>
                    </li>
                    <li>
                        <details>
                            <summary class="q">
                                <span class="ar"></span>
                                <span>How to login to user page ?</span>
                            </summary>
                            <div class="a">
                                <p>Click on the user logo at the top right corner of the webiste header.</p>
                            </div>
                        </details>
                    </li>
                    <li>
                        <details>
                            <summary class="q">
                                <span class="ar"></span>
                                <span>How to reset password ?</span>
                            </summary>
                            <div class="a">
                                <p>Click on the forget password at the login page and you will be navigate to the pages to
                                    reset your password.
                                </p>
                            </div>
                        </details>
                    </li>
                    <li>
                        <details>
                            <summary class="q">
                                <span class="ar"></span>
                                <span>How to make payment ?</span>
                            </summary>
                            <div class="a">
                                <p>The payment can be make at the reception counter at the gym,
                                    There is currently no online payment method for Dynamic Gym.
                                </p>
                            </div>
                        </details>
                    </li>
                    <li>
                        <details>
                            <summary class="q">
                                <span class="ar"></span>
                                <span>How to register as a member ?</span>
                            </summary>
                            <div class="a">
                                <p>Click on the user icon at the top right of the website header to
                                    navigate to the membership register page and create a user account.</p>
                            </div>
                        </details>
                    </li>
                    <li>
                        <details>
                            <summary class="q">
                                <span class="ar"></span>
                                <span>How to contact customer service ?</span>
                            </summary>
                            <div class="a">
                                <p>Navigate to the footer of the website and click on the contact us selection.</p>
                            </div>
                        </details>
                    </li>
                    <li>
                        <details>
                            <summary class="q">
                                <span class="ar"></span>
                                <span>How to contact customer service ?</span>
                            </summary>
                            <div class="a">
                                <p>Navigate to the footer of the website and click on the contact us selection.</p>
                            </div>
                        </details>
                    </li>
                    <li>
                        <details>
                            <summary class="q">
                                <span class="ar"></span>
                                <span>How to apply event registeration ?</span>
                            </summary>
                            <div class="a">
                                <p>Click the event on the home page and you will be navigate to the event register page.</p>
                            </div>
                        </details>
                    </li>
                    <li>
                        <details>
                            <summary class="q">
                                <span class="ar"></span>
                                <span>How to apply gym booking ?</span>
                            </summary>
                            <div class="a">
                                <p>Click on the gym booking on the home page and you will be navigate to the booking form.</p>
                            </div>
                        </details>
                    </li>
                    <li>
                        <details>
                            <summary class="q">
                                <span class="ar"></span>
                                <span>Where is the address of the Dynamic Gym ?</span>
                            </summary>
                            <div class="a">
                                <p>No.999 lorong hala timah 4, Jalan kampar, 36700, kampar, perak.</p>
                            </div>
                        </details>
                    </li>
                </ul>
                <form method="post" action="faq.php" class="form">
                    <div class="block">
                        <p class="title" style="margin: 50px 0;">Feedback</p>
                        <div class="a">
                            <span>Subject  &nbsp;&nbsp;</span>
                            <input type="text" name="subject" class="ex"/>
                        </div>
                        <div class="a">
                            <span style="vertical-align:top;">Message</span>
                            <textarea name="feedback" rows="5" class="ex" style="overflow:hidden"></textarea>
                        </div>
                    </div>
                    <?php echo "<p class='s'>$ok</p>"; 
                          echo "<p class='f'>$no</p>";
                    ?>
                    <input type="submit" name="submit" value="Submit" class="btn"/>
                </form>
            </section>
        <?php include 'footer.php';?>
    </body>
</html>