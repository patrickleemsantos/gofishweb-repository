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

	<link rel="stylesheet" href="<?php echo base_url("assets/styles/ion.rangeSlider.css"); ?>" />
	<link rel="stylesheet" href="<?php echo base_url("assets/styles/ion.rangeSlider.skinHTML5.css"); ?>" />

	<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyB1_IdI7EpTLKaptA4oXeCL2_nlMrUuGH4&libraries=places"></script>
	<script src="<?php echo base_url("assets/jquery.min.js"); ?>"></script>
	<script src="<?php echo base_url("assets/ion.rangeSlider.js"); ?>"></script>
	<script src="<?php echo base_url("assets/libs/jquery/bootstrap/dist/js/bootstrap.js"); ?>"></script>
	<script src="<?php echo base_url("assets/libs/jquery/waves/dist/waves.js"); ?>"></script>
	<script src="<?php echo base_url("assets/scripts/ui-load.js"); ?>"></script>
	<script src="<?php echo base_url("assets/scripts/ui-jp.config.js"); ?>"></script>
	<script src="<?php echo base_url("assets/scripts/ui-jp.js"); ?>"></script>
	<script src="<?php echo base_url("assets/scripts/ui-nav.js"); ?>"></script>
	<script src="<?php echo base_url("assets/scripts/ui-toggle.js"); ?>"></script>
	<script src="<?php echo base_url("assets/scripts/ui-form.js"); ?>"></script>
	<script src="<?php echo base_url("assets/scripts/ui-waves.js"); ?>"></script>

    <script src="<?php echo base_url("assets/ajaxfileupload.js"); ?>"></script>
</head>
<body>
    <div class="app">

        <!-- aside -->
        <aside id="aside" class="app-aside modal fade" role="menu">
            <div class="left">
                <div class="box bg-white">
                    <div class="navbar md-whiteframe-z1 no-radius blue">
                        <!-- brand -->
                        <a href="<?php echo base_url("index.php/home"); ?>" class="navbar-brand">
                            <img src="<?php echo base_url("assets/images/logo-header.png"); ?>" alt="." style="width:120px; height:30px; margin-left:40px;">
                        </a>
                        <!-- / brand -->
                    </div>
                    <div class="box-row">
                        <div class="box-cell scrollable hover">
                            <div class="box-inner">
                                <div class="p hidden-folded blue-50" style="background-image:url(<?php echo base_url("assets/images/bg.png "); ?>); background-size:cover">
                                    <!--        <?php
                  echo base_url("assets/images/bg.png"); 
                ?>  -->
                                    <div class="rounded w-64 bg-white inline pos-rlt">
                                        <a href="<?php echo base_url("index.php/accounts/viewaccount/").$account_id; ?>"><img src="<?php echo $account_image; ?>" class="img-responsive rounded" style="width:65px; height:65px;"></a>
                                    </div>
                                    <!-- <a class="block m-t-sm" ui-toggle-class="hide, show" target="#nav, #account"> -->
                                    <span class="block font-bold"><?php echo $first_name.' '.$last_name; ?></span>
                                    <!--  <span class="pull-right auto">
                    <i class="fa inline fa-caret-down"></i>
                    <i class="fa none fa-caret-up"></i>
                  </span> -->
                                    <?php echo $username; ?>
                                        <!-- </a> -->
                                </div>
                                <div id="nav">
                                    <nav ui-nav>
                                        <ul class="nav">
                                            <li>
                                                <a md-ink-ripple href="<?php echo base_url('index.php/home/'); ?>">
                                                    <i class="icon mdi-action-home i-20"></i>
                                                    <span>Home</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a md-ink-ripple href="<?php echo base_url('index.php/accounts/editaccount/').$account_id; ?>">
                                                    <i class="icon mdi-action-perm-contact-cal i-20"></i>
                                                    <span>My Profile</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a md-ink-ripple href="<?php echo base_url('index.php/events/'); ?>">
                                                    <i class="icon mdi-action-event i-20"></i>
                                                    <span>Add Event</span>
                                                </a>
                                            </li>
                                            <!--
                      <li>
                        <a md-ink-ripple href="page.settings.html">
                          <i class="icon mdi-action-settings i-20"></i>
                          <span>Settings</span>
                        </a>
                      </li>
