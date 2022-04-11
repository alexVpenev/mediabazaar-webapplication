<?php
    class Login
    {
        private $database;

        function __construct($dbcon)
        {
            $this->database = $dbcon;
        }

        public function verifyLogin($username, $password)
        {
            try
            {
                $stmt = $this->database->prepare("SELECT Employee_ID FROM employee WHERE Email = :email AND Password = :pass");               
                $stmt->execute(array(':email' => $username, ':pass' => $password));            
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                if($row === false)
                {
                    // die('Incorrect username / password combination!');
                    return false;
                }
                else
                {
                    // session_regenerate_id();
                    // $_SESSION["authorized"] = true;
                    // $_SESSION["sess_name"] = $row['Username'];
                    // $_SESSION["access"] = $row['Access'];
                    // session_write_close();

                    $_SESSION['EmployeeID'] = $row['Employee_ID'];
                }

                return true;
            }
            catch(PDOException $e)
            {
                die($e->getMessage());
                return false;
            }

        }

    }

?>