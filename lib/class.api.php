<?php

/*
 * API for Mobile
 */

class api {

    private $db;

    function __construct($DB_con) {
        $this->db = $DB_con;
    }

    /*
     * Create New Data
     */

    public function getDialysisID($id) {
        $stmt = $this->db->prepare("SELECT * FROM dialisis WHERE dialisis_id=:id");
        $stmt->execute(array(":id" => $id));
        $editRow = $stmt->fetch(PDO::FETCH_ASSOC);
        return $editRow;
    }

    public function getDialysis($query) {
        //$dialysis = [];
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $row;
        }
    }

}
