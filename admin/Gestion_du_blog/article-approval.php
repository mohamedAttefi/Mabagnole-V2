<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Approbation Articles - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>body { font-family: 'Poppins', sans-serif; }</style>
</head>
<body class="bg-gray-50 flex">

    <aside class="w-64 bg-white shadow-lg h-screen sticky top-0 flex flex-col p-4">
        <div class="p-4 font-bold text-xl border-b mb-6 italic">MaBagnole <span class="text-blue-600">Blog</span></div>
        <nav class="space-y-2">
            <a href="admin-blog-approval.html" class="flex items-center gap-3 p-3 bg-blue-50 text-blue-600 rounded-xl font-bold border-r-4 border-blue-600">
                <i class="fas fa-check-double"></i> Approbation
            </a>
            <a href="admin-blog-list.html" class="flex items-center gap-3 p-3 text-gray-500 hover:bg-gray-50 rounded-xl transition">
                <i class="fas fa-file-alt"></i> Articles
            </a>
            <a href="admin-blog-comments.html" class="flex items-center gap-3 p-3 text-gray-500 hover:bg-gray-50 rounded-xl transition">
                <i class="fas fa-comments"></i> Commentaires
            </a>
            <a href="admin-blog-categories.html" class="flex items-center gap-3 p-3 text-gray-500 hover:bg-gray-50 rounded-xl transition">
                <i class="fas fa-layer-group"></i> Catégories
            </a>
        </nav>
    </aside>

    <main class="flex-grow p-8">
        <header class="mb-8">
            <h1 class="text-2xl font-bold text-gray-800">Files d'attente</h1>
            <p class="text-sm text-gray-500">Vérifiez la qualité du contenu avant la mise en ligne.</p>
        </header>

        <div class="grid gap-6">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col md:flex-row justify-between gap-6">
                <div class="flex gap-4">
                    <img src="https://images.unsplash.com/photo-1549317661-bd32c8ce0db2?auto=format&fit=crop&q=80&w=150" class="w-24 h-24 rounded-xl object-cover">
                    <div>
                        <span class="bg-orange-100 text-orange-600 text-[10px] font-bold px-2 py-1 rounded-full uppercase">Attente</span>
                        <h3 class="text-lg font-bold text-gray-800 mt-1">Comment entretenir son moteur hybride ?</h3>
                        <p class="text-xs text-gray-400">Par Lucas Martin • Soumis le 05 Janvier 2026</p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <button class="px-5 py-2 text-sm font-bold text-gray-600 hover:bg-gray-100 rounded-lg">Aperçu</button>
                    <button class="px-5 py-2 text-sm font-bold bg-green-600 text-white rounded-lg shadow-lg shadow-green-100 hover:bg-green-700">Publier</button>
                    <button class="p-2 text-red-500 hover:bg-red-50 rounded-lg"><i class="fas fa-trash"></i></button>
                </div>
            </div>
        </div>
    </main>
</body>
</html>