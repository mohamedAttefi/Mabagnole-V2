<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    header('Location: ../index.php');
    exit();
}
include "../header.php";
include "../../classes/Reservation.php";

$reservation_en_attente = Reservation::getAll(null, null, "en_attente");
$reservation_confirmee = Reservation::getAll(null, null, "confirmee");
$reservation_annulee = Reservation::getAll(null, null, "annulee");
$reservations = Reservation::getAll();

?>

<main class="main-content">
    <div class="p-6 lg:p-8 pt-20 lg:pt-8">
        <!-- Page Header -->
        <div class="mb-8">
            <h1 class="text-2xl lg:text-3xl font-bold text-gray-800">Suivi des Réservations</h1>
            <p class="text-sm text-gray-500 mt-1">Validez les demandes et gérez les contrats de location en cours.</p>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-clock text-blue-600 text-lg"></i>
                    </div>
                    <div>
                        <p class="text-slate-500 text-sm">En attente</p>
                        <p class="text-2xl font-bold text-blue-600"><?= count($reservation_en_attente) ?></p>
                    </div>
                </div>
            </div>

            <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-check-circle text-green-600 text-lg"></i>
                    </div>
                    <div>
                        <p class="text-slate-500 text-sm">Confirmées</p>
                        <p class="text-2xl font-bold text-green-600"><?= count($reservation_confirmee) ?></p>
                    </div>
                </div>
            </div>

            <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-times-circle text-red-600 text-lg"></i>
                    </div>
                    <div>
                        <p class="text-slate-500 text-sm">Annulées</p>
                        <p class="text-2xl font-bold text-red-600"><?= count($reservation_annulee) ?></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search and Filter Bar -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 mb-8">
            <div class="flex flex-col lg:flex-row gap-4 items-center">
                <div class="relative flex-grow">
                    <input type="text"
                        placeholder="Rechercher par n° de réservation, client ou véhicule..."
                        class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600">
                    <i class="fas fa-search absolute left-3 top-3.5 text-gray-400"></i>
                </div>

                <select class="bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm outline-none focus:ring-2 focus:ring-blue-600">
                    <option>Tous les statuts</option>
                    <option>En attente</option>
                    <option>Confirmées</option>
                    <option>En cours</option>
                    <option>Terminées</option>
                    <option>Annulées</option>
                </select>

                <input type="date"
                    class="bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm outline-none focus:ring-2 focus:ring-blue-600">

                <button class="text-sm text-blue-600 font-bold hover:bg-blue-50 px-4 py-3 rounded-xl transition flex items-center gap-2 whitespace-nowrap">
                    <i class="fas fa-filter"></i>
                    Filtres avancés
                </button>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full min-w-[900px]">
                    <thead class="bg-gray-50">
                        <tr class="text-gray-400 text-xs uppercase tracking-wider font-bold">
                            <th class="px-6 py-4 text-left">Client</th>
                            <th class="px-6 py-4 text-left">Véhicule</th>
                            <th class="px-6 py-4 text-left">Période</th>
                            <th class="px-6 py-4 text-left">Montant</th>
                            <th class="px-6 py-4 text-left">Statut</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <?php foreach ($reservations as $reservation) { ?>
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2 mt-1">

                                        <p class="text-xs text-gray-500"><?= $reservation["nom"] ?></p>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <img src="<?= $reservation["image_url"] ?>" class="w-12 h-10 object-cover rounded-md">
                                        <div>
                                            <p class="text-sm font-medium text-gray-800"><?= $reservation["marque"] . " " . $reservation["modele"] ?></p>
                                            <p class="text-xs text-gray-500">Immat: <?= $reservation["immatriculation"] ?></p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="space-y-1">
                                        <p class="text-sm font-medium text-gray-800"><?= (new DateTime($reservation["date_debut"]))->format("m/d") ?> - <?= (new DateTime($reservation["date_fin"]))->format("m/d") ?></p>
                                        <?php
                                        $debut = new DateTime($reservation["date_debut"]);
                                        $fin = new DateTime($reservation["date_fin"]);
                                        $interval = $debut->diff($fin);
                                        $nbJours = $interval->days;
                                        ?>
                                        <p class="text-xs text-blue-600 font-bold"><?= $nbJours + 1 ?> jours</p>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="text-lg font-bold text-gray-800"><?= $reservation["prix_total"] ?> €</p>
                                    <p class="text-xs text-gray-500"><?= $reservation["prix_journalier"] ?>€/jour</p>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center gap-1  <?= $reservation["statut"] == "annulee" ? "bg-red-100 text-red-600" : ($reservation["statut"] == "confirmee" ? "bg-green-100 text-green-600" : "bg-blue-100 text-blue-600") ?> text-xs font-bold px-3 py-1.5 rounded-full uppercase">
                                        <i class="fas <?= $reservation["statut"] == "annulee" ? "fa-ban" : ($reservation["statut"] == "confirmee" ? "fa-check-circle" : "fa-clock") ?> text-xs"></i>
                                        <?= $reservation["statut"] == "annulee" ? "ANNULE" : ($reservation["statut"] == "confirmee" ? "CONFIRME" : "ATTENTE") ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex justify-end gap-2">
                                        <?php if ($reservation["statut"] == "en_attente") { ?>
                                            <a href="reservation-approval.php?id=<?= $reservation["id"] ?>" class="bg-green-500 text-white p-2 rounded-lg hover:bg-green-600 transition" title="Confirmer">
                                                <i class="fas fa-check"></i>
                                            </a>
                                        <?php } ?>
                                        <a href="reservation-annulee.php?id=<?= $reservation["id"] ?>" class="bg-red-100 text-red-500 p-2 rounded-lg hover:bg-red-200 transition" title="Annuler">
                                            <i class="fas fa-times"></i>
                                        </a>
                                        <a class="bg-gray-100 text-gray-600 p-2 rounded-lg hover:bg-gray-200 transition" title="Voir détails">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

            <div class="p-6 bg-gray-50 border-t border-gray-200">
                <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                    <p class="text-sm text-gray-500">
                        Affichage <span class="font-bold text-gray-800">1-4</span> sur <span class="font-bold text-gray-800">189</span> réservations
                    </p>
                    <div class="flex gap-2">
                        <button class="px-4 py-2 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 transition shadow-sm flex items-center gap-2 text-sm">
                            <i class="fas fa-chevron-left text-xs"></i>
                            <span>Précédent</span>
                        </button>
                        <button class="px-4 py-2 bg-blue-600 text-white border border-blue-600 rounded-lg hover:bg-blue-700 transition shadow-sm text-sm">
                            1
                        </button>
                        <button class="px-4 py-2 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 transition shadow-sm text-sm">
                            2
                        </button>
                        <button class="px-4 py-2 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 transition shadow-sm text-sm">
                            3
                        </button>
                        <button class="px-4 py-2 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 transition shadow-sm flex items-center gap-2 text-sm">
                            <span>Suivant</span>
                            <i class="fas fa-chevron-right text-xs"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    // Mobile sidebar toggle functionality
    const mobileMenuToggle = document.getElementById('mobileMenuToggle');
    const sidebar = document.querySelector('.sidebar');
    const overlay = document.getElementById('overlay');

    if (mobileMenuToggle && sidebar && overlay) {
        mobileMenuToggle.addEventListener('click', function() {
            sidebar.classList.toggle('active');
            overlay.classList.toggle('hidden');
        });

        overlay.addEventListener('click', function() {
            sidebar.classList.remove('active');
            overlay.classList.add('hidden');
        });

        // Close sidebar when clicking on a link (mobile)
        sidebar.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', function() {
                if (window.innerWidth < 1024) {
                    sidebar.classList.remove('active');
                    overlay.classList.add('hidden');
                }
            });
        });
    }
</script>

</body>

</html>