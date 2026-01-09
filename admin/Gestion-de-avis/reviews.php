<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    header('Location: ../index.php');
    exit();
}
include "../../classes/Review.php";

$reviews = Review::findByAllUser();

if (isset($_GET["id"])) {
    Review::deleteReview($_GET["id"]);
    header("locatin: reviews.php");
}
include "../header.php";


?>

<main class="main-content">
    <div class="p-6 lg:p-8 pt-20 lg:pt-8">
        <!-- Page Header -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
            <div>
                <h1 class="text-2xl lg:text-3xl font-bold text-gray-800">Gestion des Avis Clients</h1>
                <p class="text-sm text-gray-500 mt-1">Modérez et gérez les avis laissés par les clients sur vos véhicules.</p>
            </div>
            <div class="flex gap-3">
                <button class="bg-white border border-gray-200 px-5 py-2.5 rounded-xl text-sm font-bold flex items-center gap-2 hover:bg-gray-50 transition shadow-sm">
                    <i class="fas fa-download text-gray-600"></i> Exporter
                </button>
                <button class="bg-blue-600 text-white px-5 py-2.5 rounded-xl text-sm font-bold flex items-center gap-2 hover:bg-blue-700 transition shadow-lg shadow-blue-200">
                    <i class="fas fa-chart-bar"></i> Statistiques
                </button>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-star text-blue-600 text-lg"></i>
                    </div>
                    <div>
                        <p class="text-slate-500 text-sm">Total Avis</p>
                        <p class="text-2xl font-bold text-slate-900"><?= count($reviews) ?></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Rating Distribution -->


        <!-- Search and Filter Bar -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 mb-8">
            <div class="flex flex-col lg:flex-row gap-4 items-center">
                <div class="relative flex-grow">
                    <input type="text"
                        placeholder="Rechercher par client, véhicule ou contenu..."
                        class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600">
                    <i class="fas fa-search absolute left-3 top-3.5 text-gray-400"></i>
                </div>

                <select class="bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm outline-none focus:ring-2 focus:ring-blue-600">
                    <option>Tous les statuts</option>
                    <option>Approuvé</option>
                    <option>En attente</option>
                    <option>Signalé</option>
                    <option>Masqué</option>
                </select>

                <select class="bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm outline-none focus:ring-2 focus:ring-blue-600">
                    <option>Toutes les notes</option>
                    <option>5 étoiles</option>
                    <option>4 étoiles</option>
                    <option>3 étoiles</option>
                    <option>2 étoiles</option>
                    <option>1 étoile</option>
                </select>

                <button class="text-sm text-blue-600 font-bold hover:bg-blue-50 px-4 py-3 rounded-xl transition flex items-center gap-2 whitespace-nowrap">
                    <i class="fas fa-filter"></i>
                    Plus de filtres
                </button>
            </div>
        </div>

        <!-- Reviews Table -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full min-w-[1000px]">
                    <thead class="bg-gray-50">
                        <tr class="text-gray-400 text-xs uppercase tracking-wider font-bold">
                            <th class="px-6 py-4 text-left">Client</th>
                            <th class="px-6 py-4 text-left">Véhicule</th>
                            <th class="px-6 py-4 text-left">Note</th>
                            <th class="px-6 py-4 text-left">Date</th>
                            <th class="px-6 py-4 text-left">Commentaire</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <?php foreach ($reviews as $review) { ?>
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4">
                                    <div class="flex items-start gap-3">

                                        <div class="flex-grow">
                                            <p class="font-bold text-gray-800"><?= $review["nom"] ?></p>

                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="space-y-1">
                                        <p class="font-medium text-gray-800"><?= $review["marque"] . " " . $review["modele"] ?></p>
                                        <p class="text-xs text-gray-500"><?= $review["immatriculation"] ?></p>
                                        <p class="text-xs text-blue-600 font-medium"><?= $review["categorie"] . " " . $review["carburant"] ?></p>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <div class="flex text-yellow-400">
                                            <?php for ($i = 0; $i < 5; $i++): ?>
                                                <?php if ($i < $review["note"]): ?>
                                                    <i class="fas fa-star"></i>
                                                <?php else: ?>
                                                    <i class="far fa-star"></i>
                                            <?php endif;
                                            endfor; ?>
                                        </div>
                                        <span class="text-lg font-bold text-gray-800"><?= $review["note_moyenne"] ?></span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="space-y-1">
                                        <p class="text-sm text-gray-800"><?= (new DateTime($review["date_creation"]))->format("Y/m/d") ?></p>
                                        <?php
                                        $date_creation = new DateTime($review["date_creation"]);
                                        $now = new DateTime();
                                        $interval = $date_creation->diff($now);
                                        $duree = "";
                                        if ($interval->m > 0) {
                                            $duree = "il ya " . $interval->m . " mois";
                                        } elseif ($interval->d > 0) {
                                            $duree = "il ya " . $interval->d . " jours";
                                        } elseif ($interval->h > 0) {
                                            $duree = "il ya " . $interval->h . " heures";
                                        } elseif ($interval->i > 0) {
                                            $duree = "il ya " . $interval->i . " minutes";
                                        } elseif ($interval->s > 0) {
                                            $duree = "il ya " . $interval->s . " secondes";
                                        } else {
                                            $duree = "just now";
                                        }
                                        ?>
                                        <p class="text-xs text-gray-500"><?= $duree ?></p>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="text-sm text-gray-700 line-clamp-2">
                                        "<?= $review["commentaire"] ?>"
                                    </p>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex justify-end gap-2">

                                        <a href="reviews.php?id=<?= $review["id"] ?>" class="bg-red-100 text-red-600 p-2 rounded-lg hover:bg-red-200 transition" title="Supprimer">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="p-6 bg-gray-50 border-t border-gray-200">
                <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                    <p class="text-sm text-gray-500">
                        Affichage <span class="font-bold text-gray-800">1-4</span> sur <span class="font-bold text-gray-800">247</span> avis
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