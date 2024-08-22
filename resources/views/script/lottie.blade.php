<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
<script src="https://unpkg.com/@lottiefiles/lottie-interactivity@latest/dist/lottie-interactivity.min.js"></script>
<script>
    LottieInteractivity.create({
        player: "#edit",
        mode:"chain",
        actions: [
        {
            state: 'autoplay',
            transition: "onComplete",
            frames: [0,90]
        },
        {
            state: 'autoplay',
            transition: "hover",
            frames: [300,301]
        },
        {
            state: 'autoplay',
            forceflag: true,
            transition: 'hover',
            frames: [300,390],
            jump_to: 1
        }
        ]}),
    LottieInteractivity.create({
        player: "#trash",
        mode:"chain",
        actions: [
        {
        state: 'autoplay',
        transition: "onComplete",
        frames: [0,90.2]
      },
      {
        state: 'autoplay',
        transition: "hover",
        frames: [100.19921875,101.19921875]
      },
      {
        state: 'autoplay',
        forceflag: true,
        transition: 'hover',
        frames: [100.19921875,149.39921875],
        jump_to: 1
     }
     ]})
     ;
</script>

<!--<script>
    LottieInteractivity.create({
    player: "#edit",
    mode:"scroll",
    actions: [
      {
        visibility: [0.50, 1.0],
        type: "play",
        frames: [0,90]
      },
      {
        visibility: [0.50, 1.0],
        type: "hover",
        forceFlag: true,
        frames: [300,390]
     }
      
    ]
});
  </script> -->