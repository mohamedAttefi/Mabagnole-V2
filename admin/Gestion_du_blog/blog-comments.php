<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    header('Location: ../index.php');
    exit();
}
include "../../classes/BlogComment.php";
include "../../classes/Article.php";

$comments = BlogComment::all();

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    echo $id;
    $commentToDelete = BlogComment::findById($id);
    $commentToDelete->delete();
    print_r($commentToDelete);
    header("location: blog-comments.php");
}

include "../header.php";
?>

<main class="main-content">
    <div class="p-6 lg:p-8 pt-20 lg:pt-8">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
            <div>
                <h1 class="text-2xl lg:text-3xl font-bold text-gray-800">Modération des Commentaires</h1>
                <p class="text-sm text-gray-500 mt-1">Gérez et modérez les échanges sur votre blog</p>
            </div>
            <div class="flex items-center gap-4">
                <div class="relative">
                    <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    <input type="text" placeholder="Rechercher un commentaire..."
                        class="pl-10 pr-4 py-2 bg-white border border-gray-200 rounded-xl text-sm outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600">
                </div>
                <button class="bg-gray-100 text-gray-700 px-4 py-2 rounded-xl text-sm font-bold hover:bg-gray-200 transition flex items-center gap-2">
                    <i class="fas fa-filter"></i> Filtrer
                </button>
            </div>
        </div>

        <!-- Stats Cards -->


        <!-- Tabs Navigation -->
        <div class="flex border-b border-gray-200 mb-6">
            <button class="px-6 py-3 text-sm font-bold text-gray-500 hover:text-gray-800 border-b-2 border-transparent hover:border-blue-600 transition">
                Tous les commentaires (<?= count($comments) ?>)
            </button>
        </div>



        <?php if (empty($comments)) { ?>
            <div class="bg-white border border-gray-100 rounded-2xl p-12 text-center">
                <div class="w-16 h-16 bg-gray-100 text-gray-400 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-comments text-2xl"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-800 mb-2">Aucun commentaire pour le moment</h3>
                <p class="text-gray-500 mb-6">Les commentaires apparaîtront ici lorsqu'ils seront publiés par les utilisateurs</p>
                <a href="../blog/" class="inline-block bg-blue-600 text-white px-6 py-3 rounded-xl text-sm font-bold hover:bg-blue-700 transition shadow-lg shadow-blue-200">
                    <i class="fas fa-newspaper mr-2"></i> Voir les articles
                </a>
            </div>
        <?php } else { ?>
            <div class="space-y-4">
                <!-- Comment 1 - Signalé -->
                <?php foreach ($comments as $comment) {
                    $article = Article::find($comment["article_id"]);
                ?>
                    <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition">
                        <div class="flex justify-between items-start mb-4">
                            <div class="flex items-center gap-3">
                                <div>
                                    <h4 class="text-sm font-bold text-gray-800"><?= $article["user_name"] ?></h4>
                                    <p class="text-xs text-gray-500">sur <a href="#" class="text-blue-600 hover:underline">"<?= $article["title"] ?>"</a></p>
                                    <?php
                                    $inscription = new DateTime($article["created_at"]);
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
                                        $duree = "pas d'article";
                                    }
                                    ?>
                                    <p class="text-xs text-gray-400"><?= $duree ?></p>
                                </div>
                            </div>
                        </div>

                        <div class="pl-14">
                            <p class="text-sm text-gray-600 leading-relaxed mb-4 italic border-l-4 border-gray-200 pl-4">
                                "<?= $comment["content"] ?>"
                            </p>

                            <div class="flex gap-3">
                                <a href="blog-comments.php?id=<?= $comment["id"] ?>" class="text-xs bg-red-50 text-red-600 hover:bg-red-100 px-4 py-2 rounded-lg font-bold transition flex items-center gap-2">
                                    <i class="fas fa-trash"></i> Supprimer
                                </a>
                                <button class="text-xs bg-blue-50 text-blue-600 hover:bg-blue-100 px-4 py-2 rounded-lg font-bold transition flex items-center gap-2">
                                    <i class="fas fa-reply"></i> Répondre
                                </button>
                                <button class="text-xs bg-gray-50 text-gray-600 hover:bg-gray-100 px-4 py-2 rounded-lg font-bold transition flex items-center gap-2">
                                    <i class="fas fa-eye"></i> Voir l'article
                                </button>
                            </div>
                        </div>
                    </div>
                <?php } ?>

                <?php if ($empty($comments)) { ?>

                <?php } ?>


            </div>
            <!-- Pagination -->
            <div class="flex justify-center items-center gap-2 mt-8 pt-8 border-t border-gray-100">
                <button class="w-10 h-10 flex items-center justify-center text-gray-500 hover:text-gray-800 hover:bg-gray-100 rounded-lg transition">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button class="w-10 h-10 flex items-center justify-center bg-blue-600 text-white rounded-lg font-bold">
                    1
                </button>
                <button class="w-10 h-10 flex items-center justify-center text-gray-500 hover:text-gray-800 hover:bg-gray-100 rounded-lg transition">
                    2
                </button>
                <button class="w-10 h-10 flex items-center justify-center text-gray-500 hover:text-gray-800 hover:bg-gray-100 rounded-lg transition">
                    3
                </button>
                <button class="w-10 h-10 flex items-center justify-center text-gray-500 hover:text-gray-800 hover:bg-gray-100 rounded-lg transition">
                    ...
                </button>
                <button class="w-10 h-10 flex items-center justify-center text-gray-500 hover:text-gray-800 hover:bg-gray-100 rounded-lg transition">
                    8
                </button>
                <button class="w-10 h-10 flex items-center justify-center text-gray-500 hover:text-gray-800 hover:bg-gray-100 rounded-lg transition">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        <?php } ?>



        <!-- Bulk Actions -->
        <div class="fixed bottom-6 right-6 bg-white border border-gray-200 rounded-2xl shadow-lg p-4">
            <div class="flex items-center gap-4">
                <div class="text-sm text-gray-600">
                    <span class="font-bold">3</span> commentaires sélectionnés
                </div>
                <div class="flex gap-2">
                    <button class="text-xs bg-green-50 text-green-600 hover:bg-green-100 px-4 py-2 rounded-lg font-bold transition flex items-center gap-2">
                        <i class="fas fa-check"></i> Approuver tout
                    </button>
                    <button class="text-xs bg-red-50 text-red-600 hover:bg-red-100 px-4 py-2 rounded-lg font-bold transition flex items-center gap-2">
                        <i class="fas fa-trash"></i> Supprimer tout
                    </button>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Modal pour répondre -->
