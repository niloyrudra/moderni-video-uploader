<style>
    /* 64ac15 */
    *,
    *:before,
    *:after {
      box-sizing: border-box;
    }
    body {
      /* padding: 1em; */
      /* font-family: "Open Sans", "Helvetica Neue", Helvetica, Arial, sans-serif; */
      /* font-size: 15px; */
      /* color: #b9b9b9; */
      /* background-color: #e3e3e3; */
    }
    #moderni-form-2 h4 {
		  color: #f0a500;
    }
    #moderni-form-2 textarea {
      font-size:14px;
    }
    #moderni-form-2 input,
	  #moderni-form-2 textarea,
    #moderni-form-2 input[type="radio"] + label,
    #moderni-form-2 input[type="checkbox"] + label:before,
    #moderni-form-2 select option,
    #moderni-form-2 select {
      width: 100%;
      padding: 1em;
      line-height: 1.4;
      background-color: #f9f9f9;
      border: 1px solid #e5e5e5;
      border-radius: 3px;
      -webkit-transition: 0.35s ease-in-out;
      -moz-transition: 0.35s ease-in-out;
      -o-transition: 0.35s ease-in-out;
      transition: 0.35s ease-in-out;
      transition: all 0.35s ease-in-out;
    }
    #moderni-form-2 input:focus,
	  #moderni-form-2 textarea:focus {
      outline: 0;
      border-color: #bd8200;
    }
    #moderni-form-2 input:focus + .input-icon i,
	  #moderni-form-2 textarea:focus + .input-icon i {
		  color: #f0a500;
    }
    #moderni-form-2 input:focus + .input-icon:after,
	  #moderni-form-2 textarea:focus + .input-icon:after {
		  border-right-color: #f0a500;
    }
    #moderni-form-2 input[type="radio"] {
		  display: none;
    }
    /* #moderni-form-2 select, */
      #moderni-form-2 input[type="radio"] + label {
      display: inline-block;
      width: 50%;
      text-align: center;
      float: left;
      border-radius: 0;
    }
    #moderni-form-2 input[type="radio"] + label:first-of-type {
      border-top-left-radius: 3px;
      border-bottom-left-radius: 3px;
    }
    #moderni-form-2 input[type="radio"] + label:last-of-type {
      border-top-right-radius: 3px;
      border-bottom-right-radius: 3px;
    }
    #moderni-form-2 input[type="radio"] + label i {
		  padding-right: 0.4em;
    }
    #moderni-form-2 input[type="radio"]:checked + label,
    #moderni-form-2 input:checked + label:before,
    #moderni-form-2 select:focus,
    #moderni-form-2 select:active {
      background-color: #f0a500;
      color: #fff;
      border-color: #bd8200;
    }
    #moderni-form-2 input[type="checkbox"] {
      display: none;
    }
    #moderni-form-2 input[type="checkbox"] + label {
      position: relative;
      display: block;
      padding-left: 1.6em;
    }
    #moderni-form-2 input[type="checkbox"] + label:before {
      position: absolute;
      top: 0.2em;
      left: 0;
      display: block;
      width: 1em;
      height: 1em;
      padding: 0;
      content: "";
    }
    #moderni-form-2 input[type="checkbox"] + label:after {
      position: absolute;
      top: 0.45em;
      left: 0.2em;
      font-size: 0.8em;
      color: #fff;
      opacity: 0;
      font-family: FontAwesome;
      content: "\f00c";
    }
    #moderni-form-2 input:checked + label:after {
    	opacity: 1;
    }
    #moderni-form-2 select {
      height: 3.4em;
      line-height: 2;
    }
    #moderni-form-2 select:first-of-type {
      border-top-left-radius: 3px;
      border-bottom-left-radius: 3px;
    }
    #moderni-form-2 select:last-of-type {
      border-top-right-radius: 3px;
      border-bottom-right-radius: 3px;
    }
    #moderni-form-2 select:focus,
    #moderni-form-2 select:active {
    	outline: 0;
    }
    #moderni-form-2 select option {
      background-color: #f0a500;
      color: #fff;
    }
    #moderni-form-2 .input-group {
      margin-bottom: 1em;
      zoom: 1;
    }
    #moderni-form-2 .input-group:before,
    #moderni-form-2 .input-group:after {
    	content: "";
    	display: table;
    }
    #moderni-form-2 .input-group:after {
    	clear: both;
    }
    #moderni-form-2 .input-group-icon {
    	position: relative;
    }
    #moderni-form-2 .input-group-icon input,
    #moderni-form-2 .input-group-icon textarea,
    #moderni-form-2 .input-group-icon select {
    	padding-left: 4.4em;
    }
    #moderni-form-2 .input-group-icon select {
      text-align: left;
      color: #333;
    }

    #moderni-form-2 .input-group-icon .input-icon {
      position: absolute;
      top: 0;
      left: 0;
      width: 3.4em;
      height: 3.4em;
      line-height: 3.4em;
      text-align: center;
      pointer-events: none;
    }
    #moderni-form-2 .input-group-icon .input-icon:after {
      position: absolute;
      top: 0.6em;
      bottom: 0.6em;
      left: 3.4em;
      display: block;
      border-right: 1px solid #e5e5e5;
      content: "";
      -webkit-transition: 0.35s ease-in-out;
      -moz-transition: 0.35s ease-in-out;
      -o-transition: 0.35s ease-in-out;
      transition: 0.35s ease-in-out;
      transition: all 0.35s ease-in-out;
    }
    #moderni-form-2 .input-group-icon .input-icon i {
      -webkit-transition: 0.35s ease-in-out;
      -moz-transition: 0.35s ease-in-out;
      -o-transition: 0.35s ease-in-out;
      transition: 0.35s ease-in-out;
      transition: all 0.35s ease-in-out;
    }
    #moderni-form-2.container {
      max-width: 38em;
      padding: 1em 3em 2em 3em;
      margin: 0em auto;
      background-color: #fff;
      border-radius: 4.2px;
      box-shadow: 0px 3px 10px -2px rgba(0, 0, 0, 0.2);
    }

    @media ( max-width:767px ) {
      #moderni-form-2.container {
        padding: 1em 2em 2em 2em;
      }
    }
    @media ( max-width:420px ) {
      #moderni-form-2.container {
        padding: 1em 1em 2em 1em;
      }
    }

    #moderni-form-2 .row {
		  zoom: 1;
    }
    #moderni-form-2 .row:before,
    #moderni-form-2 .row:after {
      content: "";
      display: table;
    }
    #moderni-form-2 .row:after {
		  clear: both;
    }
    #moderni-form-2 .col-half {
      padding-right: 10px;
      float: left;
      width: 50%;
    }
    #moderni-form-2 .col-half:last-of-type {
		  padding-right: 0;
    }
    #moderni-form-2 .col-third {
      padding-right: 10px;
      float: left;
      width: 33.33333333%;
    }
    #moderni-form-2 .col-third:last-of-type {
		  padding-right: 0;
    }
    @media only screen and (max-width: 540px) {
        #moderni-form-2 .col-half {
            width: 100%;
            padding-right: 0;
        }
    }
