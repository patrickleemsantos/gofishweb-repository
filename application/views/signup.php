<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>Go Fish | Ocean of Experiences</title>
  <meta name="description" content="app, web app, responsive, responsive layout, admin, admin panel, admin dashboard, flat, flat ui, ui kit, AngularJS, ui route, charts, widgets, components" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  <link rel="stylesheet" href="<?php echo base_url('assets/libs/assets/animate.css/animate.css'); ?>" />
  <link rel="stylesheet" href="<?php echo base_url('assets/libs/assets/font-awesome/css/font-awesome.css'); ?>" />
  <link rel="stylesheet" href="<?php echo base_url('assets/libs/jquery/waves/dist/waves.css'); ?>" />
  <link rel="stylesheet" href="<?php echo base_url('assets/styles/material-design-icons.css'); ?>" />

  <link rel="stylesheet" href="<?php echo base_url('assets/libs/jquery/bootstrap/dist/css/bootstrap.css'); ?>" />
  <link rel="stylesheet" href="<?php echo base_url('assets/styles/font.css'); ?>" />
  <link rel="stylesheet" href="<?php echo base_url('assets/styles/app.css'); ?>" />

  <script src="<?php echo base_url('assets/libs/jquery/jquery/dist/jquery.js'); ?>"></script>
  <script src="<?php echo base_url('assets/libs/jquery/bootstrap/dist/js/bootstrap.js '); ?>"></script>
  <script src="<?php echo base_url('assets/libs/jquery/waves/dist/waves.js '); ?>"></script>
  <script src="<?php echo base_url('assets/scripts/ui-load.js'); ?>"></script>
  <script src="<?php echo base_url('assets/scripts/ui-jp.config.js'); ?>"></script>
  <script src="<?php echo base_url('assets/scripts/ui-jp.js'); ?>"></script>
  <script src="<?php echo base_url('assets/scripts/ui-nav.js'); ?>"></script>
  <script src="<?php echo base_url('assets/scripts/ui-toggle.js'); ?>"></script>
  <script src="<?php echo base_url('assets/scripts/ui-form.js'); ?>"></script>
  <script src="<?php echo base_url('assets/scripts/ui-waves.js'); ?>"></script>
  <script src="<?php echo base_url('assets/scripts/ui-client.js'); ?>"></script>

  <script src="<?php echo base_url("assets/ajaxfileupload.js"); ?>"></script>
</head>
<body>
<div class="app">
  

  <div class="center-block w-xxl w-auto-xs p-v-md">
    <div class="navbar">
      <div class="navbar-brand m-t-lg text-center">
       <center><img src="<?php echo base_url('assets/images/icon_180.png '); ?>" style="width:150px; height:150px" />
                    </center>
      </div>
      <br />
      <br />
      <br />
      <br />
      <br />
    </div>

    <div class="p-lg panel md-whiteframe-z1 text-color m">
      <div class="m-b text-sm">
        <center>Sign up to your Go Fish Account</center>
      </div>
      <!-- <form method="post" action="<?php echo base_url(); ?>index.php/accounts/addemailaccount/" > -->
      <form role="form" method="post" action="" id="form-add-account">
      <div class="md-form-group">
        <input type="file" id="txt-profile-image" name="txt-profile-image" class="md-input">
        <label>Profile Image</label>
      </div>
        <div class="md-form-group">
          <input id="txt-email" type="email" class="md-input">
          <label>Email</label>
        </div>
        <div class="md-form-group">
          <input id="txt-password" type="password" class="md-input">
          <label>Password</label>
        </div>
        <div class="md-form-group">
          <input id="txt-repeat-password" type="password" class="md-input">
          <label>Repeat Password</label>
        </div>
        <div class="md-form-group">
          <input id="txt-first-name" type="text" class="md-input">
          <label>First Name</label>
        </div>
        <div class="md-form-group">
          <input id="txt-last-name" type="text" class="md-input">
          <label>Last Name</label>
        </div>
        <div class="md-form-group">
          <input id="txt-age" type="number" class="md-input">
          <label>Age</label>
        </div>
        <div class="md-form-group">
          <input id="txt-description" type="text" class="md-input">
          <label>Description</label>
        </div>
        <!-- <textarea id="txt-description" class="form-control" rows="3" placeholder="Description" required></textarea> -->
        <!-- <div class="m-b-md">
          <label class="md-check">
            <input type="checkbox" ng-model="agree" required><i class="indigo"></i> Agree the <a href>terms and policy</a>
          </label>
        </div> -->
        <button id="btn-signup" md-ink-ripple type="submit" class="md-btn md-raised blue btn-block p-h-md">Sign up</button>
      </form>
    </div>

    <div class="p-v-lg text-center">
      <a href="<?php echo base_url('index.php/home'); ?>"><div>Already have an account? <button ui-sref="access.signin" class="md-btn">Sign in</button></div></a>
    </div>
  </div>



</div>

<script>
  $(document).ready(function() {

    $('#form-add-account').submit(function(e) {
      event.preventDefault();
      var email = $("#txt-email").val();
      var password = $("#txt-password").val();
      var repeat_password = $("#txt-repeat-password").val();
      var first_name = $("#txt-first-name").val();
      var last_name = $("#txt-last-name").val();
      var age = $("#txt-age").val();
      var description = $("#txt-description").val();

      if (email == '') {
          alert('Please enter email!');
          event.preventDefault();
          return false;
      }

      if (validateEmail(email) == false) {
          alert('Please enter valid email!');
          event.preventDefault();
          return false;
      }

      if (password == '') {
          alert('Please enter password!');
          event.preventDefault();
          return false;
      }

      if (repeat_password == '') {
          alert('Please repeat the password!');
          event.preventDefault();
          return false;
      }

      if (password != repeat_password) {
          alert('Password is not the same!');
          event.preventDefault();
          return false;
      } 

      if (password.length < 6) {
          alert("min 6 characters, max 50 characters");
          event.preventDefault();
          return false;
      }

      if (password.length > 50) {
          alert("min 6 characters, max 50 characters");
          event.preventDefault();
          return false;
      }

      if (password.search(/\d/) == -1) {
          alert("must contain at least 1 number");
          event.preventDefault();
          return false;
      }

      if (password.search(/[a-zA-Z]/) == -1) {
          alert("must contain at least 1 letter");
          event.preventDefault();
          return false;
      }

      if (password.search(/[^a-zA-Z0-9\!\@\#\$\%\^\&\*\(\)\_\+\.\,\;\:]/) != -1) {
          alert("character ivalid");
          event.preventDefault();
          return false;
      }

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
        url       : "<?php echo base_url(); ?>index.php/accounts/addemailaccount", 
        secureuri   : false,
        fileElementId : 'txt-profile-image',
        dataType    : 'json',
        data      : {
          'email':email,
          'password': password,
          'first_name': first_name,
          'last_name': last_name,
          'age': age,
          'description': description
        },
        success : function (data, status) {
          if(data.status != 'error') {
            window.location="<?php echo base_url('index.php/home'); ?>";
          } else {
            window.location="<?php echo base_url('index.php/signup'); ?>";
          }
          alert(data.msg);
        }
      });
      return false;
    });

    function validateEmail(sEmail) {
      var filter = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
      if (filter.test(sEmail)) {
          return true;
      } else {
          return false;
      }
    }
  });
</script>

</body>
</html>
