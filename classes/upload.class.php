<?php

class Upload extends Db {
    
    public function get() {

        $stmt = $this->conn()->prepare("SELECT * FROM dataset");

        try {

            $stmt->execute();

            return $stmt->fetchAll();

        } catch(PDOException $e) {
            return $e->getMessage();
        }
    }

    public function delete($id) {

        $stmt = $this->conn()->prepare("DELETE FROM dataset WHERE id = ?");

        try {

            $stmt->execute([$id]);
            
            return true;

        } catch(PDOException $e) {
            return $e->getMessage();
        }
    }

    public function deleteAll() {

        $sql = "DELETE FROM dataset";
        $stmt = $this->conn()->prepare($sql);

        try {

            $stmt->execute();
            
            return true;

        } catch(PDOException $e) {
            return $e->getMessage();
        }
    }

    public function save($specific_gravity, $ph, $osmolarity, $conductivity, $urea_concentration, $calcium_concentration, $predicted) {
        
        $stmt = $this->conn()->prepare("INSERT INTO dataset(specific_gravity, ph, osmolarity, conductivity, urea_concentration, calcium_concentration, predicted)
                                VALUES(?, ?, ?, ?, ?, ?, ?)");
        
        try {
            $stmt->execute([$specific_gravity, $ph, $osmolarity, $conductivity, $urea_concentration, $calcium_concentration, $predicted]);
    
            return true;

        }
        catch(PDOException $e) {
            return $e->getMessage();
        }
    }

    public function getUploadStats() {
        
        $sql = "SELECT DATE(date_added) AS day, COUNT(date_added) as users FROM dataset WHERE YEAR(date_added) = YEAR(CURDATE()) AND MONTH(date_added) = MONTH(CURDATE()) GROUP BY day ORDER BY day ASC;";
        $stmt = $this->conn()->prepare($sql);
        
        try {
            $stmt->execute();
    
            return $stmt->fetchAll();

        }
        catch(PDOException $e) {
            return $e->getMessage();
        }
    }

    public function getTargetStats() {
        
        $negative = $this->conn()->prepare("SELECT COUNT(predicted) AS negative FROM dataset WHERE predicted = 0");
        $positive = $this->conn()->prepare("SELECT COUNT(predicted) AS positive FROM dataset WHERE predicted = 1");
        
        try {
            $positive->execute();
            $negative->execute();
    
            return [$positive->fetch()->positive, $negative->fetch()->negative];
        }
        catch(PDOException $e) {
            return $e->getMessage();
        }
    }

    


}