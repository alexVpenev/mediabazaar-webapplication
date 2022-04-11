<?php include_once 'head.php'; 
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

<?php echo'<h2>Hi ' . $user->getFirstName() . ' </h2>'; ?> 


<form action="" method="POST" class="input-group">
<div class="row">
    <div class="column1">

    <label for="email">Email:</label>
    <input type="email" class="input" value="<?php echo $user->getEmail() ?>" name="email"><br><br>

    <label for="fname">First Name:</label>
    <input type="fname" class="input" value="<?php echo $user->getFirstName() ?>" name="fname"><br><br>
    
    <label for="lname">Last Name:</label>
    <input type="lname" class="input" value="<?php echo $user->getLastName() ?>" name="lname"><br><br>

    <label for="address">Address:</label>
    <input type="address" class="input" value="<?php echo $user->getAddress() ?>" name="address"><br><br>

    <label for="phone">Phone:</label>
    <input type="phone" class="input" value="<?php echo $user->getPhone() ?>" name="phone"><br><br>

    <label for="phone">Emergency contact:</label>
    <input type="phone" class="input" value="<?php echo $user->getEmergencyContact() ?>" name="emergencyPhone"><br><br>

    <button type="Update" name="Update" value="Update" class="btn">Save changes</button>
    <a href="../views/resetPassword.php" class="btn">Change Password</a>

</div>
    <!--  Could you put these V on the right -->
    <div class="column2">

    <label for="dateOfBirth">Date of Birth:</label>
    <input type="input" class="input" value="<?php echo $user->getDateOfBirth() ?>" name="dateOfBirth" disabled><br><br>

    <label for="dateOfBirth">Marital Status:</label>
    <input type="input" class="input" value="<?php echo $user->getMaritalStatus() ?>" name="martStat" disabled><br><br>

    <label for="dateOfBirth">BSN:</label>
    <input type="input" class="input" value="<?php echo $user->getBSN() ?>" name="bsn" disabled><br><br>

    <label for="dateOfBirth">Hourly Wage:</label>
    <input type="input" class="input" value="<?php echo $user->getHourlyWage() ?>" name="hourlyWage" disabled><br><br>

    <label for="dateOfBirth">Fulltime:</label>
    <input type="input" class="input" value="<?php echo $user->getFulltime() ?>" name="fulltime" disabled><br><br>
    
    <label for="dateOfBirth">FTE:</label>
    <input type="input" class="input" value="<?php echo $user->getFTE() ?>" name="fte" disabled><br><br>

    <label for="dateOfBirth">Department:</label>
    <input type="input" class="input" value="<?php echo $user->getDepartmentName() ?>" name="departmentName" disabled><br><br>

    <label for="dateOfBirth">Position:</label>
    <input type="input" class="left" value="<?php echo $user->getPosition() ?>" name="position" disabled><br><br>

</div>


</div>
</form>


<?php 


if(isset($_POST['Update']))
{
    $user->EditInfo($_SESSION['EmployeeID'], $_POST['email'], $_POST['fname'], $_POST['lname'], $_POST['phone'], $_POST['address'], $_POST['emergencyPhone']);
    header('Refresh: 0');
}
















include 'footer.php' ?>