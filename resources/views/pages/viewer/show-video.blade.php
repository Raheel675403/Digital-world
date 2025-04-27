@extends('layouts.app_layout')
@section('background-color', 'linear-gradient(135deg, #1d2b64, #f8cdda)')

<style>


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
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        let videoIds = [];
        let currentVideoIndex = 0;
        let player;
        let isMuted = false;
        let isPaused = false;
        let mouseMoveTimeout;

        $(document).ready(function () {
            $.ajax({
                url: "{{ route('request-view-video') }}",
                type: 'GET',
                success: function(response) {
                    $.each(response.data, function(index, video) {
                        const parts = video.url.split('/');
                        const videoId = parts[parts.length - 1];
                        videoIds.push(videoId);
                    });

                    const tag = document.createElement('script');
                    tag.src = "https://www.youtube.com/iframe_api";
                    const firstScriptTag = $('script')[0];
                    $(firstScriptTag).before(tag);
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });

            // Play/Pause Button
            $('#playPauseBtn').on('click', function() {
                if (isPaused) {
                    player.playVideo();
                    isPaused = false;
                    $('#playPauseBtn').text('Pause').removeClass('clicked');
                } else {
                    player.pauseVideo();
                    isPaused = true;
                    $('#playPauseBtn').text('Play').addClass('clicked');
                }
            });

            // Mute/Unmute Button
            $('#muteBtn').on('click', function() {
                if (player) {
                    if (isMuted) {
                        console.log('Unmuting the player');
                        player.unMute();  // Ensure unmute is called
                        isMuted = false;
                        $('#muteBtn').text('Mute').removeClass('clicked');
                    } else {
                        console.log('Muting the player');
                        player.mute();  // Ensure mute is called
                        isMuted = true;
                        $('#muteBtn').text('Unmute').addClass('clicked');
                    }
                } else {
                    console.log('Player not ready yet');
                }
            });

            // Fullscreen Button
            $('#fullscreenBtn').on('click', function() {
                const container = $('#videoContainer')[0];
                if (!document.fullscreenElement) {
                    enterFullscreen(container);
                    $('#fullscreenBtn').addClass('clicked');
                } else {
                    exitFullscreen();
                    $('#fullscreenBtn').removeClass('clicked');
                }
            });

            $(document).on('fullscreenchange', function() {
                resizePlayerForFullscreen();
                updateFullscreenButtonText();
            });

            // Show/hide controls on mouse movement
            $('#videoContainer').on('mousemove', function() {
                $('#btnContainer').addClass('show-buttons');
                clearTimeout(mouseMoveTimeout);
                mouseMoveTimeout = setTimeout(function() {
                    $('#btnContainer').removeClass('show-buttons');
                }, 1000); // Hide after 1 second of no movement
            });
        });

        function onYouTubeIframeAPIReady() {
            player = new YT.Player('player', {
                videoId: videoIds[currentVideoIndex],
                playerVars: {
                    autoplay: 1,
                    controls: 1,
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
            console.log('Player is ready');
            player.unMute();  // Ensure player starts unmuted
            isMuted = false;
            $('#muteBtn').text('Mute');  // Ensure button text is 'Mute' when player is ready
        }

        function onPlayerStateChange(event) {
            if (event.data === YT.PlayerState.ENDED) {
                // Get the video URL and channel name
                const videoUrl = player.getVideoUrl();
                const channelName = player.getVideoData().author;

                // Send an AJAX request with the video URL and channel name
                $.ajax({
                    url: '{{ route('viewer.save.video') }}',  // Ensure this is the correct route
                    type: 'POST',  // Make sure the request is of type POST
                    data: {
                        videoUrl: videoUrl,
                        channelName: channelName,
                        _token: "{{ csrf_token() }}"  // CSRF token for Laravel
                    },
                    success: function(response) {
                        alert('Video completion data sent successfully!');
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                    }
                });
                // Move to the next video
                currentVideoIndex = (currentVideoIndex + 1) % videoIds.length;
                player.loadVideoById(videoIds[currentVideoIndex]);
            }
        }


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
            const playerDiv = $('#player');
            const container = $('#videoContainer');
            if (document.fullscreenElement) {
                playerDiv.css({'width': '100vw', 'height': '100vh'});
                container.css({'width': '100vw', 'height': '100vh'});
            } else {
                playerDiv.css({'width': '100%', 'height': '100%'});
                container.css({'width': '1260px', 'height': '360px'});
            }
        }

        function updateFullscreenButtonText() {
            $('#fullscreenBtn').text(document.fullscreenElement ? 'Exit Fullscreen' : 'Fullscreen');
        }


    </script>

@endsection