-->
                                            <li>
                                                <!-- <a md-ink-ripple href="<?php echo base_url().'index.php/accounts/logout'; ?>" id="btn_logout"> -->
                                                <a md-ink-ripple href="#" id="btn_logout">
                                                    <i class="icon mdi-action-exit-to-app i-20"></i>
                                                    <span>Logout</span>
                                                </a>
                                            </li>
                                            <li class="m-v-sm b-b b"></li>
                                            <script>
                                                $('#btn_logout').click(function() {
                                                    <?php if ($this->session->userdata('is_facebook_login') == true) { ?>
                                                    // alert('fb logout!');
                                                    window.fbAsyncInit = function() {
                                                        FB.init({
                                                            appId: '868229593309562',
                                                            cookie: true,
                                                            xfbml: true,
                                                            version: 'v2.5'
                                                        });

                                                        FB.getLoginStatus(function(response) {
                                                            statusChangeCallback(response);
                                                        });

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

                                                    function statusChangeCallback(response) {
                                                        // console.log(response);
                                                        if (response.status === 'connected') {
                                                            if (response && response.status === 'connected') {
                                                                FB.logout(function(response) {
                                                                    console.log(response);
                                                                    // document.location.reload();
                                                                    // window.location="<?php echo base_url('index.php/home'); ?>";
                                                                });
                                                            }
                                                        } else if (response.status === 'not_authorized') {} else {}
                                                    }
                                                    <?php } 
                            // $this->session->sess_destroy();
                            ?>
                                                    window.location = "<?php echo base_url('index.php/accounts/logout'); ?>";
                                                });
                                            </script>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </aside>
        <!-- / aside -->

        <!-- content -->
        <div id="content" class="app-content" role="main">
            <div class="box">
                <!-- Content Navbar -->
                <div class="navbar md-whiteframe-z1 no-radius blue">
                    <!-- Open side - Naviation on mobile -->
                    <a md-ink-ripple data-toggle="modal" data-target="#aside" class="navbar-item pull-left visible-xs visible-sm"><i class="mdi-navigation-menu i-24"></i></a>
                    <!-- / -->
                    <!-- Page title - Bind to $state's title -->
                    <div class="navbar-item pull-left h4">
                        <!-- <img src="<?php echo base_url("assets/images/logo-header.png"); ?>" style="width:120px; height:40px; padding-top:5px; padding-bottom:5px;"> -->
                    </div>
                    <!-- / -->
                    <!-- Common tools -->
                    <ul class="nav nav-sm navbar-tool pull-right">
                        <!-- <li>
                            <a md-ink-ripple ui-toggle-class="show" target="#search">
                                <i class="mdi-action-search i-24"></i>
                            </a>
                        </li> -->
                        <li>
                            <a id="btn_chat_list" md-ink-ripple data-toggle="modal" data-target="#user">
                                <i class="mdi-social-person-outline i-24"></i>
                            </a>
                        </li>
                    </ul>
                    <div class="pull-right" ui-view="navbar@"></div>
                    <!-- / -->
                    <!-- Search form -->
                    <div id="search" class="pos-abt w-full h-full blue hide">
                        <div class="box">
                            <div class="box-col w-56 text-center">
                                <!-- hide search form -->
                                <a md-ink-ripple class="navbar-item inline" ui-toggle-class="show" target="#search"><i class="mdi-navigation-arrow-back i-24"></i></a>
                            </div>
                            <div class="box-col v-m">
                                <!-- bind to app.search.content -->
                                <input class="form-control input-lg no-bg no-border" placeholder="Search" ng-model="app.search.content">
                            </div>
                            <div class="box-col w-56 text-center">
                                <a md-ink-ripple class="navbar-item inline"><i class="mdi-av-mic i-24"></i></a>
                            </div>
                        </div>
                    </div>
                    <!-- / -->
                </div>

                <script>
                    $(document).ready(function() {
                        var chat_interval = null;

                        $("#btn_chat_list").click(function() {
                            var url = "<?php echo base_url("index.php/chats/getchatlist "); ?>";
                            $("#div_chat_list").empty();
                            $.getJSON(url, function(result) {
                                $.each(result, function(i, field) {
                                    if (field.status == 'empty') {
                                        $("#div_chat_list").append('<div class="list-group-item p-h-md"><div class="clear"><span class="clear text-ellipsis text-xs">No chat available</span></div></div>');
                                    } else {
                                        $("#div_chat_list").append('<a data-toggle="modal" data-id="' + field.event_id + '" data-target="#chat" data-dismiss="modal" class="list-group-item p-h-md open-chatDialog"><img src="' + field.image_url + '" class="pull-left w-40 m-r img-circle"><div class="clear"><span class="font-bold block">' + field.name + '</span><span class="clear text-ellipsis text-xs">' + field.date + '</span></div></a>');
                                    }
                                });
                            });
                        });

                        $("#btn-close-chat").click(function() {
                          clearInterval(chat_interval);
                        });

                        $(document).on("click", ".open-chatDialog", function() {
                            localStorage.setItem('currentChatEventId', $(this).data('id'));
                            $.getJSON("<?php echo base_url('index.php/chats/getchatconversation/'); ?>" + $(this).data('id'), function(result) {
                                $("#messages").empty();
                                $.each(result, function(i, field) {
                                    if (field.status == 'empty') {
                                        // $("#messages").scrollTop($("#message")[0].scrollHeight);
                                    } else {
                                        var message_id = field.message_id;
                                        var account_id = field.account_id;
                                        var full_name = field.first_name + ' ' + field.last_name;
                                        var message = field.message;
                                        var timestamp = field.timestamp;
                                        var image_url = field.image_url;

                                        if (message != '' || message != null) {
                                            if (<?php echo $this->session->userdata('account_id') ?> == account_id) {
                                                $("#messages").append('<div class="m-b"><a href="<?php echo base_url('index.php/accounts/viewaccount/'); ?>'+account_id+'" class="pull-right w-40 m-l-sm"><img src="' + image_url + '" class="w-full img-circle" alt="..."></a><div class="clear text-right"><div class="p p-v-sm bg-info inline text-left r">' + message + '</div><div class="text-muted-lt text-xs m-t-xs">' + timestamp + '</div></div></div>');
                                            } else {
                                                $("#messages").append('<div class="m-b"><a href="<?php echo base_url('index.php/accounts/viewaccount/'); ?>'+account_id+'" class="pull-left w-40 m-r-sm"><img src="' + image_url + '" alt="..." class="w-full img-circle"></a><div class="clear"><div class="p p-v-sm bg-warning inline r">' + message + '</div><div class="text-muted-lt text-xs m-t-xs"><i class="fa fa-ok text-success"></i> ' + timestamp + '</div></div></div>');
                                            }

                                            localStorage.setItem('lastMessageIdReceived', message_id);
                                        }
                                    }
                                });
                                $("#div_chat").animate({
                                  scrollTop: $('#div_chat')[0].scrollHeight - $('#div_chat')[0].clientHeight
                                }, 1000);
                            });

                            $("#btn_send_message").click(function() {
                                var message = $('#txt-message').val();

                                if (message != '' || message == null) {
                                    $("#messages").append('<div class="m-b"><a href="<?php echo base_url('index.php/accounts/viewaccount/').$this->session->userdata('account_id'); ?>" class="pull-right w-40 m-l-sm"><img src="<?php echo $this->session->userdata('account_image'); ?>" class="w-full img-circle" alt="..."></a><div class="clear text-right"><div class="p p-v-sm bg-info inline text-left r">' + message + '</div><div class="text-muted-lt text-xs m-t-xs"><?php echo date('Y - m - d h: i: s '); ?></div></div></div>');

                                    $.ajax({
                                        type: "POST",
                                        url: "<?php echo base_url('index.php/chats/addchat/'); ?>",
                                        data: {
                                            'event_id': localStorage.getItem('currentChatEventId'),
                                            'account_id': <?php echo $this->session->userdata('account_id'); ?>,
                                            'message': message
                                        },
                                        dataType: "json",
                                        success: function(msg, string, jqXHR) {
                                            if (msg.status == 0) {
                                                $('#txt-message').val('');
                                            } else {
                                                alert(msg.message);
                                            }
                                        },
                                        error: function(msg, string, jqXHR) {
                                            alert("An error occured, please try again.");
                                        }
                                    });
                                    $("#div_chat").animate({
                                      scrollTop: $('#div_chat')[0].scrollHeight - $('#div_chat')[0].clientHeight
                                    }, 1000);
                                }
                            });

                            chat_interval = setInterval(function() {
                              $.getJSON("<?php echo base_url('index.php/chats/getchatlatest/'); ?>" + localStorage.getItem('currentChatEventId') + "/" + localStorage.getItem('lastMessageIdReceived') + "/<?php echo $this->session->userdata('account_id') ?>", function(result) {
                                  $.each(result, function(i, field) {
                                      if (field.status != 'empty') {
                                          var message_id = field.message_id;
                                          var account_id = field.account_id;
                                          var full_name = field.full_name;
                                          var message = field.message;
                                          var timestamp = field.timestamp;
                                          var image_url = field.image_url;

                                          if (message_id != localStorage.getItem('lastMessageIdReceived')) {
                                              $("#messages").append('<div class="m-b"><a href="<?php echo base_url('index.php/accounts/viewaccount/'); ?>'+account_id+'" class="pull-left w-40 m-r-sm"><img src="' + image_url + '" class="w-full img-circle"></a><div class="clear"><div class="p p-v-sm bg-warning inline r">' + message + '</div><div class="text-muted-lt text-xs m-t-xs"><i class="fa fa-ok text-success"></i> ' + timestamp + '</div></div></div>');
                                          }

                                          localStorage.setItem('lastMessageIdReceived', message_id);
                                      }
                                  });

                                    $("#div_chat").animate({
                                        scrollTop: $('#div_chat')[0].scrollHeight - $('#div_chat')[0].clientHeight
                                    }, 1000);
                              });
                          }, 2000);

                        });

                    });
                </script>