<?php
session_start();
require_once ('db.php');
global $email_exist, $success_msg ;

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email_check']) && $_POST['email_check'] == 1) {

    $mail = $_POST['mail'];

    $stmt = $conn->prepare("SELECT count(*) as cntMail FROM employee WHERE mail=:mail");
    $stmt->bindValue(':mail', $mail, PDO::PARAM_STR);
    $stmt->execute();
    $count = $stmt->fetchColumn();

    if($count > 0){
        echo "Sorry! email has already taken. Please try another.";
    }
    exit;
}
    if (isset($_POST['Submit'])) {

        move_uploaded_file($_FILES["image"]["tmp_name"],"uploads/" . $_FILES["image"]["name"]);

        $location = $_FILES["image"]["name"];
        $fname = $_POST['fname'];
        $mname = $_POST['mname'];
        $lname = $_POST['lname'];
        $gender = $_POST['gender'];
        $mail = $_POST['mail'];
        $mobile_no = $_POST['mobile_no'];
        $date_of_birth = $_POST['date_of_birth'];
        $e_status = $_POST['e_status'];

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO employee (fname, mname, lname, gender, mail, mobile_no, date_of_birth, e_status, photograph)
        VALUES ('$fname', '$mname', '$lname', '$gender', '$mail', '$mobile_no', '$date_of_birth', '$e_status', '$location')";

        $conn->exec($sql);

        $states = $_POST['states'];
        $country = $_POST['country'];
        $id = $conn->lastInsertId();

        foreach($_POST['add_line1'] as $k => $val) {

            $q2 = "INSERT INTO eaddress (employee_id, add_line1, states, country) VALUES ('$id', '$val', '$states', '$country')";
            $conn->exec($q2);
        }

            if(!$q2){

            } else {
            $_SESSION['message'] = 'Successfully Added !!!';
            header('location:index.php');
            //echo "<script>alert('Successfully Added!!!'); window.location='index.php'</script>";
            exit;
            }
        }
?>