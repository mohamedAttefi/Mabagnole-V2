<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion Commentaires - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>body { font-family: 'Poppins', sans-serif; }</style>
</head>
<body class="bg-gray-50 flex">
    <aside class="w-64 bg-white shadow-lg h-screen sticky top-0 p-4">
        <div class="p-4 font-bold text-xl border-b mb-6 italic">MaBagnole <span class="text-blue-600">Blog</span></div>
        <nav class="space-y-2">
            <a href="admin-blog-approval.html" class="flex items-center gap-3 p-3 text-gray-500 hover:bg-gray-50 rounded-xl transition"><i class="fas fa-check-double"></i> Approbation</a>
            <a href="admin-blog-list.html" class="flex items-center gap-3 p-3 text-gray-500 hover:bg-gray-50 rounded-xl transition"><i class="fas fa-file-alt"></i> Articles</a>
            <a href="admin-blog-comments.html" class="flex items-center gap-3 p-3 bg-blue-50 text-blue-600 rounded-xl font-bold border-r-4 border-blue-600"><i class="fas fa-comments"></i> Commentaires</a>
            <a href="admin-blog-categories.html" class="flex items-center gap-3 p-3 text-gray-500 hover:bg-gray-50 rounded-xl transition"><i class="fas fa-layer-group"></i> Catégories</a>
        </nav>
    </aside>

    <main class="flex-grow p-8">
        <h1 class="text-2xl font-bold text-gray-800 mb-8">Modération des échanges</h1>
        
        <div class="space-y-4 max-w-4xl">
            <div class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm">
                <div class="flex justify-between items-center mb-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-blue-600 flex items-center justify-center text-white text-xs font-bold">SB</div>
                        <div>
                            <p class="text-sm font-bold text-gray-800">Samuel Blanc</p>
                            <p class="text-[10px] text-gray-400">il y a 10 min sur "Moteur Hybride"</p>
                        </div>
                    </div>
                    <span class="text-[10px] bg-red-100 text-red-600 px-2 py-1 rounded font-bold uppercase">Signalé</span>
                </div>
                <p class="text-sm text-gray-600 leading-relaxed italic border-l-4 border-gray-100 pl-4 mb-4">
                    "Cet article contient une erreur sur le cycle de charge des batteries lithium..."
                </p>
                <div class="flex gap-4">
                    <button class="text-[10px] font-bold uppercase text-blue-600 hover:underline">Répondre</button>
                    <button class="text-[10px] font-bold uppercase text-red-500 hover:underline">Supprimer</button>
                </div>
            </div>
        </div>
    </main>
</body>
</html>