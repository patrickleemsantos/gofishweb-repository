<style>
    #map-canvas {
        margin: 0;
        padding: 0;
        height: 400px;
        max-width: none;
    }
    #map-canvas img {
        max-width: none !important;
    }
</style>
<!-- Content -->

<div class="box-row">
    <div class="box-cell">
        <div class="box-inner padding">


            <div class="row row-sm">
                <div class="col-sm-3">
                    <div class="panel panel-card">
                        <div class="r-t pos-rlt" md-ink-ripple>
                            <div class="p-lg bg-white-overlay text-center r-t">
                                <a href="<?php echo base_url("index.php/accounts/viewaccount/").$host_id; ?>" class="w-xs inline">
                                  <img src="<?php echo $host_image; ?>" class="img-circle img-responsive" style="width:100%; height:100%;">
                                </a>
                                <div class="m-b m-t-sm h2">
                                    <span class=""><?php echo $host_first_name.' '.$host_last_name; ?></span>
                                    <br />
                                    <small><?php echo $host_age; ?> yrs. old</small>
                                </div>
                            </div>
                        </div>
                        <div class="p">
                            <p><b>My interest are</b>
                            </p>
                            <p>
                                <?php echo $host_description; ?>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-sm-9">
                    <div class="card">
                        <div class="card-heading">
                            <p style="font-size:20px;"><b><?php echo $event_name; ?></b></p>
                            <small><b>Description: </b><?php echo $event_description; ?></small>
                        </div>
                        <?php
                          if ($host_id == $account_id) {
                        ?>
                        <div class="card-tools">
                            <button id="btn_remove" md-ink-ripple class="md-btn md-raised m-b btn-fw red" >Remove</button>
                            <br>
                        </div>
                        <?php
                          }
                        ?>
                        <div class="card-divider"></div>
                        <div class="card-body">
                            <div id="device" class="row list-icon">
                                <div class="col-xs-12 col-md-12"><i class="mdi-communication-location-on text-lg m-t-sm pull-left"></i><span style="font-size:18px;"><b><?php echo $event_location; ?></b></span>
                                </div>
                                <!-- <div class="col-xs-12 col-md-12"><i class="mdi-maps-navigation text-lg m-t-sm pull-left"></i><span><?php echo $distance.' km'; ?></span>
                                </div> -->
                                <div class="col-xs-12 col-md-12"><i class="mdi-device-access-time text-lg m-t-sm pull-left"></i><span><?php echo $event_date; ?></span>
                                </div>
                                <div class="col-xs-12 col-md-12"><i class="mdi-social-people text-lg m-t-sm pull-left"></i><span>Age between <b><?php echo $min_age; ?></b> to <b><?php echo $max_age; ?></b></span>
                                </div>
                                <!-- <div class="col-xs-12 col-md-12"><i class="mdi-action-description text-lg m-t-sm pull-left"></i><span><?php echo $event_description; ?></span> 
                                </div> -->
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-heading">
                            <h2 class="font-thin">Participants</h2>
                            <small>Max of <b><?php echo $max_participants; ?></b> people</small>
                        </div>
                        <div class="card-tools">
                            <button id="btn_attend" md-ink-ripple class="md-btn md-raised m-b btn-fw green" style="margin-top:13px;">Attend</button>
                            <br>
                        </div>
                        <div class="card-tools">
                            <button id="btn_unattend" md-ink-ripple class="md-btn md-raised m-b btn-fw green" style="margin-top:13px;">Unattend</button>
                            <br>
                        </div>
                        <div class="card-divider"></div>
                        <div class="card-body" id="div_participants">
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-heading">
                            <h2 class="font-thin">Event Image</h2>
                        </div>
                        <div class="card-divider"></div>
                        <div class="card-body">
                           <center><img src="<?php echo $event_image; ?>" class="img-responsive"/></center>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-heading">
                            <h2 class="font-thin">Map</h2>
                        </div>
                        <div class="card-divider"></div>
                        <div class="card-body">
                           <div id="map-canvas"></div>
                        </div>
                    </div>
                    <!-- <div class="card">
                        <div class="card-heading">
                            <h2 class="font-thin">Hosted by: <b><?php echo $host_first_name.' '.$host_last_name; ?></b></h2>
                            <small><?php echo $host_description; ?></small>
                        </div>
                        <div class="card-divider"></div>
                        <div class="card-body">
                            <a href class="m-r-xs inline">
                          <img src="<?php echo $host_image; ?>" class="w-40 img-circle" style="height:70px; width:70px;">
                        </a>
                        </div>
                    </div> -->
                   <!--  <div class="panel panel-card">
                        <div id="map-canvas"></div>
                    </div> -->
                </div>
            </div>
            <?php
              if ($host_id == $account_id) {
            ?>
            <a href="<?php echo base_url('index.php/events/editevent/').$event_id; ?>" md-ink-ripple class="md-btn md-fab md-fab-bottom-right pos-fix pink"><i class="mdi-editor-mode-edit i-24"></i></a>
            <?php
              }
            ?>
        </div>
    </div>
</div>
</div>
</div>
<!-- / content -->

