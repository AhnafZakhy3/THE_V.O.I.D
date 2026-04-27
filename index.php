<?php
session_start();
include 'config/koneksi.php';

if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}

$error = '';
if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    $query = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");
    if (mysqli_num_rows($query) === 1) {
        $row = mysqli_fetch_assoc($query);
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            header("Location: dashboard.php");
            exit();
        } else {
            $error = 'ACCESS DENIED: INVAL_CREDENTIALS';
        }
    } else {
        $error = 'ACCESS DENIED: ENTITY_NOT_FOUND';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ENTER // THE VOID</title>
    <link rel="stylesheet" href="output.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;800&family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,400;1,600&family=JetBrains+Mono:wght@100;300;400;700&display=swap" rel="stylesheet">
</head>
<body class="min-h-screen relative flex items-center justify-center overflow-hidden bg-vanta">

    <!-- Global Hover Triggers (used to bind cursor events globally to specific interactive elements) -->
    <div class="noise-overlay"></div>
    <div class="cursor-dot"></div>
    <div class="cursor-trail"></div>

    <!-- Liquid Blob SVG Filter Definition -->
    <svg style="width:0;height:0;position:absolute;" aria-hidden="true" focusable="false">
      <defs>
        <filter id="liquid">
          <feGaussianBlur in="SourceGraphic" stdDeviation="10" result="blur" />
          <feColorMatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 18 -7" result="liquid" />
          <feBlend in="SourceGraphic" in2="liquid" />
        </filter>
      </defs>
    </svg>

    <!-- Liquid Blob Background -->
    <div class="fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-neon opacity-20 liquid-blob mix-blend-screen pointer-events-none"></div>

    <!-- Unsplash Image Background with Blend Mode -->
    <div class="fixed inset-0 z-[-1] opacity-10 pointer-events-none bg-center bg-cover bg-no-repeat" style="background-image: url('https://source.unsplash.com/random/1920x1080/?abstract,dark,architecture,brutalist'); mix-blend-mode: luminosity;"></div>

    <!-- Canvas Particle System -->
    <canvas id="particles" class="fixed inset-0 z-[-1] pointer-events-none opacity-30"></canvas>

    <!-- Infinite Marquee Top -->
    <div class="fixed top-0 left-0 w-full z-10 pointer-events-none border-b border-ash/50 bg-vanta/50 backdrop-blur-sm marquee-container py-2">
        <div class="marquee-content font-mono text-xs text-neon tracking-[0.5em] uppercase px-4 flex whitespace-nowrap">
            <span>UNAUTHORIZED ACCESS STRICTLY PROHIBITED // ENCRYPTED NODE 4A // SYSTEM INITIALIZATION PENDING // </span>
            <span>UNAUTHORIZED ACCESS STRICTLY PROHIBITED // ENCRYPTED NODE 4A // SYSTEM INITIALIZATION PENDING // </span>
            <span>UNAUTHORIZED ACCESS STRICTLY PROHIBITED // ENCRYPTED NODE 4A // SYSTEM INITIALIZATION PENDING // </span>
        </div>
    </div>

    <!-- Infinite Marquee Bottom Reverse -->
    <div class="fixed bottom-0 left-0 w-full z-10 pointer-events-none border-t border-ash/50 bg-vanta/50 backdrop-blur-sm marquee-container py-2">
        <div class="marquee-content font-mono text-xs text-bone/50 tracking-[0.5em] uppercase px-4 flex whitespace-nowrap" style="animation-direction: reverse;">
            <span>AWAITING ENTITY MANIFESTATION // ESTABLISHING CONNECTION // SIGNAL STRENGTH OPTIMAL // </span>
            <span>AWAITING ENTITY MANIFESTATION // ESTABLISHING CONNECTION // SIGNAL STRENGTH OPTIMAL // </span>
            <span>AWAITING ENTITY MANIFESTATION // ESTABLISHING CONNECTION // SIGNAL STRENGTH OPTIMAL // </span>
        </div>
    </div>

    <!-- Main Content Grid Breaking -->
    <div class="w-full max-w-[100rem] mx-auto px-6 grid lg:grid-cols-12 gap-10 items-center relative z-20">
        
        <!-- Left Side: Extreme Typography -->
        <div class="lg:col-span-7 flex flex-col justify-center relative">
            
            <div class="absolute -left-20 -top-20 text-[20vw] font-display font-black text-outline select-none pointer-events-none leading-none opacity-50 z-[-1]">
                VOID
            </div>

            <div class="stagger-1 mb-6">
                <span class="font-mono text-sm tracking-[0.5em] text-neon uppercase flex items-center">
                    <span class="w-8 h-[1px] bg-neon mr-4"></span> Protocol Initiation
                </span>
            </div>

            <h1 class="font-serif italic text-6xl md:text-[8rem] text-bone leading-[0.8] stagger-2 mb-2">
                Enter
            </h1>
            <h1 class="font-display font-black text-6xl md:text-[8rem] uppercase tracking-tighter stagger-3 glitch-text" data-text="THE SYSTEM">
                The System
            </h1>

            <p class="font-mono text-bone/40 mt-12 max-w-md text-sm border-l border-neon/30 pl-6 stagger-4 typewriter relative w-max max-w-full">
                Identify yourself to the central node.
            </p>
        </div>

        <!-- Right Side: The Terminal Form -->
        <div class="lg:col-span-5 flex flex-col justify-center stagger-5 relative">
            <div class="absolute -inset-10 bg-vanta/80 backdrop-blur-md z-[-1] border-l border-b border-ash/20"></div>

            <div class="w-full relative z-10 p-10">
                
                <?php if($error): ?>
                    <div class="mb-12 font-mono text-neon text-xs uppercase tracking-[0.2em] flex items-center">
                        <div class="w-2 h-2 bg-neon rounded-full mr-4 animate-ping"></div>
                        <?= $error ?>
                    </div>
                <?php endif; ?>

                <form method="POST" action="" class="space-y-16">
                    <div class="group relative">
                        <label class="absolute -top-6 left-0 font-mono text-xs text-bone/30 uppercase tracking-[0.2em] transition-colors group-focus-within:text-neon">Entity Identifier</label>
                        <input type="text" name="username" class="void-input hover-trigger" placeholder="USER_01" required autocomplete="off">
                    </div>
                    
                    <div class="group relative">
                        <label class="absolute -top-6 left-0 font-mono text-xs text-bone/30 uppercase tracking-[0.2em] transition-colors group-focus-within:text-neon">Access Cipher</label>
                        <input type="password" name="password" class="void-input hover-trigger" placeholder="••••••••" required>
                    </div>

                    <div class="pt-8 flex items-center justify-between">
                        <a href="register.php" class="font-mono text-xs text-bone/40 hover:text-bone uppercase tracking-[0.2em] hover-trigger transition-colors relative after:content-[''] after:absolute after:-bottom-2 after:left-0 after:w-0 after:h-px after:bg-bone hover:after:w-full after:transition-all after:duration-500">
                            Create Identity
                        </a>
                        
                        <button type="submit" name="login" class="btn-magnetic hover-trigger border border-bone/10 px-12 py-6">
                            <span>Execute</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- JS Implementations -->
    <script>
        // Custom Cursor Binding
        const dot = document.querySelector('.cursor-dot');
        const trail = document.querySelector('.cursor-trail');

        document.addEventListener('mousemove', (e) => {
            dot.style.left = e.clientX + 'px';
            dot.style.top = e.clientY + 'px';
            
            // Trailing effect using setTimeout
            setTimeout(() => {
                trail.style.left = e.clientX + 'px';
                trail.style.top = e.clientY + 'px';
            }, 80);
        });

        // Particle System (Nodes connecting)
        const canvas = document.getElementById('particles');
        const ctx = canvas.getContext('2d');
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;

        let particlesArray = [];
        const numberOfParticles = 100;

        class Particle {
            constructor() {
                this.x = Math.random() * canvas.width;
                this.y = Math.random() * canvas.height;
                this.size = Math.random() * 2 + 1;
                this.speedX = Math.random() * 1 - 0.5;
                this.speedY = Math.random() * 1 - 0.5;
            }
            update() {
                this.x += this.speedX;
                this.y += this.speedY;
                if (this.size > 0.2) this.size -= 0.01;
                if (this.x < 0 || this.x > canvas.width) this.speedX *= -1;
                if (this.y < 0 || this.y > canvas.height) this.speedY *= -1;
            }
            draw() {
                ctx.fillStyle = 'rgba(255, 42, 0, 0.5)'; // Neon
                ctx.beginPath();
                ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
                ctx.fill();
            }
        }

        function initParticles() {
            particlesArray = [];
            for (let i = 0; i < numberOfParticles; i++) {
                particlesArray.push(new Particle());
            }
        }

        function animateParticles() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            for (let i = 0; i < particlesArray.length; i++) {
                particlesArray[i].update();
                particlesArray[i].draw();
                
                // Draw lines connecting particles
                for (let j = i; j < particlesArray.length; j++) {
                    const dx = particlesArray[i].x - particlesArray[j].x;
                    const dy = particlesArray[i].y - particlesArray[j].y;
                    const distance = Math.sqrt(dx * dx + dy * dy);
                    if (distance < 100) {
                        ctx.beginPath();
                        ctx.strokeStyle = `rgba(240, 240, 240, ${1 - distance/100})`; // Bone
                        ctx.lineWidth = 0.5;
                        ctx.moveTo(particlesArray[i].x, particlesArray[i].y);
                        ctx.lineTo(particlesArray[j].x, particlesArray[j].y);
                        ctx.stroke();
                        ctx.closePath();
                    }
                }
            }
            requestAnimationFrame(animateParticles);
        }

        initParticles();
        animateParticles();

        window.addEventListener('resize', () => {
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
            initParticles();
        });
    </script>
</body>
</html>
