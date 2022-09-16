<!DOCTYPE HTML>
<style>
    .s-block{
        width: 100%;
        text-align: center;
    }
    .sbtn{

        border:2px solid black;
        color:black;
        padding:5px 35px 5px 35px;
    }
    .sbtn:hover{
        background-color: black;
        color:white;
        transition: 0.2s;
        cursor: pointer;
    }
    @media screen and (min-width:300px) and (max-width:1000px){
        .sbtn{
            padding: 0;
        }
    }
</style>
<script type="text/JavaScript">
    var loadus = function (event) {
            alert('Please click the save photo button on user info page to save the picture permanently.');
            var image = document.getElementById("user");
            image.src = URL.createObjectURL(event.target.files[0]);
    };
</script>

<div class="con-b">
    <div class="side">
        <div class="user">
            <label for="us" class="us">
                <span class="fa fa-camera"></span>
                <span>&nbsp;change picture</span>
            </label>
            <input type="file" id="us" name="us" onchange="loadus(event)"/>
            <img src="<?php echo $id_pic; ?>" id="user" alt="blank background"/>
        </div>
        <table class="side-bar">
            <tr>
                <td>
                    <a href="u_info.php">USER INFO</a>
                </td>
            </tr>
            <tr>
                <td>
                    <a href="u_pass.php">CHANGE PASSWORD</a>
                </td>
            </tr>
            <tr>
                <td>
                    <a href="u_booking.php">GYM BOOKING RECORD</a>
                </td>
            </tr>
            <tr>
                <td>
                    <a href="u_register.php">EVENT REGISTER RECORD</a>
                </td>
            </tr>
            <tr>
                <td>
                    <a href="#" class="logout">LOGOUT</a>
                </td>
            </tr>
        </table>
    </div>
</div>

