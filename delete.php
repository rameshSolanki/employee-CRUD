<?php
require_once('db.php');

$get_id = $_GET['eid'];

// sql to delete a record employee
//$sql = "Delete from employee where eid = '$get_id'";
$sql = "DELETE c,p FROM eaddress c
INNER JOIN employee p ON c.employee_id = p.eid
WHERE employee_id = ?";
// use exec() because no results are returned
$stmt = $conn->prepare($sql);
$stmt->bindParam(1, $get_id);
deleteImage($conn, $get_id );
if ($stmt->execute()) {
  header('location:index.php');
}



// sql to delete a record of address
 $result = 0;
 $aid = intval($_POST['aid']);
 if(intval($aid)) {
  $stmt = $conn->prepare("DELETE FROM eaddress WHERE aid = :aid");
  $stmt->bindParam(':aid', $aid, PDO::PARAM_INT);
  if($stmt->execute()){
    $result = 1;
  }
}
echo $result;
$conn = null;

function deleteImage($conn, $get_id )
{
    $delete_sql = "SELECT * FROM employee WHERE eid=?";
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $delete_stmt = $conn->prepare($delete_sql);
    $delete_stmt->bindParam(1, $get_id );
    $delete_stmt->execute();
    $result = $delete_stmt->fetch();
     //print_r($result['photograph']);
    // die();
    unlink('uploads/' . $result['photograph']);
    // die();
}
