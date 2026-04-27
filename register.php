<?php
session_start();
include 'config/koneksi.php';

if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}

$error = '';
$success = '';

if (isset($_POST['register'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $check = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");
    if (mysqli_num_rows($check) > 0) {
        $error = "E_CONFLICT: Entity exists.";
    } else {
        mysqli_query($conn, "INSERT INTO users (username, password) VALUES ('$username', '$password')");
        $success = "SYS_ACK: Registration bound to matrix. Proceed.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JOIN // SYS</title>
    <link rel="stylesheet" href="output.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,400;1,600&family=JetBrains+Mono:wght@100;300;400;700&family=Unbounded:wght@200;400;700;900&display=swap" rel="stylesheet">
</head>
<body class="min-h-screen relative flex items-center">
    
    <div class="noise-overlay"></div>
    <div class="cursor-dot"></div>
    <div class="cursor-ring"></div>

    <!-- Cinematic Background Mesh -->
    <div class="fixed top-[-50%] left-[-50%] w-[200%] h-[200%] pointer-events-none z-[-1] opacity-40 mix-blend-screen animate-mesh">
        <div class="absolute bottom-1/3 left-1/3 w-[500px] h-[500px] bg-aura rounded-full filter blur-[150px] opacity-20"></div>
        <div class="absolute top-1/4 right-1/4 w-[400px] h-[400px] bg-neon rounded-full filter blur-[120px] opacity-20"></div>
    </div>

    <!-- Grid-breaking Vertical Text -->
    <div class="fixed right-8 top-1/2 -translate-y-1/2 rotate-90 origin-right hidden lg:block opacity-30 pointer-events-none animate-fade-in stagger-0">
        <span class="font-mono text-xs tracking-[0.5em] uppercase">SYSTEM_REGISTRATION_//_002</span>
    </div>

    <div class="w-full max-w-[90rem] mx-auto px-6 grid lg:grid-cols-2 gap-20">
        
        <!-- Left Side: Dramatic Typography -->
        <div class="flex flex-col justify-center animate-reveal-up stagger-1 lg:order-2">
            <h1 class="font-serif italic text-6xl md:text-8xl text-bone/60 leading-[0.8] mb-4">
                Bind <br>
                <span class="font-display not-italic font-black text-7xl md:text-9xl text-bone uppercase tracking-tighter">Entity</span>
            </h1>
            <p class="font-mono text-ash mt-8 max-w-sm text-sm border-l border-aura pl-6">
                Establish your presence within the architecture.
            </p>
        </div>

        <!-- Right Side: Brutal Minimal Form -->
        <div class="flex flex-col justify-center animate-fade-in stagger-3 lg:order-1">
            <div class="max-w-md w-full mr-auto relative">
                
                <div class="absolute -right-12 top-0 w-[1px] h-full bg-gradient-to-b from-transparent via-ash to-transparent"></div>

                <?php if($error): ?>
                    <div class="mb-12 font-mono text-neon text-sm uppercase tracking-widest flex items-center animate-slide-right">
                        <span class="w-2 h-2 bg-neon rounded-full mr-4 animate-pulse"></span>
                        <?= $error ?>
                    </div>
                <?php endif; ?>

                <?php if($success): ?>
                    <div class="mb-12 font-mono text-aura text-sm uppercase tracking-widest flex items-center animate-slide-right">
                        <span class="w-2 h-2 bg-aura rounded-full mr-4 animate-pulse"></span>
                        <?= $success ?>
                    </div>
                <?php endif; ?>

                <form method="POST" action="" class="space-y-12">
                    <div class="group relative">
                        <label class="absolute -top-6 left-0 font-mono text-xs text-bone/40 uppercase tracking-[0.2em] transition-colors group-focus-within:text-aura">New Ident</label>
                        <input type="text" name="username" class="void-input focus:border-aura hover-target" placeholder="USER_02" required autocomplete="off">
                    </div>
                    
                    <div class="group relative">
                        <label class="absolute -top-6 left-0 font-mono text-xs text-bone/40 uppercase tracking-[0.2em] transition-colors group-focus-within:text-aura">New Cipher</label>
                        <input type="password" name="password" class="void-input focus:border-aura hover-target" placeholder="••••••••" required>
                    </div>

                    <div class="pt-8 flex items-center justify-between">
                        <a href="index.php" class="font-mono text-xs text-bone/50 hover:text-bone uppercase tracking-widest hover-target transition-colors">
                            Return
                        </a>
                        
                        <button type="submit" name="register" class="btn-magnetic hover-target border border-bone/20 px-10 py-5">
                            <span class="relative z-10 before:content-[''] before:absolute before:inset-0 before:bg-aura before:scale-y-0 before:origin-bottom before:transition-transform before:duration-500 group-hover:before:scale-y-100">Initialize</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Custom Cursor Logic -->
    <script>
        const dot = document.querySelector('.cursor-dot');
        const ring = document.querySelector('.cursor-ring');
        const hoverTargets = document.querySelectorAll('a, button, input, .hover-target');

        document.addEventListener('mousemove', (e) => {
            dot.style.left = e.clientX + 'px';
            dot.style.top = e.clientY + 'px';
            
            setTimeout(() => {
                ring.style.left = e.clientX + 'px';
                ring.style.top = e.clientY + 'px';
            }, 50);
        });

        hoverTargets.forEach(target => {
            target.addEventListener('mouseenter', () => {
                dot.style.width = '60px';
                dot.style.height = '60px';
                dot.style.backgroundColor = '#E5E5E0';
                ring.style.opacity = '0';
            });
            target.addEventListener('mouseleave', () => {
                dot.style.width = '8px';
                dot.style.height = '8px';
                dot.style.backgroundColor = '#4400FF'; // Aura color for register
                ring.style.opacity = '1';
            });
        });
    </script>
</body>
</html>
