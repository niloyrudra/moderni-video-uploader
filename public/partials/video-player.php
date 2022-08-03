<style>

                @font-face {
                    font-family: 'HeydingsControlsRegular';
                    src: url( <?php echo MODERNI_FORM_PLUGIN_DIR_URL . 'public/fonts/heydings_controls-webfont.eot'; ?> );
                    src: url( <?php echo MODERNI_FORM_PLUGIN_DIR_URL . 'public/fonts/heydings_controls-webfont.eot?#iefix'; ?> ) format('embedded-opentype'),
                            url( <?php echo MODERNI_FORM_PLUGIN_DIR_URL . 'public/fonts/heydings_controls-webfont.woff'; ?> ) format('woff'),
                            url( <?php echo MODERNI_FORM_PLUGIN_DIR_URL . 'public/fonts/heydings_controls-webfont.ttf'; ?> ) format('truetype');
                    font-weight: normal;
                    font-style: normal;
                }
                button {
                    position: relative;
                    border: 0;
                    flex: 1;
                    outline: none;
                }
                button, .timer {
                    height: 38px;
                    line-height: 19px;
                    box-shadow: inset 0 -5px 25px rgb(0 0 0 / 30%);
                    border-right: 1px solid #333;
                }

                button:before {
                    font-family: HeydingsControlsRegular;
                    font-size: 20px;
                    position: relative;
                    content: attr(data-icon);
                    color: #aaa;
                    text-shadow: 1px 1px 0px black;
                }
                button:hover, button:focus {
                    box-shadow: inset 1px 1px 2px black;
                }

                button, .controls {
                    background: linear-gradient(to bottom,#222,#666);
                }
                .controls {
                    visibility: hidden;
                    opacity: 0.5;
                    width: 400px;
                    border-radius: 10px;
                    position: absolute;
                    bottom: 20px;
                    left: 50%;
                    margin-left: -200px;
                    background-color: black;
                    box-shadow: 3px 3px 5px black;
                    transition: 1s all;
                    display: flex;
                }
                .controls:hover,
                .controls:focus {
                    opacity:1;
                }
                .player {
                    position:relative;
                    isolation:isolate;
                }

                .player video {
                    width: 100%;
                    height: auto;
                    background-color: slategray;
                }

                .player:hover .controls, 
                .player:focus-within .controls {
                    opacity: 1;
                }
                .play {
                    border-radius: 10px 0 0 10px;
                }
                .fwd {
                    border-radius: 0 10px 10px 0;
                }
                .timer {
                    line-height: 38px;
                    height: 38px;
                    font-size: 10px;
                    font-family: monospace;
                    text-shadow: 1px 1px 0px black;
                    color: white;
                    flex: 5;
                    position: relative;
                }
                .timer div {
                    position: absolute;
                    background-color: rgba(255,255,255,0.2);
                    left: 0;
                    top: 0;
                    width: 0;
                    height: 38px;
                    z-index: 2;
                }

                .timer span {
                    position: absolute;
                    z-index: 3;
                    left: 19px;
                }
                .morderni-form-video-player {
                    padding:3%;
                }
            </style>

            <div class="player morderni-form-video-player">
                <video>
                    <source src="<?php echo esc_url( get_post_meta( get_the_ID(), '_mvf_project_vid_url', true ) ); ?>" type="video/mp4">
                    <!-- <source src="video/sintel-short.webm" type="video/webm"> -->
                    <!-- fallback content here -->
                </video>
                <div class="controls" style="visibility:visible;">
                    <button class="play" data-icon="P" aria-label="play pause toggle"></button>
                    <button class="stop" data-icon="S" aria-label="stop"></button>
                    <div class="timer">
                    <div></div>
                    <span aria-label="timer">00:00</span>
                    </div>
                    <button class="rwd" data-icon="B" aria-label="rewind"></button>
                    <button class="fwd" data-icon="F" aria-label="fast forward"></button>
                </div>
            </div>

            <script>
                const media = document.querySelector('video');
                const controls = document.querySelector('.controls');

                const play = document.querySelector('.play');
                const stop = document.querySelector('.stop');
                const rwd = document.querySelector('.rwd');
                const fwd = document.querySelector('.fwd');

                const timerWrapper = document.querySelector('.timer');
                const timer = document.querySelector('.timer span');
                const timerBar = document.querySelector('.timer div');
                media.removeAttribute('controls');
                controls.style.visibility = 'visible';
                play.addEventListener('click', playPauseMedia);
                function playPauseMedia() {
                if(media.paused) {
                    play.setAttribute('data-icon','u');
                    media.play();
                } else {
                    play.setAttribute('data-icon','P');
                    media.pause();
                }
                }

                stop.addEventListener('click', stopMedia);
                media.addEventListener('ended', stopMedia);
                function stopMedia() {
                media.pause();
                media.currentTime = 0;
                play.setAttribute('data-icon','P');
                }

                rwd.addEventListener('click', mediaBackward);
                fwd.addEventListener('click', mediaForward);
                let intervalFwd;
                let intervalRwd;

                function mediaBackward() {
                clearInterval(intervalFwd);
                fwd.classList.remove('active');

                if(rwd.classList.contains('active')) {
                    rwd.classList.remove('active');
                    clearInterval(intervalRwd);
                    media.play();
                } else {
                    rwd.classList.add('active');
                    media.pause();
                    intervalRwd = setInterval(windBackward, 200);
                }
                }

                function mediaForward() {
                clearInterval(intervalRwd);
                rwd.classList.remove('active');

                if(fwd.classList.contains('active')) {
                    fwd.classList.remove('active');
                    clearInterval(intervalFwd);
                    media.play();
                } else {
                    fwd.classList.add('active');
                    media.pause();
                    intervalFwd = setInterval(windForward, 200);
                }
                }
                function windBackward() {
                if(media.currentTime <= 3) {
                    rwd.classList.remove('active');
                    clearInterval(intervalRwd);
                    stopMedia();
                } else {
                    media.currentTime -= 3;
                }
                }

                function windForward() {
                if(media.currentTime >= media.duration - 3) {
                    fwd.classList.remove('active');
                    clearInterval(intervalFwd);
                    stopMedia();
                } else {
                    media.currentTime += 3;
                }
                }
                media.addEventListener('timeupdate', setTime);
                function setTime() {
                const minutes = Math.floor(media.currentTime / 60);
                const seconds = Math.floor(media.currentTime - minutes * 60);

                const minuteValue = minutes.toString().padStart(2, '0');
                const secondValue = seconds.toString().padStart(2, '0');

                const mediaTime = `${minuteValue}:${secondValue}`;
                timer.textContent = mediaTime;

                const barLength = timerWrapper.clientWidth * (media.currentTime/media.duration);
                timerBar.style.width = `${barLength}px`;
                }

                rwd.classList.remove('active');
                fwd.classList.remove('active');
                clearInterval(intervalRwd);
                clearInterval(intervalFwd);
            </script>