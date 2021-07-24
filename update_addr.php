<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="description" content="">
    <title>Update</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
</head>

<body class="app sidebar-mini rtl">

    <div class="container mt-4">
        <div class="col-md-9">
            <div class="card">
                <?php
                 session_start();
                require_once('db.php');
                if (!empty($_POST["save"])) {
                    $get_id = $_REQUEST['aid'];
                    $add_line1 = $_POST["add_line1"];

                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $sql = "UPDATE eaddress SET add_line1 ='$add_line1' WHERE aid = '$get_id' ";

                    $conn->exec($sql);
                    if ($conn) {
                        $_SESSION['message'] = 'Address Updated!!!';
                        echo "<script>

             window.history.go(-2);
     </script>";

                      }
                }
                $sth = $conn->prepare("SELECT * FROM eaddress WHERE aid=" . $_GET["aid"]);
                $sth->execute();

                $result = $sth->fetchAll(\PDO::FETCH_ASSOC);
                //print_r($result);
                ?>

                <div class="card-header">
                    <h3 class="btn btn-primary"><i class="fa fa-lg fa-edit"></i> Update Address ID: <?php echo $_GET["aid"]; ?></h3>
                    <?php
                if(isset($_SESSION['message'])){
                    ?>
                    <p class="alert alert-info text-center">
                        <?php echo $_SESSION['message']; ?>
                    </p>
                    <?php

                    unset($_SESSION['message']);
                }
            ?>
                </div>
                <div class="card-body">

                    <form class="form-horizontal" method="post" action="" enctype="multipart/form-data">

                        <div class="form-group row mb-3">
                            <label class="control-label col-md-3">Address:</label>
                            <div class="col-md-9">

                                <textarea name="add_line1" class="form-control" cols="40" rows="3" value="<?php echo $result[0]['add_line1']; ?>"><?php echo $result[0]['add_line1']; ?></textarea>
                            </div>
                        </div>

                </div>

                <div class="card-footer text-muted">
                    <div class="row">
                        <div class="col-md-9 col-md-offset-3">
                            <input class="btn btn-primary" value="Update" type="submit" name="save">&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="javascript:history.back()">Cancel</a>
                        </div>
                    </div>
                </div>

                </form>
            </div>
        </div>
    </div>

    <!-- Essential javascripts for application to work-->
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/main.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>