</style>

<div id="moderni-form-2" class="container">

    <form method ="post" action="" name="upload_project_video" id="mvf_project_submit_form"  enctype="multipart/form-data" style="display: flex;flex-direction: column;gap: 1rem;">      

      <div class="row">
        <h4>Create your project</h4>

        <div class="input-group input-group-icon">
          <input type="text" value="" name="mvf_title" id="mvf_title" class="" required placeholder="Your project name/title" />
          <div class="input-icon"><i class="fa fa-home" aria-hidden="true"></i></div>
        </div>

        <div class="input-group input-group-icon">
          <select name="mvf_type" id="mvf_type">
            <option value=""><?php _e( "Select your project type" ); ?></option>
            <?php
              $args = array(
                "taxonomy"    => "mvf_property_type",
                "hide_empty"  => 0,
                'orderby'     => 'name',
                'order'       => 'ASC',
              );
              $property_types = get_terms( $args );
              if( $property_types ) {
                foreach( $property_types as $property_type ) :
                ?>
                  <option value="<?php echo $property_type->term_id; ?>"><?php echo $property_type->name; ?></option>
                <?php
                endforeach;
              }
            ?>
            
          </select>
          <div class="input-icon"><i class="fa fa-list-alt" aria-hidden="true"></i></div>
        </div>
			
        <div class="input-group input-group-icon">
          <textarea type="text" value="" name="mvf_detail" id="mvf_detail" class="" required placeholder="Your project details" cols="30" rows="6"></textarea>
          <div class="input-icon"><i class="fa fa-info-circle" aria-hidden="true"></i></div>
        </div>

        <div class="input-group input-group-icon">
          <input type="text" value="" name="mvf_street" id="mvf_street" class="" required placeholder="Street name" />
          <div class="input-icon"><i class="fa fa-street-view" aria-hidden="true"></i></div>
        </div>

        <div class="input-group input-group-icon">
          <input type="text" value="" name="mvf_street2" id="mvf_street2" class="" placeholder="Street 2 name" />
          <div class="input-icon"><i class="fa fa-map-signs"></i></div>
        </div>

        <div class="input-group input-group-icon">
          <input type="text" value="" name="mvf_city" id="mvf_city" class="" required placeholder="City name" />
          <div class="input-icon"><i class="fa fa-map-marker" aria-hidden="true"></i></div>
        </div>

        <div class="input-group input-group-icon">
          <input type="text" value="" name="mvf_state" id="mvf_state" class="" required placeholder="State name" />
          <div class="input-icon"><i class="fa fa-map-pin"></i></div>
        </div>

        <div class="input-group input-group-icon">
          <input type="text" value="" name="mvf_zip_code" id="mvf_zip_code" class="" required placeholder="Zip-code" />
          <div class="input-icon"><i class="fa fa-road"></i></div>
        </div>
        
        <?php if( !is_user_logged_in() ) : ?>
          <div class="input-group input-group-icon">
            <input type="text" value="" name="mvf_name" id="mvf_name" class="" required placeholder="Your name" />
            <div class="input-icon"><i class="fa fa-user"></i></div>
          </div>

          <div class="input-group input-group-icon">
            <input type="text" value="" name="mvf_email" id="mvf_email" class="" required placeholder="Your email" />
            <div class="input-icon"><i class="fa fa-at"></i></div>
          </div>

          <div class="input-group input-group-icon">
            <input type="text" value="" name="mvf_telephone" id="mvf_telephone" class="" required placeholder="Your telephone number" />
            <div class="input-icon"><i class="fa fa-phone"></i></div>
          </div>
        <?php endif; ?>

        <div class="input-group input-group-icon">
          <input type="file" value="" accept="image/*" name="mvf_gallary_image[]" id="mvf_gallary_image" class="" required multiple="multiple" camera placeholder="Upload your gallery images" />
          <div class="input-icon"><i class="fa fa-images"></i></div>
        </div>

        <div class="input-group input-group-icon">
          <input type="file" value="" accept="video/*" name="video_content" id="mvf_video" class="" required multiple="multiple" camera placeholder="Your video file" />
          <div class="input-icon"><i class="fa fa-video"></i></div>
          <!-- <div class="input-icon"><i class="fa fa-upload"></i></div> -->
        </div>

        <input name="security" value="<?php echo wp_create_nonce("uploadingFile"); ?>" type="hidden">

      </div>

        <!-- <div class="row">
        <h4>Terms and Conditions</h4>
        <div class="input-group">
            <input id="terms" type="checkbox"/>
            <label for="terms">I accept the terms and conditions for signing up to this service, and hereby confirm I have read the privacy policy.</label>
        </div>
        </div> -->

      <div class="row">
        <div class="input-group">
          <input type="submit" value="Submit" name="upload_project_video" id="mvf_submit_button" class="btn">
          <label for="terms"><div id="mvfNotifications"></div></label>
        </div>
      </div>

    </form>

</div>