<!-- Content -->
      <div class="box-row">
        <div class="box-cell">
          <div class="box-inner padding">
            
  <div class="row">
    <div class="col-lg-6 col-md-5 col-sm-5">
      <div class="row">
        <div id="div_latest_events" class="col-xs-12">
            <script type="text/javascript">
                $(document).ready(function() {
                    var distance = "/"+myCurrentLongitude+"/"+myCurrentLatitude;
                    var url = "<?php echo base_url("index.php/home/getlatestevents"); ?>" + distance;
                    $.getJSON(url, function(result) {
                        $.each(result, function(i, field) {
                            if (field.status == 'empty') {
                                $("#div_latest_events").append('<li><center><p>No event</p><center></li>');
                            } else {
                                if (field.image_url == '' || field.image_url == null) {
                                  var image_url = "<?php echo base_url("assets/images/uploadevent.png"); ?>";
                                } else {
                                  var image_url = field.image_url;
                                }
                                $("#div_latest_events").append('<div class="col-sm-12"><div class="panel panel-card"><div class="item" style="background-color: #CCCCCC; height:200px;"><center><img src="'+ image_url +'" class="img-responsive w-full r-t" alt="No image" style="width:auto; height:200px;"></center></div><a href="<?php echo base_url('index.php/events/viewevent/'); ?>'+field.event_id+'"><button md-ink-ripple class="md-btn md-fab md-raised pink m-r md-fab-offset pull-right"><i class="mdi-image-remove-red-eye i-24"></i></button></a><div class="p"><b style="font-size:18px;">' + field.event_name + '</b><p style="font-size:12px;">' + field.event_date + '</p><p>' + field.location + '</p></div></div></div>');
                                // $("#div_latest_events").append('<div class="col-sm-12"><div class="panel panel-card"><div class="item" style="background-color: #CCCCCC; height:200px;"><center><img src="'+ image_url +'" class="w-full r-t" alt="No image" style="width:auto; height:200px;"></center></div><a href="<?php echo base_url('index.php/events/viewevent/'); ?>'+field.event_id+'"><button md-ink-ripple class="md-btn md-fab md-raised pink m-r md-fab-offset pull-right"><i class="mdi-image-remove-red-eye i-24"></i></button></a><div class="p"><b style="font-size:18px;">' + field.event_name + '</b><p style="font-size:12px;">' + field.event_date + ' - ' + field.distance + ' Km</p><p>' + field.location + '</p></div></div></div>');
                            }
                        });
                    });
                });
            </script>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-4">
      <div class="card">
        <div class="card-heading">
          <h2>My Events</h2>
        </div>
        <div class="card-body">
          <div id="div_my_events" class="streamline b-l b-accent m-b">
            <script type="text/javascript">
                $(document).ready(function() {
                    var url = "<?php echo base_url("index.php/home/getmyevents"); ?>";
                    $.getJSON(url, function(result) {
                        $.each(result, function(i, field) {
                            if (field.status == 'empty') {
                                $("#div_my_events").append('<div class="sl-item"><div class="sl-content"><div class="text-muted-dk">No event</div></div>');
                            } else {
                                $("#div_my_events").append('<div class="sl-item"><div class="sl-content"><div><a href="<?php echo base_url('index.php/events/viewevent/'); ?>'+field.event_id+'" class="text-info"><b>'+ field.event_name +'</b></a></div><p style="font-size:12px;">'+field.event_date+'</p></div>');
                            }
                        });
                    });
                });
            </script>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-4">
        <div class="card">
            <div class="card-heading">
              <h2>Other Events</h2>
            </div>
            <div class="card-body">
              <div id="div_other_events" class="streamline b-l b-accent m-b">
                <script type="text/javascript">
                    $(document).ready(function() {
                        var url = "<?php echo base_url("index.php/home/getotherevents"); ?>";
                        $.getJSON(url, function(result) {
                            $.each(result, function(i, field) {
                                if (field.status == 'empty') {
                                    $("#div_other_events").append('<div class="sl-item"><div class="sl-content"><div class="text-muted-dk">No event</div></div>');
                                } else {
                                    $("#div_other_events").append('<div class="sl-item"><div class="sl-content"><div><a href="<?php echo base_url('index.php/events/viewevent/'); ?>'+field.event_id+'" class="text-info"><b>'+ field.event_name +'</b></a></div><p style="font-size:12px;">'+field.event_date+'</p></div>');
                                }
                            });
                        });
                    });
                </script>
              </div>
            </div>
          </div>
    </div>
  </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>

    var myCurrentLatitude = 0;
    var myCurrentLongitude = 0;

    try {
      var options = {
          enableHighAccuracy: true,
          maximumAge: 3600000
      }

      var watchID = navigator.geolocation.getCurrentPosition(onSuccess, onError, options);

      function onSuccess(position) {
          myCurrentLatitude = position.coords.latitude;
          myCurrentLongitude = position.coords.longitude;
      };

      function onError(error) {
          // alert('code: ' + error.code + '\n' + 'message: ' + error.message + '\n');
      }
    } catch (err) { 
        // alert(err.message);
    } 
    
  </script>
  <!-- / content -->
