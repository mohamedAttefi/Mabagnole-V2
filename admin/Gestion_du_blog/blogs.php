<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    header('Location: ../index.php');
    exit();
}
include "../../classes/Article.php";
include "../header.php";
$articles = Article::all();
$articles_publie = Article::all("approved");
$articles_enAttente = Article::all("pending");


if(isset($_GET["id_reject"])){
    
}
if(isset($_GET["id_approuve"])){
    
}

?>

<main class="main-content">
    <div class="p-6 lg:p-8 pt-20 lg:pt-8">
        <!-- Page Header -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
            <div>
                <h1 class="text-2xl lg:text-3xl font-bold text-gray-800">Gestion des Articles</h1>
                <p class="text-sm text-gray-500 mt-1">Créez et gérez le contenu du blog automobile.</p>
            </div>
            <div class="flex gap-3">
                <button class="bg-white border border-gray-200 px-5 py-2.5 rounded-xl text-sm font-bold flex items-center gap-2 hover:bg-gray-50 transition shadow-sm">
                    <i class="fas fa-download text-gray-600"></i> Exporter
                </button>
                <button class="bg-blue-600 text-white px-5 py-2.5 rounded-xl text-sm font-bold flex items-center gap-2 hover:bg-blue-700 transition shadow-lg shadow-blue-200">
                    <i class="fas fa-plus"></i> Nouvel Article
                </button>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-newspaper text-blue-600 text-lg"></i>
                    </div>
                    <div>
                        <p class="text-slate-500 text-sm">Total Articles</p>
                        <p class="text-2xl font-bold text-slate-900"><?= count($articles) ?></p>
                    </div>
                </div>
            </div>

            <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-eye text-green-600 text-lg"></i>
                    </div>
                    <div>
                        <p class="text-slate-500 text-sm">Articles Publiés</p>
                        <p class="text-2xl font-bold text-slate-900"><?= count($articles_publie) ?></p>
                    </div>
                </div>
            </div>

            <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-yellow-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-clock text-yellow-600 text-lg"></i>
                    </div>
                    <div>
                        <p class="text-slate-500 text-sm">En attente</p>
                        <p class="text-2xl font-bold text-slate-900"><?= count($articles_enAttente) ?></p>
                    </div>
                </div>
            </div>

            <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-chart-line text-purple-600 text-lg"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search and Filter Bar -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 mb-8">
            <div class="flex flex-col lg:flex-row gap-4 items-center">
                <div class="relative flex-grow">
                    <input type="text"
                        placeholder="Rechercher un article par titre ou auteur..."
                        class="w-full pl-10 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600">
                    <i class="fas fa-search absolute left-3 top-3.5 text-gray-400"></i>
                </div>

                <select class="bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm outline-none focus:ring-2 focus:ring-blue-600">
                    <option>Tous les statuts</option>
                    <option>Publié</option>
                    <option>Brouillon</option>
                    <option>En attente</option>
                    <option>Archivé</option>
                </select>

                <select class="bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm outline-none focus:ring-2 focus:ring-blue-600">
                    <option>Toutes les catégories</option>
                    <option>Actualités</option>
                    <option>Tests</option>
                    <option>Conseils</option>
                    <option>Électrique</option>
                </select>

                <button class="text-sm text-blue-600 font-bold hover:bg-blue-50 px-4 py-3 rounded-xl transition flex items-center gap-2 whitespace-nowrap">
                    <i class="fas fa-filter"></i>
                    Filtres avancés
                </button>
            </div>
        </div>

        <!-- Articles Table -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full min-w-[1000px]">
                    <thead class="bg-gray-50">
                        <tr class="text-gray-400 text-xs uppercase tracking-wider font-bold">
                            <th class="px-6 py-4 text-left">Article</th>
                            <th class="px-6 py-4 text-left">Auteur</th>
                            <th class="px-6 py-4 text-left">Catégorie</th>
                            <th class="px-6 py-4 text-left">Date</th>
                            <th class="px-6 py-4 text-left">Statut</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <!-- Published Article -->
                        <?php foreach ($articles as $article) { ?>
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4">
                                    <div class="flex items-start gap-3">
                                        <div class="">
                                            <p class="font-bold text-gray-800 line-clamp-2">
                                                <?= $article["title"] ?>
                                            </p>
                                            <p class="text-xs text-gray-500 line-clamp-2">
                                                "<?= $article["content"] ?>"
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <span class="text-sm text-gray-700"><?= $article["user_name"] ?></span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="inline-flex items-center gap-1 bg-blue-50 text-blue-700 text-xs font-medium px-3 py-1.5 rounded-full">
                                        <?= $article["theme_name"] ?>
                                    </span>
                                </td>
                                <td class="">
                                    <div class="">
                                        <p class="text-sm text-gray-800"><?= (new DateTime($article["created_at"]))->format("Y/m/d") ?></p>
                                        <?php
                                        $date_creation = new DateTime($article["created_at"]);
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
                                        <p class="text-xs text-gray-500">Publié <?= $duree ?> </p>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <?php if ($article["status"] == "approved") { ?>
                                        <span class="inline-flex items-center gap-1 bg-green-100 text-green-700 text-xs font-bold px-3 py-1.5 rounded-full">
                                            Publié</span>
                                    <?php } elseif ($article["status"] == "pending") { ?>
                                        <span class="inline-flex text-center items-center gap-1 bg-blue-100 text-blue-700 text-xs font-bold px-3 py-1.5 rounded-full">
                                            En attente</span>
                                    <?php } else { ?>
                                        <span class="inline-flex items-center gap-1 bg-red-100 text-red-700 text-xs font-bold px-3 py-1.5 rounded-full">
                                            Rejected</span>
                                    <?php } ?>

                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex justify-end gap-2">
                                        <button class="bg-blue-100 text-blue-600 p-2 rounded-lg hover:bg-blue-200 transition" title="Voir">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                     
                                        <?php if ($article["status"] == "approved") { ?>
                                            <a href="blogs.php?id_reject=<?= $article["id"] ?>" class="bg-red-100 text-red-600 p-2 rounded-lg hover:bg-red-200 transition" title="Rejecteé">
                                                <i class="fa-solid fa-ban" style="color: #ff0000;"></i>
                                            </a>
                                        <?php } elseif ($article["status"] == "pending") { ?>
                                            <a href="blogs.php?id_approuve=<?= $article["id"] ?>" class="bg-green-100 text-green-600 p-2 rounded-lg hover:bg-green-200 transition" title="Approuvée">
                                                <i class="fa-solid fa-check" style="color: #1ae000;"></i>
                                            </a>
                                            <a href="blogs.php?id_reject=<?= $article["id"] ?>" class="bg-red-100 text-red-600 p-2 rounded-lg hover:bg-red-200 transition" title="Rejecteé">
                                                <i class="fa-solid fa-ban" style="color: #ff0000;"></i>

                                            </a>
                                        <?php } else { ?>
                                            <a href="blogs.php?id_approuve=<?= $article["id"] ?>" class="bg-green-100 text-green-600 p-2 rounded-lg hover:bg-green-200 transition" title="Approuvée">
                                                <i class="fa-solid fa-check" style="color: #1ae000;"></i>
                                            </a>
                                        <?php } ?>
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
                        Affichage <span class="font-bold text-gray-800">1-4</span> sur <span class="font-bold text-gray-800">48</span> articles
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