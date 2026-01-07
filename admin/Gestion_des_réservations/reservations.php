<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Réservations - Admin MaBagnole</title>
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
                <a href="admin-bookings.html" class="flex items-center gap-3 p-3 bg-blue-50 text-blue-600 rounded-lg font-bold transition">
                    <i class="fas fa-calendar-check w-5"></i> Réservations
                </a>
                <a href="admin-users.html" class="flex items-center gap-3 p-3 text-gray-600 hover:bg-gray-50 rounded-lg transition">
                    <i class="fas fa-users w-5"></i> Utilisateurs
                </a>
            </nav>
        </aside>

        <main class="flex-grow p-8">
            <div class="mb-8">
                <h1 class="text-2xl font-bold text-gray-800">Suivi des Réservations</h1>
                <p class="text-sm text-gray-500">Validez les demandes et gérez les contrats de location en cours.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
                <button class="bg-white p-4 rounded-xl shadow-sm border-b-4 border-blue-500 hover:shadow-md transition text-left">
                    <span class="text-xs font-bold text-gray-400 uppercase">En attente</span>
                    <span class="block text-2xl font-bold text-blue-600">12</span>
                </button>
                <button class="bg-white p-4 rounded-xl shadow-sm border-b-4 border-green-500 hover:shadow-md transition text-left">
                    <span class="text-xs font-bold text-gray-400 uppercase">Confirmées</span>
                    <span class="block text-2xl font-bold text-green-600">45</span>
                </button>
                <button class="bg-white p-4 rounded-xl shadow-sm border-b-4 border-orange-500 hover:shadow-md transition text-left">
                    <span class="text-xs font-bold text-gray-400 uppercase">Terminées</span>
                    <span class="block text-2xl font-bold text-orange-600">128</span>
                </button>
                <button class="bg-white p-4 rounded-xl shadow-sm border-b-4 border-red-500 hover:shadow-md transition text-left">
                    <span class="text-xs font-bold text-gray-400 uppercase">Annulées</span>
                    <span class="block text-2xl font-bold text-red-600">04</span>
                </button>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6 border-b flex flex-col md:flex-row justify-between items-center gap-4">
                    <div class="relative w-full md:w-96">
                        <input type="text" placeholder="Rechercher par n° de réservation ou client..." class="w-full pl-10 pr-4 py-2 bg-gray-50 border rounded-lg text-sm outline-none focus:ring-2 focus:ring-blue-600">
                        <i class="fas fa-search absolute left-3 top-2.5 text-gray-400"></i>
                    </div>
                    <button class="text-sm text-blue-600 font-bold hover:bg-blue-50 px-4 py-2 rounded-lg transition">
                        <i class="fas fa-filter mr-2"></i> Filtres avancés
                    </button>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-gray-50 text-[10px] text-gray-400 uppercase font-bold tracking-wider">
                            <tr>
                                <th class="px-6 py-4">ID / Client</th>
                                <th class="px-6 py-4">Véhicule</th>
                                <th class="px-6 py-4">Période</th>
                                <th class="px-6 py-4">Montant</th>
                                <th class="px-6 py-4">Statut</th>
                                <th class="px-6 py-4 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 text-sm">
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4">
                                    <p class="font-bold text-gray-800">#RES-7429</p>
                                    <p class="text-xs text-gray-500">Thomas Legrand</p>
                                </td>
                                <td class="px-6 py-4 text-gray-600">Tesla Model 3</td>
                                <td class="px-6 py-4">
                                    <p class="font-medium">10/01 - 15/01</p>
                                    <p class="text-[10px] text-blue-500">5 Jours</p>
                                </td>
                                <td class="px-6 py-4 font-bold">445,00 €</td>
                                <td class="px-6 py-4">
                                    <span class="bg-blue-100 text-blue-600 text-[10px] font-bold px-2 py-1 rounded-full uppercase">Attente Confirmation</span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex justify-end gap-2">
                                        <button class="bg-green-500 text-white p-2 rounded-lg hover:bg-green-600 transition" title="Confirmer"><i class="fas fa-check"></i></button>
                                        <button class="bg-red-100 text-red-500 p-2 rounded-lg hover:bg-red-200 transition" title="Annuler"><i class="fas fa-times"></i></button>
                                        <button class="bg-gray-100 text-gray-600 p-2 rounded-lg hover:bg-gray-200 transition"><i class="fas fa-eye"></i></button>
                                    </div>
                                </td>
                            </tr>

                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4">
                                    <p class="font-bold text-gray-800">#RES-7420</p>
                                    <p class="text-xs text-gray-500">Julie Bernard</p>
                                </td>
                                <td class="px-6 py-4 text-gray-600">Audi A3 Sportback</td>
                                <td class="px-6 py-4">
                                    <p class="font-medium">05/01 - 08/01</p>
                                    <p class="text-[10px] text-green-500 font-bold uppercase">En cours</p>
                                </td>
                                <td class="px-6 py-4 font-bold">280,00 €</td>
                                <td class="px-6 py-4">
                                    <span class="bg-green-100 text-green-600 text-[10px] font-bold px-2 py-1 rounded-full uppercase">Confirmé</span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex justify-end gap-2">
                                        <button class="bg-blue-600 text-white px-3 py-1.5 rounded-lg text-xs font-bold hover:bg-blue-700 transition">Retour véhicule</button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                <div class="p-6 bg-gray-50 flex justify-center border-t">
                    <button class="text-sm font-bold text-gray-400 hover:text-blue-600 transition">Charger plus de réservations...</button>
                </div>
            </div>
        </main>
    </div>

</body>
</html>