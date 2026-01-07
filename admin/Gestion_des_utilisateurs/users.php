<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Utilisateurs - Admin MaBagnole</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>body { font-family: 'Poppins', sans-serif; }</style>
</head>
<body class="bg-gray-50">

    <div class="flex min-h-screen">
        <aside class="w-64 bg-white shadow-sm hidden lg:flex flex-col sticky top-0 h-screen">
            <div class="p-6 border-b text-center">
                <span class="text-xl font-bold">Ma<span class="text-blue-600">Bagnole</span> Admin</span>
            </div>
            <nav class="flex-grow p-4 space-y-2 mt-4">
                <a href="admin-dashboard.html" class="flex items-center gap-3 p-3 text-gray-600 hover:bg-gray-50 rounded-lg transition">
                    <i class="fas fa-chart-pie w-5"></i> Dashboard
                </a>
                <a href="admin-fleet.html" class="flex items-center gap-3 p-3 text-gray-600 hover:bg-gray-50 rounded-lg transition">
                    <i class="fas fa-car w-5"></i> Gestion Flotte
                </a>
                <a href="admin-bookings.html" class="flex items-center gap-3 p-3 text-gray-600 hover:bg-gray-50 rounded-lg transition">
                    <i class="fas fa-calendar-check w-5"></i> Réservations
                </a>
                <a href="admin-users.html" class="flex items-center gap-3 p-3 bg-blue-50 text-blue-600 rounded-lg font-bold transition">
                    <i class="fas fa-users w-5"></i> Utilisateurs
                </a>
            </nav>
        </aside>

        <main class="flex-grow p-8">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Répertoire des Utilisateurs</h1>
                    <p class="text-sm text-gray-500">Gérez les accès, les rôles et les profils de vos clients.</p>
                </div>
                <div class="flex gap-2">
                    <button class="bg-white border border-gray-200 px-4 py-2 rounded-lg text-sm font-bold flex items-center gap-2 hover:bg-gray-50 transition">
                        <i class="fas fa-download"></i> Exporter CSV
                    </button>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6 border-b bg-white flex flex-col md:flex-row gap-4 justify-between items-center">
                    <div class="relative w-full md:w-96">
                        <input type="text" placeholder="Rechercher un nom, email ou ID..." class="w-full pl-10 pr-4 py-2 bg-gray-50 border rounded-lg text-sm outline-none focus:ring-2 focus:ring-blue-600">
                        <i class="fas fa-search absolute left-3 top-2.5 text-gray-400"></i>
                    </div>
                    <div class="flex gap-2">
                        <select class="text-sm border rounded-lg px-3 py-2 bg-gray-50 outline-none">
                            <option>Tous les Rôles</option>
                            <option>Client</option>
                            <option>Administrateur</option>
                            <option>Banni</option>
                        </select>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-gray-50 text-[10px] text-gray-400 uppercase font-bold tracking-wider">
                            <tr>
                                <th class="px-6 py-4">Utilisateur</th>
                                <th class="px-6 py-4">Rôle</th>
                                <th class="px-6 py-4">Inscrit le</th>
                                <th class="px-6 py-4 text-center">Locations</th>
                                <th class="px-6 py-4">Statut</th>
                                <th class="px-6 py-4 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 text-sm">
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold">TL</div>
                                        <div>
                                            <p class="font-bold text-gray-800">Thomas Legrand</p>
                                            <p class="text-[11px] text-gray-400">t.legrand@exemple.com</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-gray-600">Client Premium</td>
                                <td class="px-6 py-4 text-gray-500">12/01/2024</td>
                                <td class="px-6 py-4 text-center font-semibold">14</td>
                                <td class="px-6 py-4">
                                    <span class="bg-green-100 text-green-600 text-[10px] font-bold px-2 py-1 rounded-full">ACTIF</span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex justify-end gap-2">
                                        <button class="p-2 text-gray-400 hover:text-blue-600 transition" title="Voir profil"><i class="fas fa-eye"></i></button>
                                        <button class="p-2 text-gray-400 hover:text-orange-500 transition" title="Suspendre"><i class="fas fa-ban"></i></button>
                                        <button class="p-2 text-gray-400 hover:text-red-600 transition" title="Supprimer"><i class="fas fa-trash-alt"></i></button>
                                    </div>
                                </td>
                            </tr>

                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&q=80&w=100" class="w-10 h-10 rounded-full object-cover">
                                        <div>
                                            <p class="font-bold text-gray-800">Sarah Connor</p>
                                            <p class="text-[11px] text-gray-400">s.connor@sky.net</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-gray-600">Administrateur</td>
                                <td class="px-6 py-4 text-gray-500">01/12/2023</td>
                                <td class="px-6 py-4 text-center font-semibold">2</td>
                                <td class="px-6 py-4">
                                    <span class="bg-purple-100 text-purple-600 text-[10px] font-bold px-2 py-1 rounded-full">STAFF</span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex justify-end gap-2">
                                        <button class="p-2 text-gray-400 hover:text-blue-600 transition"><i class="fas fa-eye"></i></button>
                                        <button class="p-2 text-gray-400 hover:text-orange-500 transition"><i class="fas fa-ban"></i></button>
                                    </div>
                                </td>
                            </tr>

                            <tr class="hover:bg-gray-50 transition bg-red-50/30">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center text-gray-500 font-bold italic">?</div>
                                        <div>
                                            <p class="font-bold text-gray-800">Anonyme Suspect</p>
                                            <p class="text-[11px] text-gray-400">spam@bot.com</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-gray-600">Client</td>
                                <td class="px-6 py-4 text-gray-500">04/01/2024</td>
                                <td class="px-6 py-4 text-center font-semibold">0</td>
                                <td class="px-6 py-4">
                                    <span class="bg-red-100 text-red-600 text-[10px] font-bold px-2 py-1 rounded-full">BANNI</span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex justify-end gap-2">
                                        <button class="bg-gray-800 text-white px-3 py-1 rounded text-[10px] font-bold hover:bg-gray-700 transition">Réactiver</button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

</body>
</html>