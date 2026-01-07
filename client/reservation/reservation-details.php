<?php
include "../../includes/header.php";
include "../../classes/Reservation.php";
include "../../classes/Review.php";

$id_reservation = $_GET["id"];


$reservation = Reservation::find($id_reservation);

$avis = Review::findByUser($_SESSION["user_id"], $id_reservation);
// print_r($avis);
// var_dump($reservation);

$reservation_class = ["en_attente" => "bg-gray-100 text-gray-800", "confirmee" => "bg-green-100 text-green-800", "annulee" => "bg-red-100 text-red-800"]


?>
<!-- Header -->


<!-- Header avec statut -->
<div class="mt-[100px] flex flex-col md:flex-row justify-between items-start md:items-center mb-8">
    <div>
        <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mb-2">Détails de la réservation</h1>
        <p class="text-gray-600"><?= $reservation["marque"] . " " . $reservation["modele"] ?> • Du <?= $reservation["date_debut"] ?> au <?= $reservation["date_fin"] ?></p>
    </div>
    <div class="mt-4 md:mt-0">
        <span class="px-4 py-2 <?= $reservation_class[$reservation["statut"]] ?> rounded-full text-sm font-semibold">
            <?= $reservation["statut"] ?>
        </span>
    </div>
</div>

<!-- Grille principale -->
<div class="grid lg:grid-cols-3 gap-8">
    <!-- Colonne principale -->
    <div class="lg:col-span-2 space-y-8">
        <!-- Détails du véhicule -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h2 class="text-xl font-bold mb-6 flex items-center">
                <i class="fas fa-car text-blue-600 mr-3"></i>
                Véhicule loué
            </h2>

            <div class="flex flex-col md:flex-row gap-6">
                <img src="<?= $reservation["image_url"] ?>"
                    alt="Tesla Model 3"
                    class="w-full md:w-48 h-48 object-cover rounded-lg">

                <div class="flex-grow">
                    <h3 class="text-2xl font-bold mb-2"><?= $reservation["marque"] . " " . $reservation["modele"] ?></h3>
                    <div class="flex flex-wrap gap-2 mb-4">
                        <span class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-sm"><?= $reservation["categorie"] ?></span>
                        <span class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-sm"><?= $reservation["carburant"] ?></span>
                        <span class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-sm"><?= $reservation["nb_places"] ?> places</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Dates et lieu -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h2 class="text-xl font-bold mb-6 flex items-center">
                <i class="fas fa-calendar-alt text-blue-600 mr-3"></i>
                Dates et lieu
            </h2>

            <div class="grid md:grid-cols-3 gap-6">
                <div class="text-center p-4 border border-gray-200 rounded-lg">
                    <div class="text-sm text-gray-500 mb-2">Début</div>
                    <div class="text-2xl font-bold text-blue-600"><?= $reservation["date_debut"] ?></div>
                </div>

                <div class="text-center p-4 border border-gray-200 rounded-lg">
                    <div class="text-sm text-gray-500 mb-2">Durée</div>
                    <?php
                    $debut = new DateTime($reservation["date_debut"]);
                    $fin = new DateTime($reservation["date_fin"]);
                    $interval = $debut->diff($fin);
                    $nombreJours = $interval->days;
                    // echo $id_reservation;
                    // print_r($avis);
                    ?>
                    <div class="text-2xl font-bold text-gray-800"><?= $nombreJours ?></div>
                    <div class="font-medium">jours</div>
                </div>

                <div class="text-center p-4 border border-gray-200 rounded-lg">
                    <div class="text-sm text-gray-500 mb-2">Fin</div>
                    <div class="text-2xl font-bold text-blue-600"><?= $reservation["date_fin"] ?></div>

                </div>
            </div>

            <div class="mt-6 p-4 bg-gray-50 rounded-lg">
                <div class="flex items-start">
                    <i class="fas fa-map-marker-alt text-blue-600 mt-1 mr-3"></i>
                    <div>
                        <div class="font-semibold"><?= $reservation["lieu_priseencharge"] ?></div>
                        <div class="text-sm text-gray-600">123 Avenue des Champs-Élysées, 75008 Paris</div>
                        <div class="text-xs text-gray-500 mt-1">Même lieu de restitution</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section Ajouter un avis -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold flex items-center">
                    <i class="fas fa-star text-yellow-500 mr-3"></i>
                    Votre avis sur cette location
                </h2>

            </div>

            <?php if (!empty($avis)): ?>
                <div class="bg-green-50 border-l-4 border-green-600 p-6 rounded-r-lg mb-6">
                    <div class="flex items-start">
                        <i class="fas fa-check-circle text-green-600 text-2xl mr-4 mt-1"></i>
                        <div>
                            <h3 class="font-bold text-lg mb-2">Vous avez déjà noté cette location</h3>
                            <div class="flex items-center mb-3">
                                <div class="text-yellow-400 mr-3">
                                    <?php for ($i = 0; $i < $avis["note"]; $i++) { ?>
                                        <i class="fas fa-star"></i>
                                    <?php } ?>
                                </div>
                                <span class="font-bold"><?= $avis["note"] ?>/5</span>
                            </div>
                            <p class="text-gray-700 italic mb-3">"<?= $avis["commentaire"] ?>"</p>
                            <div class="text-sm text-gray-500">
                                <i class="far fa-clock mr-1"></i>Publié le <?= $avis["date_creation"] ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex gap-3">
                    <button class="px-5 py-2 border border-blue-600 text-blue-600 rounded-lg hover:bg-blue-50 transition font-medium">
                        <i class="fas fa-edit mr-2"></i>Modifier mon avis
                    </button>
                    <button class="px-5 py-2 border border-red-600 text-red-600 rounded-lg hover:bg-red-50 transition font-medium">
                        <i class="fas fa-trash mr-2"></i>Supprimer mon avis
                    </button>
                </div>
            <?php else: ?>
                <div class="bg-blue-50 border-l-4 border-blue-600 p-6 rounded-r-lg mb-6">
                    <h3 class="font-bold text-lg mb-4">Partagez votre expérience</h3>
                    <p class="text-gray-700 mb-6">Votre avis aide d'autres utilisateurs à faire le bon choix. Soyez honnête et précis dans votre évaluation.</p>

                    <form id="reviewForm" method="post" action="addReview.php">
                        <!-- Note globale -->
                        <div class="mb-6">
                            <label class="block text-gray-700 font-medium mb-3">Note globale</label>
                            <div class="flex items-center space-x-2 mb-2">
                                <div class="text-3xl text-gray-300" id="starsContainer">
                                    <i class="far fa-star hover:text-yellow-400 cursor-pointer" data-rating="1"></i>
                                    <i class="far fa-star hover:text-yellow-400 cursor-pointer" data-rating="2"></i>
                                    <i class="far fa-star hover:text-yellow-400 cursor-pointer" data-rating="3"></i>
                                    <i class="far fa-star hover:text-yellow-400 cursor-pointer" data-rating="4"></i>
                                    <i class="far fa-star hover:text-yellow-400 cursor-pointer" data-rating="5"></i>
                                </div>
                                <span class="text-lg font-bold text-gray-800 ml-4" id="ratingText">0/5</span>
                            </div>
                            <input type="hidden" name="note" id="ratingInput" value="0">
                        </div>

                        <div class="mb-6">

                        </div>

                        <!-- Commentaire -->
                        <div class="mb-6">
                            <label for="comment" class="block text-gray-700 font-medium mb-3">Votre commentaire</label>
                            <textarea id="comment" rows="4" name="comment"
                                class="w-full p-4 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-600 focus:border-transparent outline-none"
                                placeholder="Décrivez votre expérience avec ce véhicule..."></textarea>
                            <p class="text-sm text-gray-500 mt-2">Minimum 20 caractères</p>
                        </div>
                        <input type="hidden" value="<?= $_GET["id"] ?>" name="reservation_id">
                        <input type="hidden" value="<?= $_SESSION["user_id"] ?>" name="user_id">
                        <input type="hidden" value="<?= $reservation["vehicule_id"] ?>" name="vehicule_id">


                        <!-- Boutons -->
                        <div class="flex flex-col sm:flex-row gap-3">
                            <button type="submit" name="add"
                                class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-bold flex-grow">
                                <i class="fas fa-paper-plane mr-2"></i>Publier mon avis
                            </button>
                            <button type="button"
                                class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition">
                                Annuler
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Conseils -->
                <div class="bg-yellow-50 border-l-4 border-yellow-500 p-4 rounded-r-lg">
                    <div class="flex">
                        <i class="fas fa-lightbulb text-yellow-600 text-xl mr-3 mt-1"></i>
                        <div>
                            <h4 class="font-bold mb-1">Conseils pour un bon avis</h4>
                            <ul class="text-sm text-gray-700 space-y-1">
                                <li>• Soyez précis et honnête dans votre évaluation</li>
                                <li>• Mentionnez les points forts et les points à améliorer</li>
                                <li>• Ajoutez des photos si possible pour illustrer votre expérience</li>
                                <li>• Votre avis reste anonyme vis-à-vis du propriétaire</li>
                            </ul>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="lg:col-span-1 space-y-8">
        <!-- Résumé de prix -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-lg font-bold mb-6 flex items-center">
                <i class="fas fa-receipt text-blue-600 mr-3"></i>
                Récapitulatif
            </h3>

            <div class="space-y-3">
                <div class="flex justify-between">
                    <span class="text-gray-600">Location (<?= $nombreJours ?> jours)</span>
                    <span class="font-medium"><?=  $avis["prix_journalier"] ?> €/jour</span>
                </div>
                
                <div class="border-t pt-3 mt-3">
                    <div class="flex justify-between font-bold text-lg">
                        <span>Total</span>
                        <span class="text-blue-600"><?= $nombreJours * $avis["prix_journalier"] ?> €</span>
                    </div>
                </div>
            </div>

            <div class="mt-6 pt-6 border-t">
                <div class="text-sm text-gray-600 mb-2">Mode de paiement</div>
                <div class="flex items-center">
                    <i class="fab fa-cc-visa text-2xl text-blue-900 mr-3"></i>
                    <div>
                        <div class="font-medium">Visa •••• 4321</div>
                        <div class="text-sm text-gray-500">Payé le 14/03/2024</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Actions rapides -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <h3 class="text-lg font-bold mb-6">Actions</h3>
            <div class="space-y-3">
                <a href="#" class="flex items-center p-3 border border-gray-200 rounded-lg hover:bg-gray-50 transition">
                    <i class="fas fa-file-invoice text-blue-600 mr-3"></i>
                    <div>
                        <div class="font-medium">Télécharger facture</div>
                        <div class="text-sm text-gray-500">PDF</div>
                    </div>
                </a>
                <a href="#" class="flex items-center p-3 border border-gray-200 rounded-lg hover:bg-gray-50 transition">
                    <i class="fas fa-file-contract text-green-600 mr-3"></i>
                    <div>
                        <div class="font-medium">Contrat de location</div>
                        <div class="text-sm text-gray-500">PDF</div>
                    </div>
                </a>
                <button class="w-full flex items-center p-3 border border-red-200 text-red-600 rounded-lg hover:bg-red-50 transition">
                    <i class="fas fa-flag mr-3"></i>
                    <div class="font-medium">Signaler un problème</div>
                </button>
            </div>
        </div>

        <!-- Assistance -->
        <div class="bg-blue-50 border-l-4 border-blue-600 p-6 rounded-r-lg">
            <h3 class="text-lg font-bold mb-4">Besoin d'aide ?</h3>
            <p class="text-gray-700 mb-4">Notre équipe est là pour vous aider avec votre réservation.</p>
            <div class="space-y-3">
                <a href="tel:+33123456789" class="flex items-center text-blue-600 hover:text-blue-800">
                    <i class="fas fa-phone mr-3"></i>
                    <span>01 23 45 67 89</span>
                </a>
                <a href="mailto:support@mabagnole.com" class="flex items-center text-blue-600 hover:text-blue-800">
                    <i class="fas fa-envelope mr-3"></i>
                    <span>support@mabagnole.com</span>
                </a>
            </div>
        </div>
    </div>
