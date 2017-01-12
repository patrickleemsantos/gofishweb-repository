  <!-- Content -->

      <div class="box-row">
        <div class="box-cell">
          <div class="box-inner padding">

  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading bg-white">
          <b>Update Profile</b><br>
        </div>
        <div class="panel-body">
          <form class="form-horizontal" role="form" method="post" id="form-edit-account">
		  <div class="form-group">
			  <label class="col-sm-2 control-label">Image</label>
        <div class="col-sm-10">
          <input type="file" id="txt-profile-image" name="txt-profile-image" class="md-input">
          <input type="hidden" id="txt-hidden-profile-image" value="<?php echo $account_image; ?>">
        </div>
			</div>
            <div class="form-group">
              <label for="txt-event" class="col-sm-2 control-label">First Name</label>
              <div class="col-sm-10">
                <input type="texts" class="form-control" id="txt-first-name" placeholder="First name" value="<?php echo $profile_first_name; ?>" required>
              </div>
            </div>
            <div class="form-group">
              <label for="txt-date" class="col-sm-2 control-label">Last Name</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="txt-last-name" placeholder="Last name" value="<?php echo $profile_last_name; ?>" required>
              </div>
            </div>
			<div class="form-group">
              <label for="txt-location" class="col-sm-2 control-label">Age</label>
              <div class="col-sm-10">
                <input type="number" class="form-control" id="txt-age" placeholder="Age" value="<?php echo $profile_age; ?>" required>
              </div>
            </div>
			<div class="form-group">
              <label for="txt-description" class="col-sm-2 control-label">My interest are</label>
              <div class="col-sm-10">
                <textarea id="txt-description" class="form-control" rows="3" placeholder="Description" equired><?php echo $profile_description; ?></textarea>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default" id="btn-edit">Update</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- / content -->
  
  <script>
  $(document).ready(function() {

    $('#form-edit-account').submit(function(e) {
      event.preventDefault();
      var first_name = $("#txt-first-name").val();
      var last_name = $("#txt-last-name").val();
      var age = $("#txt-age").val();
      var description = $("#txt-description").val();
      var account_image = $("#txt-hidden-profile-image").val();

      if (first_name == '') {
          alert('Please enter first name!');
          event.preventDefault();
          return false;
      }

      if (last_name == '') {
          alert('Please enter last name!');
          event.preventDefault();
          return false;
      }

      if (age == '') {
          alert('Please enter age!');
          event.preventDefault();
          return false;
      }

      $.ajaxFileUpload({
        url       : "<?php echo base_url(); ?>index.php/accounts/updateAccount", 
        secureuri   : false,
        fileElementId : 'txt-profile-image',
        dataType    : 'json',
        data      : {
          'account_id': <?php echo $profile_id; ?>,
          'first_name': first_name,
          'last_name': last_name,
          'age': age,
          'description': description,
          'account_image': account_image
        },
        success : function (data, status) {
          if(data.status != 'error') {
            window.location="<?php echo base_url('index.php/accounts/viewaccount/').$profile_id; ?>";
          }
          alert(data.msg);
        }
      });
      return false;

    });

  });

</script>   
