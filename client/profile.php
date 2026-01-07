<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Profil - MaBagnole</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>body { font-family: 'Poppins', sans-serif; }</style>
</head>
<body class="bg-gray-50">

    <nav class="bg-white shadow-sm h-20">
        <div class="max-w-7xl mx-auto px-4 h-full flex justify-between items-center">
            <a href="index.html" class="flex items-center gap-2">
                <i class="fas fa-car-side text-blue-600 text-3xl"></i>
                <span class="text-2xl font-bold">MaBagnole</span>
            </a>
            <div class="flex items-center gap-6">
                <a href="vehicles.html" class="text-gray-600 hover:text-blue-600">Véhicules</a>
                <a href="blog.html" class="text-gray-600 hover:text-blue-600">Blog</a>
                <div class="flex items-center gap-3 border-l pl-6">
                    <span class="text-sm font-semibold text-gray-800">Thomas Legrand</span>
                    <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?auto=format&fit=crop&q=80&w=100" class="w-10 h-10 rounded-full border-2 border-blue-600">
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 py-10">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            
            <aside class="lg:col-span-1 space-y-4">
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-2">
                    <a href="profile.html" class="flex items-center gap-3 p-3 bg-blue-50 text-blue-600 rounded-lg font-bold">
                        <i class="fas fa-user-circle w-6"></i> Mon Profil
                    </a>
                    <a href="my-reservations.html" class="flex items-center gap-3 p-3 text-gray-600 hover:bg-gray-50 rounded-lg transition">
                        <i class="fas fa-calendar-alt w-6"></i> Mes Réservations
                    </a>
                    <a href="my-reviews.html" class="flex items-center gap-3 p-3 text-gray-600 hover:bg-gray-50 rounded-lg transition">
                        <i class="fas fa-star w-6"></i> Mes Avis
                    </a>
                    <a href="favorites.html" class="flex items-center gap-3 p-3 text-gray-600 hover:bg-gray-50 rounded-lg transition">
                        <i class="fas fa-heart w-6"></i> Mes Favoris
                    </a>
                    <hr class="my-2">
                    <a href="login.html" class="flex items-center gap-3 p-3 text-red-500 hover:bg-red-50 rounded-lg transition">
                        <i class="fas fa-sign-out-alt w-6"></i> Déconnexion
                    </a>
                </div>
            </aside>

            <div class="lg:col-span-3 space-y-8">
                
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="h-32 bg-blue-600"></div>
                    <div class="px-8 pb-8">
                        <div class="relative flex justify-between items-end -mt-12 mb-8">
                            <div class="relative group">
                                <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?auto=format&fit=crop&q=80&w=100" class="w-32 h-32 rounded-xl border-4 border-white shadow-lg object-cover">
                                <button class="absolute bottom-2 right-2 bg-white p-2 rounded-lg shadow-md hover:text-blue-600 transition">
                                    <i class="fas fa-camera"></i>
                                </button>
                            </div>
                            <button class="bg-gray-800 text-white px-6 py-2 rounded-lg font-bold hover:bg-gray-700 transition">Modifier</button>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Prénom & Nom</label>
                                <p class="text-gray-800 font-medium border-b pb-2">Thomas Legrand</p>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Email</label>
                                <p class="text-gray-800 font-medium border-b pb-2">t.legrand@exemple.com</p>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Téléphone</label>
                                <p class="text-gray-800 font-medium border-b pb-2">+33 6 12 34 56 78</p>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Date d'inscription</label>
                                <p class="text-gray-800 font-medium border-b pb-2">12 Janvier 2024</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center gap-4">
                        <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center text-xl">
                            <i class="fas fa-car"></i>
                        </div>
                        <div>
                            <span class="block text-2xl font-bold">04</span>
                            <span class="text-xs text-gray-500 font-bold uppercase">Locations</span>
                        </div>
                    </div>
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center gap-4">
                        <div class="w-12 h-12 bg-green-100 text-green-600 rounded-lg flex items-center justify-center text-xl">
                            <i class="fas fa-pen"></i>
                        </div>
                        <div>
                            <span class="block text-2xl font-bold">02</span>
                            <span class="text-xs text-gray-500 font-bold uppercase">Articles</span>
                        </div>
                    </div>
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center gap-4">
                        <div class="w-12 h-12 bg-yellow-100 text-yellow-600 rounded-lg flex items-center justify-center text-xl">
                            <i class="fas fa-star"></i>
                        </div>
                        <div>
                            <span class="block text-2xl font-bold">18</span>
                            <span class="text-xs text-gray-500 font-bold uppercase">Avis reçus</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

</body>
</html>