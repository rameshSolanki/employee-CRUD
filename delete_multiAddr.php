<?php
require_once('db.php');

// sql to delete a record of address
$result = 0;
$aids = $_POST['aid'];
foreach ($aids as $aid) {
 $stmt = $conn->prepare("DELETE FROM eaddress WHERE aid = :aid");
 $stmt->bindParam(':aid', $aid, PDO::PARAM_INT);
 if($stmt->execute()){
   $result = 1;
 }
}
echo $result;
$conn = null;