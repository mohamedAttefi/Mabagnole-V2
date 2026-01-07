<?php
include "../includes/header.php";
include "../classes/Review.php";

$id = $_SESSION["user_id"];
$reviews = Review::findByUser($id);
$reviews_count = count($reviews);
?>

<main class="max-w-4xl mx-auto pt-20 px-4 py-12">
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        <!-- Sidebar Navigation -->
        <aside class="lg:col-span-1 space-y-4">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4">
                <a href="profile.php" class="flex items-center gap-3 p-3 text-gray-600 hover:bg-gray-50 rounded-lg transition">
                    <i class="fas fa-user-circle w-5"></i> Mon Profil
                </a>
                <a href="my-reservations.php" class="flex items-center gap-3 p-3 text-gray-600 hover:bg-gray-50 rounded-lg transition">
                    <i class="fas fa-calendar-alt w-5"></i> Mes Réservations
                </a>
                <a href="my-reviews.php" class="flex items-center gap-3 p-3 bg-blue-50 text-blue-600 rounded-lg font-medium border-l-4 border-blue-600">
                    <i class="fas fa-star w-5"></i> Mes Avis
                </a>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="lg:col-span-3">
            <!-- Header -->
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mb-2">Mes avis publiés</h1>
                    <p class="text-gray-600">Consultez et gérez les avis que vous avez laissés</p>
                </div>
                <span class="px-4 py-2 bg-blue-100 text-blue-700 rounded-full text-sm font-bold">
                    <?= $reviews_count ?> <?= $reviews_count == 1 ? 'Avis' : 'Avis' ?>
                </span>
            </div>

            <!-- No Reviews Message -->
            <?php if ($reviews_count == 0): ?>
            <div class="text-center py-16 bg-gray-50 rounded-xl border-2 border-dashed border-gray-200">
                <div class="mx-auto w-20 h-20 bg-blue-100 rounded-full flex items-center justify-center mb-6">
                    <i class="far fa-star text-3xl text-blue-600"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-3">Vous n'avez pas encore publié d'avis</h3>
                <p class="text-gray-600 max-w-md mx-auto mb-8">
                    Partagez votre expérience avec les véhicules que vous avez loués. Vos avis aident la communauté à faire les bons choix !
                </p>
                <div class="space-y-4">
                    <a href="my-reservations.php" 
                       class="inline-flex items-center bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition font-medium">
                        <i class="fas fa-calendar-check mr-2"></i> Noter mes réservations
                    </a>
                    <p class="text-sm text-gray-500 mt-4">
                        <i class="fas fa-info-circle mr-1"></i>
                        Vous pouvez noter les véhicules jusqu'à 30 jours après votre location
                    </p>
                </div>
            </div>
            <?php endif; ?>

            <!-- Reviews List -->
            <div class="space-y-6">
                <?php foreach ($reviews as $review): ?>
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition">
                    <div class="flex gap-4">
                        <img src="<?= htmlspecialchars($review["image_url"]) ?>" 
                             alt="<?= htmlspecialchars($review["marque"] . ' ' . $review["modele"]) ?>"
                             class="w-16 h-16 rounded-lg object-cover">
                        <div class="flex-grow">
                            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-start gap-2 mb-3">
                                <h4 class="font-bold text-lg"><?= htmlspecialchars($review["marque"] . " " . $review["modele"]) ?></h4>
                                <div class="flex items-center">
                                    <div class="text-yellow-400 mr-2">
                                        <?php for ($i = 0; $i < 5; $i++): ?>
                                            <?php if ($i < $review["note"]): ?>
                                                <i class="fas fa-star"></i>
                                            <?php else: ?>
                                                <i class="far fa-star"></i>
                                            <?php endif; ?>
                                        <?php endfor; ?>
                                    </div>
                                    <span class="text-gray-800 font-semibold"><?= number_format($review["note"], 1) ?>/5</span>
                                </div>
                            </div>
                            
                            <!-- Review Content -->
                            <div class="bg-blue-50 border-l-4 border-blue-600 p-4 mb-4 rounded-r-lg">
                                <p class="text-gray-700 italic">"<?= htmlspecialchars($review["commentaire"] ?? "Une voiture fantastique pour un trajet silencieux vers la côte. Service irréprochable.") ?>"</p>
                            </div>
                            
                            <!-- Dates and Actions -->
                            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3">
                                <div class="text-sm text-gray-500">
                                    <i class="far fa-clock mr-1"></i>
                                    Publié le <?= date('d/m/Y', strtotime($review["created_at"] ?? '2024-01-15')) ?>
                                </div>
                                <div class="flex gap-3">
                                    <button onclick="editReview(<?= $review['id'] ?>)" 
                                            class="px-4 py-2 text-sm border border-blue-600 text-blue-600 rounded-lg hover:bg-blue-50 transition flex items-center">
                                        <i class="fas fa-edit mr-2"></i>Modifier
                                    </button>
                                    <button onclick="deleteReview(<?= $review['id'] ?>)" 
                                            class="px-4 py-2 text-sm border border-red-600 text-red-600 rounded-lg hover:bg-red-50 transition flex items-center">
                                        <i class="fas fa-trash mr-2"></i>Supprimer
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <!-- Quick Stats (when reviews exist) -->
            <?php if ($reviews_count > 0): ?>
            <div class="mt-8 bg-blue-50 border-l-4 border-blue-600 p-6 rounded-r-lg">
                <h3 class="text-lg font-bold mb-4">Votre impact sur la communauté</h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="text-center">
                        <div class="text-2xl font-bold text-blue-600"><?= $reviews_count ?></div>
                        <div class="text-sm text-gray-600">Avis publiés</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-green-600">
                            <?php 
                            $average_note = array_sum(array_column($reviews, 'note')) / $reviews_count;
                            echo number_format($average_note, 1);
                            ?>
                        </div>
                        <div class="text-sm text-gray-600">Note moyenne</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-yellow-600">0</div>
                        <div class="text-sm text-gray-600">Avis utiles</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-gray-600"><?= count(array_unique(array_column($reviews, 'vehicule_id'))) ?></div>
                        <div class="text-sm text-gray-600">Véhicules notés</div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</main>

<script>
    function editReview(id) {
        window.location.href = 'edit-review.php?id=' + id;
    }

    function deleteReview(id) {
        if (confirm('Êtes-vous sûr de vouloir supprimer cet avis ? Cette action est irréversible.')) {
            // AJAX request to delete review
            fetch('delete-review.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ id: id })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Avis supprimé avec succès !');
                    window.location.reload();
                } else {
                    alert('Erreur : ' + data.message);
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
                alert('Une erreur est survenue lors de la suppression');
            });
        }
    }
</script>

<?php include "../includes/footer.php"; ?>