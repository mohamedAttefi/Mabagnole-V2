<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord Admin - MaBagnole</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #F8FAFC;
        }

        .sidebar {
            width: 280px;
            min-height: 100vh;
            background: linear-gradient(180deg, #1e293b 0%, #0f172a 100%);
        }

        .main-content {
            margin-left: 280px;
            min-height: 100vh;
        }

        @media (max-width: 1024px) {
            .sidebar {
                width: 100%;
                position: fixed;
                z-index: 50;
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }
        }

        .stat-card {
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
        }

        .table-row:hover {
            background-color: #f8fafc;
        }

        .alert-card {
            border-left: 4px solid transparent;
        }

        .alert-red {
            border-left-color: #ef4444;
            background: linear-gradient(to right, #fef2f2 1%, #ffffff 10%);
        }

        .alert-blue {
            border-left-color: #3b82f6;
            background: linear-gradient(to right, #eff6ff 1%, #ffffff 10%);
        }
    </style>
</head>

<body class="bg-[#F8FAFC]">
    <!-- Admin Sidebar -->
    <aside class="sidebar fixed top-0 left-0 text-white ">
        <div class="p-6 border-b border-slate-700">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-purple-600 rounded-xl flex items-center justify-center">
                    <i class="fas fa-car text-lg"></i>
                </div>
                <div>
                    <h2 class="font-bold text-lg">MaBagnole <span class="text-blue-300">Admin</span></h2>
                    <p class="text-slate-400 text-xs">Dashboard</p>
                </div>
            </div>

            <div class="">
                <a href="/MABAGNOLE-V2/admin/dashboard.php" class="flex items-center gap-3 p-3 text-slate-300 hover:bg-slate-800 rounded-lg transition">
                    <i class="fas fa-chart-pie w-5"></i>
                    Tableau de bord
                </a>
                <a href="/MABAGNOLE-V2/admin/Gestion_des_véhicules/vehicles.php" class="flex items-center gap-3 p-3 text-slate-300 hover:bg-slate-800 rounded-lg transition">
                    <i class="fas fa-car w-5"></i>
                    Véhicules
                </a>
                <a href="/MABAGNOLE-V2/admin/Gestion_des_réservations/reservations.php" class="flex items-center gap-3 p-3 text-slate-300 hover:bg-slate-800 rounded-lg transition">
                    <i class="fas fa-calendar-alt w-5"></i>
                    Réservations
                </a>
                <a href="/MABAGNOLE-V2/admin/Gestion_des_utilisateurs/users.php" class="flex items-center gap-3 p-3 text-slate-300 hover:bg-slate-800 rounded-lg transition">
                    <i class="fas fa-users w-5"></i>
                    Clients
                </a>
                <a href="/MABAGNOLE-V2/admin/Gestion-de-avis/reviews.php" class="flex items-center gap-3 p-3 text-slate-300 hover:bg-slate-800 rounded-lg transition">
                    <i class="fas fa-star w-5"></i>
                    Avis
                </a>
                <a href="/MABAGNOLE-V2/admin/Gestion_des_catégories/categories.php" class="flex items-center gap-3 p-3 text-slate-300 hover:bg-slate-800 rounded-lg transition">
                    <i class="fa-solid fa-layer-group"></i>
                    Categories
                </a>
                <a href="/MABAGNOLE-V2/admin/Gestion_du_blog/blog-categories.php" class="flex items-center gap-3 p-3 text-slate-300 hover:bg-slate-800 rounded-lg transition">
                    <i class="fa-solid fa-list"></i>
                    Themes
                </a>
                <a href="/MABAGNOLE-V2/admin/Gestion_du_blog/blogs.php" class="flex items-center gap-3 p-3 text-slate-300 hover:bg-slate-800 rounded-lg transition">
                    <i class="fa-solid fa-newspaper"></i>
                    Articles
                </a>
                <a href="/MABAGNOLE-V2/admin/Gestion_du_blog/blog-comments.php" class="flex items-center gap-3 p-3 text-slate-300 hover:bg-slate-800 rounded-lg transition">
                    <i class="fa-solid fa-comment"></i>
                    Comments
                </a>
                <a href="/MABAGNOLE-V2/admin/Gestion_du_blog/blog-tags.php" class="flex items-center gap-3 p-3 text-slate-300 hover:bg-slate-800 rounded-lg transition">
                    <i class="fa-solid fa-tag"></i>
                    Tags
                </a>


            </div>
        </div>

        <div class="">
            <div class="">
                <a href="/MABAGNOLE-V2/public/logout.php" class="flex items-center gap-3 p-3 text-slate-300 hover:bg-slate-800 rounded-lg transition">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    Deconnection
                </a>
            </div>
        </div>
    </aside>

    <!-- Mobile Menu Button -->
    <button id="mobileMenuToggle" class="lg:hidden fixed top-4 left-4 z-40 w-10 h-10 bg-white rounded-xl shadow-lg flex items-center justify-center text-slate-700">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Overlay for mobile -->
    <div id="overlay" class="lg:hidden fixed inset-0 bg-black bg-opacity-50 z-30 hidden"></div>