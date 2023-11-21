for (let index = 0; index < (Math.floor(Math.random() * 4) + 2); index++) {
    confetti({
        particleCount: 500,
        startVelocity: 30,
        spread: 360,
        origin: {
            x: Math.random(),
            y: Math.random() - 0.2
        }
    });
} 
    