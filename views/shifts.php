<?php 
include_once 'head.php';
require_once "../classes/User.php";
require '..\form_handlers\db.php';
session_start();
$user = new User($_SESSION['EmployeeID']);
$_SESSION['weekModifier'] = 0;
?>

<ul>        
    <li><a href="schedule.php">Schedule</a></li>
    <li><a href="shifts.php" class="active">Availability</a></li>  
    <li><a href="user_profile.php">My profile</a></li>            
    <li class="right"><a href="../form_handlers/logout.php">Log out</a></li>              
</ul>

<h2>Add work-shift availability</h2>

<div class="input-group">
<label for="email">Pick a day:</label>
<form action="" method="POST">
<input type="date" id="date" name="date">
<button type="upload" name="upload" value="upload" style="text-align:center">View</button>
</form>


</div>



<?php 

if(isset($_POST['upload'])) 
{
    $user->CreateUnavailability($_SESSION['EmployeeID'], $_POST['date']);

}

include 'footer.php' ?>

<!--

<div class="added">
    <div id="success">
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
             //echo "Unavailability added"; ?>
    </div>
</div>
-->