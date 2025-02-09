<?php

class Db {
    protected function conn() {
        
        $hname  = "localhost";
        $uname  = "root";
        $pwd    = "";
        $dbname = "kidney_stone_prediction_db";
        
        $conn = new PDO("mysql:host=$hname;dbname=$dbname", $uname, $pwd);
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

        return $conn;
    }
}