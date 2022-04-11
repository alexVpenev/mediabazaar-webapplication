<?php
include_once 'head.php';
require_once "../classes/User.php";
require '..\form_handlers\db.php';
session_start();
$user = new User($_SESSION['EmployeeID']);

?>

<ul>
    <li><a href="schedule.php">Schedule</a></li>
    <li><a href="shifts.php">Availability</a></li>
    <li><a href="user_profile.php" class="active">My profile</a></li>
    <li class="right"><a href="../form_handlers/logout.php">Log out</a></li>
</ul>

<div class="input-group">
<form action="" method="POST">

    <label for="password">Old Password:</label>
    <input type="password" class="input" name="oldPass"><br><br>

    <label for="password">New Password:</label>
    <input type="password" class="input" name="newPass1"><br><br>

    <label for="password">Re-Enter New Password:</label>
    <input type="password" class="input" name="newPass2"><br><br>



    <button type="Update" name="Update" value="Update" style="text-align:center">Save</button><br>
    <a href="../views/user_profile.php" class="btn-back" style="padding-left:3.8%; padding-right:3.8%">Go back</a>

</form>
</div>
<?php

if (isset($_POST['Update'])) {
    if ($_POST['newPass1'] == $_POST['newPass2']) {
        if ($user->changePassword($_SESSION['EmployeeID'], $_POST['oldPass'], $_POST['newPass1'])) {

            header('Location: ../views/user_profile.php');

        } else {
?>
        <div class="added">
            <div id="success">
                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                <?php echo "Wrong old password"; ?>
            </div>
        <?php
        }
    } else {
        ?>
        <div id="success">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
            <?php echo "New passwords don't match"; ?>
        </div>
    </div>
<?php
    }
}





?>