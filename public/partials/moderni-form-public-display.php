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
<form action="" method="post">
    <label for="vidUploader">
        <input id="vidUploader" type="file" accept="video/*" capture />
        <!-- <input type="file" accept="video/*" capture="user" />
        <input type="file" accept="video/*" capture="environment" /> -->
    </label>
</form>

<video id="player" controls></video>
<script defer>
  var recorder = document.getElementById('vidUploader');
  var player = document.getElementById('player');

  var handleSuccess = function (stream) {
    player.srcObject = stream;
  };
  

  navigator.permissions.query({name: 'camera'}).then(function (result) {
    if (result.state == 'granted') {
        console.log("GRANTED")
    } else if (result.state == 'prompt') {
        console.log("PROMPTED")
    } else if (result.state == 'denied') {
        console.log("DENIED")
        return;
    }
    result.onchange = function () {};
    });

  navigator.mediaDevices
    .getUserMedia({audio: true, video: true})
    .then(handleSuccess);

  navigator.mediaDevices.enumerateDevices().then((devices) => {
    devices = devices.filter((d) => d.kind === 'videoinput');
  });
  navigator.mediaDevices.getUserMedia({
    audio: true,
    video: {
        deviceId: devices[0].deviceId,
    },
  });

  recorder.addEventListener('change', function (e) {
    var file = e.target.files[0];
    // Do something with the video file.
    player.src = URL.createObjectURL(file);
  });
</script>

<a id="download">Download</a>
<button id="stop">Stop</button>

<script>
  let shouldStop = false;
  let stopped = false;
  const downloadLink = document.getElementById('download');
  const stopButton = document.getElementById('stop');

  stopButton.addEventListener('click', function() {
    shouldStop = true;
  })

  var handleSuccess = function(stream) {
    const options = {mimeType: 'video/webm'};
    const recordedChunks = [];
    <strong>const mediaRecorder = new MediaRecorder(stream, options);

    mediaRecorder.addEventListener('dataavailable', function(e) {
      if (e.data.size > 0) {
        recordedChunks.push(e.data);
      }

      if(shouldStop === true && stopped === false) {
        mediaRecorder.stop();
        stopped = true;
      }
    });

    mediaRecorder.addEventListener('stop', function() {
      downloadLink.href = URL.createObjectURL(new Blob(recordedChunks));
      downloadLink.download = 'acetest.webm';
    });

    mediaRecorder.start();</strong>
  };

  navigator.mediaDevices.getUserMedia({ audio: true, video: true })
      .then(handleSuccess);
</script>