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
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-heading">
                        	<img src="<?php echo $profile_image; ?>" class="img-responsive" style="max-width:100px; max-height:200px;"/><br />
                            <p style="font-size:20px;"><b><?php echo $profile_first_name.' '.$profile_last_name; ?></b></p>
                            <small><?php echo $profile_description; ?></small>
                        </div>
                        <div class="card-divider"></div>
                        <div class="card-body">
                            <div id="device" class="row list-icon">
                            	<div class="col-xs-12 col-md-12"><i class="mdi-action-account-circle text-lg m-t-sm pull-left"></i><span><?php echo $profile_username; ?></span></div>
                                <div class="col-xs-12 col-md-12"><i class="mdi-action-accessibility text-lg m-t-sm pull-left"></i><span><?php echo $profile_age; ?> yrs. old</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-heading">
                            <h2 class="font-thin">Upcoming Events</h2>
                        </div>
                        <div class="card-divider"></div>
                        <div class="card-body">
						      <div class="md-list md-whiteframe-z0 bg-white m-b"  id="div_upcoming_events">
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
<!-- / content -->

<script>
    $(document).ready(function() {
    	var url = "<?php echo base_url("index.php/home/getupcomingevents/").$profile_id; ?>";
        $.getJSON(url, function(result) {
            $.each(result, function(i, field) {
                if (field.status == 'empty') {
                    $("#div_upcoming_events").append('No event');
                } else {
                    $("#div_upcoming_events").append('<div class="md-list-item"><a href="<?php echo base_url('index.php/events/viewevent/'); ?>'+field.event_id+'"><div class="md-list-item-left"><img src="'+ field.image_url +'" class="w-full"></div><div class="md-list-item-content"><h3 class="text-md"><b>'+ field.event_name +'</b></h3><small class="font-thin">'+ field.event_date +'</small></div></a></div>');
                }
            });
        });
    });
</script>