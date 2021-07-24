<?php
require_once('db.php');
class functions
{
    public function display_records()
    {
        $result = $conn->prepare("SELECT * FROM employee ORDER BY eid DESC");
        $result->execute();
        return $result->fetchAll(PDO::FETCH_OBJ);
    }
}