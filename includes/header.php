<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MaBagnole | Location de voitures Premium</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #FDFDFD; }
        .blog-card { transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); }
        .blog-card:hover { transform: translateY(-10px); }
        .image-zoom { transition: transform 0.6s shadow 0.6s; }
        .blog-card:hover .image-zoom { transform: scale(1.1); }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .glass-nav {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
        }

        .hero-mesh {
            background-color: #000;
            background-image:
                linear-gradient(to bottom, rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.7)),
                url('https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&q=80&w=1920');
            background-size: cover;
            background-position: center;
        }

        .card-hover:hover {
            transform: translateY(-10px);
        }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #F8FAFC;
        }
        
        .vehicle-detail-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 0 0 40px 40px;
        }
        
        .spec-card {
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .spec-card:hover {
            transform: translateY(-5px);
            background: rgba(255, 255, 255, 0.2);
        }
        
        .gallery-main {
            height: 500px;
            overflow: hidden;
            position: relative;
        }
        
        .gallery-main img {
            transition: transform 0.5s ease;
        }
        
        .gallery-main:hover img {
            transform: scale(1.05);
        }
        
        .floating-badge {
            animation: float 3s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        
        .feature-bullet {
            position: relative;
            padding-left: 2rem;
        }
        
        .feature-bullet::before {
            content: "✓";
            position: absolute;
            left: 0;
            color: #10b981;
            font-weight: bold;
        }

         body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #F8FAFC;
        }
        
        .pending-badge {
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0% { opacity: 1; }
            50% { opacity: 0.7; }
            100% { opacity: 1; }
        }
        
        .reservation-card {
            transition: all 0.3s ease;
            border-left: 4px solid transparent;
        }
        
        .reservation-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
        }
        
        .status-pending {
            border-left-color: #f59e0b;
            background: linear-gradient(to right, #fffbeb, #ffffff);
        }
        
        .status-confirmed {
            border-left-color: #10b981;
            background: linear-gradient(to right, #ecfdf5, #ffffff);
        }
        
        .status-cancelled {
            border-left-color: #ef4444;
            background: linear-gradient(to right, #fef2f2, #ffffff);
        }
        
        .empty-state {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .price-card {
            background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }
        
        .price-card:hover {
            box-shadow: 0 30px 80px rgba(0, 0, 0, 0.12);
            transform: translateY(-5px);
        }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .glass-nav {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
        }

        .hero-mesh {
            background-color: #000;
            background-image:
                linear-gradient(to bottom, rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.7)),
                url('https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&q=80&w=1920');
            background-size: cover;
            background-position: center;
        }

        .card-hover:hover {
            transform: translateY(-10px);
        }
    </style>
</head>

<body class="bg-[#F8FAFC] text-slate-900">

    <nav class="glass-nav fixed top-0 w-full z-[100] border-b border-slate-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <!-- Logo -->
                <a href="index.php" class="flex items-center gap-2 group">
                    <div class="bg-blue-600 p-2 rounded-xl rotate-[-10deg] group-hover:rotate-0 transition-transform">
                        <i class="fas fa-car-side text-white text-xl"></i>
                    </div>
                    <span class="text-2xl font-extrabold tracking-tight text-slate-800">Ma<span class="text-blue-600">Bagnole</span></span>
                </a>

                <!-- Navigation Desktop -->
                <div class="hidden md:flex items-center space-x-10 text-sm font-semibold uppercase tracking-wider">
                    <!-- Liens communs -->
                    <a href="vehicles.php" class="text-slate-600 hover:text-blue-600 transition">Catalogue</a>
                    <a href="blog.php" class="text-slate-600 hover:text-blue-600 transition">L'actu</a>
                    
                    <?php if(isset($_SESSION['user_id'])): ?>
                        <!-- Utilisateur connecté -->
                        <div class="h-6 w-px bg-slate-200"></div>
                        
                        <?php if($_SESSION['user_role'] === 'admin'): ?>
                            <!-- Menu Admin -->
                            <div class="relative group">
                                <button class="flex items-center gap-2 text-slate-600 hover:text-blue-600 transition">
                                    <i class="fas fa-tachometer-alt"></i>
                                    <span>Dashboard</span>
                                    <i class="fas fa-chevron-down text-xs"></i>
                                </button>
                                <div class="absolute hidden group-hover:block bg-white shadow-2xl rounded-xl mt-2 py-2 w-48 z-50 border border-slate-100">
                                    <a href="admin/dashboard.php" class="block px-4 py-2 text-sm hover:bg-slate-50">Tableau de bord</a>
                                    <a href="admin/vehicles.php" class="block px-4 py-2 text-sm hover:bg-slate-50">Gestion véhicules</a>
                                    <a href="admin/reservations.php" class="block px-4 py-2 text-sm hover:bg-slate-50">Réservations</a>
                                    <a href="admin/users.php" class="block px-4 py-2 text-sm hover:bg-slate-50">Clients</a>
                                    <div class="border-t my-1"></div>
                                    <a href="admin/settings.php" class="block px-4 py-2 text-sm hover:bg-slate-50">Paramètres</a>
                                </div>
                            </div>
                        <?php else: ?>
                            <!-- Menu Client -->
                            <div class="relative group">
                                <button class="flex items-center gap-2 text-slate-600 hover:text-blue-600 transition">
                                    <i class="fas fa-user-circle"></i>
                                    <span>Mon espace</span>
                                    <i class="fas fa-chevron-down text-xs"></i>
                                </button>
                                <div class="absolute hidden group-hover:block bg-white shadow-2xl rounded-xl mt-2 py-2 w-48 z-50 border border-slate-100">
                                    <a href="profile.php" class="block px-4 py-2 text-sm hover:bg-slate-50">
                                        <i class="fas fa-user mr-2"></i>Mon profil
                                    </a>
                                    <a href="my-reservations.php" class="block px-4 py-2 text-sm hover:bg-slate-50">
                                        <i class="fas fa-calendar-alt mr-2"></i>Mes réservations
                                    </a>
                                    <a href="my-reviews.php" class="block px-4 py-2 text-sm hover:bg-slate-50">
                                        <i class="fas fa-star mr-2"></i>Mes avis
                                    </a>
                                    <a href="favorites.php" class="block px-4 py-2 text-sm hover:bg-slate-50">
                                        <i class="fas fa-heart mr-2"></i>Favoris
                                    </a>
                                    <div class="border-t my-1"></div>
                                    <a href="settings.php" class="block px-4 py-2 text-sm hover:bg-slate-50">
                                        <i class="fas fa-cog mr-2"></i>Paramètres
                                    </a>
                                </div>
                            </div>
                        <?php endif; ?>
                        
                        <!-- Bouton Déconnexion -->
                        <a href="logout.php" class="bg-red-500 text-white px-6 py-2.5 rounded-full hover:bg-red-600 transition shadow-lg shadow-red-100">
                            <i class="fas fa-sign-out-alt mr-2"></i>Déconnexion
                        </a>
                        
                    <?php else: ?>
                        <!-- Utilisateur non connecté -->
                        <div class="h-6 w-px bg-slate-200"></div>
                        <a href="login.php" class="text-slate-600 hover:text-blue-600 transition">Connexion</a>
                        <a href="register.php" class="bg-slate-900 text-white px-7 py-3 rounded-full hover:bg-blue-600 transition shadow-lg shadow-blue-100">
                            Rejoindre
                        </a>
                    <?php endif; ?>
                </div>

                <!-- Menu Mobile Toggle -->
                <button id="mobileMenuToggle" class="md:hidden text-slate-800">
                    <i class="fas fa-bars-staggered text-2xl"></i>
                </button>
            </div>
        </div>

        <!-- Menu Mobile -->
        <div id="mobileMenu" class="md:hidden bg-white border-t border-slate-100 hidden">
            <div class="px-4 py-6 space-y-4">
                <!-- Liens communs -->
                <a href="vehicles.php" class="block text-slate-600 hover:text-blue-600 transition py-2">
                    <i class="fas fa-car mr-3"></i>Catalogue
                </a>
                <a href="blog.php" class="block text-slate-600 hover:text-blue-600 transition py-2">
                    <i class="fas fa-newspaper mr-3"></i>L'actu
                </a>
                
                <?php if(isset($_SESSION['user_id'])): ?>
                    <div class="border-t my-2"></div>
                    
                    <?php if($_SESSION['user_role'] === 'admin'): ?>
                        <!-- Menu Admin Mobile -->
                        <p class="text-xs uppercase text-slate-400 font-bold px-2 py-1">Administration</p>
                        <a href="admin/dashboard.php" class="block text-slate-600 hover:text-blue-600 transition py-2">
                            <i class="fas fa-tachometer-alt mr-3"></i>Dashboard
                        </a>
                        <a href="admin/vehicles.php" class="block text-slate-600 hover:text-blue-600 transition py-2">
                            <i class="fas fa-car mr-3"></i>Véhicules
                        </a>
                        <a href="admin/reservations.php" class="block text-slate-600 hover:text-blue-600 transition py-2">
                            <i class="fas fa-calendar-alt mr-3"></i>Réservations
                        </a>
                        <a href="admin/users.php" class="block text-slate-600 hover:text-blue-600 transition py-2">
                            <i class="fas fa-users mr-3"></i>Clients
                        </a>
                    <?php else: ?>
                        <!-- Menu Client Mobile -->
                        <p class="text-xs uppercase text-slate-400 font-bold px-2 py-1">Mon compte</p>
                        <a href="profile.php" class="block text-slate-600 hover:text-blue-600 transition py-2">
                            <i class="fas fa-user mr-3"></i>Mon profil
                        </a>
                        <a href="my-reservations.php" class="block text-slate-600 hover:text-blue-600 transition py-2">
                            <i class="fas fa-calendar-alt mr-3"></i>Mes réservations
                        </a>
                        <a href="my-reviews.php" class="block text-slate-600 hover:text-blue-600 transition py-2">
                            <i class="fas fa-star mr-3"></i>Mes avis
                        </a>
                        <a href="favorites.php" class="block text-slate-600 hover:text-blue-600 transition py-2">
                            <i class="fas fa-heart mr-3"></i>Favoris
                        </a>
                    <?php endif; ?>
                    
                    <div class="border-t my-2"></div>
                    <a href="logout.php" class="block bg-red-500 text-white px-4 py-3 rounded-lg hover:bg-red-600 transition text-center">
                        <i class="fas fa-sign-out-alt mr-2"></i>Déconnexion
                    </a>
                    
                <?php else: ?>
                    <div class="border-t my-2"></div>
                    <a href="login.php" class="block text-slate-600 hover:text-blue-600 transition py-2">
                        <i class="fas fa-sign-in-alt mr-3"></i>Connexion
                    </a>
                    <a href="register.php" class="block bg-slate-900 text-white px-4 py-3 rounded-lg hover:bg-blue-600 transition text-center">
                        <i class="fas fa-user-plus mr-2"></i>Créer un compte
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    