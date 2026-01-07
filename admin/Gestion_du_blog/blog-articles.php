<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Articles - Admin MaBagnole</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>body { font-family: 'Poppins', sans-serif; }</style>
</head>
<body class="bg-gray-50 flex">

    <aside class="w-64 bg-white shadow-lg h-screen sticky top-0 flex flex-col p-4">
        <div class="p-4 font-bold text-xl border-b mb-6 flex items-center gap-2">
            <i class="fas fa-pen-fancy text-blue-600"></i>
            <span>Blog Admin</span>
        </div>
        <nav class="space-y-2 flex-grow">
            <a href="admin-blog-approval.html" class="flex items-center gap-3 p-3 text-gray-500 hover:bg-gray-50 rounded-xl transition">
                <i class="fas fa-hourglass-half w-5"></i> Approbations
            </a>
            <a href="admin-blog-list.html" class="flex items-center gap-3 p-3 bg-blue-600 text-white rounded-xl font-bold shadow-md">
                <i class="fas fa-file-alt w-5"></i> Tous les articles
            </a>
            <a href="admin-blog-comments.html" class="flex items-center gap-3 p-3 text-gray-500 hover:bg-gray-50 rounded-xl transition">
                <i class="fas fa-comments w-5"></i> Commentaires
            </a>
            <a href="admin-blog-categories.html" class="flex items-center gap-3 p-3 text-gray-500 hover:bg-gray-50 rounded-xl transition">
                <i class="fas fa-tags w-5"></i> Catégories
            </a>
        </nav>
        <div class="pt-4 border-t">
            <a href="admin-dashboard.html" class="flex items-center gap-3 p-3 text-gray-400 hover:text-gray-800 transition text-sm">
                <i class="fas fa-arrow-left"></i> Retour Dashboard
            </a>
        </div>
    </aside>

    <main class="flex-grow p-8">
        <header class="flex justify-between items-center mb-10">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Articles</h1>
                <p class="text-gray-500">Gérez l'ensemble des publications de votre plateforme.</p>
            </div>
            <a href="write-article.html" class="bg-blue-600 text-white px-6 py-3 rounded-2xl font-bold flex items-center gap-2 hover:bg-blue-700 transition shadow-lg shadow-blue-200">
                <i class="fas fa-plus"></i> Nouvel Article
            </a>
        </header>

        <div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100 mb-6 flex flex-wrap gap-4 items-center">
            <div class="relative flex-grow">
                <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                <input type="text" placeholder="Rechercher par titre ou mot-clé..." class="w-full pl-12 pr-4 py-3 bg-gray-50 border-none rounded-xl focus:ring-2 focus:ring-blue-500 outline-none text-sm">
            </div>
            <select class="bg-gray-50 px-4 py-3 rounded-xl text-sm font-medium border-none outline-none focus:ring-2 focus:ring-blue-500">
                <option>Toutes les catégories</option>
                <option>Voyages</option>
                <option>Conseils</option>
                <option>Électrique</option>
            </select>
            <button class="bg-gray-100 p-3 rounded-xl text-gray-600 hover:bg-gray-200 transition">
                <i class="fas fa-sliders-h"></i>
            </button>
        </div>

        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
            <table class="w-full text-left">
                <thead class="bg-gray-50 text-[11px] uppercase font-bold text-gray-400 tracking-wider">
                    <tr>
                        <th class="px-8 py-5">Contenu</th>
                        <th class="px-8 py-5">Auteur</th>
                        <th class="px-8 py-5 text-center">Engagement</th>
                        <th class="px-8 py-5">Statut</th>
                        <th class="px-8 py-5 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    <tr class="hover:bg-gray-50/50 transition">
                        <td class="px-8 py-5">
                            <div class="flex items-center gap-4">
                                <img src="https://images.unsplash.com/photo-1469474094887-11830a50bc74?auto=format&fit=crop&q=80&w=100" class="w-14 h-14 rounded-xl object-cover">
                                <div>
                                    <p class="font-bold text-gray-800 leading-tight">Les plus beaux Roadtrips en 2026</p>
                                    <p class="text-[10px] text-gray-400 mt-1 uppercase">Publié le 02 Jan. 2026</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-8 py-5 text-sm font-medium text-gray-600">Admin</td>
                        <td class="px-8 py-5">
                            <div class="flex justify-center gap-4">
                                <span class="text-xs text-gray-500 flex items-center gap-1.5"><i class="fas fa-eye"></i> 2.4k</span>
                                <span class="text-xs text-gray-500 flex items-center gap-1.5"><i class="fas fa-comment"></i> 45</span>
                            </div>
                        </td>
                        <td class="px-8 py-5">
                            <span class="bg-green-100 text-green-600 text-[10px] font-bold px-3 py-1 rounded-full">EN LIGNE</span>
                        </td>
                        <td class="px-8 py-5 text-right">
                            <div class="flex justify-end gap-2">
                                <button class="w-9 h-9 flex items-center justify-center bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-600 hover:text-white transition" title="Modifier">
                                    <i class="fas fa-edit text-xs"></i>
                                </button>
                                <button class="w-9 h-9 flex items-center justify-center bg-red-50 text-red-500 rounded-lg hover:bg-red-500 hover:text-white transition" title="Supprimer">
                                    <i class="fas fa-trash text-xs"></i>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <tr class="hover:bg-gray-50/50 transition">
                        <td class="px-8 py-5">
                            <div class="flex items-center gap-4">
                                <img src="https://images.unsplash.com/photo-1593941707882-a5bba14938c7?auto=format&fit=crop&q=80&w=100" class="w-14 h-14 rounded-xl object-cover opacity-60">
                                <div>
                                    <p class="font-bold text-gray-800 leading-tight italic">Guide : Passer à l'électrique</p>
                                    <p class="text-[10px] text-gray-400 mt-1 uppercase">Dernière modif : Hier</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-8 py-5 text-sm font-medium text-gray-600">J. Martin</td>
                        <td class="px-8 py-5 text-center text-gray-300">--</td>
                        <td class="px-8 py-5">
                            <span class="bg-gray-100 text-gray-400 text-[10px] font-bold px-3 py-1 rounded-full">BROUILLON</span>
                        </td>
                        <td class="px-8 py-5 text-right">
                            <div class="flex justify-end gap-2">
                                <button class="w-9 h-9 flex items-center justify-center bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-600 hover:text-white transition">
                                    <i class="fas fa-edit text-xs"></i>
                                </button>
                                <button class="w-9 h-9 flex items-center justify-center bg-red-50 text-red-500 rounded-lg hover:bg-red-500 hover:text-white transition">
                                    <i class="fas fa-trash text-xs"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            
            <div class="px-8 py-5 bg-gray-50/50 flex justify-between items-center">
                <p class="text-xs font-bold text-gray-400">Page 1 sur 4</p>
                <div class="flex gap-2">
                    <button class="px-4 py-2 bg-white border border-gray-200 rounded-lg text-xs font-bold text-gray-400 cursor-not-allowed">Précédent</button>
                    <button class="px-4 py-2 bg-white border border-gray-200 rounded-lg text-xs font-bold text-gray-700 hover:bg-gray-50 transition shadow-sm">Suivant</button>
                </div>
            </div>
        </div>
    </main>

</body>
</html>