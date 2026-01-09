<?php
session_start();
// Check if user is admin
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    header('Location: ../index.php');
    exit();
}
include "../header.php";
include "../../classes/Client.php";

$clients = Client::getAll();
?>

<main class="main-content">
    <div class="p-6 lg:p-8 pt-20 lg:pt-8">
        <!-- Page Header -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
            <div>
                <h1 class="text-2xl lg:text-3xl font-bold text-gray-800">Répertoire des Utilisateurs</h1>
                <p class="text-sm text-gray-500 mt-1">Gérez les accès, les rôles et les profils de vos clients.</p>
            </div>
            <div class="flex gap-3">
                <button class="bg-white border border-gray-200 px-5 py-2.5 rounded-xl text-sm font-bold flex items-center gap-2 hover:bg-gray-50 transition shadow-sm">
                    <i class="fas fa-download text-gray-600"></i> Exporter CSV
                </button>
                <button class="bg-blue-600 text-white px-5 py-2.5 rounded-xl text-sm font-bold flex items-center gap-2 hover:bg-blue-700 transition shadow-lg shadow-blue-200">
                    <i class="fas fa-user-plus"></i> Nouvel Utilisateur
                </button>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-users text-blue-600 text-lg"></i>
                    </div>
                    <div>
                        <p class="text-slate-500 text-sm">Total Utilisateurs</p>
                        <p class="text-2xl font-bold text-slate-900"><?= count($clients) ?></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 mb-8">
            <div class="flex flex-col lg:flex-row gap-4 items-center">
                <div class="relative flex-grow">
                    <input type="text"
                        placeholder="Rechercher par nom, email, téléphone..."
                        class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600">
                    <i class="fas fa-search absolute left-3 top-3.5 text-gray-400"></i>
                </div>

                <select class="bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm outline-none focus:ring-2 focus:ring-blue-600">
                    <option>Tous les rôles</option>
                    <option>Client Standard</option>
                    <option>Client Premium</option>
                    <option>Administrateur</option>
                    <option>Banni</option>
                </select>

                <select class="bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm outline-none focus:ring-2 focus:ring-blue-600">
                    <option>Tous les statuts</option>
                    <option>Actif</option>
                    <option>Inactif</option>
                    <option>Email non vérifié</option>
                </select>

                <button class="text-sm text-blue-600 font-bold hover:bg-blue-50 px-4 py-3 rounded-xl transition flex items-center gap-2 whitespace-nowrap">
                    <i class="fas fa-filter"></i>
                    Plus de filtres
                </button>
            </div>
        </div>

        <!-- Users Table -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full min-w-[900px]">
                    <thead class="bg-gray-50">
                        <tr class="text-gray-400 text-xs uppercase tracking-wider font-bold">
                            <th class="px-6 py-4 text-left">Utilisateur</th>
                            <th class="px-6 py-4 text-left">Inscription</th>
                            <th class="px-6 py-4 text-left">Locations</th>
                            <th class="px-6 py-4 text-left">Dépenses</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <?php foreach ($clients as $client) { ?>

                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full bg-gradient-to-r from-blue-500 to-blue-600 flex items-center justify-center text-white font-bold">
                                            TL
                                        </div>
                                        <div>
                                            <div class="flex items-center gap-2">
                                                <p class="font-bold text-gray-800"><?= $client["nom"] ?></p>
                                            </div>
                                            <div class="flex flex-col text-xs text-gray-500">
                                                <span><?= $client["email"] ?></span>
                                                <span class="flex items-center gap-1 mt-1">
                                                    <i class="fas fa-phone text-[10px]"></i>
                                                    <?= $client["telephone"] ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-4">
                                    <div class="space-y-1">
                                        <p class="text-sm text-gray-800"><?= (new DateTime($client["date_inscription"]))->format("Y/m/d") ?></p>
                                        <?php
                                        $inscription = new DateTime($client["date_inscription"]);
                                        $now = new DateTime();
                                        $interval = $inscription->diff($now);
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
                                    <div class="space-y-1">
                                        <p class="text-lg font-bold text-gray-800"><?= $client["total_reservation"] ?></p>
                                        <p class="text-xs text-gray-500">Total locations</p>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="text-lg font-bold text-gray-800"><?= $client["total_depense"] ?? "0" ?> €</p>
                                    <p class="text-xs text-green-600 font-medium">Dépenses totales</p>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex justify-end gap-2">
                                        <?php if ($client["statut"] == 1) { ?>
                                            <a href="banne.php?id=<?= $client["id"] ?>" class="bg-red-100 text-red-600 p-2 rounded-lg hover:bg-red-200 transition" title="Banneé">
                                                <i class="fa-solid fa-ban" style="color: #ff0000;"></i>
                                            </a>
                                        <?php } else { ?>
                                            <a href="active.php?id=<?= $client["id"] ?>" class="bg-green-100 text-green-600 p-2 rounded-lg hover:bg-green-200 transition" title="Activé">
                                                <i class="fa-solid fa-check" style="color: #1ae000;"></i>
                                            </a> <?php } ?>
                                    </div>
                                </td>
                            <?php } ?>
                            </tr>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="p-6 bg-gray-50 border-t border-gray-200">
                <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                    <p class="text-sm text-gray-500">
                        Affichage <span class="font-bold text-gray-800">1-4</span> sur <span class="font-bold text-gray-800">1,204</span> utilisateurs
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