<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Flotte - Admin MaBagnole</title>
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
                <a href="admin-dashboard.html" class="flex items-center gap-3 p-3 text-gray-600 hover:bg-gray-50 rounded-lg">
                    <i class="fas fa-chart-pie w-5"></i> Dashboard
                </a>
                <a href="admin-fleet.html" class="flex items-center gap-3 p-3 bg-blue-50 text-blue-600 rounded-lg font-bold">
                    <i class="fas fa-car w-5"></i> Gestion Flotte
                </a>
                <a href="admin-bookings.html" class="flex items-center gap-3 p-3 text-gray-600 hover:bg-gray-50 rounded-lg">
                    <i class="fas fa-calendar-check w-5"></i> Réservations
                </a>
                <a href="admin-users.html" class="flex items-center gap-3 p-3 text-gray-600 hover:bg-gray-50 rounded-lg">
                    <i class="fas fa-users w-5"></i> Utilisateurs
                </a>
            </nav>
        </aside>

        <main class="flex-grow p-8">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Gestion du Parc Automobile</h1>
                    <p class="text-sm text-gray-500">Supervisez et mettez à jour la disponibilité de vos véhicules.</p>
                </div>
                <button class="bg-blue-600 text-white px-6 py-3 rounded-xl font-bold shadow-lg shadow-blue-200 hover:bg-blue-700 transition flex items-center gap-2">
                    <i class="fas fa-plus"></i> Nouveau Véhicule
                </button>
            </div>

            <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 mb-8 flex flex-wrap gap-4 items-center">
                <div class="relative flex-grow max-w-md">
                    <input type="text" placeholder="Rechercher par immatriculation ou modèle..." class="w-full pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-600 outline-none">
                    <i class="fas fa-search absolute left-3 top-3.5 text-gray-400"></i>
                </div>
                <select class="bg-gray-50 border border-gray-200 rounded-lg px-4 py-2.5 text-sm outline-none focus:ring-2 focus:ring-blue-600">
                    <option>Tous les statuts</option>
                    <option>Disponible</option>
                    <option>Loué</option>
                    <option>Maintenance</option>
                </select>
                <div class="flex items-center gap-2 ml-auto">
                    <span class="text-xs text-gray-400 font-bold uppercase">Vue :</span>
                    <button class="p-2 text-blue-600 bg-blue-50 rounded"><i class="fas fa-list"></i></button>
                    <button class="p-2 text-gray-400 hover:text-blue-600 transition"><i class="fas fa-th-large"></i></button>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-50 text-gray-400 text-[11px] uppercase tracking-wider font-bold">
                        <tr>
                            <th class="px-6 py-4">Véhicule</th>
                            <th class="px-6 py-4">Catégorie</th>
                            <th class="px-6 py-4">Prix/Jour</th>
                            <th class="px-6 py-4">Statut</th>
                            <th class="px-6 py-4">Kilométrage</th>
                            <th class="px-6 py-4 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <img src="https://images.unsplash.com/photo-1560958089-b8a1929cea89?auto=format&fit=crop&q=80&w=100" class="w-12 h-10 object-cover rounded-md">
                                    <div>
                                        <p class="font-bold text-gray-800 text-sm">Tesla Model 3</p>
                                        <p class="text-[10px] text-gray-500 uppercase">AB-123-CD</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">Berline Élec.</td>
                            <td class="px-6 py-4 text-sm font-bold text-gray-800">89,00 €</td>
                            <td class="px-6 py-4">
                                <span class="bg-green-100 text-green-600 text-[10px] font-bold px-2 py-1 rounded uppercase">Disponible</span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">12 450 km</td>
                            <td class="px-6 py-4">
                                <div class="flex justify-center gap-2">
                                    <button class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition" title="Éditer"><i class="fas fa-edit"></i></button>
                                    <button class="p-2 text-orange-500 hover:bg-orange-50 rounded-lg transition" title="Maintenance"><i class="fas fa-tools"></i></button>
                                    <button class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition" title="Supprimer"><i class="fas fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>

                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&q=80&w=100" class="w-12 h-10 object-cover rounded-md">
                                    <div>
                                        <p class="font-bold text-gray-800 text-sm">Porsche 911</p>
                                        <p class="text-[10px] text-gray-500 uppercase">GT-911-RS</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">Sport</td>
                            <td class="px-6 py-4 text-sm font-bold text-gray-800">240,00 €</td>
                            <td class="px-6 py-4">
                                <span class="bg-blue-100 text-blue-600 text-[10px] font-bold px-2 py-1 rounded uppercase">Loué</span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">5 200 km</td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center gap-2">
                                    <button class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition"><i class="fas fa-edit"></i></button>
                                    <button class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition"><i class="fas fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>

                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <img src="https://images.unsplash.com/photo-1533473359331-0135ef1b58bf?auto=format&fit=crop&q=80&w=100" class="w-12 h-10 object-cover rounded-md">
                                    <div>
                                        <p class="font-bold text-gray-800 text-sm">Land Rover</p>
                                        <p class="text-[10px] text-gray-500 uppercase">EV-789-JK</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">SUV 4x4</td>
                            <td class="px-6 py-4 text-sm font-bold text-gray-800">145,00 €</td>
                            <td class="px-6 py-4">
                                <span class="bg-red-100 text-red-600 text-[10px] font-bold px-2 py-1 rounded uppercase">Maintenance</span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">42 100 km</td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center gap-2">
                                    <button class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition"><i class="fas fa-edit"></i></button>
                                    <button class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition"><i class="fas fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                
                <div class="p-6 bg-gray-50 flex justify-between items-center text-xs font-bold text-gray-400">
                    <span>AFFICHAGE : 1-10 SUR 56</span>
                    <div class="flex gap-2">
                        <button class="p-2 bg-white border rounded hover:bg-gray-100 shadow-sm"><i class="fas fa-chevron-left"></i> Précédent</button>
                        <button class="p-2 bg-white border rounded hover:bg-gray-100 shadow-sm">Suivant <i class="fas fa-chevron-right"></i></button>
                    </div>
                </div>
            </div>
        </main>
    </div>

</body>
</html>