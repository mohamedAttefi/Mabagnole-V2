<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catégories Blog - Admin</title>
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
            <a href="admin-blog-comments.html" class="flex items-center gap-3 p-3 text-gray-500 hover:bg-gray-50 rounded-xl transition"><i class="fas fa-comments"></i> Commentaires</a>
            <a href="admin-blog-categories.html" class="flex items-center gap-3 p-3 bg-blue-50 text-blue-600 rounded-xl font-bold border-r-4 border-blue-600"><i class="fas fa-layer-group"></i> Catégories</a>
        </nav>
    </aside>

    <main class="flex-grow p-8">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-2xl font-bold text-gray-800">Thématiques</h1>
            <button class="bg-blue-600 text-white px-4 py-2 rounded-xl text-sm font-bold shadow-lg shadow-blue-100 hover:bg-blue-700 transition">+ Ajouter</button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition group">
                <div class="flex justify-between items-start">
                    <div class="w-12 h-12 bg-green-50 text-green-600 rounded-xl flex items-center justify-center text-xl mb-4">
                        <i class="fas fa-leaf"></i>
                    </div>
                    <div class="flex gap-2 opacity-0 group-hover:opacity-100 transition">
                        <button class="text-gray-400 hover:text-blue-600"><i class="fas fa-edit text-xs"></i></button>
                        <button class="text-gray-400 hover:text-red-500"><i class="fas fa-trash text-xs"></i></button>
                    </div>
                </div>
                <h3 class="font-bold text-gray-800">Écologie & Électrique</h3>
                <p class="text-xs text-gray-400 mt-2">8 articles dans cette catégorie</p>
            </div>
        </div>
    </main>
</body>
</html>