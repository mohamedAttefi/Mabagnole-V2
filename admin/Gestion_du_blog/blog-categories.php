<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    header('Location: ../index.php');
    exit();
}
include "../../classes/Theme.php";
include "../../classes/Article.php";
include "../../classes/BlogComment.php";

$themes = Theme::all();
$articles_publie = Article::all("approved");
$articles_enAttente = Article::all("pending");
$comments = BlogComment::all();

if (isset($_POST["add"])) {
    $category_name = $_POST["category_name"];
    $category_description = $_POST["category_description"];
    $theme = new Theme(null, $category_name, $category_description);
    $theme->create();
    header("Location: blog-categories.php");
}

if (isset($_POST["delete"])) {
    $id = $_POST["delete"];
    Theme::delete($id);
    header("Location: blog-categories.php");
}
if (isset($_POST["edit"])) {
    $theme_id = $_POST["theme_id"];
    $category_name = $_POST["category_name"];
    $category_description = $_POST["category_description"];

    $theme = new Theme($theme_id, $category_name, $category_description);
    $theme->update();

    header("Location: blog-categories.php");
    exit;
}

include "../header.php";

?>

<main class="main-content">
    <div class="p-6 lg:p-8 pt-20 lg:pt-8">
        <!-- Page Header -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
            <div>
                <h1 class="text-2xl lg:text-3xl font-bold text-gray-800">Themes du Blog</h1>
                <p class="text-sm text-gray-500 mt-1">Gérez les thématiques et catégories de votre blog</p>
            </div>
            <div class="flex gap-3">
                <button class="bg-blue-600 text-white px-5 py-2.5 rounded-xl text-sm font-bold hover:bg-blue-700 transition shadow-lg shadow-blue-200 flex items-center gap-2">
                    <i class="fas fa-plus"></i> Ajouter un Theme
                </button>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
            <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Total catégories</p>
                        <h3 class="text-2xl font-bold text-gray-800"><?= count($themes) ?></h3>
                    </div>
                    <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center">
                        <i class="fas fa-layer-group text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Articles publiés</p>
                        <h3 class="text-2xl font-bold text-gray-800"><?= count($articles_publie) ?></h3>
                    </div>
                    <div class="w-12 h-12 bg-green-50 text-green-600 rounded-xl flex items-center justify-center">
                        <i class="fas fa-file-alt text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">En attente</p>
                        <h3 class="text-2xl font-bold text-gray-800"><?= count($articles_enAttente) ?></h3>
                    </div>
                    <div class="w-12 h-12 bg-yellow-50 text-yellow-600 rounded-xl flex items-center justify-center">
                        <i class="fas fa-clock text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white border border-gray-100 rounded-2xl p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500">Commentaires</p>
                        <h3 class="text-2xl font-bold text-gray-800"><?= count($comments) ?></h3>
                    </div>
                    <div class="w-12 h-12 bg-purple-50 text-purple-600 rounded-xl flex items-center justify-center">
                        <i class="fas fa-comments text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php if (count($themes) > 0) { ?>
                <?php foreach ($themes as $theme) { ?>
                    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition group">
                        <div class="flex justify-between items-start">
                            <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center text-xl mb-4">
                                <i class="fas fa-car"></i>
                            </div>
                            <div class="flex gap-2 opacity-0 group-hover:opacity-100 transition">
                                <form id="delete-form" method="post">
                                    <button name="delete" value="<?= $theme["id"] ?>" class="delete-btn text-gray-400 hover:text-red-500 transition">
                                        <i class="fas fa-trash text-sm"></i>
                                    </button>

                                    <button name="edit" value="<?= $theme['id'] ?>"
                                        class="btn-edit text-gray-400 hover:text-blue-500 transition"
                                        data-id="<?= $theme['id'] ?>"
                                        data-name="<?= htmlspecialchars($theme['name']) ?>"
                                        data-description="<?= htmlspecialchars($theme['description']) ?>">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                </form>

                            </div>
                        </div>
                        <h3 class="font-bold text-gray-800 text-lg"><?= $theme["name"] ?></h3>
                        <p class="text-sm text-gray-500 mt-2"><?= $theme["description"] ?></p>
                        <div class="flex items-center gap-2 mt-4">
                            <span class="text-xs bg-green-100 text-green-800 px-3 py-1 rounded-full font-medium">
                                <?= $theme["total"] == 0 ? "No articles" : $theme["total"] . " articles" ?>
                            </span>
                            <span class="text-xs text-gray-400">•</span>
                            <?php
                            $inscription = new DateTime($theme["created_at"]);
                            $now = new DateTime();
                            $interval = $inscription->diff($now);
                            echo $interval->d;
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
                                $duree = "pas d'article";
                            }
                            ?>
                            <span class="text-xs text-gray-500">Dernier: <?= $duree ?></span>
                        </div>
                    </div>
                <?php } ?>
            <?php } ?>


        </div>

        <?php if (count($themes) == 0) { ?>
            <div class="bg-white border border-gray-100 rounded-2xl p-12 text-center">
                <div class="w-16 h-16 bg-gray-100 text-gray-400 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-layer-group text-2xl"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-800 mb-2">Aucune catégorie créée</h3>
                <p class="text-gray-500 mb-6">Commencez par créer votre première catégorie pour organiser vos articles</p>
                <button class="bg-blue-600 text-white px-6 py-3 rounded-xl text-sm font-bold hover:bg-blue-700 transition shadow-lg shadow-blue-200">
                    <i class="fas fa-plus mr-2"></i> Créer une catégorie
                </button>
            </div>
        <?php } ?>

    </div>
