<?php

class User extends Db {
    private $uname;

    public function __construct(String $uname = null) {
        $this->uname = $uname;
    }

    public function get() {

        $stmt = $this->conn()->prepare("SELECT * FROM users WHERE uname = ?");

        try {

            $stmt->execute([$this->uname]);

            return $stmt->fetch();

        } catch(PDOException $e) {
            die($e->getMessage()) ;
        }
    }

    public function getFromID($id) {

        $stmt = $this->conn()->prepare("SELECT * FROM users WHERE id = ?");

        try {

            $stmt->execute([$id]);

            return $stmt->fetch();

        } catch(PDOException $e) {
            die($e->getMessage()) ;
        }
    }

    public function getAll() {

        $stmt = $this->conn()->prepare("SELECT * FROM users");

        try {

            $stmt->execute();

            return $stmt->fetchAll();

        } catch(PDOException $e) {
            die($e->getMessage()) ;
        }
    }


    public function exists() {

        $stmt = $this->conn()->prepare("SELECT id FROM users WHERE uname = ?");

        try {

            $stmt->execute([$this->uname]);

            if ($stmt->rowCount() > 0) {

                return true;

            } else {
                return false;
            }
        } catch(PDOException $e) {
            die($e->getMessage()) ;
        }
    }

    public function save($lname, $mname, $fname, $utype, $uname, $pwd) {

        $stmt = $this->conn()->prepare("INSERT INTO users(lname, mname, fname, utype, uname, pwd)
                                VALUES(?, ?, ?, ?, ?, ?)");

        try {

            $stmt->execute([$lname, $mname, $fname, $utype, $uname, $pwd]);

            return true;

        } catch(PDOException $e) {
            die($e->getMessage()) ;
        }
    }

    public function edit($lname, $mname, $fname, $utype, $uname, $id) {

        $stmt = $this->conn()->prepare("UPDATE users SET lname = ?, mname = ?, fname = ?, utype = ?, uname = ? WHERE id = ?");

        try {

            $stmt->execute([$lname, $mname, $fname, $utype, $uname, $id]);

            return true;

        } catch(PDOException $e) {
            die($e->getMessage()) ;
        }
    }

    public function remove($id) {

        $stmt = $this->conn()->prepare("DELETE FROM users WHERE id = ?");

        try {

            $stmt->execute([$id]);

            return true;

        } catch(PDOException $e) {
            die($e->getMessage()) ;
        }
    }

    public function removeAll() {

        $stmt = $this->conn()->prepare("DELETE FROM users WHERE NOT id = ?");

        try {

            $stmt->execute([$this->uname]);

            return true;

        } catch(PDOException $e) {
            die($e->getMessage()) ;
        }
    }

    public function getUserStats() {

        $sql = "SELECT DATE(reg_date) AS day, COUNT(reg_date) as user FROM users WHERE YEAR(reg_date) = YEAR(CURDATE()) AND MONTH(reg_date) = MONTH(CURDATE()) GROUP BY day ORDER BY day ASC;";
        $stmt = $this->conn()->prepare($sql);

        try {
            $stmt->execute();
    
            return $stmt->fetchAll();

        } catch(PDOException $e) {
            die($e->getMessage()) ;
        }
    }
}