</div>
</main>

<!-- Footer -->
<footer class="bg-gray-50 border-t py-12 text-center text-gray-400 text-sm">
    &copy; 2024 MaBagnole.
</footer>

<script>
    // Gestion des étoiles de notation
    const stars = document.querySelectorAll('#starsContainer .fa-star');
    const ratingInput = document.getElementById('ratingInput');
    const ratingText = document.getElementById('ratingText');

    stars.forEach(star => {
        // star.addEventListener('mouseover', function() {
        //     const rating = this.getAttribute('data-rating');
        //     highlightStars(rating);
        // });

        star.addEventListener('click', function() {
            const rating = this.getAttribute('data-rating');
            ratingInput.value = rating;
            ratingText.textContent = rating + '/5';
            highlightStars(rating);
        });
    });

    function highlightStars(rating) {
        stars.forEach(star => {
            const starRating = star.getAttribute('data-rating');
            if (starRating <= rating) {
                star.classList.remove('far', 'text-gray-300');
                star.classList.add('fas', 'text-yellow-400');
            } else {
                star.classList.remove('fas', 'text-yellow-400');
                star.classList.add('far', 'text-gray-300');
            }
        });
    }

    // Gestion des sliders de critères
    const sliders = ['vehicleState', 'cleanliness', 'service'];
    sliders.forEach(sliderId => {
        const slider = document.getElementById(sliderId);
        const valueDisplay = document.getElementById(sliderId + 'Value');

        slider.addEventListener('input', function() {
            valueDisplay.textContent = this.value + '/5';
        });
    });

    // Gestion du formulaire
    document.getElementById('reviewForm').addEventListener('submit', function(e) {
        e.preventDefault();

        if (ratingInput.value === '0') {
            alert('Veuillez donner une note avant de soumettre votre avis.');
            return;
        }

        const comment = document.getElementById('comment').value;
        if (comment.length < 20) {
            alert('Votre commentaire doit contenir au moins 20 caractères.');
            return;
        }

        // Simulation d'envoi
        alert('Merci ! Votre avis a été soumis avec succès.');
        window.location.reload();
    });
</script>
</body>

</html>