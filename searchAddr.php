<?php
define("ROW_PER_PAGE", 5);
require_once('db.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="description" content="">
    <title>Images</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">

</head>

<body class="app sidebar-mini rtl">
<div class="container mt-4">
    <div class="col-md-3">
      <h3 class=""><a href="add.php" class="btn btn-primary"><i class="fa fa-plus"></i> Add New Employee</a></h3>
    </div>
  </div>
    <div class="container mt-2">
        <div class="col-md-12">
            <div class="card mb-5">
                <?php
                $search_keyword = '';
                if (!empty($_POST['search']['keyword'])) {
                    $search_keyword = $_POST['search']['keyword'];
                }
                $sql = 'SELECT * FROM employee WHERE fname LIKE :keyword OR lname LIKE :keyword OR mobile_no LIKE :keyword ORDER BY eid DESC ';

                /* Pagination Code starts */
                $per_page_html = '';
                $page = 1;
                $start = 0;
                if (!empty($_POST["page"])) {
                    $page = $_POST["page"];
                    $start = ($page - 1) * ROW_PER_PAGE;
                }
                $limit = " limit " . $start . "," . ROW_PER_PAGE;
                $pagination_statement = $conn->prepare($sql);
                $pagination_statement->bindValue(':keyword', '%' . $search_keyword . '%', PDO::PARAM_STR);
                $pagination_statement->execute();

                $row_count = $pagination_statement->rowCount();
                if (!empty($row_count)) {
                    $per_page_html .= "<nav aria-label='Page navigation example'>
                    <ul class='pagination'>";
                    $page_count = ceil($row_count / ROW_PER_PAGE);
                    if ($page_count > 1) {
                        for ($i = 1; $i <= $page_count; $i++) {
                            if ($i == $page) {
                                $per_page_html .= '<li class="page-item active" aria-current="page"><input type="submit" name="page" value="' . $i . '" class="page-link btn-page current" /></li>';
                            } else {
                                $per_page_html .= '<li class="page-item" aria-current="page"><input type="submit" name="page" value="' . $i . '" class="page-link btn-page" /></li>   ';
                            }
                        }
                    }
                    $per_page_html .= " </ul></nav>";
                }

                $query = $sql . $limit;
                $pdo_statement = $conn->prepare($query);
                $pdo_statement->bindValue(':keyword', '%' . $search_keyword . '%', PDO::PARAM_STR);
                $pdo_statement->execute();
                $result = $pdo_statement->fetchAll();
                ?>

                        <form name='frmSearch' action='' method='post'>
                            <div class="d-flex container-fluid col-sm-5 container mt-3 mb-4">
                                <input class="form-control mr-2" type="search" placeholder="Search" aria-label="Search" name="search[keyword]" value="<?php echo $search_keyword; ?>" id='keyword' maxlength="25">
                                <button class="btn btn-outline-success" type="submit">Search</button>
                            </div>

                            <div class="container table table-responsive">
                                <table class="table table-bordered">
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
                                        if (!empty($result)) {
                                            foreach ($result as $row) {
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

                                        <?php
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>

                                <?php echo $per_page_html; ?>
                        </form>

                    </div>
            </div>
        </div>
</body>
<!-- Essential javascripts for application to work-->
<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/main.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script src="bootstrap/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript">

</script>
<script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="js/dataTables.bootstrap.min.js"></script>

</html>