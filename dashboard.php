<?php
session_start();
include 'config/koneksi.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if (isset($_GET['delete'])) {
    $id_note = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM notes WHERE id = '$id_note' AND user_id = '$user_id'");
    header("Location: dashboard.php");
    exit();
}

if (isset($_POST['tambah'])) {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $content = mysqli_real_escape_string($conn, $_POST['content']);
    
    mysqli_query($conn, "INSERT INTO notes (user_id, title, content) VALUES ('$user_id', '$title', '$content')");
    header("Location: dashboard.php");
    exit();
}

$query = "SELECT * FROM notes WHERE user_id = '$user_id' ORDER BY id DESC";
$notes = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WORKSPACE // THE ARCHIVE</title>
    <link rel="stylesheet" href="output.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;800&family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,400;1,600&family=JetBrains+Mono:wght@100;300;400;700&display=swap" rel="stylesheet">
    <style>
        /* Specific Styles for Dashboard */
        .tilt-card {
            transform-style: preserve-3d;
            transform: perspective(1000px);
        }
        .tilt-card-inner {
            transform: translateZ(40px); /* Lift text */
        }
        .counter-number {
            font-feature-settings: "tnum";
            font-variant-numeric: tabular-nums;
        }
    </style>
</head>
<body class="min-h-screen relative bg-vanta text-bone">
    
    <div class="noise-overlay"></div>
    <div class="cursor-dot"></div>
    <div class="cursor-trail"></div>

    <!-- Liquid Blob SVG Filter Definition -->
    <svg style="width:0;height:0;position:absolute;" aria-hidden="true" focusable="false">
      <defs>
        <filter id="liquid2">
          <feGaussianBlur in="SourceGraphic" stdDeviation="15" result="blur" />
          <feColorMatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 25 -10" result="liquid" />
          <feBlend in="SourceGraphic" in2="liquid" />
        </filter>
      </defs>
    </svg>

    <!-- Deep Backgrounds -->
    <div class="fixed top-1/4 right-1/4 w-[800px] h-[800px] bg-aura opacity-10 liquid-blob mix-blend-screen pointer-events-none" style="animation-delay: -5s;"></div>

    <!-- Massive Scrolling Background Text -->
    <div class="fixed top-[20%] left-0 w-full whitespace-nowrap opacity-[0.02] pointer-events-none z-[-1] font-display font-black text-[25vw] leading-none text-outline select-none" id="scroll-text">
        ARCHIVE / MEMORY
    </div>

    <!-- Header Navigation -->
    <nav class="fixed top-0 w-full z-50 mix-blend-difference p-8 flex justify-between items-start pointer-events-none">
        <div class="stagger-1">
            <h1 class="font-serif italic text-3xl leading-none mb-1">The</h1>
            <h1 class="font-display font-black text-4xl uppercase tracking-tighter">Archive</h1>
        </div>
        
        <div class="text-right stagger-2 pointer-events-auto flex flex-col items-end">
            <div class="font-mono text-[10px] tracking-[0.3em] uppercase text-bone/50 mb-4">
                Entity // <span class="text-neon text-outline"><?= htmlspecialchars($_SESSION['username']) ?></span>
            </div>
            <a href="logout.php" class="btn-magnetic border border-bone/20 px-8 py-3 text-[10px]">
                <span>Terminate Session</span>
            </a>
        </div>
    </nav>

    <!-- Main Layout Grid -->
    <div class="max-w-[120rem] mx-auto px-6 pt-48 pb-20 flex flex-col xl:flex-row gap-20 relative">
        
        <!-- Left Column: Sticky Form -->
        <div class="xl:w-[35%] relative z-20 shrink-0">
            <div class="sticky top-48 stagger-3">
                
                <div class="flex items-end mb-16">
                    <span class="font-mono text-xs text-neon tracking-[0.5em] uppercase -rotate-90 origin-bottom-left absolute -left-12 bottom-0 hidden lg:block">
                        Inject Node
                    </span>
                    <h2 class="font-display font-black text-5xl uppercase tracking-widest leading-[0.9]">
                        New <br>
                        <span class="font-serif italic text-7xl text-neon font-light">Thought</span>
                    </h2>
                </div>

                <form method="POST" action="" class="space-y-16">
                    <div class="group relative">
                        <label class="absolute -top-6 left-0 font-mono text-[10px] text-bone/30 uppercase tracking-[0.2em] transition-colors group-focus-within:text-neon">Identifier // Title</label>
                        <input type="text" name="title" class="void-input hover-trigger" placeholder="Subject Matter" required autocomplete="off">
                    </div>
                    
                    <div class="group relative">
                        <label class="absolute -top-6 left-0 font-mono text-[10px] text-bone/30 uppercase tracking-[0.2em] transition-colors group-focus-within:text-neon">Substance // Content</label>
                        <textarea name="content" rows="3" class="void-input hover-trigger resize-none" placeholder="Elaborate..." required></textarea>
                    </div>

                    <button type="submit" name="tambah" class="btn-magnetic hover-trigger border border-bone/20 w-full py-6 mt-8 bg-vanta">
                        <span>Manifest into Reality</span>
                    </button>
                </form>

                <!-- Dynamic Counter -->
                <div class="mt-20 pt-8 border-t border-ash/50 font-mono text-xs text-bone/40 uppercase tracking-[0.2em] flex justify-between items-center">
                    <span>Nodes Archived</span>
                    <span class="text-3xl text-bone counter-number" id="node-counter">0</span>
                </div>
            </div>
        </div>

        <!-- Right Column: Asymmetrical Fragments -->
        <div class="xl:w-[65%] relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-32">
                <?php 
                $delay = 1;
                $index = 1;
                $total_notes = mysqli_num_rows($notes);
                while($row = mysqli_fetch_assoc($notes)): 
                    // Create massive asymmetry in the grid layout
                    $marginTop = ($index % 2 == 0) ? 'md:mt-48' : 'mt-0'; 
                    // Use a unique unsplash image for each note to give texture, blended with luminosity
                    $imgUrl = "https://source.unsplash.com/random/800x800/?texture,abstract,dark&sig=" . $row['id'];
                ?>
                <div class="note-fragment <?= $marginTop ?> hover-trigger tilt-card group" style="animation: slideUpFade 1.2s cubic-bezier(0.16, 1, 0.3, 1) forwards <?= $delay * 0.1 ?>s; opacity: 0;">
                    
                    <!-- Background Image Blended -->
                    <div class="absolute inset-0 z-[-1] opacity-0 group-hover:opacity-30 transition-opacity duration-1000 bg-cover bg-center grayscale mix-blend-luminosity" style="background-image: url('<?= $imgUrl ?>');"></div>
                    
                    <!-- SVG Clip Path Outline -->
                    <svg class="absolute inset-0 w-full h-full pointer-events-none z-[-1]" preserveAspectRatio="none">
                        <rect width="100%" height="100%" fill="none" stroke="rgba(255,42,0,0)" stroke-width="1" class="transition-colors duration-700 group-hover:stroke-neon/50"/>
                        <circle cx="20" cy="20" r="2" fill="#FF2A00" class="opacity-0 group-hover:opacity-100 transition-opacity duration-700"/>
                        <circle cx="calc(100% - 20px)" cy="calc(100% - 20px)" r="2" fill="#FF2A00" class="opacity-0 group-hover:opacity-100 transition-opacity duration-700"/>
                    </svg>

                    <div class="tilt-card-inner">
                        <div class="flex justify-between items-start mb-8">
                            <div class="font-mono text-[10px] text-bone/40 tracking-[0.4em]">
                                NODE_<?= str_pad($row['id'], 4, '0', STR_PAD_LEFT) ?>
                            </div>
                            <div class="font-serif italic text-3xl text-bone/10 font-light group-hover:text-neon/20 transition-colors duration-700">
                                <?= str_pad($index, 2, '0', STR_PAD_LEFT) ?>
                            </div>
                        </div>

                        <h3 class="font-display font-black text-3xl text-bone uppercase mb-8 leading-tight group-hover:text-neon transition-colors duration-500">
                            <?= htmlspecialchars($row['title']) ?>
                        </h3>
                        
                        <p class="font-mono text-sm text-bone/60 leading-relaxed mb-12 border-l border-ash pl-6 group-hover:border-neon transition-colors duration-500 line-clamp-4">
                            <?= nl2br(htmlspecialchars($row['content'])) ?>
                        </p>
                        
                        <div class="flex space-x-8 font-mono text-[10px] tracking-[0.3em] uppercase">
                            <a href="edit.php?id=<?= $row['id'] ?>" class="text-bone/50 hover:text-bone transition-colors hover-trigger relative after:content-[''] after:absolute after:-bottom-2 after:left-0 after:w-0 after:h-px after:bg-bone hover:after:w-full after:transition-all after:duration-500">
                                Alter
                            </a>
                            <a href="dashboard.php?delete=<?= $row['id'] ?>" class="text-neon/70 hover:text-neon transition-colors hover-trigger relative after:content-[''] after:absolute after:-bottom-2 after:left-0 after:w-0 after:h-px after:bg-neon hover:after:w-full after:transition-all after:duration-500">
                                Erase
                            </a>
                        </div>
                    </div>
                </div>
                <?php 
                $delay++;
                $index++;
                endwhile; 
                ?>

                <?php if($total_notes == 0): ?>
                    <div class="col-span-1 md:col-span-2 py-40 stagger-5 relative pl-12 border-l border-ash/30">
                        <h3 class="font-display font-black text-5xl text-bone/20 uppercase tracking-tighter mb-4 text-outline">Void is empty</h3>
                        <p class="font-serif italic text-3xl text-bone/40">The archive awaits its first injection.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Interaction Scripts -->
    <script>
        // Custom Cursor Binding
        const dot = document.querySelector('.cursor-dot');
        const trail = document.querySelector('.cursor-trail');
        const triggers = document.querySelectorAll('.hover-trigger');

        document.addEventListener('mousemove', (e) => {
            dot.style.left = e.clientX + 'px';
            dot.style.top = e.clientY + 'px';
            setTimeout(() => {
                trail.style.left = e.clientX + 'px';
                trail.style.top = e.clientY + 'px';
            }, 80);
        });

        // Background Text Parallax Scroll
        const scrollText = document.getElementById('scroll-text');
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            scrollText.style.transform = `translateX(-${scrolled * 0.5}px)`;
        });

        // Tilt Card 3D Effect
        const tiltCards = document.querySelectorAll('.tilt-card');
        tiltCards.forEach(card => {
            card.addEventListener('mousemove', (e) => {
                const rect = card.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;
                
                const centerX = rect.width / 2;
                const centerY = rect.height / 2;
                
                const rotateX = ((y - centerY) / centerY) * -10; // Max 10 deg
                const rotateY = ((x - centerX) / centerX) * 10;
                
                card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale3d(1.02, 1.02, 1.02)`;
            });
            
            card.addEventListener('mouseleave', () => {
                card.style.transform = `perspective(1000px) rotateX(0deg) rotateY(0deg) scale3d(1, 1, 1)`;
                card.style.transition = 'transform 0.5s cubic-bezier(0.16, 1, 0.3, 1)';
            });
            
            card.addEventListener('mouseenter', () => {
                card.style.transition = 'none';
            });
        });

        // Dynamic Counter Animation
        const targetCount = <?= $total_notes ?>;
        const counterElement = document.getElementById('node-counter');
        let currentCount = 0;
        
        const updateCounter = () => {
            if (currentCount < targetCount) {
                currentCount++;
                counterElement.innerText = currentCount;
                setTimeout(updateCounter, 50); // Speed of counting
            }
        };
        setTimeout(updateCounter, 1000); // Delay start
    </script>
</body>
</html>