<script>
    $(document).ready(function() {
        $('#btn_attend').hide();
        $('#btn_unattend').hide();
        var map;
        var marker;

        if (<?php echo $account_id; ?> != <?php echo $host_id; ?>) {
          $('#btn_attend').show();
        }

        function initialize() {
            var mapOptions = {
                center: new google.maps.LatLng(40.680898, -8.684059),
                zoom: 11,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };

            map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);

            var addressInput = "<?php echo $event_location; ?>";
            var geocoder = new google.maps.Geocoder();

            geocoder.geocode({
                address: addressInput
            }, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    var myResult = results[0].geometry.location;
                    createMarker(myResult);
                    map.setCenter(myResult);
                    map.setZoom(17);
                }
            });

        }

        google.maps.event.addDomListener(window, 'load', initialize);

        function createMarker(latlng) {
            if (marker != undefined && marker != '') {
                marker.setMap(null);
                marker = '';
            }

            marker = new google.maps.Marker({
                map: map,
                position: latlng
            });
        }

        $.getJSON("<?php echo base_url('index.php/events/getparticipants/').$event_id; ?>", function(result) {
            $.each(result, function(i, field) {
                if (field.status == 'empty') {
                    $("#div_participants").prepend('<p>No participants</p>');
                } else {
                    var participant_id = field.participant_id;
                    var participant_name = field.participant_name;
                    var participant_image = field.participant_image;
                    if (participant_image == '' || participant_image == null) {
                        participant_image = '';
                    }

                    if (<?php echo $account_id; ?> == field.participant_id) {
                      $('#btn_attend').hide();
                      $('#btn_unattend').show();
                    }

                    $("#div_participants").prepend('<a href="<?php echo base_url('index.php/accounts/viewaccount/'); ?>'+field.participant_id+'" class="m-r-xs inline" title="' + participant_name + '" style="margin-bottom:5px;"><img src="' + participant_image + '" class=" img-circle" style="height:70px; width:70px;" alt="' + participant_name + '"></a>');
                }
            });
        });

        $("#btn_attend").click(function() {
          $('#btn_attend').attr('disabled', true);
          $.ajax({
              type: "POST",
              url: "<?php echo base_url('index.php/events/addParticipant/').$event_id.'/'.$max_participants; ?>",
              dataType: "json",
              success: function(msg, string, jqXHR) {
                  if (msg.status == 'Success') {
                      alert('You successfully joined the event');
                      $('#btn_attend').hide();
                      $('#btn_unattend').show();
                      $("#div_participants").empty();
                      $.getJSON("<?php echo base_url('index.php/events/getparticipants/').$event_id; ?>", function(result) {
                          $.each(result, function(i, field) {
                              if (field.status == 'empty') {
                                  $("#div_participants").prepend('<p>No participants</p>');
                              } else {
                                  var participant_id = field.participant_id;
                                  var participant_name = field.participant_name;
                                  var participant_image = field.participant_image;
                                  if (participant_image == '' || participant_image == null) {
                                      participant_image = '';
                                  }

                                  $("#div_participants").prepend('<a href="<?php echo base_url('index.php/accounts/viewaccount/'); ?>'+field.participant_id+'" class="m-r-xs inline" title="' + participant_name + '" style="margin-bottom:5px;"><img src="' + participant_image + '" class=" img-circle" style="height:70px; width:70px;" alt="' + participant_name + '"></a>');
                              }
                          });
                      });
                  } else {
                      alert(msg.status);
                  }
                  $('#btn_attend').removeAttr("disabled");
              },
              error: function(msg, string, jqXHR) { 
                  alert("An error occured, please try again.");
                  $('#btn_attend').removeAttr("disabled");
              }
          });
      });

      $("#btn_unattend").click(function() {
          var r = confirm("Are you sure?");
          if (r == true) {
            $('#btn_unattend').attr('disabled', true);
            $.ajax({
                type: "POST",
                url: "<?php echo base_url('index.php/events/deleteparticipant/').$event_id; ?>",
                dataType: "json",
                success: function(msg, string, jqXHR) {
                    if (msg.status == 'Success') {
                        alert('You successfully left the event');
                        $('#btn_attend').show();
                        $('#btn_unattend').hide();
                        $("#div_participants").empty();
                        $.getJSON("<?php echo base_url('index.php/events/getparticipants/').$event_id; ?>", function(result) {
                            $.each(result, function(i, field) {
                                if (field.status == 'empty') {
                                    $("#div_participants").prepend('<p>No participants</p>');
                                } else {
                                    var participant_id = field.participant_id;
                                    var participant_name = field.participant_name;
                                    var participant_image = field.participant_image;
                                    if (participant_image == '' || participant_image == null) {
                                        participant_image = '';
                                    }

                                    $("#div_participants").prepend('<a href="<?php echo base_url('index.php/accounts/viewaccount/'); ?>'+field.participant_id+'" class="m-r-xs inline" title="' + participant_name + '" style="margin-bottom:5px;"><img src="' + participant_image + '" class=" img-circle" style="height:70px; width:70px;" alt="' + participant_name + '"></a>');
                                }
                            });
                        });
                    } else {
                        alert(msg.status);
                    }
                },
                error: function(msg, string, jqXHR) { 
                    alert("An error occured, please try again.");
                    $('#btn_unattend').removeAttr("disabled");
                }
            });
            $('#btn_unattend').removeAttr("disabled");
        }
      });

      $("#btn_remove").click(function() {
        var r = confirm("Are you sure?");
          if (r == true) {
            $('#btn_remove').attr('disabled', true);
              $.ajax({
                  type: "POST",
                  url: "<?php echo base_url('index.php/events/deleteevent/').$event_id; ?>",
                  dataType: "json",
                  success: function(msg, string, jqXHR) {
                      alert(msg.message);
                      window.location="<?php echo base_url('index.php/home'); ?>";
                  },
                  error: function(msg, string, jqXHR) { 
                      alert("An error occured, please try again.");
                      $('#btn_remove').removeAttr("disabled");
                  }
              });
            $('#btn_remove').removeAttr("disabled");
          }
      });
    });
</script>