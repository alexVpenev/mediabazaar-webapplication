<?php
include_once 'head.php';
require_once "../classes/User.php";
require '..\form_handlers\db.php';
session_start();
$user = new User($_SESSION['EmployeeID']);
$message;

// if(!isset($_SESSION['sess_name']) || !isset($_SESSION['authorized'])){

//     header('Location: login.php?=wrong_pass');
//     exit();
// }
?>

<?php include 'head.php' ?>

<ul>
    <li><a href="schedule.php" class="active">Schedule</a></li>
    <li><a href="shifts.php">Availability</a></li>
    <li><a href="user_profile.php">My profile</a></li>
    <li class="right"><a href="../form_handlers/logout.php">Log out</a></li>
</ul>

<h2>View schedule</h2>

<form action="" method="POST">
    <button type="left" name="left" value="left" style="text-align:center">Left</button>
    <button type="right" name="right" value="right" style="text-align:center">Right</button>
</form>


<?php

if (isset($_POST['left'])) {
    $_SESSION['weekModifier']--;
}
if (isset($_POST['right'])) {
    $_SESSION['weekModifier']++;
}


$date = new DateTime();

if ($date->format('N') !== 1) {
    $date->sub(new DateInterval('P' . $date->format('N') . 'D'));
}

$interval = new DateInterval('P' . abs($_SESSION['weekModifier']) . 'W');

if ($_SESSION['weekModifier'] > 0) {
    $date->add($interval);
} else {
    $date->sub($interval);
}

$weekDays = array(
    "monday" => $date->add(new DateInterval('P1D'))->format("Y-m-d"),
    "tuesday" => $date->add(new DateInterval('P1D'))->format("Y-m-d"),
    "wednesday" => $date->add(new DateInterval('P1D'))->format("Y-m-d"),
    "thursday" => $date->add(new DateInterval('P1D'))->format("Y-m-d"),
    "friday" => $date->add(new DateInterval('P1D'))->format("Y-m-d"),
    "saturday" => $date->add(new DateInterval('P1D'))->format("Y-m-d"),
    "sunday" => $date->add(new DateInterval('P1D'))->format("Y-m-d")
);

//it doesnt work with a foreach function
//I couldn't find another way than to do this monstrosity
//fix in the future!

if ($user->checkMorning($_SESSION['EmployeeID'], $weekDays['monday'])) {
    $mm = "Morning";
} else {
    $mm = "";
}

if ($user->checkAfternoon($_SESSION['EmployeeID'], $weekDays['monday'])) {
    $ma = "Afternoon";
} else {
    $ma = "";
}

if ($user->checkEvening($_SESSION['EmployeeID'], $weekDays['monday'])) {
    $me = "Evening";
} else {
    $me = "";
}


if ($user->checkMorning($_SESSION['EmployeeID'], $weekDays['tuesday'])) {
    $tm = "Morning";
} else {
    $tm = "";
}

if ($user->checkAfternoon($_SESSION['EmployeeID'], $weekDays['tuesday'])) {
    $ta = "Afternoon";
} else {
    $ta = "";
}

if ($user->checkEvening($_SESSION['EmployeeID'], $weekDays['tuesday'])) {
    $te = "Evening";
} else {
    $te = "";
}





if ($user->checkMorning($_SESSION['EmployeeID'], $weekDays['wednesday'])) {
    $wm = "Morning";
} else {
    $wm = "";
}

if ($user->checkAfternoon($_SESSION['EmployeeID'], $weekDays['wednesday'])) {
    $wa = "Afternoon";
} else {
    $wa = "";
}

if ($user->checkEvening($_SESSION['EmployeeID'], $weekDays['wednesday'])) {
    $we = "Evening";
} else {
    $we = "";
}

if ($user->checkMorning($_SESSION['EmployeeID'], $weekDays['thursday'])) {
    $thm = "Morning";
} else {
    $thm = "";
}

if ($user->checkAfternoon($_SESSION['EmployeeID'], $weekDays['thursday'])) {
    $tha = "Afternoon";
} else {
    $tha = "";
}

