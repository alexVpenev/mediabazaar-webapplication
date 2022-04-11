<?php
    class User
    {
        private $employee_ID;
        private $firstName;
        private $lastName;
        private $email;
        private $dateOfBirth;
        private $phone;
        private $address;
        private $maritalStatus;
        private $bsn;
        private $fulltime;
        private $fte;
        private $hourlyWage;
        private $emergencyContact;
        private $departmentID;
        private $departmentName;
        private $position;

    function __construct($employee_ID)
    {
        try {
            global $dbcon;
            $stmt = $dbcon->prepare("SELECT * FROM employee WHERE Employee_ID = :id");
            $stmt->execute(array(':id' => $employee_ID));
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->employee_ID = $row['Employee_ID'];
            $this->email = $row['Email'];
            $this->firstName = $row['FirstName'];
            $this->lastName = $row['LastName'];
            $this->phone = $row['Phone'];
            $this->address = $row['Address'];
            $this->emergencyContact = $row['EmergencyContact'];
            $this->dateOfBirth = $row['DateOfBirth'];
            $this->hourlyWage = $row['HourlyWage'];
            $this->maritalStatus = $row['MaritalStatus'];
            $this->bsn = $row['BSN'];
            $this->fulltime = $row['Fulltime'];
            $this->fte = $row['FTE'];
            $this->departmentID = $row['DepartmentID'];
            $this->departmentName = $row['DepartmentName'];
            $this->position = $row['Position'];




        } catch (PDOException $e) {
            die($e->getMessage());
            return false;
        }
    }

    public function getEmail()
    {
        return $this->email;
    }
    public function getFirstName()
    {
        return $this->firstName;
    }
    public function getLastName()
    {
        return $this->lastName;
    }
    public function getAddress()
    {
        return $this->address;
    }
    public function getPhone()
    {
        return $this->phone;
    }
    public function getEmergencyContact()
    {
        return $this->emergencyContact;
    }
    public function getDateOfBirth()
    {
        return $this->dateOfBirth;
    }
    public function getMaritalStatus()
    {
        return $this->maritalStatus;
    }
    public function getBSN()
    {
        return $this->bsn;
    }
    public function getFulltime()
    {
        return $this->fulltime;
    }
    public function getFTE()
    {
        return $this->fte;
    }
    public function getHourlyWage()
    {
        return $this->hourlyWage;
    }
    public function getDepartmentID()
    {
        return $this->departmentID;
    }
    public function getDepartmentName()
    {
        return $this->departmentName;
    }
    public function getPosition()
    {
        return $this->position;
    }

    
    public function changePassword($employee_ID, $oldPassword, $newPassword)
    {
        if($this->checkIfOldPasswordIsCorrect($employee_ID, $oldPassword))
        {
            try {
                global $dbcon;
                $query = 'UPDATE employee SET Password = :pass WHERE Employee_ID = :id';
                $values = array(':pass' => $newPassword, ':id' => $employee_ID);
                $res = $dbcon->prepare($query);
                $res->execute($values);
                //$row = $stmt->fetch(PDO::FETCH_ASSOC);
                return true;
            } catch (PDOException $e) {
                die($e->getMessage());
                return false;
            }
        }
        else 
        {
            return false;
        }
    }

    public function checkIfOldPasswordIsCorrect($employee_ID, $password): bool
    {
        try {
            global $dbcon;
            $stmt = $dbcon->prepare("SELECT Password FROM employee WHERE Employee_ID = :id");
            $stmt->execute(array(':id' => $employee_ID));
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die($e->getMessage());
            return false;
        }

        if ($row['Password'] == $password) {
            return true;
        } else {
            return false;
        }
    }


    public function EditInfo($id, $email, $fname, $lname, $phone, $addr, $cont) 
    {
        try {
            global $dbcon;
            $query = 'UPDATE employee SET Email = :email, FirstName = :fname, LastName = :lname,  Phone = :phone, Address = :addr, EmergencyContact = :cont WHERE Employee_ID = :id';
            $values = array(':id' => $id, ':email' => $email, ':fname' => $fname, ':lname' => $lname, ':phone' => $phone, ':addr' => $addr, ':cont' => $cont );
            $res = $dbcon->prepare($query);
            $res->execute($values);
            //$row = $stmt->fetch(PDO::FETCH_ASSOC);
            return true;
        } catch (PDOException $e) {
            die($e->getMessage());
            return false;
        }
    }

    public function checkMorning($employee_ID, $date): bool
    {
        try {
            global $dbcon;
            $stmt = $dbcon->prepare("SELECT ShiftTime FROM shift WHERE Employee_ID = :id AND ShiftDate = :date AND ShiftTime = 'Morning'");
            $stmt->execute(array(':id' => $employee_ID, ':date' => $date));
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die($e->getMessage());
            return false;
        }

        if($row['ShiftTime'] == 'Morning')
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function CreateUnavailability($employee_ID, $date) {
        //INSERT INTO `availability` (`Employee_ID`, `AvailabilityDate`) VALUES ('20', '2021-05-25 04:50:06')
        try {
            global $dbcon;
            $stmt = $dbcon->prepare("INSERT INTO `availability` (`Employee_ID`, `AvailabilityDate`) VALUES (:id, :date)");
            $stmt->execute(array(':id' => $employee_ID, ':date' => $date));
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function checkAvailability($employee_ID, $date): bool
    {
        try {
            global $dbcon;
            $stmt = $dbcon->prepare("SELECT AvailabilityDate FROM availability WHERE Employee_ID = :id AND  AvailabilityDate = :date");
            $stmt->execute(array(':id' => $employee_ID, ':date' => $date));
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die($e->getMessage());
            return false;
        }

        if($stmt->rowCount() > 0){
			return true;;
		}
        else
        {
            return false;
        }
    }

    public function checkAfternoon($employee_ID, $date): bool
    {
        try {
            global $dbcon;
            $stmt = $dbcon->prepare("SELECT ShiftTime FROM shift WHERE Employee_ID = :id AND ShiftDate = :date AND ShiftTime = 'Afternoon'");
            $stmt->execute(array(':id' => $employee_ID, ':date' => $date));
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die($e->getMessage());
            return false;
        }

        if($row['ShiftTime'] == 'Afternoon')
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function checkEvening($employee_ID, $date): bool
    {
        try {
            global $dbcon;
            $stmt = $dbcon->prepare("SELECT ShiftTime FROM shift WHERE Employee_ID = :id AND ShiftDate = :date AND ShiftTime = 'Evening'");
            $stmt->execute(array(':id' => $employee_ID, ':date' => $date));
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die($e->getMessage());
            return false;
        }

        if($row['ShiftTime'] == 'Evening')
        {
            return true;
        }
        else
        {
            return false;
        }
    }

}
