<?php include 'header.php' ?>

  <div class="container mt-4">
    <div class="col-md-9">

      <?php

       session_start();
      require_once("db.php");

      if (!empty($_POST["save"])) {

        $directory = "uploads/";
        unlink($directory . $row["image"]);
        move_uploaded_file($_FILES["image"]["tmp_name"], "uploads/" . $_FILES["image"]["name"]);

        $location1 = $_FILES["image"]["name"];
        $fname = $_POST['fname'];
        $mname = $_POST['mname'];
        $lname = $_POST['lname'];
        $gender = $_POST['gender'];
        $mail = $_POST['mail'];
        $mobile_no = $_POST['mobile_no'];
        $date_of_birth = $_POST['date_of_birth'];
        $e_status = $_POST['e_status'];
        if ((!($_FILES['image']['name']))) /* If there Is No file Selected*/ {
          $pdo_statement = $conn->prepare("UPDATE employee SET fname='$fname', mname='$mname', lname='$lname', gender='$gender', mail='$mail', mobile_no='$mobile_no', date_of_birth='$date_of_birth', e_status='$e_status'
          WHERE eid=" . $_GET["eid"]);

          $result = $pdo_statement->execute();

          $states = $_POST['states'];
          $country = $_POST['country'];
          $id = $_GET["eid"];

          foreach ($_POST['add_line1'] as $k => $val) {

            $q2 = "INSERT INTO eaddress (employee_id, add_line1, states, country) VALUES ('$id', '$val', '$states', '$country')";
            $conn->exec($q2);
          }

          if ($result) {
            $_SESSION['message'] = 'Successfully Updated!!!';
            header('location:index.php');
          }
        } else /* If file is  Selected*/ {
          $pdo_statement = $conn->prepare("UPDATE employee SET photograph ='$location1', fname='$fname', mname='$mname', lname='$lname', gender='$gender', mail='$mail', mobile_no='$mobile_no', date_of_birth='$date_of_birth', e_status='$e_status'
  WHERE eid=" . $_GET["eid"]);

          $result = $pdo_statement->execute();

          $states = $_POST['states'];
          $country = $_POST['country'];
          $id = $_GET["eid"];

          foreach ($_POST['add_line1'] as $k => $val) {

            $q2 = "INSERT INTO eaddress (employee_id, add_line1, states, country) VALUES ('$id', '$val', '$states', '$country')";
            $conn->exec($q2);
          }

          if ($result) {
            $_SESSION['message'] = 'Successfully Updated!!!';
            header('location:index.php');
          }
        }
      }

      $pdo_statement = $conn->prepare("SELECT * FROM employee WHERE eid=" . $_GET["eid"]);
      $pdo_statement->execute();
      $result = $pdo_statement->fetchAll();

      $result2 =  $conn->prepare("SELECT * FROM eaddress WHERE employee_id=" . $_GET["eid"]);
      $result2->execute();
      $results = $result2->fetchAll();
      $result2->execute();

      ?>
      <div class="card mb-5">
        <div class="card-header">
          <h3 class="btn btn-primary"><i class="fa fa-lg fa-edit"></i> Update Employee</h3>
        </div>
        <div class="card-body">

          <form class="form-horizontal" method="post" action="" enctype="multipart/form-data">

            <div class="form-group row mb-3">
              <label class="control-label col-md-3">First Name:</label>
              <div class="col-md-9">
                <input type="text" name="fname" class="form-control" value="<?php echo $result[0]['fname']; ?>">
              </div>
            </div>

            <div class="form-group row mb-3">
              <label class="control-label col-md-3">Middle Name:</label>
              <div class="col-md-9">
                <input type="text" name="mname" class="form-control" value="<?php echo $result[0]['mname']; ?>">
              </div>
            </div>

            <div class="form-group row mb-3">
              <label class="control-label col-md-3">Last Name:</label>
              <div class="col-md-9">
                <input type="text" name="lname" class="form-control" value="<?php echo $result[0]['lname']; ?>">
              </div>
            </div>

            <div class="form-group row mb-3">
              <label class="control-label col-md-3">Gender:</label>
              <div class="col-md-9">
                <select name="gender" id="gender" class="form-control" required="true">
                  <option value="<?php echo $result[0]['gender']; ?>"><?php echo $result[0]['gender']; ?></option>
                  <option>Male</option>
                  <option>Female</option>
                  <option>Other</option>
                </select>
              </div>
            </div>

            <div class="form-group row mb-3">
              <label class="control-label col-md-3">Mail:</label>
              <div class="col-md-9">
                <input type="text" name="mail" class="form-control" value="<?php echo $result[0]['mail']; ?>">
              </div>
            </div>

            <div class="form-group row mb-3">
              <label class="control-label col-md-3">Mobile No:</label>
              <div class="col-md-9">
                <input type="number" name="mobile_no" class="form-control" value="<?php echo $result[0]['mobile_no']; ?>">
              </div>
            </div>

            <div class="form-group row mb-3">
              <label class="control-label col-md-3">Date Of Birth:</label>
              <div class="col-md-9">
                <input type="date" name="date_of_birth" class="form-control" value="<?php echo $result[0]['date_of_birth']; ?>">
              </div>
            </div>

            <div class="form-group row mb-3">
              <label class="control-label col-md-3">Select Your Photograph:</label>
              <div class="col-md-9">
                <div class="form-file">
                  <input type="file" class="form-file-input" name="image" id="customFile">
                  <label class="form-file-label" for="customFile">
                    <span class="form-file-text">Choose file...</span>
                    <span class="form-file-button">Browse</span>
                  </label>
                </div>
              </div>
            </div>

            <div class="form-group row mb-3">
              <div class="col-md-9">
                <?php if ($result[0]['photograph'] != "") : ?>
                  <img data-aos="zoom-in" src="uploads/<?php echo $result[0]['photograph']; ?>" width="80px" height="80px">
                <?php else : ?>
                  <img src="images/default.png" width="100px" height="100px">
                <?php endif; ?>
              </div>
            </div>

            <div class="form-group row mb-3">
              <label class="control-label col-md-3">Status:</label>
              <div class="col-md-9">
                <select name="e_status" id="e_status" class="form-control" required="true">
                  <option value="<?php echo $result[0]['e_status']; ?>"><?php echo $result[0]['e_status']; ?></option>
                  <option>Active</option>
                  <option>Inactive</option>
                </select>
              </div>
            </div>

            <div class="form-group row mb-3">
              <label class="control-label col-md-3">Address:</label>
              <div class="col-md-6 input_fields_wrap">
                <?php if (!$results) { //<-- this should be $result_table ?
                  echo "<p>No address found.</p>";
                } else {
                }
                ?>
                <?php
                for ($i = 0; $row1 = $result2->fetch(); $i++) {
                  $id = $row1['employee_id'];
                  $aid = $row1['aid'];
                ?>
                  <input id="<?php echo $aid; ?>" type="text" name="add_line1" class="form-control mt-2" value="<?php echo $row1['add_line1']; ?>" readonly="true">

                  <input type="checkbox" class="emp_checkbox" data-aid="<?php echo $aid; ?>">

                  <a href="update_addr.php?aid=<?php echo $aid; ?>" class="mt-2 btn btn-sm btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> |

                  <a class='delbtn mt-2 btn btn-sm btn-danger' data-aid=<?php echo $row1['aid']; ?> href='javascript:void(0)'><i class="fa fa-trash-o" aria-hidden="true"></i></a>

                <?php } ?>
              </div>
              <?php if (!$results) { //<-- this should be $result_table ?
                  // echo "<p>No address found.</p>";
                  echo '<div class="col-md-3">
                  <button class=" btn btn-primary btn-sm add_field_button"><i class="fa fa-fw fa-lg fa-plus-circle"></i>Add More Address</button>
                  </div>

                  <div class="form-group row mb-3">
              <label class="control-label col-md-3">State:</label>
              <div class="col-md-9">
                <input type="text" name="states" class="form-control">
              </div>
            </div>

            <div class="form-group row mb-3">
              <label class="control-label col-md-3">Country:</label>
              <div class="col-md-9">
                <input type="text" name="country" class="form-control">
              </div>
            </div>';
                } else {

                ?>
              <div class="col-md-3">
                <a class='delAddrBtn mt-2 btn btn-sm btn-danger' data-aid=<?php echo $aid; ?> href='javascript:void(0)'><i class="fa fa-trash-o" aria-hidden="true"></i> Delete Selected</a>
                <button class="mt-2 btn btn-primary btn-sm add_field_button"><i class="fa fa-fw fa-lg fa-plus-circle"></i>Add More Address</button>
              </div>

            </div>

            <div class="form-group row mb-3">
              <label class="control-label col-md-3">State:</label>
              <div class="col-md-9">
                <input type="text" name="states" class="form-control" value="<?php echo $results[0]['states']; ?>">
              </div>
            </div>

            <div class="form-group row mb-3">
              <label class="control-label col-md-3">Country:</label>
              <div class="col-md-9">
                <input type="text" name="country" class="form-control" value="<?php echo $results[0]['country']; ?>">
              </div>
            </div>

            <?php
                }
                ?>


        </div>

        <div class="card-footer text-muted">
          <div class="row">
            <div class="col-md-9 col-md-offset-3">
              <input class="btn btn-primary" value="Update" type="submit" name="save">&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="index.php">Cancel</a>
            </div>
          </div>
        </div>

        </form>

      </div>
    </div>
  </div>

  <?php include 'footer.php' ?>