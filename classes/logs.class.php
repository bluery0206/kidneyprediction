<?php

class Logs extends Db {

    public function insert($uname, $uaction) {
        $log = $this->conn()->prepare("INSERT INTO logs(uname, uaction) VALUES(?, ?);");
        
        try {

            $log->execute([$uname, $uaction]);

            return true;

        } catch(PDOException $e) {
            die($e->getMessage()) ;
        }
    }

    public function getLogsStats() {
        $sql = "SELECT uname, COUNT(*) AS total_uploads FROM logs WHERE uaction = 'upload' GROUP BY uname ORDER BY total_uploads DESC LIMIT 10;";
        $stmt = $this->conn()->prepare($sql);

        try {
            $stmt->execute();
    
            return $stmt->fetchAll();

        } catch(PDOException $e) {
            die($e->getMessage()) ;
        }
    }




}