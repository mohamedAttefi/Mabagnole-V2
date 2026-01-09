<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    header('Location: ../index.php');
    exit();
}

include "../header.php";
include "../../classes/Vehicle.php";
$vehicles = Vehicle::all();
$vehicles_disponible = Vehicle::all(1);



?>

<main class="main-content">
    <div class="p-6 lg:p-8 pt-20 lg:pt-8">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
            <div>
                <h1 class="text-2xl lg:text-3xl font-bold text-gray-800">Gestion du Parc Automobile</h1>
                <p class="text-sm text-gray-500 mt-1">Supervisez et mettez à jour la disponibilité de vos véhicules.</p>
            </div>
            <a href="vehicle-add.php" class="bg-blue-600 text-white px-6 py-3 rounded-xl font-bold shadow-lg shadow-blue-200 hover:bg-blue-700 transition flex items-center gap-2">
                <i class="fas fa-plus"></i> Nouveau Véhicule
            </a>
        </div>

        <!-- Quick Stats -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-car text-blue-600 text-lg"></i>
                    </div>
                    <div>
                        <p class="text-slate-500 text-sm">Total Véhicules</p>
                        <p class="text-2xl font-bold text-slate-900"><?= count($vehicles) ?></p>
                    </div>
                </div>
            </div>
            <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-check-circle text-green-600 text-lg"></i>
                    </div>
                    <div>
                        <p class="text-slate-500 text-sm">Disponibles</p>
                        <p class="text-2xl font-bold text-slate-900"><?= count($vehicles_disponible) ?></p>
                    </div>
                </div>
            </div>
            <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-road text-blue-600 text-lg"></i>
                    </div>
                    <div>
                        <p class="text-slate-500 text-sm">En location</p>
                        <p class="text-2xl font-bold text-slate-900"><?= count($vehicles_disponible) - count($vehicles) ?></p>
                    </div>
                </div>
            </div>

        </div>

        <div class="bg-white p-4 rounded-2xl shadow-sm border border-gray-100 mb-8 flex flex-wrap gap-4 items-center">
            <div class="relative flex-grow max-w-md">
                <input type="text" placeholder="Rechercher par immatriculation ou modèle..." class="w-full pl-10 pr-4 py-2.5 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-600 outline-none">
                <i class="fas fa-search absolute left-3 top-3.5 text-gray-400"></i>
            </div>
            <select class="bg-gray-50 border border-gray-200 rounded-lg px-4 py-2.5 text-sm outline-none focus:ring-2 focus:ring-blue-600">
                <option>Tous les statuts</option>
                <option>Disponible</option>
                <option>Loué</option>
                <option>Maintenance</option>
            </select>
            <select class="bg-gray-50 border border-gray-200 rounded-lg px-4 py-2.5 text-sm outline-none focus:ring-2 focus:ring-blue-600">
                <option>Toutes les catégories</option>
                <option>Berline</option>
                <option>SUV</option>
                <option>Sport</option>
                <option>Électrique</option>
            </select>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full min-w-[800px]">
                    <thead class="bg-gray-50">
                        <tr class="text-gray-400 text-xs uppercase tracking-wider font-bold">
                            <th class="px-6 py-4 text-left">Véhicule</th>
                            <th class="px-6 py-4 text-left">Catégorie</th>
                            <th class="px-6 py-4 text-left">Prix/Jour</th>
                            <th class="px-6 py-4 text-left">Statut</th>
                            <th class="px-6 py-4 text-left">Immatriculation</th>
                            <th class="px-6 py-4 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <?php foreach ($vehicles as $vehicle) { ?>
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <img src="<?= $vehicle["image_url"] ?>" class="w-12 h-10 object-cover rounded-md">
                                        <div>
                                            <p class="font-bold text-gray-800 text-sm"><?= $vehicle["marque"] . " " . $vehicle["modele"]  ?></p>
                                            <p class="text-xs text-gray-500"><?= $vehicle["annee"] ?> • <?= $vehicle["carburant"] ?></p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center gap-1 bg-blue-50 text-blue-700 text-xs font-medium px-3 py-1 rounded-full">
                                        <i class="fas fa-bolt"></i>
                                        <?= $vehicle["categorie"] ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="text-sm font-bold text-gray-800"><?= $vehicle["prix_journalier"] ?> €</p>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="<?= $vehicle["disponible"] == 1 ? "bg-green-100 text-green-600" : "bg-red-100 text-red-600" ?> text-xs font-bold px-3 py-1.5 rounded-lg uppercase">Disponible</span>
                                </td>
                                
                                <td class="px-6 py-4">
                                    <p class="text-sm font-mono text-gray-800 font-bold"><?= $vehicle["immatriculation"] ?></p>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex justify-center gap-2">
                                        <a href="vehicle-edit.php?id=<?= $vehicle["id"] ?>" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition" title="Éditer">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="vehicle-delete.php?id=<?= $vehicle["id"] ?>" class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition" title="Supprimer">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                        
                    </tbody>
                </table>
            </div>

            <div class="p-6 bg-gray-50 flex flex-col sm:flex-row justify-between items-center gap-4 text-xs font-bold text-gray-400">
                <span>AFFICHAGE : 1-4 SUR 56</span>
                <div class="flex gap-2">
                    <button class="px-4 py-2 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 transition shadow-sm flex items-center gap-2">
                        <i class="fas fa-chevron-left text-xs"></i>
                        <span>Précédent</span>
                    </button>
                    <button class="px-4 py-2 bg-blue-600 text-white border border-blue-600 rounded-lg hover:bg-blue-700 transition shadow-sm">
                        1
                    </button>
                    <button class="px-4 py-2 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 transition shadow-sm">
                        2
                    </button>
                    <button class="px-4 py-2 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 transition shadow-sm">
                        3
                    </button>
                    <button class="px-4 py-2 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 transition shadow-sm flex items-center gap-2">
                        <span>Suivant</span>
                        <i class="fas fa-chevron-right text-xs"></i>
                    </button>
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