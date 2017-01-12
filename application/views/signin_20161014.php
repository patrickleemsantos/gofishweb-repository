<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Go Fish | Ocean of Experiences</title>
    <meta name="description" content="app, web app, responsive, responsive layout, admin, admin panel, admin dashboard, flat, flat ui, ui kit, AngularJS, ui route, charts, widgets, components" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <link rel="stylesheet" href="<?php echo base_url("assets/libs/assets/animate.css/animate.css"); ?>" />
    <link rel="stylesheet" href="<?php echo base_url("assets/libs/assets/font-awesome/css/font-awesome.css"); ?>" />
    <link rel="stylesheet" href="<?php echo base_url("assets/libs/jquery/waves/dist/waves.css"); ?>" />
    <link rel="stylesheet" href="<?php echo base_url("assets/styles/material-design-icons.css"); ?>" />

    <link rel="stylesheet" href="<?php echo base_url("assets/libs/jquery/bootstrap/dist/css/bootstrap.css"); ?>" />
    <link rel="stylesheet" href="<?php echo base_url("assets/styles/font.css"); ?>" />
    <link rel="stylesheet" href="<?php echo base_url("assets/styles/app.css"); ?>" />

</head>

<body>
    <div class="app">


        <div class="center-block w-xxl w-auto-xs p-v-md">
            <div class="navbar">
                <div class="navbar-brand m-t-lg text-center">
                    <center><img alt="logo" src="<?php echo base_url("assets/images/icon_180.png "); ?>" style="width:150px; height:150px" />
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
                    <center>Sign in with your Go Fish Account</center>
                </div>
                <form name="form" action="<?=base_url()?>index.php/accounts/" method="post">
                    <div class="md-form-group float-label">
                        <input name="txt_username" type="email" class="md-input" required>
                        <label>Email</label>
                    </div>
                    <div class="md-form-group float-label">
                        <input name="txt_password" type="password" class="md-input" required>
                        <label>Password</label>
                    </div>
                    <button type="submit" class="md-btn md-raised blue btn-block p-h-md">Sign in</button><br /><br />
                    <div id="fb_id" style="margin-left:33%" class="fb-login-button" data-scope="email,user_birthday,user_hometown,user_location,user_website,user_work_history,user_about_me,public_profile,user_friends, read_custom_friendlists" data-max-rows="5" data-size="large" data-show-faces="false" data-auto-logout-link="true" onlogin="checkLoginState();">
                    </div>
                    <!-- <input type="button" onclick = "fbLogoutUser()" value="Logout"/><br><br> -->
                </form>
            </div>

            <div class="p-v-lg text-center">
                <div class="m-b">
                    <button id="btn_forgot_password" onclick="sendEmailPassword()" class="md-btn">Forgot password?</button>
                </div>
                <div>
                    <a href="<?php echo base_url('index.php/accounts/signup'); ?>" class="md-btn">Create an account</a>
                </div>
            </div>
        </div>



    </div>
    <script>
        // This is called with the results from from FB.getLoginStatus().
        function statusChangeCallback(response) {
            console.log('statusChangeCallback');
            console.log(response);
            // The response object is returned with a status field that lets the
            // app know the current login status of the person.
            // Full docs on the response object can be found in the documentation
            // for FB.getLoginStatus().
            if (response.status === 'connected') {
                // Logged into your app and Facebook.
                getFBDetails();
            } else if (response.status === 'not_authorized') {
                // The person is logged into Facebook, but not your app.
            } else {
                // The person is not logged into Facebook, so we're not sure if
                // they are logged into this app or not.
            }
        }

        // This function is called when someone finishes with the Login
        // Button.  See the onlogin handler attached to it in the sample
        // code below.
        function checkLoginState() {
            FB.getLoginStatus(function(response) {
                statusChangeCallback(response);
            });
        }

        window.fbAsyncInit = function() {
            FB.init({
                appId: '868229593309562',
                cookie: true, // enable cookies to allow the server to access 
                // the session
                xfbml: true, // parse social plugins on this page
                version: 'v2.5' // use graph api version 2.5
            });

            // Now that we've initialized the JavaScript SDK, we call 
            // FB.getLoginStatus().  This function gets the state of the
            // person visiting this page and can return one of three states to
            // the callback you provide.  They can be:
            //
            // 1. Logged into your app ('connected')
            // 2. Logged into Facebook, but not your app ('not_authorized')
            // 3. Not logged into Facebook and can't tell if they are logged into
            //    your app or not.
            //
            // These three cases are handled in the callback function.

            // FB.getLoginStatus(function(response) {
            //     statusChangeCallback(response);
            // });

        };

        // Load the SDK asynchronously
        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
        // Here we run a very simple test of the Graph API after login is
        // successful.  See statusChangeCallback() for when this call is made.s

        function getFBDetails() {
            FB.api('/me', {
                    fields: "id,about,age_range,picture.type(large),bio,birthday,context,email,first_name,last_name,gender,hometown,link,location,middle_name,name,timezone,website,work"
                },
                function(response) {
                    $.ajax({
                      type: "POST",
                      url: "<?php echo base_url('index.php/accounts/getFBDetails/'); ?>" + response.id,
                      data: {
                              'first_name': response.first_name,
                              'last_name': response.last_name,
                              'age': calcAge(response.birthday),
                              'image_url': response.picture.data.url,
                            },
                      dataType: "json",
                      success: function(msg, string, jqXHR) {
                          if (msg.status == '0') {
                              <?php $this->session->set_userdata('is_facebook_login', true); ?>
                              // alert(msg.message);
                              window.location="<?php echo base_url('index.php/home'); ?>";
                          } else {
                              alert(msg.message);
                          }
                      },
                      error: function(msg, string, jqXHR) { 
                          alert("An error occured, please try again.");
                      }
                  });
                }
            );
        }

        function calcAge(dateString) {
          var birthday = +new Date(dateString);
          return ~~((Date.now() - birthday) / (31557600000));
        }

        function sendEmailPassword() {
            var email = prompt("Please enter your email", "");
            if (email != null) {
                 if (validateEmail(email) == false) {
                    alert('Invalid email format');
                    return false;
                }
                $.ajax({
                    type: "POST",
                    url: "http://185.121.173.201/gofish/send_password.php",
                    data: "email=" + email,
                    dataType: "json",
                    success: function(msg, string, jqXHR) {
                        alert(msg.status);
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert("An error occured, please try again.");
                    }
                });
            }
        }

        function validateEmail(sEmail) {
            var filter = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
            if (filter.test(sEmail)) {
                return true;
            } else {
                return false;
            }
        }
    </script>

    <script src="<?php echo base_url("assets/libs/jquery/jquery/dist/jquery.js "); ?>"></script>
    <script src="<?php echo base_url("assets/libs/jquery/bootstrap/dist/js/bootstrap.js "); ?>"></script>
    <script src="<?php echo base_url("assets/libs/jquery/waves/dist/waves.js "); ?>"></script>
    <script src="<?php echo base_url("assets/scripts/ui-load.js "); ?>"></script>
    <script src="<?php echo base_url("assets/scripts/ui-jp.config.js "); ?>"></script>
    <script src="<?php echo base_url("assets/scripts/ui-jp.js "); ?>"></script>
    <script src="<?php echo base_url("assets/scripts/ui-nav.js "); ?>"></script>
    <script src="<?php echo base_url("assets/scripts/ui-toggle.js "); ?>"></script>
    <script src="<?php echo base_url("assets/scripts/ui-form.js "); ?>"></script>
    <script src="<?php echo base_url("assets/scripts/ui-waves.js "); ?>"></script>
    <script src="<?php echo base_url("assets/scripts/ui-client.js "); ?>"></script>

</body>

</html>