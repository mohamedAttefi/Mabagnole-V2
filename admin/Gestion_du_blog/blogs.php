<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Blog - Admin MaBagnole</title>
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
                <a href="admin-blog.html" class="flex items-center gap-3 p-3 bg-blue-50 text-blue-600 rounded-lg font-bold">
                    <i class="fas fa-newspaper w-5"></i> Gestion Blog
                </a>
                <a href="admin-users.html" class="flex items-center gap-3 p-3 text-gray-600 hover:bg-gray-50 rounded-lg">
                    <i class="fas fa-users w-5"></i> Utilisateurs
                </a>
            </nav>
        </aside>

        <main class="flex-grow p-8">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Gestion du Blog</h1>
                    <p class="text-sm text-gray-500">Gérez les publications, validez les articles et modérez les commentaires.</p>
                </div>
                <a href="write-article.html" class="bg-blue-600 text-white px-6 py-3 rounded-xl font-bold shadow-lg shadow-blue-200 hover:bg-blue-700 transition flex items-center gap-2">
                    <i class="fas fa-pen-nib"></i> Nouvel Article
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4">
                    <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-xl flex items-center justify-center text-xl">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <div>
                        <span class="block text-2xl font-bold">24</span>
                        <span class="text-xs text-gray-500 font-bold uppercase">Articles publiés</span>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4">
                    <div class="w-12 h-12 bg-yellow-100 text-yellow-600 rounded-xl flex items-center justify-center text-xl">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div>
                        <span class="block text-2xl font-bold">03</span>
                        <span class="text-xs text-gray-500 font-bold uppercase">En attente</span>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4">
                    <div class="w-12 h-12 bg-green-100 text-green-600 rounded-xl flex items-center justify-center text-xl">
                        <i class="fas fa-eye"></i>
                    </div>
                    <div>
                        <span class="block text-2xl font-bold">12.5k</span>
                        <span class="text-xs text-gray-500 font-bold uppercase">Vues totales</span>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6 border-b flex justify-between items-center">
                    <h2 class="font-bold text-gray-800">Dernières Publications</h2>
                    <div class="flex gap-2">
                        <button class="text-xs font-bold text-gray-400 hover:text-blue-600">Tous</button>
                        <span class="text-gray-300">|</span>
                        <button class="text-xs font-bold text-gray-400 hover:text-blue-600">Brouillons</button>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-gray-50 text-[10px] text-gray-400 uppercase font-bold tracking-wider">
                            <tr>
                                <th class="px-6 py-4">Article</th>
                                <th class="px-6 py-4">Auteur</th>
                                <th class="px-6 py-4">Catégorie</th>
                                <th class="px-6 py-4 text-center">Engagement</th>
                                <th class="px-6 py-4">Statut</th>
                                <th class="px-6 py-4 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 text-sm">
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 max-w-xs">
                                    <div class="flex items-center gap-3">
                                        <img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&q=80&w=100" class="w-12 h-10 object-cover rounded shadow-sm">
                                        <div>
                                            <p class="font-bold text-gray-800 truncate">Top 10 des plus belles routes de France</p>
                                            <p class="text-[10px] text-gray-400">Publié le 02/01/2024</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-gray-600">Admin</td>
                                <td class="px-6 py-4">
                                    <span class="bg-blue-50 text-blue-600 px-2 py-1 rounded text-[10px] font-bold">VOYAGE</span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex justify-center gap-3 text-gray-400 text-xs">
                                        <span><i class="fas fa-eye"></i> 1.2k</span>
                                        <span><i class="fas fa-comment"></i> 14</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-green-500 font-bold text-[10px] flex items-center gap-1">
                                        <span class="w-1.5 h-1.5 bg-green-500 rounded-full"></span> EN LIGNE
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex justify-end gap-2">
                                        <button class="p-2 text-gray-400 hover:text-blue-600 transition"><i class="fas fa-edit"></i></button>
                                        <button class="p-2 text-gray-400 hover:text-red-600 transition"><i class="fas fa-trash"></i></button>
                                    </div>
                                </td>
                            </tr>

                            <tr class="hover:bg-gray-50 transition bg-yellow-50/20">
                                <td class="px-6 py-4 max-w-xs">
                                    <div class="flex items-center gap-3">
                                        <div class="w-12 h-10 bg-gray-200 rounded flex items-center justify-center">
                                            <i class="fas fa-image text-gray-400"></i>
                                        </div>
                                        <div>
                                            <p class="font-bold text-gray-800 truncate">Pourquoi passer à l'électrique en 2024 ?</p>
                                            <p class="text-[10px] text-gray-400">Par Jean Dupont</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-gray-600">J. Dupont</td>
                                <td class="px-6 py-4">
                                    <span class="bg-gray-100 text-gray-600 px-2 py-1 rounded text-[10px] font-bold">CONSEILS</span>
                                </td>
                                <td class="px-6 py-4 text-center text-gray-400 italic">--</td>
                                <td class="px-6 py-4">
                                    <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded text-[10px] font-bold">ATTENTE</span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex justify-end gap-2">
                                        <button class="bg-green-600 text-white px-3 py-1 rounded text-[10px] font-bold hover:bg-green-700 transition">Publier</button>
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