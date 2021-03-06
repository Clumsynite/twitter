<?php

    class follow{

        private $db;

        function __construct($conn){
            $this->db=$conn;
        }

        public function startFollowing($user, $follower){
            try {

                $check = $this->checkFollowState($user, $follower);
                if ($check) {
                    return false;
                } else {
                    $sql = "INSERT INTO following (user, follower) VALUES (:user, :flr)";
                    $stmt = $this->db->prepare($sql);
                    $stmt->bindparam(":user", $user);
                    $stmt->bindparam(":flr", $follower);
                    $stmt->execute();
                    return true;
                }
            } catch (PDOExecution $e) {
                echo $e->getMessage();
                return false;
            }
        }

        public function getFollowingTweets($name){
            try{
                $sql = "SELECT authorName, body, created FROM tweets t join following f on f.user = authorName where follower = '$name' ORDER BY created DESC" ;
                $result = $this->db->query($sql);
                return $result;
            } catch (PDOExecution $e) {
                echo $e->getMessage();
                return false;
            }
        }

        public function getFollowing($username){
            try{
                $sql = "SELECT * FROM `following` WHERE follower = '$username'";
                $result = $this->db->query($sql);
                return $result;
            } catch (PDOExecution $e) {
                echo $e->getMessage();
                return false;
            }

        }

        public function getFollowingCount($username){
            try{
                $sql = "SELECT count(*) as num FROM following where follower = :username";
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

        public function checkFollowState($user, $follower){
            try{
                $sql = "SELECT * FROM following WHERE user = :user AND follower = :follower";
                $stmt = $this->db->prepare($sql);
                $stmt->bindparam(":user", $user);
                $stmt->bindparam(":follower", $follower);
                $stmt->execute();
                $result = $stmt->fetch();
                return $result;
            } catch (PDOExecution $e) {
                echo $e->getMessage();
                return false;
            }
        }

        public function unfollow($user, $follower){
            try {

                $check = $this->checkFollowState($user, $follower);
                if (!$check) {
                    return false;
                } else {
                    $sql = "DELETE FROM `following` WHERE user = :user and follower = :follower";
                    $stmt = $this->db->prepare($sql);
                    $stmt->bindparam(":user", $user);
                    $stmt->bindparam(":follower", $follower);
                    $stmt->execute();
                    return true;
                }
            } catch (PDOExecution $e) {
                echo $e->getMessage();
                return false;
            }
        }

        public function getFollowers($user){
            try {
                $sql = "SELECT * from following where user = '$user'";
                $result = $this->db->query($sql);
                return $result;
            } catch (PDOExecution $e) {
                echo $e->getMessage();
                return false;
            }
        }

        public function checkFollowerState($user, $follower){
            try{
                $sql = "SELECT * FROM following WHERE follower = :user AND user = :follower";
                $stmt = $this->db->prepare($sql);
                $stmt->bindparam(":user", $user);
                $stmt->bindparam(":follower", $follower);
                $stmt->execute();
                $result = $stmt->fetch();
                return $result;
            } catch (PDOExecution $e) {
                echo $e->getMessage();
                return false;
            }
        }

        public function getFollowerCount($username){
            try{
                $sql = "SELECT count(follower) as num FROM following where user = :username";
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

        
    }

?>