@extends('layouts.app_layout')
@section('background-color', 'linear-gradient(135deg, #1d2b64, #f8cdda)')

<style>
    #videoContainer {
        position: relative;
        width: 1260px;
        height: 360px;
    }

    #player {
        position: absolute;
        top: 0;
        left: 0;
        z-index: 1;
        pointer-events: none;
        width: 100%;
        height: 100%;
    }

    .btn-container {
        position: absolute;
        bottom: 20px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 999;
        display: flex;
        gap: 15px;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.3s ease, visibility 0.3s ease;
    }

    .show-buttons {
        opacity: 1;
        visibility: visible;
        background-color: lime;
        color: #000;
    }
    .btn {
        background-color: lime;
        color: #000;
        padding: 10px 18px;
        border: 1px solid #ccc;
        cursor: pointer;
        border-radius: 8px;
        font-size: 16px;
        font-weight: bold;
        text-shadow: 1px 1px 2px #000;
        box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.6);
        transition: background-color 0.3s, transform 0.2s;
    }

    .btn:hover {
        background-color: #ccffcc;
        transform: scale(1.05);
        color: #000;
        border-color: #00ffcc;
    }

    .btn.clicked {
        background-color: red !important;
        color: white !important;
    }


    :fullscreen #videoContainer,
    :-webkit-full-screen #videoContainer {
        width: 100vw !important;
        height: 100vh !important;
    }

    :fullscreen #player,
    :-webkit-full-screen #player {
        width: 100vw !important;
        height: 100vh !important;
    }

</style>

@section('content')
    <div class="container mt-5">
        <div class="card bg-dark text-white shadow-lg rounded-4">
            <div class="card-body d-flex justify-content-center p-4">
                <div id="videoContainer" onmousemove="handleMouseMove()">
                    <div id="player"></div>

                    <div class="btn-container" id="btnContainer">
                        <button id="playPauseBtn" class="btn">Pause</button>
                        <button id="muteBtn" class="btn">Mute</button>
                        <button id="fullscreenBtn" class="btn">Fullscreen</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const videoIds = ['jq_gfWvA5NM', 'M7lc1UVf-VE', 'dQw4w9WgXcQ'];
        let currentVideoIndex = 0;
        let player;
        let isMuted = false;
        let isPaused = false;
        let mouseMoveTimeout;

        const fullscreenBtn = document.getElementById('fullscreenBtn');
        const playPauseBtn = document.getElementById('playPauseBtn');
        const muteBtn = document.getElementById('muteBtn');
        const btnContainer = document.getElementById('btnContainer');

        const tag = document.createElement('script');
        tag.src = "https://www.youtube.com/iframe_api";
        const firstScriptTag = document.getElementsByTagName('script')[0];
        firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

        function onYouTubeIframeAPIReady() {
            player = new YT.Player('player', {
                videoId: videoIds[currentVideoIndex],
                playerVars: {
                    autoplay: 1,
                    controls: 0,
                    modestbranding: 1,
                    rel: 0,
                    showinfo: 0,
                    fs: 1,
                    disablekb: 1
                },
                events: {
                    onReady: onPlayerReady,
                    onStateChange: onPlayerStateChange
                }
            });
        }

        function onPlayerReady(event) {
            document.body.addEventListener('click', () => player.unMute(), { once: true });
            player.unMute();
            isMuted = false;
            muteBtn.innerText = 'Mute';
        }

        function onPlayerStateChange(event) {
            if (event.data === YT.PlayerState.ENDED) {
                currentVideoIndex = (currentVideoIndex + 1) % videoIds.length;
                player.loadVideoById(videoIds[currentVideoIndex]);
            }
        }

        // Play/Pause Button
        playPauseBtn.addEventListener('click', () => {
            if (isPaused) {
                player.playVideo();
                isPaused = false;
                playPauseBtn.innerText = 'Pause';
                playPauseBtn.classList.remove('clicked');
            } else {
                player.pauseVideo();
                isPaused = true;
                playPauseBtn.innerText = 'Play';
                playPauseBtn.classList.add('clicked');
            }
        });

        // Mute/Unmute Button
        muteBtn.addEventListener('click', () => {
            if (isMuted) {
                player.unMute();
                isMuted = false;
                muteBtn.innerText = 'Mute';
                muteBtn.classList.remove('clicked');
            } else {
                player.mute();
                isMuted = true;
                muteBtn.innerText = 'Unmute';
                muteBtn.classList.add('clicked');
            }
        });

        // Fullscreen Button
        fullscreenBtn.addEventListener('click', () => {
            const container = document.getElementById('videoContainer');
            if (!document.fullscreenElement) {
                enterFullscreen(container);
                fullscreenBtn.classList.add('clicked');
            } else {
                exitFullscreen();
                fullscreenBtn.classList.remove('clicked');
            }
        });

        document.addEventListener('fullscreenchange', () => {
            resizePlayerForFullscreen();
            updateFullscreenButtonText();
        });

        function enterFullscreen(element) {
            if (element.requestFullscreen) {
                element.requestFullscreen();
            } else if (element.mozRequestFullScreen) {
                element.mozRequestFullScreen();
            } else if (element.webkitRequestFullscreen) {
                element.webkitRequestFullscreen();
            } else if (element.msRequestFullscreen) {
                element.msRequestFullscreen();
            }
        }

        function exitFullscreen() {
            if (document.exitFullscreen) {
                document.exitFullscreen();
            } else if (document.mozCancelFullScreen) {
                document.mozCancelFullScreen();
            } else if (document.webkitExitFullscreen) {
                document.webkitExitFullscreen();
            }
        }

        function resizePlayerForFullscreen() {
            const playerDiv = document.getElementById('player');
            const container = document.getElementById('videoContainer');
            if (document.fullscreenElement) {
                playerDiv.style.width = '100vw';
                playerDiv.style.height = '100vh';
                container.style.width = '100vw';
                container.style.height = '100vh';
            } else {
                playerDiv.style.width = '100%';
                playerDiv.style.height = '100%';
                container.style.width = '1260px';
                container.style.height = '360px';
            }
        }

        function updateFullscreenButtonText() {
            fullscreenBtn.innerText = document.fullscreenElement ? 'Exit Fullscreen' : 'Fullscreen';
        }

        // Show/hide controls on mouse movement
        function handleMouseMove() {
            btnContainer.classList.add('show-buttons');
            clearTimeout(mouseMoveTimeout);
            mouseMoveTimeout = setTimeout(() => {
                btnContainer.classList.remove('show-buttons');
            }, 1000); // Hide after 1 second of no movement
        }
    </script>
@endsection
