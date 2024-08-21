

<!DOCTYPE html>
<html lang="en">
<head>
<style>
.image-container {
    width: 300px; /* Adjust based on your image size */
    height: 300px;
    position: relative;
}

#stillImage, #animatedGif {
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
}

#animatedGif {
    display: none; /* Initially hide the GIF */
}
</style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hover to Play GIF</title>
</head>
<body>
    <div class="image-container">
        <img src="{{ asset('still-image.png')}}" alt="Still Image" id="stillImage">
        <img src="{{ asset('animated-image.gif') }}" alt="Animated GIF" id="animatedGif">
    </div>
    <lottie-player id="firstLottie" src="{{ asset('system-solid-39-trash.json')}}" background="transparent" count="1"  speed="1"  style="width: 200px; height: 200px;" loop></lottie-player>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <script src="https://unpkg.com/@lottiefiles/lottie-interactivity@latest/dist/lottie-interactivity.min.js"></script>
</body>
<script>
const stillImage = document.getElementById('stillImage');
const animatedGif = document.getElementById('animatedGif');

stillImage.addEventListener('mouseover', () => {
    animatedGif.style.display = 'block'; // Show the GIF
    stillImage.style.display = 'none';   // Hide the still image
    animatedGif.src = animatedGif.src;   // Restart the GIF
});

animatedGif.addEventListener('mouseover', () => {
    animatedGif.src = animatedGif.src;   // Restart the GIF on re-hover
});
</script>

<!-- Cari tahu cara pake vite terus ganti src ini -->
<script>
    LottieInteractivity.create({
    player: "#firstLottie",
    mode:"cursor", 
    actions: [ { type: "hover", forceFlag: false } ]
});
  </script>
</html>
