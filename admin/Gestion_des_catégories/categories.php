<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Catégories - Admin MaBagnole</title>
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
                <a href="admin-fleet.html" class="flex items-center gap-3 p-3 text-gray-600 hover:bg-gray-50 rounded-lg">
                    <i class="fas fa-car w-5"></i> Gestion Flotte
                </a>
                <a href="admin-categories.html" class="flex items-center gap-3 p-3 bg-blue-50 text-blue-600 rounded-lg font-bold">
                    <i class="fas fa-tags w-5"></i> Catégories
                </a>
                <a href="admin-bookings.html" class="flex items-center gap-3 p-3 text-gray-600 hover:bg-gray-50 rounded-lg">
                    <i class="fas fa-calendar-check w-5"></i> Réservations
                </a>
            </nav>
        </aside>

        <main class="flex-grow p-8">
            <div class="mb-8">
                <h1 class="text-2xl font-bold text-gray-800">Catégories de Véhicules</h1>
                <p class="text-sm text-gray-500">Organisez votre flotte pour faciliter la recherche des clients.</p>
            </div>

            <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
                
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 h-fit">
                    <h2 class="font-bold text-gray-800 mb-6 flex items-center gap-2">
                        <i class="fas fa-plus-circle text-blue-600"></i> Nouvelle Catégorie
                    </h2>
                    <form class="space-y-4">
                        <div>
                            <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Nom de la catégorie</label>
                            <input type="text" placeholder="Ex: Électrique, Sportive..." class="w-full px-4 py-2.5 bg-gray-50 border rounded-lg outline-none focus:ring-2 focus:ring-blue-600 transition text-sm">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Icône (FontAwesome)</label>
                            <input type="text" placeholder="Ex: fas fa-bolt" class="w-full px-4 py-2.5 bg-gray-50 border rounded-lg outline-none focus:ring-2 focus:ring-blue-600 transition text-sm">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Description courte</label>
                            <textarea rows="3" class="w-full px-4 py-2.5 bg-gray-50 border rounded-lg outline-none focus:ring-2 focus:ring-blue-600 transition text-sm placeholder:text-gray-300" placeholder="Décrivez le type de véhicules..."></textarea>
                        </div>
                        <button class="w-full bg-blue-600 text-white font-bold py-3 rounded-xl shadow-lg shadow-blue-100 hover:bg-blue-700 transition">
                            Créer la catégorie
                        </button>
                    </form>
                </div>

                <div class="xl:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <table class="w-full text-left">
                        <thead class="bg-gray-50 text-[10px] text-gray-400 uppercase font-bold tracking-wider">
                            <tr>
                                <th class="px-6 py-4">Icône & Nom</th>
                                <th class="px-6 py-4">Description</th>
                                <th class="px-6 py-4 text-center">Nb. Véhicules</th>
                                <th class="px-6 py-4 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 text-sm">
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-yellow-100 text-yellow-600 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-bolt text-lg"></i>
                                        </div>
                                        <span class="font-bold text-gray-800">Électrique</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-gray-500 text-xs">Véhicules 100% propres pour la ville et les longs trajets.</td>
                                <td class="px-6 py-4 text-center font-bold">12</td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex justify-end gap-2">
                                        <button class="p-2 text-gray-400 hover:text-blue-600 transition"><i class="fas fa-edit"></i></button>
                                        <button class="p-2 text-gray-400 hover:text-red-600 transition"><i class="fas fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-gem text-lg"></i>
                                        </div>
                                        <span class="font-bold text-gray-800">Luxe</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-gray-500 text-xs">Berlines de prestige et voitures de sport haut de gamme.</td>
                                <td class="px-6 py-4 text-center font-bold">8</td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex justify-end gap-2">
                                        <button class="p-2 text-gray-400 hover:text-blue-600 transition"><i class="fas fa-edit"></i></button>
                                        <button class="p-2 text-gray-400 hover:text-red-600 transition"><i class="fas fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 bg-green-100 text-green-600 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-truck-pickup text-lg"></i>
                                        </div>
                                        <span class="font-bold text-gray-800">Utilitaire</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-gray-500 text-xs">Fourgonnettes et camions pour vos déménagements.</td>
                                <td class="px-6 py-4 text-center font-bold">5</td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex justify-end gap-2">
                                        <button class="p-2 text-gray-400 hover:text-blue-600 transition"><i class="fas fa-edit"></i></button>
                                        <button class="p-2 text-gray-400 hover:text-red-600 transition"><i class="fas fa-trash"></i></button>
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