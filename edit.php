<?php
session_start();
include 'config/koneksi.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$id_note = $_GET['id'];

// Prevent altering someone else's note
$query = mysqli_query($conn, "SELECT * FROM notes WHERE id = '$id_note' AND user_id = '$user_id'");
if(mysqli_num_rows($query) == 0){
    header("Location: dashboard.php");
    exit();
}
$note = mysqli_fetch_assoc($query);

if (isset($_POST['update'])) {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $content = mysqli_real_escape_string($conn, $_POST['content']);
    
    mysqli_query($conn, "UPDATE notes SET title = '$title', content = '$content' WHERE id = '$id_note' AND user_id = '$user_id'");
    header("Location: dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ALTER // THE ARCHIVE</title>
    <link rel="stylesheet" href="output.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;800&family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,400;1,600&family=JetBrains+Mono:wght@100;300;400;700&display=swap" rel="stylesheet">
</head>
<body class="min-h-screen relative flex items-center justify-center bg-vanta text-bone">
    
    <div class="noise-overlay"></div>
    <div class="cursor-dot"></div>
    <div class="cursor-trail"></div>

    <!-- Massive Centered Text Background -->
    <div class="fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 opacity-[0.02] pointer-events-none z-[-1] font-display font-black text-[30vw] leading-none text-outline select-none glitch-text" data-text="ALTER">
        ALTER
    </div>

    <!-- Dark Unsplash Texture Blend -->
    <div class="fixed inset-0 z-[-2] opacity-[0.15] pointer-events-none bg-center bg-cover bg-no-repeat grayscale mix-blend-luminosity" style="background-image: url('https://source.unsplash.com/random/1920x1080/?texture,metal,dark');"></div>

    <div class="w-full max-w-[80rem] mx-auto px-6 grid lg:grid-cols-2 gap-24 relative z-10">
        
        <!-- Typography Axis -->
        <div class="flex flex-col justify-center stagger-1">
            <a href="dashboard.php" class="font-mono text-[10px] text-bone/40 hover:text-bone uppercase tracking-[0.5em] hover-trigger transition-colors mb-20 flex items-center w-max">
                <span class="w-8 h-[1px] bg-bone/40 mr-4 group-hover:bg-bone transition-colors"></span> 
                Cancel Protocol
            </a>

            <div class="font-mono text-xs text-neon tracking-[0.5em] uppercase mb-4">
                Target: NODE_<?= str_pad($note['id'], 4, '0', STR_PAD_LEFT) ?>
            </div>
            <h1 class="font-display font-black text-6xl md:text-8xl uppercase tracking-tighter leading-[0.9]">
                Alter <br>
                <span class="font-serif italic text-neon text-7xl md:text-9xl font-light">Structure</span>
            </h1>
        </div>

        <!-- Form Axis -->
        <div class="flex flex-col justify-center stagger-3 relative">
            <div class="absolute -inset-10 border-l border-ash/20 bg-vanta/50 backdrop-blur-md z-[-1]"></div>

            <form method="POST" action="" class="space-y-16 p-10">
                <div class="group relative">
                    <label class="absolute -top-6 left-0 font-mono text-[10px] text-bone/30 uppercase tracking-[0.2em] transition-colors group-focus-within:text-neon">Identifier // Title</label>
                    <input type="text" name="title" value="<?= htmlspecialchars($note['title']) ?>" class="void-input hover-trigger" required autocomplete="off">
                </div>
                
                <div class="group relative">
                    <label class="absolute -top-6 left-0 font-mono text-[10px] text-bone/30 uppercase tracking-[0.2em] transition-colors group-focus-within:text-neon">Substance // Content</label>
                    <textarea name="content" rows="6" class="void-input hover-trigger resize-none" required><?= htmlspecialchars($note['content']) ?></textarea>
                </div>

                <div class="pt-10">
                    <button type="submit" name="update" class="btn-magnetic hover-trigger border border-neon w-full py-8 bg-vanta">
                        <span class="font-mono tracking-[0.4em] text-xs">Overwrite Node</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Script -->
    <script>
        const dot = document.querySelector('.cursor-dot');
        const trail = document.querySelector('.cursor-trail');

        document.addEventListener('mousemove', (e) => {
            dot.style.left = e.clientX + 'px';
            dot.style.top = e.clientY + 'px';
            setTimeout(() => {
                trail.style.left = e.clientX + 'px';
                trail.style.top = e.clientY + 'px';
            }, 80);
        });
    </script>
</body>
</html>
