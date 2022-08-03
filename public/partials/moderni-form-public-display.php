<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://niloyrudra.com/
 * @since      1.0.0
 *
 * @package    Moderni_Form
 * @subpackage Moderni_Form/public/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500&display=swap" rel="stylesheet"> 
<link href="<?php echo MODERNI_FORM_PLUGIN_DIR_PATH . '/public/css/moderni-form-public.css'; ?>" rel="stylesheet" />

<style>
  .moderni-form-container-wrapper {
    display:flex;
    background: linear-gradient(45deg, #FC466B, #3F5EFB);
    min-height: 100vh;
    /* height: auto; */
    font-family: "Montserrat", sans-serif;

    /* position:relative; */
    isolation: isolate;
  }
  .container {
    position: relative;
    margin: 15% auto;
    /* position: absolute;
    transform: translate(-50%, -50%);
    top: 50%;
    left: 50%; */
  }

  form {
    background: rgba(255, 255, 255, 0.3);
    padding: 3em;

    /* height: 320px; */

    border-radius: 20px;
    border-left: 1px solid rgba(255, 255, 255, 0.3);
    border-top: 1px solid rgba(255, 255, 255, 0.3);
    -webkit-backdrop-filter: blur(10px);
            backdrop-filter: blur(10px);
    box-shadow: 20px 20px 40px -6px rgba(0, 0, 0, 0.2);
    text-align: center;
    position: relative;
    transition: all 0.2s ease-in-out;
  }
  form p {
    font-weight: 500;
    color: #fff;
    opacity: 0.7;
    font-size: 1.4rem;
    margin-top: 0;
    margin-bottom: 60px;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
  }
  form a {
    text-decoration: none;
    color: #ddd;
    font-size: 12px;
  }
  form a:hover {
    text-shadow: 2px 2px 6px #00000040;
  }
  form a:active {
    text-shadow: none;
  }
  form input {
    background: transparent;
    width: 200px;
    padding: 1em;
    margin-bottom: 2em;
    border: none;
    border-left: 1px solid rgba(255, 255, 255, 0.3);
    border-top: 1px solid rgba(255, 255, 255, 0.3);
    border-radius: 5000px;
    -webkit-backdrop-filter: blur(5px);
            backdrop-filter: blur(5px);
    box-shadow: 4px 4px 60px rgba(0, 0, 0, 0.2);
    color: #fff;
    font-family: Montserrat, sans-serif;
    font-weight: 500;
    transition: all 0.2s ease-in-out;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
  }
  form input:hover {
    background: rgba(255, 255, 255, 0.1);
    box-shadow: 4px 4px 60px 8px rgba(0, 0, 0, 0.2);
  }
  form input[type=email]:focus, form input[type=password]:focus {
    background: rgba(255, 255, 255, 0.1);
    box-shadow: 4px 4px 60px 8px rgba(0, 0, 0, 0.2);
  }
  form input[type=button] {
    margin-top: 10px;
    width: 150px;
    font-size: 1rem;
  }
  form input[type=button]:hover {
    cursor: pointer;
  }
  form input[type=button]:active {
    background: rgba(255, 255, 255, 0.2);
  }
  form:hover {
    margin: 4px;
  }

  ::-moz-placeholder {
    font-family: Montserrat, sans-serif;
    font-weight: 400;
    color: #fff;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.4);
  }

  :-ms-input-placeholder {
    font-family: Montserrat, sans-serif;
    font-weight: 400;
    color: #fff;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.4);
  }

  ::placeholder {
    font-family: Montserrat, sans-serif;
    font-weight: 400;
    color: #fff;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.4);
  }

  .drop {
    background: rgba(255, 255, 255, 0.3);
    -webkit-backdrop-filter: blur(10px);
            backdrop-filter: blur(10px);
    border-radius: 10px;
    border-left: 1px solid rgba(255, 255, 255, 0.3);
    border-top: 1px solid rgba(255, 255, 255, 0.3);
    box-shadow: 10px 10px 60px -8px rgba(0, 0, 0, 0.2);
    position: absolute;
    transition: all 0.2s ease;
  }
  .drop-1 {
    height: 80px;
    width: 80px;
    top: -20px;
    left: -40px;
    z-index: -1;
  }
  .drop-2 {
    height: 80px;
    width: 80px;
    bottom: -30px;
    right: -10px;
  }
  .drop-3 {
    height: 100px;
    width: 100px;
    bottom: 120px;
    right: -50px;
    z-index: -1;
  }
  .drop-4 {
    height: 120px;
    width: 120px;
    top: -60px;
    right: -60px;
  }
  .drop-5 {
    height: 60px;
    width: 60px;
    bottom: 170px;
    left: 90px;
    z-index: -1;
  }

  a,
  input:focus,
  select:focus,
  textarea:focus,
  button:focus {
    outline: none;
  }
</style>
<div class="moderni-form-container-wrapper">
  <div class="container">
    <!-- <form >
      <p>Welcome</p>
      <input type="email" placeholder="Email"><br>
      <input type="password" placeholder="Password"><br>
      <input type="button" value="Sign in"><br>
      <a href="#">Forgot Password?</a>
    </form> -->
  

    <form method ="post" action="" name="upload_project_video" id="mvf_project_submit_form"  enctype="multipart/form-data" style="display: flex;flex-direction: column;gap: 1rem;">

      <p>Create your project</p>

      <!-- <label for="mvf_title">Your Project Name/Title:</label> -->
      <input type="text" value="" name="mvf_title" id="mvf_title" class="" required placeholder="Your project name/title" />

      <!-- <label for="mvf_type">Your project type:</label> -->
      <input type="text" value="" name="mvf_type" id="mvf_type" class="" required placeholder="Your project type" />
      
      <!-- <label for="mvf_street">Street Name:</label> -->
      <input type="text" value="" name="mvf_street" id="mvf_street" class="" required placeholder="Street name" />
      
      <!-- <label for="mvf_street2">Street Name - 2:</label> -->
      <input type="text" value="" name="mvf_street2" id="mvf_street2" class="" required placeholder="Street name 2" />
      
      <!-- <label for="mvf_city">Your City:</label> -->
      <input type="text" value="" name="mvf_city" id="mvf_city" class="" required placeholder="Your city" />
      
      <!-- <label for="mvf_state">Your State:</label> -->
      <input type="text" value="" name="mvf_state" id="mvf_state" class="" required placeholder="Your state" />
      
      <!-- <label for="mvf_zip_code">Your Zip Code:</label> -->
      <input type="text" value="" name="mvf_zip_code" id="mvf_zip_code" class="" required placeholder="Your zip-code" />
      
      <!-- <label for="mvf_video">Your Video Files</label> -->
      <input type="file" value="" accept="video/*" name="video_content" id="mvf_video" class="" required multiple="multiple" camera placeholder="Your video file" />

      <?php //wp_nonce_field( plugin_basename( __FILE__ ), 'mvf_project_video_nonce' ); ?>

      <input name="security" value="<?php echo wp_create_nonce("uploadingFile"); ?>" type="hidden">


      <!-- <label for="mvf_submit_button"></label> -->
      <input type="submit" value="Submit" name="upload_project_video" id="mvf_submit_button" class="btn" style="cursor: pointer;">

      <div id="mvfNotifications"></div>

    </form>


    <div class="drops">
      <div class="drop drop-1"></div>
      <div class="drop drop-2"></div>
      <div class="drop drop-3"></div>
      <div class="drop drop-4"></div>
      <div class="drop drop-5"></div>
    </div>
  </div>
</div>