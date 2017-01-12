  <!-- Content -->

      <div class="box-row">
        <div class="box-cell">
          <div class="box-inner padding">

  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading bg-white">
          <b>Update Event</b><br>
        </div>
        <div class="panel-body">
          <form class="form-horizontal" role="form" method="post" action="" id="form-edit-event">
		  <div class="form-group">
			  <label class="col-sm-2 control-label">Image</label>
			  <div class="col-sm-10">
				<input type="file" id="txt-event-image" name="txt-event-image">
        <input type="hidden" id="txt-hidden-event-image" value="<?php echo $event_image; ?>">
			  </div>
			</div>
            <div class="form-group">
              <label for="txt-event" class="col-sm-2 control-label">Name</label>
              <div class="col-sm-10">
                <input type="texts" class="form-control" id="txt-event-name" placeholder="I Feel Like..." value="<?php echo $event_name; ?>" required>
              </div>
            </div>
            <div class="form-group">
              <label for="txt-date" class="col-sm-2 control-label">Date</label>
              <div class="col-sm-10">
                <input type="datetime-local" class="form-control" id="txt-event-date" placeholder="Date" value="<?php echo $formatted_date; ?>"required>
              </div>
            </div>
			<div class="form-group">
              <label for="txt-location" class="col-sm-2 control-label">Location</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="txt-location" placeholder="Location" value="<?php echo $event_location; ?>" required>
              </div>
            </div>
			<div class="form-group">
              <label for="txt-description" class="col-sm-2 control-label">Description</label>
              <div class="col-sm-10">
                <textarea id="txt-description" class="form-control" rows="3" placeholder="Description" equired><?php echo $event_description; ?></textarea>
              </div>
            </div>
			<div class="form-group">
              <label for="txt-age" class="col-sm-2 control-label">With people between</label>
              <div class="col-sm-6">
                <input id="txt-age" type="text" />
              </div>
            </div>
			<div class="form-group">
              <label for="txt-participants" class="col-sm-2 control-label">Participants</label>
              <div class="col-sm-6">
                <input id="txt-participants" type="text" />
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
    var longitude = <?php echo $longitude; ?>;
    var latitude = <?php echo $latitude; ?>;

    $("#txt-location").keyup(function() {
      longitude = '';
      latitude = '';
    });

   $("#txt-age").ionRangeSlider({
     type: "double",
     min: 1,
     max: 100,
      from: <?php echo $min_age; ?>,
      to: <?php echo $max_age; ?>
   });
    
   $("#txt-participants").ionRangeSlider({
     min: 1,
     max: 999,
      from: <?php echo $max_participants; ?>
   });

    // $("#txt-event-date").val(new Date().toJSON().slice(0,16));
    
    google.maps.event.addDomListener(window, 'load', function() {
      var places = new google.maps.places.Autocomplete(document.getElementById('txt-location'));
      google.maps.event.addListener(places, 'place_changed', function() {
        place = places.getPlace();
        address = place.formatted_address;
        latitude = place.geometry.location.lat();
        longitude = place.geometry.location.lng();
      });
    });

    $('#form-edit-event').submit(function(e) {
      event.preventDefault();
      var event_name = $("#txt-event-name").val();
      var date = $("#txt-event-date").val();
      var location = $("#txt-location").val();
      var description = $("#txt-description").val();
      var age = $("#txt-age").val();
      var age_array = age.split(";");
      var min_age = age_array[0];
      var max_age = age_array[1];
      var max_participants = $("#txt-participants").val();
      var image_url = $("#txt-hidden-event-image").val();

      if (event_name == '' || event_name == null) {
        alert('Please enter event name');
        return false;
      }

      if (date == '' || date == null) {
        alert('Please enter event date');
        return false;
      }

      if (latitude == '' || longitude == '') {
        alert('Please enter a valid location');
        return false;
      }

      if (description == '' || description == null) {
        alert('Please enter description');
        return false;
      }

      if (min_age == '' || min_age == null) {
        alert('Please enter minimum age');
        return false;
      }

      if (max_age == '' || max_age == null) {
        alert('Please enter maximum age');
        return false;
      }

      if (min_age > max_age) {
        alert('Minimum age cannot be greater than max age');
        return false;
      }

      if (max_participants == '' || max_participants == null) {
        alert('Please enter maximum participant');
        return false;
      }

      $.ajaxFileUpload({
        url       : "<?php echo base_url('index.php/events/updateevent'); ?>", 
        secureuri   : false,
        fileElementId : 'txt-event-image',
        dataType    : 'json',
        data      : {
          'event_id': <?php echo $event_id; ?>,
          'event_name':event_name,
          'event_date': date,
          'location': location,
          'longitude': longitude,
          'latitude': latitude,
          'description': description,
          'min_age': min_age,
          'max_age': max_age,
          'max_participants': max_participants,
          'image_url': image_url
        },
        success : function (data, status) {
          if(data.status != 'error') {
            clearEvent();
            window.location="<?php echo base_url('index.php/events/viewevent/').$event_id; ?>";
          }
          alert(data.msg);
        }
      });
      return false;
    });

    function clearEvent() {
      $("#txt-event-image").val('');
      $("#txt-event-name").val('');
      $("#txt-event-date").val(new Date().toJSON().slice(0,19));
      $("#txt-location").val('');
      $("#txt-description").val('');
      $("#txt-age").data("ionRangeSlider").reset();
      $("#txt-participants").data("ionRangeSlider").reset();
      latitude = '';
      longitude = '';
    }
  });

</script>   
