<?php
    class crud {

        private $db;

        function __construct($conn) {
            $this->db = $conn;
        }

        public function createTweet($id, $name, $body){
            try {
                
                // define sql statement to be executed
                $sql = "INSERT INTO tweets (authorId, authorName, body) VALUES (:id, :name, :body)";
                // prepare the sql statement for execution
                $stmt = $this->db->prepare($sql);
                // bind all placeholders to the actual values
                $stmt->bindparam(":id", $id);
                $stmt->bindparam(":name", $name);
                $stmt->bindparam(":body", $body);
                // execute statement
                $stmt->execute();
                return true;
            } catch (PDOException $e) {
                echo $e->getMessage();
                return false;   
            }
        }

        public function getTweetByAuthor($name) {
            try{
                $sql = "SELECT * FROM `tweets` WHERE authorName = '$name' ORDER BY created DESC";
                $result = $this->db->query($sql);
                return $result;
            } catch (PDOExecution $e) {
                echo $e->getMessage();
                return false;
            }
        }

        public function read(){            
            try{
                $sql = "SELECT * FROM `tweets` ORDER BY created DESC";
                $result = $this->db->query($sql);
                return $result;
            } catch (PDOExecution $e) {
                echo $e->getMessage();
                return false;
            }
        }
    }
?>