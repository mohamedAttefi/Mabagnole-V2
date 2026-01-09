<?php
include "../includes/header.php";
include "../classes/Client.php";
include "../classes/Reservation.php";

$client = Client::findByEmail($_SESSION["user_email"]);
// print_r($client);
$en_attente = Reservation::getAll($client->__get("id"), null, "en_attente");
$confirmee = Reservation::getAll($client->__get("id"), null, "confirmee");
$all = Reservation::getAll($client->__get("id"));
$dernier = Reservation::getAll($client->__get("id"), 3);



?>


<div class="max-w-4xl mt-20 mx-auto pt-20 px-4 py-12">
    <!-- Welcome -->
    <div class="text-center mb-10">
        <h1 class="text-3xl md:text-4xl font-bold mb-4">Bonjour, <?= $client->__get("nom") ?> 👋</h1>
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
                        <div class="text-2xl font-bold text-gray-800"><?= count($all) ?></div>
                        <div class="text-gray-600">Réservations totales</div>
                    </div>
                </div>
            </a>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 hover:shadow-md transition">
            <a href="my-reservations.html?statut=confirmee" class="block">
                <div class="flex items-center">
                    <div class="p-3 bg-green-100 text-green-600 rounded-xl mr-4">
                        <i class="fas fa-check-circle text-2xl"></i>
                    </div>
                    <div>
                        <div class="text-2xl font-bold text-gray-800"><?= count($confirmee) ?></div>
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
                        <div class="text-2xl font-bold text-gray-800"><?= count($en_attente) ?></div>
                        <div class="text-gray-600">En attente</div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 mb-8 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
            <h2 class="text-xl font-bold">Dernières réservations</h2>
            <a href="reservation/my-reservations.php" class="text-blue-600 hover:text-blue-800 text-sm font-semibold flex items-center">
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
                    <?php foreach ($dernier as $reservation) { ?>
                        <tr class="border-b border-gray-100 hover:bg-gray-50">
                            <td class="py-4 px-4">
                                <div class="flex items-center">
                                    <img src="<?= $reservation["image_url"] ?>"
                                        class="w-12 h-9 object-cover rounded mr-3">
                                    <div>
                                        <div class="font-medium"><?= $reservation["marque"] . " " . $reservation["modele"] ?></div>
                                        <div class="text-sm text-gray-500"><?= $reservation["categorie"] ?> • <?= $reservation["carburant"] ?></div>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-4">
                                <div class="text-sm"><?php echo "DE " . (new DateTime($reservation["date_debut"]))->format("m-d") . " A "  . (new DateTime($reservation["date_fin"]))->format("m-d") ?></div>
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
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Actions rapides -->
    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <a href="../public/vehiculeListing.php"
            class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 hover:shadow-md transition text-center group">
            <div class="text-blue-600 text-3xl mb-3 group-hover:scale-110 transition">
                <i class="fas fa-search"></i>
            </div>
            <div class="font-medium text-gray-800 mb-1">Louer un véhicule</div>
            <div class="text-sm text-gray-500">Trouvez votre prochaine location</div>
        </a>
        <a href="reservation/my-reservations.php"
            class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 hover:shadow-md transition text-center group">
            <div class="text-green-600 text-3xl mb-3 group-hover:scale-110 transition">
                <i class="fas fa-history"></i>
            </div>
            <div class="font-medium text-gray-800 mb-1">Mes réservations</div>
            <div class="text-sm text-gray-500">Voir toutes mes locations</div>
        </a>
        <a href="reviews.php"
            class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 hover:shadow-md transition text-center group">
            <div class="text-yellow-600 text-3xl mb-3 group-hover:scale-110 transition">
                <i class="fas fa-star"></i>
            </div>
            <div class="font-medium text-gray-800 mb-1">Mes avis</div>
            <div class="text-sm text-gray-500">Vos évaluations</div>
        </a>
        <a href="profile.php"
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