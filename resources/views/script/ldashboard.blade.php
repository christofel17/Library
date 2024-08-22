<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
<script src="https://unpkg.com/@lottiefiles/lottie-interactivity@latest/dist/lottie-interactivity.min.js"></script>
<script>
    LottieInteractivity.create({
        player: "#inbox",
        mode:"chain",
        actions: [
        {
            state: 'autoplay',
            transition: "onComplete",
            frames: [0,60]
        },
        {
            state: 'autoplay',
            transition: "hover",
            frames: [70,71]
        },
        {
            state: 'autoplay',
            forceflag: true,
            transition: 'hover',
            frames: [70,130],
            jump_to: 1
        }
        ]}),
    LottieInteractivity.create({
        player: "#list",
        mode:"chain",
        actions: [
        {
            state: 'autoplay',
            transition: "onComplete",
            frames: [0,60]
        },
        {
            state: 'autoplay',
            transition: "hover",
            frames: [70,71]
        },
        {
            state: 'autoplay',
            forceflag: true,
            transition: 'hover',
            frames: [70,130],
            jump_to: 1
        }
        ]}),
        LottieInteractivity.create({
        player: "#alarm",
        mode:"chain",
        actions: [
        {
            state: 'autoplay',
            transition: "onComplete",
            frames: [0,60]
        },
        {
            state: 'autoplay',
            transition: "hover",
            frames: [70,71]
        },
        {
            state: 'autoplay',
            forceflag: true,
            transition: 'hover',
            frames: [70,130],
            jump_to: 1
        }
        ]}),
        LottieInteractivity.create({
        player: "#up",
        mode:"chain",
        actions: [
        {
            state: 'autoplay',
            transition: "onComplete",
            frames: [0,60]
        },
        {
            state: 'autoplay',
            transition: "hover",
            frames: [70,71]
        },
        {
            state: 'autoplay',
            forceflag: true,
            transition: 'hover',
            frames: [70,130],
            jump_to: 1
        }
        ]});
        
</script>