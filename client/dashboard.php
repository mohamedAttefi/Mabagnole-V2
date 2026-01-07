<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord | MaBagnole</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .text-primary { color: #2563eb; }
        .bg-primary { background-color: #2563eb; }
        .border-primary { border-color: #2563eb; }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Header -->
    <nav class="bg-white shadow">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <a href="index.html" class="flex items-center">
                    <i class="fas fa-car text-primary text-xl mr-2"></i>
                    <span class="font-bold text-xl">MaBagnole</span>
                </a>
                <div class="flex items-center space-x-6">
                    <a href="dashboard.html" class="text-primary font-semibold">Tableau de bord</a>
                    <a href="reservations.html" class="text-gray-600 hover:text-primary">Mes réservations</a>
                    <a href="reviews.html" class="text-gray-600 hover:text-primary">Mes avis</a>
                    <a href="profile.html" class="flex items-center space-x-2 text-gray-600 hover:text-primary">
                        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=32&h=32&q=80" 
                             class="w-8 h-8 rounded-full object-cover">
                        <span>Thomas Dubois</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-4xl mx-auto pt-20 px-4 py-12">
        <!-- Welcome -->
        <div class="text-center mb-10">
            <h1 class="text-3xl md:text-4xl font-bold mb-4">Bonjour, Thomas Dubois 👋</h1>
            <p class="text-gray-600 max-w-2xl mx-auto">Bienvenue sur votre tableau de bord client</p>
        </div>

        <!-- Stats -->
        <div class="grid md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 hover:shadow-md transition">
                <a href="reservations.html" class="block">
                    <div class="flex items-center">
                        <div class="p-3 bg-blue-100 text-blue-600 rounded-xl mr-4">
                            <i class="fas fa-calendar-alt text-2xl"></i>
                        </div>
                        <div>
                            <div class="text-2xl font-bold text-gray-800">7</div>
                            <div class="text-gray-600">Réservations totales</div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 hover:shadow-md transition">
                <a href="reservations.html?statut=confirmee" class="block">
                    <div class="flex items-center">
                        <div class="p-3 bg-green-100 text-green-600 rounded-xl mr-4">
                            <i class="fas fa-check-circle text-2xl"></i>
                        </div>
                        <div>
                            <div class="text-2xl font-bold text-gray-800">3</div>
                            <div class="text-gray-600">Confirmées</div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 hover:shadow-md transition">
                <a href="reservations.html?statut=en_cours" class="block">
                    <div class="flex items-center">
                        <div class="p-3 bg-yellow-100 text-yellow-600 rounded-xl mr-4">
                            <i class="fas fa-clock text-2xl"></i>
                        </div>
                        <div>
                            <div class="text-2xl font-bold text-gray-800">1</div>
                            <div class="text-gray-600">En attente</div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <!-- Prochaine réservation -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 mb-8 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100">
                <h2 class="text-xl font-bold">Votre prochaine réservation</h2>
            </div>
            <div class="p-6">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                    <div class="flex items-center space-x-4">
                        <img src="https://images.unsplash.com/photo-1553440569-bcc63803a83d?auto=format&fit=crop&w=200&h=150&q=80"
                            alt="Tesla Model 3"
                            class="w-24 h-24 object-cover rounded-lg">
                        <div>
                            <h3 class="font-bold text-lg mb-1">Tesla Model 3</h3>
                            <p class="text-gray-600 text-sm mb-2">Berline • Électrique • Automatique</p>
                            <p class="text-sm text-gray-500">
                                <i class="far fa-calendar-alt mr-1"></i>15 - 20 Mars 2024 • 5 jours
                            </p>
                        </div>
                    </div>
                    <div class="text-center md:text-right">
                        <div class="text-2xl font-bold text-blue-600 mb-2">549,00 €</div>
                        <span class="inline-block px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-semibold">
                            <i class="fas fa-check-circle mr-1"></i>Confirmée
                        </span>
                    </div>
                </div>
                <div class="flex flex-col sm:flex-row justify-end gap-3 mt-6">
                    <a href="reservation-details.html"
                        class="px-5 py-2 border border-blue-600 text-blue-600 rounded-lg hover:bg-blue-50 transition flex items-center justify-center">
                        <i class="fas fa-eye mr-2"></i>Voir les détails
                    </a>
                    <button onclick="annulerReservation()" 
                            class="px-5 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition flex items-center justify-center">
                        <i class="fas fa-times mr-2"></i>Annuler la réservation
                    </button>
                </div>
            </div>
        </div>

        <!-- Dernières réservations -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 mb-8 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                <h2 class="text-xl font-bold">Dernières réservations</h2>
                <a href="reservations.html" class="text-blue-600 hover:text-blue-800 text-sm font-semibold flex items-center">
                    Voir toutes <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="py-4 px-4 text-left text-gray-700 font-semibold">Véhicule</th>
                            <th class="py-4 px-4 text-left text-gray-700 font-semibold">Dates</th>
                            <th class="py-4 px-4 text-left text-gray-700 font-semibold">Montant</th>
                            <th class="py-4 px-4 text-left text-gray-700 font-semibold">Statut</th>
                            <th class="py-4 px-4 text-left text-gray-700 font-semibold">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Réservation 1 -->
                        <tr class="border-b border-gray-100 hover:bg-gray-50">
                            <td class="py-4 px-4">
                                <div class="flex items-center">
                                    <img src="https://images.unsplash.com/photo-1533473359331-0135ef1b58bf?auto=format&fit=crop&w=100&h=75&q=80"
                                        class="w-12 h-9 object-cover rounded mr-3">
                                    <div>
                                        <div class="font-medium">Range Rover Sport</div>
                                        <div class="text-sm text-gray-500">SUV • Diesel</div>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-4">
                                <div class="text-sm">10 - 15 Fév 2024</div>
                                <div class="text-xs text-gray-500">5 jours</div>
                            </td>
                            <td class="py-4 px-4">
                                <div class="font-semibold text-blue-600">799,00 €</div>
                            </td>
                            <td class="py-4 px-4">
                                <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-semibold">
                                    <i class="fas fa-check-circle mr-1"></i>Terminée
                                </span>
                            </td>
                            <td class="py-4 px-4">
                                <div class="flex gap-3">
                                    <a href="reservation-details.html" class="text-blue-600 hover:text-blue-800">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="add-review.html" class="text-yellow-600 hover:text-yellow-800">
                                        <i class="fas fa-star"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        
                        <!-- Réservation 2 -->
                        <tr class="border-b border-gray-100 hover:bg-gray-50">
                            <td class="py-4 px-4">
                                <div class="flex items-center">
                                    <img src="https://images.unsplash.com/photo-1555212697-194d092e3b8f?auto=format&fit=crop&w=100&h=75&q=80"
                                        class="w-12 h-9 object-cover rounded mr-3">
                                    <div>
                                        <div class="font-medium">Renault Clio</div>
                                        <div class="text-sm text-gray-500">Citadine • Essence</div>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-4">
                                <div class="text-sm">22 - 24 Jan 2024</div>
                                <div class="text-xs text-gray-500">2 jours</div>
                            </td>
                            <td class="py-4 px-4">
                                <div class="font-semibold text-blue-600">129,00 €</div>
                            </td>
                            <td class="py-4 px-4">
                                <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-semibold">
                                    <i class="fas fa-check-circle mr-1"></i>Terminée
                                </span>
                            </td>
                            <td class="py-4 px-4">
                                <div class="flex gap-3">
                                    <a href="reservation-details.html" class="text-blue-600 hover:text-blue-800">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="add-review.html" class="text-yellow-600 hover:text-yellow-800">
                                        <i class="fas fa-star"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        
                        <!-- Réservation 3 -->
                        <tr class="hover:bg-gray-50">
                            <td class="py-4 px-4">
                                <div class="flex items-center">
                                    <img src="https://images.unsplash.com/photo-1593941707882-a5bba5338fe2?auto=format&fit=crop&w=100&h=75&q=80"
                                        class="w-12 h-9 object-cover rounded mr-3">
                                    <div>
                                        <div class="font-medium">Peugeot 3008</div>
                                        <div class="text-sm text-gray-500">SUV • Hybride</div>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-4">
                                <div class="text-sm">28 - 30 Mars 2024</div>
                                <div class="text-xs text-gray-500">2 jours</div>
                            </td>
                            <td class="py-4 px-4">
                                <div class="font-semibold text-blue-600">229,00 €</div>
                            </td>
                            <td class="py-4 px-4">
                                <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs font-semibold">
                                    <i class="fas fa-clock mr-1"></i>En attente
                                </span>
                            </td>
                            <td class="py-4 px-4">
                                <div class="flex gap-3">
                                    <a href="reservation-details.html" class="text-blue-600 hover:text-blue-800">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <button onclick="annulerReservation()" class="text-red-600 hover:text-red-800">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Actions rapides -->
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <a href="vehicules.html"
                class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 hover:shadow-md transition text-center group">
                <div class="text-blue-600 text-3xl mb-3 group-hover:scale-110 transition">
                    <i class="fas fa-search"></i>
                </div>
                <div class="font-medium text-gray-800 mb-1">Louer un véhicule</div>
                <div class="text-sm text-gray-500">Trouvez votre prochaine location</div>
            </a>
            <a href="reservations.html"
                class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 hover:shadow-md transition text-center group">
                <div class="text-green-600 text-3xl mb-3 group-hover:scale-110 transition">
                    <i class="fas fa-history"></i>
                </div>
                <div class="font-medium text-gray-800 mb-1">Mes réservations</div>
                <div class="text-sm text-gray-500">Voir toutes mes locations</div>
            </a>
            <a href="reviews.html"
                class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 hover:shadow-md transition text-center group">
                <div class="text-yellow-600 text-3xl mb-3 group-hover:scale-110 transition">
                    <i class="fas fa-star"></i>
                </div>
                <div class="font-medium text-gray-800 mb-1">Mes avis</div>
                <div class="text-sm text-gray-500">Vos évaluations</div>
            </a>
            <a href="profile.html"
                class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 hover:shadow-md transition text-center group">
                <div class="text-purple-600 text-3xl mb-3 group-hover:scale-110 transition">
                    <i class="fas fa-user-cog"></i>
                </div>
                <div class="font-medium text-gray-800 mb-1">Mon profil</div>
                <div class="text-sm text-gray-500">Gérer mes informations</div>
            </a>
        </div>

        <!-- Accès rapide -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h2 class="text-xl font-bold mb-6">Accès rapide</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <a href="documents.html" class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition">
                    <div class="w-10 h-10 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-file-contract"></i>
                    </div>
                    <div>
                        <div class="font-medium text-gray-800">Mes documents</div>
                        <div class="text-sm text-gray-500">Factures et contrats</div>
                    </div>
                </a>
                <a href="favoris.html" class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition">
                    <div class="w-10 h-10 bg-red-100 text-red-600 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-heart"></i>
                    </div>
                    <div>
                        <div class="font-medium text-gray-800">Mes favoris</div>
                        <div class="text-sm text-gray-500">Véhicules sauvegardés</div>
                    </div>
                </a>
                <a href="messages.html" class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition">
                    <div class="w-10 h-10 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div>
                        <div class="font-medium text-gray-800">Messages</div>
                        <div class="text-sm text-gray-500">Contactez le support</div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-50 border-t py-12 text-center text-gray-400 text-sm">
        &copy; 2024 MaBagnole.
    </footer>

    <script>
        function annulerReservation() {
            if (confirm('Êtes-vous sûr de vouloir annuler cette réservation ? Des frais d\'annulation peuvent s\'appliquer.')) {
                alert('Réservation annulée avec succès !');
                // Redirection ou mise à jour de l'interface
                window.location.reload();
            }
        }
    </script>
</body>
</html>