if ($user->checkEvening($_SESSION['EmployeeID'], $weekDays['thursday'])) {
    $the = "Evening";
} else {
    $the = "";
}
if ($user->checkMorning($_SESSION['EmployeeID'], $weekDays['friday'])) {
    $fm = "Morning";
} else {
    $fm = "";
}

if ($user->checkAfternoon($_SESSION['EmployeeID'], $weekDays['friday'])) {
    $fa = "Afternoon";
} else {
    $fa = "";
}

if ($user->checkEvening($_SESSION['EmployeeID'], $weekDays['friday'])) {
    $fe = "Evening";
} else {
    $fe = "";
}


if ($user->checkMorning($_SESSION['EmployeeID'], $weekDays['saturday'])) {
    $satm = "Morning";
} else {
    $satm = "";
}

if ($user->checkAfternoon($_SESSION['EmployeeID'], $weekDays['saturday'])) {
    $sata = "Afternoon";
} else {
    $sata = "";
}

if ($user->checkEvening($_SESSION['EmployeeID'], $weekDays['saturday'])) {
    $sate = "Evening";
} else {
    $sate = "";
}




if ($user->checkMorning($_SESSION['EmployeeID'], $weekDays['sunday'])) {
    $sunm = "Morning";
} else {
    $sunm = "";
}

if ($user->checkAfternoon($_SESSION['EmployeeID'], $weekDays['sunday'])) {
    $suna = "Afternoon";
} else {
    $suna = "";
}

if ($user->checkEvening($_SESSION['EmployeeID'], $weekDays['sunday'])) {
    $sune = "Evening";
} else {
    $sune = "";
}



?>


<table>
    <tr>
        <th class="day-name">Monday <?php echo $weekDays['monday'];   ?></th>
        <th class="day-name">Tuesday <?php echo $weekDays['tuesday'];   ?></th>
        <th class="day-name">Wednesday <?php echo $weekDays['wednesday'];   ?></th>
        <th class="day-name">Thursday <?php echo $weekDays['thursday'];   ?></th>
        <th class="day-name">Friday <?php echo $weekDays['friday'];   ?></th>
        <th class="day-name">Saturday <?php echo $weekDays['saturday'];   ?></th>
        <th class="day-name">Sunday <?php echo $weekDays['sunday'];   ?></th>
    </tr>
    <tr>
        <td class="day"><span class="Shift"> <?php echo $mm; ?></span></td>
        <td class="day"><span class="Shift"><?php echo $tm; ?></span></td>
        <td class="day"><span class="Shift"><?php echo $wm; ?></span></td>
        <td class="day"><span class="Shift"><?php echo $thm; ?></span></td>
        <td class="day"><span class="Shift"><?php echo $fm; ?></span></td>
        <td class="day"><span class="Shift"><?php echo $satm; ?></span></td>
        <td class="day"><span class="Shift"><?php echo $sunm; ?></span></td>
    </tr>
    <tr>
        <td class="day"><span class="Shift"><?php echo $ma; ?></span></td>
        <td class="day"><span class="Shift"><?php echo $ta; ?></span></td>
        <td class="day"><span class="Shift"></span><?php echo $wa; ?></td>
        <td class="day"><span class="Shift"><?php echo $tha; ?></span></td>
        <td class="day"><span class="Shift"><?php echo $fa; ?></span></td>
        <td class="day"><span class="Shift"><?php echo $sata; ?></span></td>
        <td class="day"><span class="Shift"><?php echo $suna; ?></span></td>
    </tr>
    <tr>
        <td class="day"><span class="Shift"><?php echo $me; ?></span></td>
        <td class="day"><span class="Shift"><?php echo $te; ?></span></td>
        <td class="day"><span class="Shift"><?php echo $we; ?></span></td>
        <td class="day"><span class="Shift"><?php echo $the; ?></span></td>
        <td class="day"><span class="Shift"><?php echo $fe; ?></span></td>
        <td class="day"><span class="Shift"><?php echo $sate; ?></span></td>
        <td class="day"><span class="Shift"><?php echo $sune; ?></span></td>
    </tr>

</table>

<?php include 'footer.php' ?>