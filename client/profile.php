<?php 
include "../includes/header.php";
include "../classes/Client.php";
include "../classes/Reservation.php";
include "../classes/Review.php";
include "../classes/Article.php";

$client = Client::findByEmail($_SESSION["user_email"]);
$reservations = Reservation::findByUser($_SESSION["user_id"]);
$reviews = Review::findByUser($_SESSION["user_id"]);
$article = Article::findByUser($_SESSION["user_id"]);

?>

    <main class="mt-[100px] max-w-7xl mx-auto px-4 py-10">
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
                                <img src="https://i.pinimg.com/736x/1f/96/71/1f96719d94013db918a66874fdfdda98.jpg" class="w-32 h-32 rounded-xl border-4 border-white shadow-lg object-cover">
                                <button class="absolute bottom-2 right-2 bg-white p-2 rounded-lg shadow-md hover:text-blue-600 transition">
                                    <i class="fas fa-camera"></i>
                                </button>
                            </div>
                            <button class="bg-gray-800 text-white px-6 py-2 rounded-lg font-bold hover:bg-gray-700 transition">Modifier</button>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Prénom & Nom</label>
                                <p class="text-gray-800 font-medium border-b pb-2"><?= $client->__get("nom") ?></p>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Email</label>
                                <p class="text-gray-800 font-medium border-b pb-2"><?= $client->__get("email") ?></p>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Téléphone</label>
                                <p class="text-gray-800 font-medium border-b pb-2"><?= $client->__get("telephone") ?></p>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-400 uppercase mb-1">Date d'inscription</label>
                                <p class="text-gray-800 font-medium border-b pb-2"><?= (new DateTime($client->__get("dateInscription")))->format("Y-m-d") ?></p>
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
                            <span class="block text-2xl font-bold"><?= count($reservations) ?></span>
                            <span class="text-xs text-gray-500 font-bold uppercase">Locations</span>
                        </div>
                    </div>
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center gap-4">
                        <div class="w-12 h-12 bg-green-100 text-green-600 rounded-lg flex items-center justify-center text-xl">
                            <i class="fas fa-pen"></i>
                        </div>
                        <div>
                            <span class="block text-2xl font-bold"><?= count($article) ?></span>
                            <span class="text-xs text-gray-500 font-bold uppercase">Articles</span>
                        </div>
                    </div>
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center gap-4">
                        <div class="w-12 h-12 bg-yellow-100 text-yellow-600 rounded-lg flex items-center justify-center text-xl">
                            <i class="fas fa-star"></i>
                        </div>
                        <div>
                            <span class="block text-2xl font-bold"><?= count($reviews)??0 ?></span>
                            <span class="text-xs text-gray-500 font-bold uppercase">Avis reçus</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

</body>
</html>