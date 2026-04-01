<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mbollo | Tableau de bord</title>
    <!-- Le reste de votre code -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }
        
        /* Couleurs de la palette */
        :root {
            --primary: #2B88D9;
            --primary-light: #99D0F2;
            --primary-soft: #BDE3F2;
            --accent: #F2B705;
            --accent-dark: #F29F05;
        }
        
        /* Animation fade-up */
        @keyframes fadeUp {
            0% {
                opacity: 0;
                transform: translateY(30px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .animate-fade-up {
            animation: fadeUp 0.6s ease forwards;
        }
        
        /* Animation pour les cards */
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        .card-animate {
            animation: slideIn 0.5s ease forwards;
        }
        
        /* Animation compteur */
        @keyframes countUp {
            from {
                opacity: 0;
                transform: scale(0.9);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }
        
        .counter-animate {
            animation: countUp 0.5s ease forwards;
        }
        
        /* Barre de progression personnalisée */
        .progress-bar {
            background: linear-gradient(90deg, var(--primary), var(--primary-light));
            box-shadow: 0 0 8px rgba(43, 136, 217, 0.3);
        }
        
        /* Transition pour le thème */
        body {
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        
        /* Scrollbar stylisée */
        ::-webkit-scrollbar {
            width: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        
        ::-webkit-scrollbar-thumb {
            background: var(--primary);
            border-radius: 10px;
        }
        
        /* Animation de survol pour les cards */
        .stat-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -12px rgba(0, 0, 0, 0.15);
        }
        
        /* Bouton switch thème */
        .theme-switch {
            transition: transform 0.3s ease;
        }
        
        .theme-switch:hover {
            transform: rotate(15deg);
        }
        
        /* Menu rétractable */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            height: 100vh;
            width: 280px;
            background: linear-gradient(135deg, #2B88D9, #1e6bb3);
            z-index: 1000;
            transform: translateX(-100%);
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
            overflow-y: auto;
        }
        
        .sidebar.open {
            transform: translateX(0);
        }
        
        .sidebar-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
            display: none;
            backdrop-filter: blur(2px);
        }
        
        .sidebar-overlay.open {
            display: block;
        }
        
        .menu-toggle-btn {
            transition: all 0.2s ease;
        }
        
        .menu-toggle-btn:hover {
            transform: scale(1.05);
        }
        
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                max-width: 280px;
            }
        }
        
        @keyframes shimmer {
            0% {
                background-position: -1000px 0;
            }
            100% {
                background-position: 1000px 0;
            }
        }
        
        .progress-bar {
            position: relative;
            overflow: hidden;
        }
        
        .progress-bar::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            animation: shimmer 2s infinite;
        }
        
        .dark-mode-card {
            transition: all 0.3s ease;
        }
    </style>
    <script src="http://localhost:8000/public/js/script.js"></script>

</head>
<body class="bg-gray-50" id="body">
    
    <div class="sidebar-overlay" id="sidebarOverlay"></div>
    
    <aside class="sidebar" id="sidebar">
        <div class="p-6">
            <div class="flex items-center justify-between mb-8">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-[#F2B705] rounded-xl flex items-center justify-center shadow-lg">
                        <i class="fas fa-users text-[#2B88D9] text-xl"></i>
                    </div>
                    <h1 class="text-2xl font-bold text-white tracking-tight">Mbollo</h1>
                </div>
                <button id="closeMenuBtn" class="text-white/80 hover:text-white text-2xl transition">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <nav class="space-y-2">
                <div class="flex items-center gap-3 px-4 py-3 rounded-lg bg-white/10 hover:bg-white/20 transition-all cursor-pointer group">
                    <a href="<?= WEBROOT ?>?page=dashboard">
                        <i class="fas fa-chart-line w-5 text-white"></i>
                    <span class="text-white">Tableau de bord</span>
                    </a>
                </div>
                <div class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/20 transition-all cursor-pointer group">
                    <a href="<?= WEBROOT ?>?page=projet">
                        <i class="fas fa-project-diagram w-5 text-white/80 group-hover:text-white"></i>
                    <span class="text-white/80 group-hover:text-white">Projets</span>
                    </a>
                </div>
                <div class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/20 transition-all cursor-pointer group">
                    <a href="<?= WEBROOT ?>?page=tache">
                        <i class="fas fa-tasks w-5 text-white/80 group-hover:text-white"></i>
                    <span class="text-white/80 group-hover:text-white">Tâches</span>
                    </a>
                </div>
                <div class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/20 transition-all cursor-pointer group">
                    <a href="<?= WEBROOT ?>?page=tache">
                        <i class="fas fa-users w-5 text-white/80 group-hover:text-white"></i>
                    <span class="text-white/80 group-hover:text-white">Équipe</span>
                    </a>
                </div>
                <div class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-white/20 transition-all cursor-pointer group">
                    <a href="<?= WEBROOT ?>?page=logout">
                        <i class="fas fa-cog w-5 text-white/80 group-hover:text-white"></i>
                    <span class="text-white/80 group-hover:text-white">Paramètres</span>
                    </a>
                </div>
            </nav>
            
            <div class="absolute bottom-6 left-6 right-6">
                <div class="bg-white/10 rounded-xl p-4 backdrop-blur-sm">
                    <div class="flex items-center gap-3 mb-3">
                        <i class="fas fa-gem text-[#F2B705] text-xl"></i>
                        <span class="text-white text-sm font-semibold">Version Pro</span>
                    </div>
                    <p class="text-white/70 text-xs mb-3">Débloquez toutes les fonctionnalités</p>
                    <button class="w-full bg-[#F2B705] hover:bg-[#F29F05] text-[#2B88D9] font-semibold py-2 rounded-lg transition-all text-sm">
                        Mettre à niveau
                    </button>
                </div>
            </div>
        </div>
    </aside>
    
    <main class="main-content" id="mainContent">
        
        <header class="bg-white shadow-sm sticky top-0 z-10">
            <div class="px-6 py-4 flex justify-between items-center">
                <div class="flex items-center gap-4">
                    <button id="menuToggleBtn" class="menu-toggle-btn w-10 h-10 rounded-lg bg-gray-100 hover:bg-gray-200 transition-all flex items-center justify-center shadow-sm">
                        <i class="fas fa-bars text-gray-600 text-xl"></i>
                    </button>
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">Tableau de bord</h2>
                        <p class="text-sm text-gray-500 mt-1">Bienvenue sur votre espace de travail</p>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <button id="themeToggle" class="theme-switch w-10 h-10 rounded-full bg-gray-100 hover:bg-gray-200 transition-all flex items-center justify-center">
                        <i id="themeIcon" class="fas fa-moon text-gray-600 text-lg"></i>
                    </button>
                    
                    <div class="flex items-center gap-3 cursor-pointer hover:bg-gray-50 rounded-lg px-3 py-2 transition">
                        <div class="text-right hidden sm:block">
                            <p class="text-sm font-semibold text-gray-800">Alexandre Martin</p>
                            <p class="text-xs text-gray-500">Product Owner</p>
                        </div>
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-[#2B88D9] to-[#99D0F2] flex items-center justify-center text-white font-bold shadow-md">
                            AM
                        </div>
                    </div>
                </div>
            </div>
        </header>
        
        <div class="p-6">