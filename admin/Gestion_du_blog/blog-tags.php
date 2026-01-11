<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    header('Location: ../index.php');
    exit();
}
include "../../classes/Tag.php";
$tags = Tag::all();

include "../header.php";
?>

<main class="main-content">
    <div class="p-6 lg:p-8 pt-20 lg:pt-8">
        <!-- Page Header -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
            <div>
                <h1 class="text-2xl lg:text-3xl font-bold text-gray-800">Gestion des Tags</h1>
                <p class="text-sm text-gray-500 mt-1">Organisez les thèmes et tags pour catégoriser votre contenu.</p>
            </div>
            <div class="flex gap-3">
                <button class="bg-white border border-gray-200 px-5 py-2.5 rounded-xl text-sm font-bold flex items-center gap-2 hover:bg-gray-50 transition shadow-sm">
                    <i class="fas fa-download text-gray-600"></i> Exporter
                </button>
                <div class="flex gap-2">
                    <button class="bg-green-600 text-white px-5 py-2.5 rounded-xl text-sm font-bold flex items-center gap-2 hover:bg-green-700 transition shadow-lg shadow-green-200">
                        <i class="fas fa-plus"></i> Nouveau Tag
                    </button>
                </div>
            </div>
        </div>

        <!-- Tabs for Themes/Tags -->
        <div class="flex border-b border-gray-200 mb-8">
            <button class="px-6 py-3 text-sm font-bold border-b-2 border-blue-600 text-blue-600">
                <i class="fas fa-tags mr-2"></i> Tags
            </button>

        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

            <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-tags text-green-600 text-lg"></i>
                    </div>
                    <div>
                        <p class="text-slate-500 text-sm">Total Tags</p>
                        <p class="text-2xl font-bold text-slate-900"><?= count($tags) ?></p>
                    </div>
                </div>
            </div>

        </div>

        <!-- Search and Filter Bar -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 mb-8">
            <div class="flex flex-col lg:flex-row gap-4 items-center">
                <div class="relative flex-grow">
                    <input type="text"
                        placeholder="Rechercher un thème ou un tag..."
                        class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600">
                    <i class="fas fa-search absolute left-3 top-3.5 text-gray-400"></i>
                </div>

                <select class="bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm outline-none focus:ring-2 focus:ring-blue-600">
                    <option>Tous les types</option>
                    <option>Thèmes principaux</option>
                    <option>Sous-thèmes</option>
                    <option>Tags articles</option>
                    <option>Tags véhicules</option>
                </select>

                <select class="bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm outline-none focus:ring-2 focus:ring-blue-600">
                    <option>Tous les statuts</option>
                    <option>Actif</option>
                    <option>Inactif</option>
                    <option>Populaire</option>
                    <option>Rarement utilisé</option>
                </select>

                <button class="text-sm text-blue-600 font-bold hover:bg-blue-50 px-4 py-3 rounded-xl transition flex items-center gap-2 whitespace-nowrap">
                    <i class="fas fa-filter"></i>
                    Filtres
                </button>
            </div>
        </div>

        <!-- Themes and Tags Table -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full min-w-[900px]">
                    <thead class="bg-gray-50">
                        <tr class="text-gray-400 text-xs uppercase tracking-wider font-bold">
                            <th class="px-6 py-4 text-left">Nom</th>
                            <th class="px-6 py-4 text-left">Articles</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <?php foreach ($tags as $tag) { ?> <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-lg bg-gradient-to-r from-blue-500 to-green-500 flex items-center justify-center">
                                            <i class="fas fa-bolt text-white"></i>
                                        </div>
                                        <div>
                                            <p class="font-bold text-gray-800"><?= $tag["name"] ?></p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center gap-1 bg-green-100 text-green-700 text-xs font-bold px-3 py-1.5 rounded-full">
                                        <i class="fas fa-fire text-xs"></i>
                                        <?= $tag["total_articles"] ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex justify-end gap-2">
                                        <button class="bg-blue-100 text-blue-600 p-2 rounded-lg hover:bg-blue-200 transition" title="Éditer">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="bg-yellow-100 text-yellow-600 p-2 rounded-lg hover:bg-yellow-200 transition" title="Voir articles">
                                            <i class="fas fa-newspaper"></i>
                                        </button>
                                        <button class="bg-red-100 text-red-600 p-2 rounded-lg hover:bg-red-200 transition" title="Supprimer">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
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
                        Affichage <span class="font-bold text-gray-800">1-4</span> sur <span class="font-bold text-gray-800">160</span> éléments
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

    document.querySelectorAll('.flex.border-b button').forEach(button => {
        button.addEventListener('click', function() {
            // Remove active class from all buttons
            document.querySelectorAll('.flex.border-b button').forEach(btn => {
                btn.classList.remove('border-b-2', 'border-blue-600', 'text-blue-600');
                btn.classList.add('text-gray-500');
            });

            // Add active class to clicked button
            this.classList.add('border-b-2', 'border-blue-600', 'text-blue-600');
            this.classList.remove('text-gray-500');
        });
    });
</script>

</body>

</html>