<?php
    class user{

        private $db;

        function __construct($conn){
            $this->db=$conn;
        }
        public function insertUser($username, $password){
            try {
                $result = $this->getUserByUsername($username);

                if($result['num']>0){
                    //echo 'This username is already present';
                    return false;
                }else{
                    $username = strtolower(trim($username));
                    $new_password = md5($password. $username);
                    // define sql statement to be executed
                    $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
                    // prepare the sql statement for execution
                    $stmt = $this->db->prepare($sql);
                    // bind all placeholders to the actual values
                    $stmt->bindparam(":username", $username);
                    $stmt->bindparam(":password", $new_password);
                    // execute statement
                    $stmt->execute();
                    return true;
                }

            } catch (PDOException $e) {
                echo $e->getMessage();
                return false;   
            }
        }

        public function getUser($username, $password){
            try{
                $sql = "SELECT * FROM users  WHERE username = :username AND password = :password";
                $stmt = $this->db->prepare($sql);
                $stmt->bindparam(":username", $username);
                $stmt->bindparam(":password", $password);
                $stmt->execute();
                $result = $stmt->fetch();
                return $result;
            } catch (PDOExecution $e) {
                echo $e->getMessage();
                return false;
            }
        }

        public function getUserByUsername($username){
            try{
                $sql = "SELECT count(*) as num FROM users  WHERE username = :username";
                $stmt = $this->db->prepare($sql);
                $stmt->bindparam(":username", $username);
                $stmt->execute();
                $result = $stmt->fetch();
                return $result;
            } catch (PDOExecution $e) {
                echo $e->getMessage();
                return false;
            }
        }

        public function getUserID($username, $password) {
            try {
                $sql = "SELECT userID FROM users WHERE username = :username AND password = :password";
                $stmt = $this->db->prepare($sql);
                $stmt->bindparam(":username", $username);
                $stmt->bindparam(":password", $password);
                $stmt->execute();
                $result = $stmt->fetch();
                return $result;
            } catch (PDOExecution $e) {
                echo $e->getMessage();
                return false;
            }
        }  

        public function getUsers(){
            try {
                $sql = "SELECT * from users ";
                $result = $this->db->query($sql);
                return $result;
            } catch (PDOExecution $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }
?>