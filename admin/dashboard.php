<?php
session_start();
include "header.php";
include "../classes/Admin.php";
include "../classes/Client.php";
include "../classes/Reservation.php";
include "../classes/Vehicle.php";
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    header('Location: ../public/login.php');
    exit();
}
$admin = Admin::findByEmail($_SESSION["user_email"]);
$vehicles = Vehicle::all();
$vehicles_disponible = Vehicle::all(1);
$reservations = Reservation::getAll();
echo count($reservations);
$reservations_en_attente = Reservation::getAll(null, null, "en_attente");
$clients = Client::getAll();
$prix_total = 0;
foreach ($reservations as $reservation) {
    $prix_total += (int)$reservation["prix_total"];
    $reservation["prix_total"];
}

?>



<!-- Main Content -->
<main class="main-content">
    <div class="p-6 lg:p-8 pt-20 lg:pt-8">
        <!-- Header -->
        <div class="flex flex-col lg:flex-row justify-between items-start lg:items-end gap-6 mb-8">
            <div>
                <h1 class="text-2xl lg:text-3xl font-bold text-gray-800">Bonjour, <?= $admin->__get("nom") ?> 👋</h1>
                <p class="text-gray-500 mt-1">Voici ce qu'il se passe sur votre plateforme aujourd'hui.</p>
            </div>
            <div class="flex gap-3 w-full lg:w-auto">
                <button class="flex-1 lg:flex-none bg-white px-4 py-2.5 rounded-xl border border-gray-200 text-sm font-bold hover:bg-gray-50 transition shadow-sm">
                    <i class="fas fa-file-pdf mr-2 text-red-500"></i>Rapport PDF
                </button>
                <button class="flex-1 lg:flex-none bg-blue-600 text-white px-4 py-2.5 rounded-xl text-sm font-bold hover:bg-blue-700 transition shadow-lg shadow-blue-200">
                    <i class="fas fa-plus mr-2"></i>Ajouter Véhicule
                </button>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
            <div class="stat-card bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                <div class="flex justify-between items-start mb-4">
                    <div class="p-3 bg-blue-100 text-blue-600 rounded-xl">
                        <i class="fas fa-euro-sign"></i>
                    </div>
                    <span class="text-green-500 text-xs font-bold">+12% <i class="fas fa-arrow-up ml-1"></i></span>
                </div>
                <p class="text-sm text-gray-500 font-medium">Revenus mensuels</p>
                <p class="text-2xl font-bold text-gray-800 mt-1"><?= $prix_total ?> €</p>
            </div>

            <div class="stat-card bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                <div class="flex justify-between items-start mb-4">
                    <div class="p-3 bg-orange-100 text-orange-600 rounded-xl">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <span class="text-orange-500 text-xs font-bold"><?= count($reservations_en_attente) ?> En attente</span>
                </div>
                <p class="text-sm text-gray-500 font-medium">Réservations</p>
                <p class="text-2xl font-bold text-gray-800 mt-1"><?= count($reservations) ?></p>
            </div>

            <div class="stat-card bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                <div class="flex justify-between items-start mb-4">
                    <div class="p-3 bg-green-100 text-green-600 rounded-xl">
                        <i class="fas fa-car"></i>
                    </div>
                    <span class="text-gray-400 text-xs font-bold">85% Occ.</span>
                </div>
                <p class="text-sm text-gray-500 font-medium">Véhicules Actifs</p>
                <p class="text-2xl font-bold text-gray-800 mt-1"><?= count($vehicles) ?> / <?= count($vehicles_disponible) ?></p>
            </div>

            <div class="stat-card bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                <div class="flex justify-between items-start mb-4">
                    <div class="p-3 bg-purple-100 text-purple-600 rounded-xl">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <span class="text-green-500 text-xs font-bold">+52</span>
                </div>
                <p class="text-sm text-gray-500 font-medium">Nouveaux Clients</p>
                <p class="text-2xl font-bold text-gray-800 mt-1"><?= count($clients) ?></p>
            </div>
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-8">
            <!-- Recent Reservations -->
            <div class="xl:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
                    <h2 class="font-bold text-gray-800 uppercase text-sm tracking-wider">Réservations Récentes</h2>
                    <a href="reservations.php" class="text-blue-600 text-xs font-bold hover:underline flex items-center gap-1">
                        Voir tout <i class="fas fa-arrow-right ml-1 text-xs"></i>
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full min-w-[600px]">
                        <thead>
                            <tr class="text-gray-400 text-xs uppercase border-b">
                                <th class="pb-4 font-bold text-left">Client</th>
                                <th class="pb-4 font-bold text-left">Véhicule</th>
                                <th class="pb-4 font-bold text-left">Date</th>
                                <th class="pb-4 font-bold text-left">Status</th>
                                <th class="pb-4 font-bold text-right">Montant</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm">
                            <?php foreach ($reservations as $reservation) { ?>
                                <tr class="border-b table-row hover:bg-slate-50 transition">
                                    <td class="py-4 font-medium"><?= $reservation["nom"] ?></td>
                                    <td class="py-4 text-gray-500"><?= $reservation["marque"] . " " . $reservation["modele"] ?></td>
                                    <td class="py-4 text-gray-500"><?= $reservation["date_debut"] ?></td>
                                    <td class="py-4">
                                        <span class=" <?= $reservation["statut"] == "annulee" ? "bg-red-100 text-red-600" : ($reservation["statut"] == "confirmee" ? "bg-green-100 text-green-600" : "bg-blue-100 text-blue-600") ?> px-3 py-1.5 rounded-lg text-xs font-bold"><?= $reservation["statut"] == "confirmee" ? "CONFIRMEE" : "EN_ATTENTE" ?></span>
                                    </td>
                                    <td class="py-4 text-right font-bold"><?= $reservation["prix_total"] ?> €</td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Fleet Alerts -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="font-bold text-gray-800 uppercase text-sm tracking-wider">Alertes Flotte</h2>
                    <span class="bg-red-100 text-red-600 text-xs font-bold px-2 py-1 rounded-full">3</span>
                </div>

                <div class="space-y-4">
                    <div class="alert-card alert-red p-4 rounded-xl">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 bg-red-100 text-red-600 rounded-full flex items-center justify-center">
                                <i class="fas fa-tools"></i>
                            </div>
                            <div class="flex-grow">
                                <p class="text-sm font-bold text-gray-800">Révision Nécessaire</p>
                                <p class="text-xs text-gray-500">Porsche 911 • #MB-221</p>
                            </div>
                            <span class="text-red-500 text-xs font-bold">URGENT</span>
                        </div>
                    </div>

                    <div class="alert-card alert-blue p-4 rounded-xl">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center">
                                <i class="fas fa-info-circle"></i>
                            </div>
                            <div class="flex-grow">
                                <p class="text-sm font-bold text-gray-800">Assurance Expirée</p>
                                <p class="text-xs text-gray-500">Renault Zoe • #MB-004</p>
                            </div>
                            <span class="text-blue-500 text-xs font-bold">DANS 7J</span>
                        </div>
                    </div>

                    <div class="alert-card bg-amber-50 p-4 rounded-xl">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 bg-amber-100 text-amber-600 rounded-full flex items-center justify-center">
                                <i class="fas fa-exclamation-triangle"></i>
                            </div>
                            <div class="flex-grow">
                                <p class="text-sm font-bold text-gray-800">Contrôle Technique</p>
                                <p class="text-xs text-gray-500">Peugeot 308 • #MB-112</p>
                            </div>
                            <span class="text-amber-500 text-xs font-bold">DANS 30J</span>
                        </div>
                    </div>
                </div>

                <div class="mt-8 pt-6 border-t border-gray-100">
                    <a href="#" class="text-blue-600 text-sm font-medium hover:underline flex items-center gap-2">
                        <i class="fas fa-history"></i>
                        Voir toutes les alertes
                    </a>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 text-white p-6 rounded-2xl">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-white/20 rounded-xl">
                        <i class="fas fa-car text-xl"></i>
                    </div>
                    <span class="text-white/80 text-xs font-bold">56 Véhicules</span>
                </div>
                <h3 class="text-lg font-bold mb-2">Gestion Flotte</h3>
                <p class="text-blue-100 text-sm mb-4">Ajoutez, modifiez ou gérez votre parc automobile</p>
                <a href="vehicles.php" class="inline-flex items-center gap-2 bg-white text-blue-600 px-4 py-2 rounded-lg font-bold text-sm hover:bg-blue-50 transition">
                    <i class="fas fa-arrow-right"></i>
                    Accéder
                </a>
            </div>

            <div class="bg-gradient-to-r from-purple-500 to-purple-600 text-white p-6 rounded-2xl">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-white/20 rounded-xl">
                        <i class="fas fa-users text-xl"></i>
                    </div>
                    <span class="text-white/80 text-xs font-bold">1 204 Clients</span>
                </div>
                <h3 class="text-lg font-bold mb-2">Gestion Clients</h3>
                <p class="text-purple-100 text-sm mb-4">Consultez et gérez les profils de vos clients</p>
                <a href="users.php" class="inline-flex items-center gap-2 bg-white text-purple-600 px-4 py-2 rounded-lg font-bold text-sm hover:bg-purple-50 transition">
                    <i class="fas fa-arrow-right"></i>
                    Accéder
                </a>
            </div>

            <div class="bg-gradient-to-r from-green-500 to-green-600 text-white p-6 rounded-2xl">
                <div class="flex items-center justify-between mb-4">
                    <div class="p-3 bg-white/20 rounded-xl">
                        <i class="fas fa-chart-line text-xl"></i>
                    </div>
                    <span class="text-white/80 text-xs font-bold">Analytique</span>
                </div>
                <h3 class="text-lg font-bold mb-2">Rapports & Stats</h3>
                <p class="text-green-100 text-sm mb-4">Analysez les performances de votre entreprise</p>
                <a href="#" class="inline-flex items-center gap-2 bg-white text-green-600 px-4 py-2 rounded-lg font-bold text-sm hover:bg-green-50 transition">
                    <i class="fas fa-arrow-right"></i>
                    Générer
                </a>
            </div>
        </div>
    </div>
</main>

</body>

</html>