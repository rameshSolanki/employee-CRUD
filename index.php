<?php include 'header.php' ?>

  <div class="container mt-4">
    <div class="col-md-3">
      <h3 class=""><a href="add.php" class="btn btn-primary"><i class="fa fa-plus"></i> Add New Employee</a></h3>
      <?php
                session_start();
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
  </div>

  <div class="container mt-2">
    <div class="col-md-12">
      <div class="card mb-5">

          <div class="table table-responsive">
            <table class="table table-hover table-bordered" id="sampleTable">
              <thead>
                <tr>
                  <th>Photograph</th>
                  <th>Full Name</th>
                  <th>Gender</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>

              <tbody>
                <?php
                require_once('db.php');
                $result = $conn->prepare("SELECT * FROM employee ORDER BY eid DESC");
                $result->execute();

                for ($i = 0; $row = $result->fetch(); $i++) {

                  $sql_empadd = $conn->prepare("SELECT * FROM eaddress WHERE employee_id  = " . $row['eid']);
                  $sql_empadd->execute();

                  $id = $row['eid'];
                ?>
                  <tr>

                    <td>
                      <?php if ($row['photograph'] != "") : ?>
                        <img data-aos="zoom-in" src="uploads/<?php echo $row['photograph']; ?>" width="100px" height="100px">
                      <?php else : ?>
                        <img src="images/default.png" width="100px" height="100px">
                      <?php endif; ?>
                    </td>

                    <td> <?php echo $row['fname']. '&nbsp;' .$row['mname']. '&nbsp;' .$row['lname'] ; ?></td>
                    <td> <?php echo $row['gender']; ?></td>

                    <?php if ($row['e_status'] == "Active") : ?>
                    <td> <span class="btn-sm btn-warning bg-success text-white"><?php echo $row['e_status']; ?></span></td>
                    <?php else : ?>
                       <td> <span class="btn-sm btn-danger bg-danger text-white"><?php echo $row['e_status']; ?></span></td>
                      <?php endif; ?>

                    <td>
                      <div class="btn-group ml-auto" role="group" aria-label="Basic outlined example">
                        <a href="update.php?eid=<?php echo ($row["eid"]); ?>" class="btn btn-sm btn-warning"><i class="fa fa-pencil-square-o"></i></a>
                        <a href="#exampleModal<?php echo $id; ?>" data-toggle="modal" class="btn btn-sm btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i> </a>
                      </div>
                    </td>
                  </tr>
                  <!-- Modal Delete Image-->

                  <div  class="modal fade" id="exampleModal<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">

                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete ID: <?php echo $id; ?></h5>
                          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">

                            <div class="row">

                              <div class="col-xl-8 form-group">
                                <?php if ($row['photograph'] != "") : ?>
                                  <img src="uploads/<?php echo $row['photograph']; ?>" width="100px" height="100px">
                                <?php else : ?>
                                  <img src="images/default.png" width="100px" height="100px">
                                <?php endif; ?>
                              </div>


                              <div class="col-xl-6 form-group">
                                <p>First Name: <?php echo $row['fname']; ?></p>
                              </div>

                            </div>
                            <p>Are you Sure you want to Delete <i class="fa fa-question-circle" aria-hidden="true"></i></p>
                            </div>

                          <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> No</button>
                            <a href="delete.php<?php echo '?eid=' . $id; ?>" class="btn btn-outline-danger"><i class="fa fa-check" aria-hidden="true"></i> Yes</a>
                          </div>


                      </div>
                    </div>
                  </div>
                  <!-- End Modal Delete Image-->
                <?php } ?>
              </tbody>
            </table>
          </div>
      </div>
    </div>

<?php include 'footer.php' ?>