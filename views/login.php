<?php
session_start();
require '..\form_handlers\db.php';
require '../classes/User.php';
require 'head.php';
?>

<?php
if (isset($_POST['save'])) {
    $username = $_POST['Username'];
    $passwordAttempt = $_POST['Password'];

    if ($login->verifyLogin($username, $passwordAttempt)) {
        header("Location: schedule.php?=logged_in");
    } else {
?>
        <div class="wrong">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
            <?php echo "Wrong email or password!"; ?>
        </div>
<?php
    }
}
?>

<?php include 'head.php' ?>

</div>
<div class="logo">
<img src="../img/logo1.jpg" alt="Logo">
</div>

<form action="" method="post">
    <div class="box">
        <h1>Welcome!</h1>
        <div class="input-group-login">
            <label>Username</label>
            <input type="Username" name='Username' required><br>

            <label>Password</label>
            <input type="Password" name='Password' required><br>
        </div>
        <input type="submit" name='save' value="Log in" class="btn-login">

    </div>
</form>

<?php include 'footer.php' ?>