<div id="replyModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 p-4">
    <div class="bg-white rounded-2xl max-w-lg w-full p-6">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-xl font-bold text-gray-800">Répondre au commentaire</h3>
            <button onclick="closeReplyModal()" class="text-gray-400 hover:text-gray-600">
                <i class="fas fa-times text-lg"></i>
            </button>
        </div>

        <div class="mb-6 p-4 bg-gray-50 rounded-xl">
            <div class="flex items-center gap-2 mb-2">
                <div class="w-8 h-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center text-sm font-bold">
                    SB
                </div>
                <span class="text-sm font-bold text-gray-800">Samuel Blanc</span>
            </div>
            <p class="text-sm text-gray-600 italic">"Cet article contient une erreur sur le cycle de charge des batteries lithium..."</p>
        </div>

        <form id="replyForm">
            <div class="mb-6">
                <label class="block text-sm font-bold text-gray-700 mb-2">
                    Votre réponse <span class="text-red-500">*</span>
                </label>
                <textarea name="reply_content" rows="4" required
                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600"
                    placeholder="Écrivez votre réponse ici..."></textarea>
            </div>

            <div class="flex gap-3">
                <button type="button" onclick="closeReplyModal()"
                    class="flex-1 bg-white border border-gray-200 px-4 py-3 rounded-xl text-sm font-bold hover:bg-gray-50 transition">
                    Annuler
                </button>
                <button type="submit"
                    class="flex-1 bg-blue-600 text-white px-4 py-3 rounded-xl text-sm font-bold hover:bg-blue-700 transition shadow-lg shadow-blue-200">
                    <i class="fas fa-paper-plane mr-2"></i> Envoyer la réponse
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Reply modal functions
    function openReplyModal() {
        document.getElementById('replyModal').classList.remove('hidden');
        document.getElementById('replyModal').classList.add('flex');
    }

    function closeReplyModal() {
        document.getElementById('replyModal').classList.add('hidden');
        document.getElementById('replyModal').classList.remove('flex');
    }

    // Open reply modal when any reply button is clicked
    document.querySelectorAll('button:has(i.fa-reply)').forEach(button => {
        button.addEventListener('click', openReplyModal);
    });

    // Form submission for reply
    document.getElementById('replyForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const replyContent = this.querySelector('textarea[name="reply_content"]').value;

        // In a real application, you would send this data to the server
        console.log('Réponse envoyée:', replyContent);

        // Show success message
        alert('Réponse envoyée avec succès !');

        // Close modal and reset form
        closeReplyModal();
        this.reset();
    });

    // Close modal when clicking outside
    document.getElementById('replyModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeReplyModal();
        }
    });

    // Comment selection for bulk actions
    document.querySelectorAll('.bg-white.rounded-2xl').forEach(comment => {
        comment.addEventListener('click', function(e) {
            if (!e.target.closest('button')) {
                this.classList.toggle('border-blue-500');
                this.classList.toggle('bg-blue-50');
                updateBulkActions();
            }
        });
    });

    function updateBulkActions() {
        const selectedComments = document.querySelectorAll('.border-blue-500').length;
        const bulkCounter = document.querySelector('.fixed.bottom-6 .font-bold');

        if (bulkCounter) {
            bulkCounter.textContent = selectedComments;

            // Show/hide bulk actions
            const bulkActions = document.querySelector('.fixed.bottom-6');
            if (selectedComments > 0) {
                bulkActions.classList.remove('hidden');
            } else {
                bulkActions.classList.add('hidden');
            }
        }
    }

    // Initially hide bulk actions
    document.querySelector('.fixed.bottom-6').classList.add('hidden');
</script>

</body>

</html>