</main>

<div id="addCategoryModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 p-4">
    <div class="bg-white rounded-2xl max-w-md w-full p-6">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-xl font-bold text-gray-800" id="form-title">Nouvelle Theme</h3>
            <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
                <i class="fas fa-times text-lg"></i>
            </button>
        </div>

        <form id="categoryForm" method="post">
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">
                        Nom de Theme <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="category_name" required id="category_name"
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600"
                        placeholder="Ex: Électrique">
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">
                        Description
                    </label>
                    <textarea name="category_description" rows="3" id="category_description"
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600"
                        placeholder="Décrivez cette Theme..."></textarea>
                </div>
            </div>

            <div class="flex gap-3 mt-8 pt-6 border-t border-gray-100">
                <button type="button" onclick="closeModal()"
                    class="flex-1 bg-white border border-gray-200 px-4 py-3 rounded-xl text-sm font-bold hover:bg-gray-50 transition">
                    Annuler
                </button>
                <button type="submit" name="add" id="add-btn"
                    class="flex-1 bg-blue-600 text-white px-4 py-3 rounded-xl text-sm font-bold hover:bg-blue-700 transition shadow-lg shadow-blue-200">
                    Créer la catégorie
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    window.addEventListener('DOMContentLoaded', function() {
        <?php if (isset($successMessage)): ?>
            showNotification("<?= addslashes($successMessage) ?>", 'success');
        <?php endif; ?>
    });

    function showNotification(message, type) {
        const notification = document.createElement('div');
        notification.className = `fixed top-4 right-4 z-50 px-6 py-3 rounded-lg shadow-lg flex items-center gap-3 
                            ${type === 'success' ? 'bg-green-500' : 'bg-red-500'} text-white animate-fade-in`;
        notification.innerHTML = `
        <i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'} text-xl"></i>
        <span class="font-medium">${message}</span>
        <button onclick="this.parentElement.remove()" class="ml-4 text-white hover:text-gray-200">
            <i class="fas fa-times"></i>
        </button>
    `;

        document.body.appendChild(notification);

        // Supprimer après 5 secondes
        setTimeout(() => {
            if (notification.parentElement) {
                notification.remove();
            }
        }, 5000);
    }

    document.querySelectorAll(".btn-edit").forEach(button => {
        button.addEventListener("click", (e) => {
            e.preventDefault();

            const id = button.getAttribute('data-id');
            const name = button.getAttribute('data-name');
            const description = button.getAttribute('data-description');

            // Mettre à jour le formulaire
            document.getElementById("form-title").textContent = "Modifier un Thème";
            document.getElementById("category_name").value = name;
            document.getElementById("category_description").value = description;

            // Changer le bouton submit
            const submitBtn = document.getElementById("add-btn");
            submitBtn.textContent = "Modifier";
            submitBtn.name = "edit";

            // Ajouter un champ caché pour l'ID
            let idInput = document.getElementById("theme_id");
            if (!idInput) {
                idInput = document.createElement("input");
                idInput.type = "hidden";
                idInput.name = "theme_id";
                idInput.id = "theme_id";
                document.getElementById("categoryForm").appendChild(idInput);
            }
            idInput.value = id;

            openModal();
        });
    });
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Êtes-vous sûr ?',
                html: `Voulez-vous vraiment supprimer ce theme`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Oui, supprimer !',
                cancelButtonText: 'Annuler',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // Soumettre le formulaire correspondant
                    document.getElementById('delete-form').submit();
                }
            });
        });
    });

    function openModal() {
        document.getElementById('addCategoryModal').classList.remove('hidden');
        document.getElementById('addCategoryModal').classList.add('flex');
    }

    function closeModal() {
        document.getElementById('addCategoryModal').classList.add('hidden');
        document.getElementById('addCategoryModal').classList.remove('flex');
        document.getElementById('categoryForm').reset();


        document.getElementById("form-title").textContent = "Nouveau Thème";
        document.getElementById("add-btn").textContent = "Créer la catégorie";
        document.getElementById("add-btn").name = "add";

        const idInput = document.getElementById("theme_id");
        if (idInput) {
            idInput.remove();
        }

    }

    document.querySelector('button.bg-blue-600').addEventListener('click', openModal);

    // Close modal when clicking outside
    document.getElementById('addCategoryModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal();
        }
    });
</script>

</body>

</html>