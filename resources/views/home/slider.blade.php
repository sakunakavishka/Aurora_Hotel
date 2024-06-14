<!DOCTYPE html>
<html>
<head>
    
    <style>
        .banner_main {
            position: relative;
            width: 100%;
            max-width: 100%;
            height: auto;
            overflow: hidden;
            background-color: black;
        }

        .banner_main video {
            width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
    <section class="banner_main">
        <video loop muted autoplay>
            <source src="{{ asset('videos/video.mp4') }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </section>
</body>
</html>

