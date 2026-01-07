<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Favoris - MaBagnole</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>body { font-family: 'Poppins', sans-serif; }</style>
</head>
<body class="bg-gray-50 text-gray-900 min-h-screen">

    <nav class="bg-white shadow-sm h-20">
        <div class="max-w-7xl mx-auto px-4 h-full flex justify-between items-center">
            <a href="index.html" class="flex items-center gap-2">
                <i class="fas fa-car-side text-blue-600 text-3xl"></i>
                <span class="text-2xl font-bold">Ma<span class="text-blue-600">Bagnole</span></span>
            </a>
            <div class="flex items-center gap-4">
                <a href="profile.html" class="hidden md:block text-sm font-semibold text-gray-700">Thomas Legrand</a>
                <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?auto=format&fit=crop&q=80&w=100" class="w-10 h-10 rounded-full border-2 border-blue-600">
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 py-10">
        <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
            <h1 class="text-3xl font-bold text-gray-800">Ma Liste d'Envies</h1>
            <div class="flex bg-white p-1 rounded-xl shadow-sm border border-gray-100">
                <button class="px-6 py-2 bg-blue-600 text-white rounded-lg font-bold transition">Véhicules (2)</button>
                <button class="px-6 py-2 text-gray-500 hover:text-blue-600 font-bold transition">Articles (1)</button>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden relative group">
                <button class="absolute top-4 right-4 z-10 bg-white/90 text-red-500 w-10 h-10 rounded-full shadow-md hover:bg-red-500 hover:text-white transition duration-300">
                    <i class="fas fa-heart"></i>
                </button>
                <div class="h-48 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1541899481282-d53bffe3c15d?auto=format&fit=crop&q=80&w=800" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                </div>
                <div class="p-6">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h3 class="text-xl font-bold">Tesla Model 3</h3>
                            <p class="text-sm text-gray-400">Électrique • Berline</p>
                        </div>
                        <span class="text-blue-600 font-bold">89€/j</span>
                    </div>
                    <div class="flex gap-4 mb-6">
                        <a href="vehicle-details.html" class="flex-grow bg-blue-600 text-white text-center py-2.5 rounded-lg font-bold hover:bg-blue-700 transition">Réserver</a>
                        <button class="px-4 py-2.5 bg-gray-100 text-gray-600 rounded-lg hover:bg-gray-200 transition"><i class="fas fa-trash"></i></button>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden relative group">
                <button class="absolute top-4 right-4 z-10 bg-white/90 text-red-500 w-10 h-10 rounded-full shadow-md hover:bg-red-500 hover:text-white transition">
                    <i class="fas fa-heart"></i>
                </button>
                <div class="h-48 overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1533473359331-0135ef1b58bf?auto=format&fit=crop&q=80&w=800" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                </div>
                <div class="p-6">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h3 class="text-xl font-bold">Range Rover Evoque</h3>
                            <p class="text-sm text-gray-400">Hybride • SUV</p>
                        </div>
                        <span class="text-blue-600 font-bold">145€/j</span>
                    </div>
                    <div class="flex gap-4 mb-6">
                        <a href="vehicle-details.html" class="flex-grow bg-blue-600 text-white text-center py-2.5 rounded-lg font-bold hover:bg-blue-700 transition">Réserver</a>
                        <button class="px-4 py-2.5 bg-gray-100 text-gray-600 rounded-lg hover:bg-gray-200 transition"><i class="fas fa-trash"></i></button>
                    </div>
                </div>
            </div>

            <div class="border-2 border-dashed border-gray-200 rounded-xl flex flex-col items-center justify-center p-12 text-center opacity-50">
                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-plus text-gray-400 text-2xl"></i>
                </div>
                <p class="font-medium text-gray-500">Ajouter d'autres véhicules</p>
                <a href="vehicles.html" class="text-blue-600 text-sm font-bold mt-2 hover:underline">Parcourir le catalogue</a>
            </div>

        </div>
    </main>

    <footer class="bg-gray-800 text-white py-8 mt-20 text-center text-sm">
        <p>&copy; 2024 MaBagnole - Géré avec passion.</p>
    </footer>

</body>
</html>