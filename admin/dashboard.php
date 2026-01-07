<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - MaBagnole</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Poppins', sans-serif; }
        .sidebar-active { border-right: 4px solid #2563eb; background: #eff6ff; color: #2563eb; }
    </style>
</head>
<body class="bg-gray-100">

    <div class="flex min-h-screen">
        <aside class="w-64 bg-white shadow-xl hidden lg:flex flex-col sticky top-0 h-screen">
            <div class="p-6 border-b">
                <a href="index.html" class="flex items-center gap-2">
                    <i class="fas fa-car-side text-blue-600 text-2xl"></i>
                    <span class="text-xl font-bold">Ma<span class="text-blue-600">Bagnole</span></span>
                </a>
            </div>
            
            <nav class="flex-grow p-4 space-y-2 mt-4">
                <a href="admin-dashboard.html" class="flex items-center gap-3 p-3 rounded-lg sidebar-active font-bold">
                    <i class="fas fa-chart-pie w-5"></i> Dashboard
                </a>
                <a href="admin-fleet.html" class="flex items-center gap-3 p-3 text-gray-600 hover:bg-gray-50 rounded-lg transition">
                    <i class="fas fa-car w-5"></i> Gestion Flotte
                </a>
                <a href="admin-bookings.html" class="flex items-center gap-3 p-3 text-gray-600 hover:bg-gray-50 rounded-lg transition">
                    <i class="fas fa-calendar-check w-5"></i> Réservations
                </a>
                <a href="admin-users.html" class="flex items-center gap-3 p-3 text-gray-600 hover:bg-gray-50 rounded-lg transition">
                    <i class="fas fa-users w-5"></i> Utilisateurs
                </a>
                <a href="admin-blog.html" class="flex items-center gap-3 p-3 text-gray-600 hover:bg-gray-50 rounded-lg transition">
                    <i class="fas fa-newspaper w-5"></i> Modération Blog
                </a>
            </nav>

            <div class="p-4 border-t">
                <div class="flex items-center gap-3 p-2 bg-gray-50 rounded-lg mb-4">
                    <div class="w-10 h-10 rounded-full bg-blue-600 flex items-center justify-center text-white font-bold">A</div>
                    <div>
                        <p class="text-sm font-bold">Admin</p>
                        <p class="text-[10px] text-gray-500 uppercase">Super Utilisateur</p>
                    </div>
                </div>
                <a href="index.html" class="flex items-center gap-3 p-3 text-red-500 hover:bg-red-50 rounded-lg transition text-sm font-bold">
                    <i class="fas fa-power-off"></i> Quitter l'Admin
                </a>
            </div>
        </aside>

        <main class="flex-grow p-8">
            <div class="lg:hidden flex justify-between items-center mb-8">
                <i class="fas fa-car-side text-blue-600 text-2xl"></i>
                <button class="p-2 bg-white rounded-lg shadow"><i class="fas fa-bars"></i></button>
            </div>

            <div class="flex justify-between items-end mb-8">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Bonjour, Admin 👋</h1>
                    <p class="text-gray-500">Voici ce qu'il se passe sur votre plateforme aujourd'hui.</p>
                </div>
                <div class="flex gap-3">
                    <button class="bg-white px-4 py-2 rounded-lg border text-sm font-bold hover:bg-gray-50 transition">Rapport PDF</button>
                    <button class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-bold hover:bg-blue-700 transition shadow-lg shadow-blue-200">+ Ajouter Véhicule</button>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <div class="flex justify-between items-start mb-4">
                        <div class="p-3 bg-blue-100 text-blue-600 rounded-xl"><i class="fas fa-euro-sign"></i></div>
                        <span class="text-green-500 text-xs font-bold">+12% <i class="fas fa-arrow-up"></i></span>
                    </div>
                    <p class="text-sm text-gray-500 font-medium">Revenus mensuels</p>
                    <p class="text-2xl font-bold text-gray-800">12 840 €</p>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <div class="flex justify-between items-start mb-4">
                        <div class="p-3 bg-orange-100 text-orange-600 rounded-xl"><i class="fas fa-calendar-alt"></i></div>
                        <span class="text-orange-500 text-xs font-bold">8 En attente</span>
                    </div>
                    <p class="text-sm text-gray-500 font-medium">Réservations</p>
                    <p class="text-2xl font-bold text-gray-800">142</p>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <div class="flex justify-between items-start mb-4">
                        <div class="p-3 bg-green-100 text-green-600 rounded-xl"><i class="fas fa-car"></i></div>
                        <span class="text-gray-400 text-xs font-bold">85% Occ.</span>
                    </div>
                    <p class="text-sm text-gray-500 font-medium">Véhicules Actifs</p>
                    <p class="text-2xl font-bold text-gray-800">48 / 56</p>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <div class="flex justify-between items-start mb-4">
                        <div class="p-3 bg-purple-100 text-purple-600 rounded-xl"><i class="fas fa-user-plus"></i></div>
                        <span class="text-green-500 text-xs font-bold">+52</span>
                    </div>
                    <p class="text-sm text-gray-500 font-medium">Nouveaux Clients</p>
                    <p class="text-2xl font-bold text-gray-800">1 204</p>
                </div>
            </div>

            <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
                <div class="xl:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="font-bold text-gray-800 uppercase text-sm tracking-wider">Réservations Récentes</h2>
                        <a href="#" class="text-blue-600 text-xs font-bold hover:underline">Voir tout</a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="text-gray-400 text-[10px] uppercase border-b">
                                    <th class="pb-4 font-bold">Client</th>
                                    <th class="pb-4 font-bold">Véhicule</th>
                                    <th class="pb-4 font-bold">Date</th>
                                    <th class="pb-4 font-bold">Status</th>
                                    <th class="pb-4 font-bold text-right">Montant</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm">
                                <tr class="border-b last:border-0">
                                    <td class="py-4 font-medium">Jean Dupont</td>
                                    <td class="py-4 text-gray-500 text-xs">Tesla Model 3</td>
                                    <td class="py-4 text-gray-500 text-xs">Aujourd'hui</td>
                                    <td class="py-4">
                                        <span class="bg-green-100 text-green-600 px-2 py-1 rounded text-[10px] font-bold">CONFIRMÉ</span>
                                    </td>
                                    <td class="py-4 text-right font-bold">245 €</td>
                                </tr>
                                <tr class="border-b last:border-0">
                                    <td class="py-4 font-medium">Sophie Martin</td>
                                    <td class="py-4 text-gray-500 text-xs">Audi A3</td>
                                    <td class="py-4 text-gray-500 text-xs">Demain</td>
                                    <td class="py-4">
                                        <span class="bg-yellow-100 text-yellow-600 px-2 py-1 rounded text-[10px] font-bold">ATTENTE</span>
                                    </td>
                                    <td class="py-4 text-right font-bold">120 €</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h2 class="font-bold text-gray-800 uppercase text-sm tracking-wider mb-6">Alertes Flotte</h2>
                    <div class="space-y-6">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 bg-red-100 text-red-600 rounded-full flex items-center justify-center"><i class="fas fa-tools"></i></div>
                            <div>
                                <p class="text-sm font-bold">Révision Nécessaire</p>
                                <p class="text-[10px] text-gray-400">Porsche 911 • #MB-221</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center"><i class="fas fa-info-circle"></i></div>
                            <div>
                                <p class="text-sm font-bold">Assurance Expirée</p>
                                <p class="text-[10px] text-gray-400">Renault Zoe • #MB-004</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

</body>
</html>