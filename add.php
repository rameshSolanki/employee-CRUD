<?php include 'upload.php' ?>
<?php include 'header.php' ?>

  <div class="container mt-4">
    <div class="col-md-9">
      <div class="card mb-5">
        <div class="card-header">
          <h3 class="btn btn-primary"><i class="fa fa-plus"></i> Add Employee</h3>
        </div>
        <div class="card-body">
          <form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
            <?php echo $success_msg; ?>

            <div class="form-group row mb-3">
              <label class="control-label col-md-3">First Name:</label>
              <div class="col-md-9">
                <input type="text" name="fname" class="form-control" id="fname" required="true">
              </div>
            </div>

            <div class="form-group row mb-3">
              <label class="control-label col-md-3">Middle Name:</label>
              <div class="col-md-9">
                <input type="text" name="mname" class="form-control" id="mname" required="true">
              </div>
            </div>

            <div class="form-group row mb-3">
              <label class="control-label col-md-3">Last Name:</label>
              <div class="col-md-9">
                <input type="text" name="lname" class="form-control" id="lname" required="true">
              </div>
            </div>

            <div class="form-group row mb-3">
              <label class="control-label col-md-3">Gender:</label>
              <div class="col-md-9">
                <select name="gender" id="gender" class="form-control" required="true">
                  <option selected>Select Gender</option>
                  <option>Male</option>
                  <option>Female</option>
                  <option>Other</option>
                </select>
              </div>
            </div>

            <div class="form-group row mb-3">
              <label class="control-label col-md-3">Mail: <span id="uname_response"></span>
              </label>
              <div class="col-md-9">
                <input type="email" name="mail" class="form-control" id="mail" required="true">
              </div>
            </div>

            <div class="form-group row mb-3">
              <label class="control-label col-md-3">Mobile No:</label>
              <div class="col-md-9">
                <input maxlength="10" minlength="10" type="number" name="mobile_no" class="form-control" id="mobile_no" required="true">
              </div>
            </div>

            <div class="form-group row mb-3">
              <label class="control-label col-md-3">Date Of Birth:</label>
              <div class="col-md-9">
                <input type="date" name="date_of_birth" class="form-control" id="date_of_birth" required="true">
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
              <label class="control-label col-md-3">Status:</label>
              <div class="col-md-9">
                <select name="e_status" id="e_status" class="form-control" required="true">
                  <option>Select Status</option>
                  <option selected>Active</option>
                  <option>Inactive</option>
                </select>
              </div>
            </div>

            <div class="form-group row mb-3">
              <label class="control-label col-md-3">Address:</label>
              <div class="col-md-6 input_fields_wrap">
                <input type="text" name="add_line1[]" class="form-control" id="add_line1" required="true">

              </div>
              <div class="col-md-3">
                <button class="btn btn-primary btn-sm add_field_button"><i class="fa fa-fw fa-lg fa-plus-circle"></i>Add More Address</button>
              </div>
            </div>

            <div class="form-group row mb-3">
              <label class="control-label col-md-3">State:</label>
              <div class="col-md-9">
                <input type="text" name="states" class="form-control" id="states" required="true">
              </div>
            </div>

            <div class="form-group row mb-3">
              <label class="control-label col-md-3">Country:</label>
              <div class="col-md-9">
                <input type="text" name="country" class="form-control" id="country" required="true">
              </div>
            </div>

        </div>
        <div class="card-footer text-muted">
          <div class="row">
            <div class="col-md-8 col-md-offset-3">
              <button class="btn btn-primary" type="submit" name="Submit" id="add">Add</button>
              <a class="btn btn-secondary mr-5" href="index.php">Cancel</a>
            </div>
          </div>
        </div>
        </form>
      </div>
    </div>
  </div>

   <?php include 'footer.php' ?>
