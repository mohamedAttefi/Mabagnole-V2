<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Tags - Admin MaBagnole</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>body { font-family: 'Poppins', sans-serif; }</style>
</head>
<body class="bg-gray-50 flex">

    <aside class="w-64 bg-white shadow-lg h-screen sticky top-0 flex flex-col p-4">
        <div class="p-4 font-bold text-xl border-b mb-6 flex items-center gap-2">
            <i class="fas fa-hashtag text-blue-600"></i>
            <span>Tags Admin</span>
        </div>
        <nav class="space-y-2 flex-grow">
            <a href="admin-blog-approval.html" class="flex items-center gap-3 p-3 text-gray-500 hover:bg-gray-50 rounded-xl transition">
                <i class="fas fa-check-circle w-5"></i> Approbation
            </a>
            <a href="admin-blog-list.html" class="flex items-center gap-3 p-3 text-gray-500 hover:bg-gray-50 rounded-xl transition">
                <i class="fas fa-file-alt w-5"></i> Articles
            </a>
            <a href="admin-blog-tags.html" class="flex items-center gap-3 p-3 bg-blue-600 text-white rounded-xl font-bold shadow-md">
                <i class="fas fa-tags w-5"></i> Tags & Étiquettes
            </a>
            <a href="admin-blog-categories.html" class="flex items-center gap-3 p-3 text-gray-500 hover:bg-gray-50 rounded-xl transition">
                <i class="fas fa-layer-group w-5"></i> Catégories
            </a>
        </nav>
        <div class="pt-4 border-t">
            <a href="admin-dashboard.html" class="flex items-center gap-3 p-3 text-gray-400 hover:text-gray-800 transition text-sm">
                <i class="fas fa-arrow-left"></i> Dashboard Principal
            </a>
        </div>
    </aside>

    <main class="flex-grow p-8">
        <header class="flex justify-between items-start mb-10">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Tags du Blog</h1>
                <p class="text-gray-500 text-sm">Organisez les mots-clés pour améliorer le SEO et la navigation.</p>
            </div>
            <div class="bg-blue-600/5 p-4 rounded-2xl border border-blue-100">
                <span class="block text-2xl font-bold text-blue-600">158</span>
                <span class="text-[10px] font-bold text-blue-400 uppercase tracking-widest">Tags Actifs</span>
            </div>
        </header>

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
            
            <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 h-fit">
                <h2 class="font-bold text-gray-800 mb-6 flex items-center gap-2">
                    <i class="fas fa-plus-circle text-blue-600"></i> Ajouter un Tag
                </h2>
                <form class="space-y-5">
                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase mb-2">Nom de l'étiquette</label>
                        <input type="text" placeholder="Ex: MobilitéDouce" class="w-full px-4 py-3 bg-gray-50 border-none rounded-xl outline-none focus:ring-2 focus:ring-blue-600 transition text-sm">
                    </div>
                    <div>
                        <label class="block text-[10px] font-bold text-gray-400 uppercase mb-2">Couleur du badge</label>
                        <div class="flex gap-3">
                            <button type="button" class="w-8 h-8 rounded-full bg-blue-500 ring-2 ring-offset-2 ring-blue-500"></button>
                            <button type="button" class="w-8 h-8 rounded-full bg-green-500 hover:scale-110 transition"></button>
                            <button type="button" class="w-8 h-8 rounded-full bg-purple-500 hover:scale-110 transition"></button>
                            <button type="button" class="w-8 h-8 rounded-full bg-orange-500 hover:scale-110 transition"></button>
                            <button type="button" class="w-8 h-8 rounded-full bg-gray-800 hover:scale-110 transition"></button>
                        </div>
                    </div>
                    <button class="w-full bg-gray-900 text-white font-bold py-4 rounded-2xl hover:bg-blue-600 transition-all shadow-lg shadow-gray-200">
                        Enregistrer le tag
                    </button>
                </form>
            </div>

            <div class="xl:col-span-2 bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6 border-b flex justify-between items-center bg-gray-50/30">
                    <h3 class="font-bold text-gray-700">Tags les plus utilisés</h3>
                    <div class="relative w-64">
                        <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-xs"></i>
                        <input type="text" placeholder="Filtrer les tags..." class="w-full pl-9 pr-4 py-2 bg-white border border-gray-200 rounded-lg text-xs focus:ring-2 focus:ring-blue-500 outline-none">
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead class="bg-white text-[10px] font-bold text-gray-400 uppercase border-b">
                            <tr>
                                <th class="px-8 py-4">Nom du Tag</th>
                                <th class="px-8 py-4">Slug</th>
                                <th class="px-8 py-4 text-center">Articles liés</th>
                                <th class="px-8 py-4 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            <tr class="hover:bg-gray-50/50 transition">
                                <td class="px-8 py-4">
                                    <span class="bg-blue-100 text-blue-600 px-3 py-1 rounded-full text-xs font-bold">#Electrique</span>
                                </td>
                                <td class="px-8 py-4 text-gray-400 font-mono text-xs">/tag/electrique</td>
                                <td class="px-8 py-4 text-center">
                                    <span class="font-bold text-gray-700">42</span>
                                </td>
                                <td class="px-8 py-4 text-right">
                                    <div class="flex justify-end gap-2">
                                        <button class="text-gray-400 hover:text-blue-600 transition p-2"><i class="fas fa-edit"></i></button>
                                        <button class="text-gray-400 hover:text-red-600 transition p-2"><i class="fas fa-trash-alt"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50/50 transition">
                                <td class="px-8 py-4">
                                    <span class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-xs font-bold">#Roadtrip</span>
                                </td>
                                <td class="px-8 py-4 text-gray-400 font-mono text-xs">/tag/roadtrip</td>
                                <td class="px-8 py-4 text-center">
                                    <span class="font-bold text-gray-700">28</span>
                                </td>
                                <td class="px-8 py-4 text-right">
                                    <div class="flex justify-end gap-2">
                                        <button class="text-gray-400 hover:text-blue-600 transition p-2"><i class="fas fa-edit"></i></button>
                                        <button class="text-gray-400 hover:text-red-600 transition p-2"><i class="fas fa-trash-alt"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50/50 transition">
                                <td class="px-8 py-4">
                                    <span class="bg-purple-100 text-purple-600 px-3 py-1 rounded-full text-xs font-bold">#Tuto</span>
                                </td>
                                <td class="px-8 py-4 text-gray-400 font-mono text-xs">/tag/tuto</td>
                                <td class="px-8 py-4 text-center">
                                    <span class="font-bold text-gray-700">15</span>
                                </td>
                                <td class="px-8 py-4 text-right">
                                    <div class="flex justify-end gap-2">
                                        <button class="text-gray-400 hover:text-blue-600 transition p-2"><i class="fas fa-edit"></i></button>
                                        <button class="text-gray-400 hover:text-red-600 transition p-2"><i class="fas fa-trash-alt"></i></button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

</body>
</html>