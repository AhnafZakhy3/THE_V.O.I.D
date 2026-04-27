<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NotesApp - Productivity Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Code:wght@400;500;600;700&family=Fira+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#0D9488',
                        secondary: '#14B8A6',
                        cta: '#F97316',
                        background: '#F0FDFA',
                        text: '#134E4A',
                    },
                    fontFamily: {
                        heading: ['"Fira Code"', 'monospace'],
                        body: ['"Fira Sans"', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Fira Sans', sans-serif;
            background-color: #F0FDFA;
            color: #134E4A;
        }
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Fira Code', monospace;
        }
        .flat-card {
            border: 2px solid #0D9488;
            background-color: white;
            transition: all 0.2s ease-in-out;
        }
        .flat-card:hover {
            transform: translateY(-2px);
            box-shadow: 4px 4px 0 0 #0D9488;
        }
        .flat-button {
            border: 2px solid #0D9488;
            transition: all 0.2s ease-in-out;
        }
        .flat-button:hover {
            transform: translateY(-2px);
            box-shadow: 4px 4px 0 0 #0D9488;
        }
        .flat-button-cta {
            background-color: #F97316;
            color: white;
            border: 2px solid #C2410C;
        }
        .flat-button-cta:hover {
            box-shadow: 4px 4px 0 0 #C2410C;
        }
        .flat-input {
            border: 2px solid #0D9488;
            transition: all 0.2s ease;
        }
        .flat-input:focus {
            outline: none;
            box-shadow: 4px 4px 0 0 #14B8A6;
        }
    </style>
</head>
<body class="min-h-screen flex flex-col">
    <?php if (isset($_SESSION['user_id'])): ?>
    <nav class="border-b-2 border-primary bg-white sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <i data-lucide="terminal" class="text-primary w-8 h-8 mr-2"></i>
                    <a href="dashboard.php" class="font-heading font-bold text-xl text-primary">NotesApp_</a>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-sm font-medium">@<?= htmlspecialchars($_SESSION['username']) ?></span>
                    <a href="logout.php" class="flat-button px-4 py-2 bg-red-100 text-red-700 border-red-700 text-sm font-bold flex items-center hover:bg-red-200 hover:shadow-[4px_4px_0_0_#b91c1c] hover:border-red-700">
                        <i data-lucide="log-out" class="w-4 h-4 mr-2"></i> Logout
                    </a>
                </div>
            </div>
        </div>
    </nav>
    <?php endif; ?>
    <main class="flex-grow">
