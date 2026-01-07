<?php
include "../classes/Vehicle.php";
include "../classes/Reservation.php";
session_start();



$idVehicle = $_GET["id"];
$Vehicle = Vehicle::find($idVehicle);
$erreur = null;

if (!$Vehicle) {
    header("Location: vehicles.php");
    exit();
}

if (isset($_POST["reserver"])) {

    if (isset($_SESSION["user_id"])) {
        $id = $_SESSION["user_id"];
        $dateDebut = $_POST["dateDebut"];
        $dateFin = $_POST["dateFin"];
        $retour = $_POST["retour"];
        $prise = $_POST["prise"];
        $debut = new DateTime($dateDebut);
        $fin = new DateTime($dateFin);

        if ($fin < $debut) {
            $erreur = "La date de fin doit être après la date de début";
        } else {
            $interval = $debut->diff($fin);
            $nombreJours = $interval->days;
            echo "<br><br><br>" . $nombreJours;

            $nombreJours = $nombreJours + 1;

            $prix_total = $nombreJours * $Vehicle["prix_journalier"];

            $data = [
                'user_id' => $id,
                'vehicule_id' => $idVehicle,
                'date_debut' => $debut->format('Y-m-d'),
                'date_fin' => $fin->format('Y-m-d'),
                'lieu_prise' => $prise,
                'lieu_retour' => $retour,
                'prix_total' => $prix_total
            ];

            $result = Reservation::create($data);
            if ($result) {
                header("location: ../client/reservation/reservation-confirm.php");
                exit;
            }
        }
    } else {
        header("location: login.php");
        exit;
    }
}
include "../includes/header.php";



?>


<!-- Hero Section -->
<section class="vehicle-detail-section text-white">
    <div class="max-w-7xl mx-auto px-4 pt-12 pb-20">
        <nav class="flex mb-8 text-sm font-medium text-white/80">
            <a href="../index.php" class="hover:text-white transition">Accueil</a>
            <span class="mx-3">/</span>
            <a href="vehicles.php" class="hover:text-white transition">Véhicules</a>
            <span class="mx-3">/</span>
            <span class="text-white font-bold"><?= htmlspecialchars($Vehicle["marque"]) ?> <?= htmlspecialchars($Vehicle["modele"]) ?></span>
        </nav>

        <div class="flex flex-col lg:flex-row justify-between items-start lg:items-end gap-8">
            <div>
                <div class="flex items-center gap-3 mb-4">
                    <span class="bg-white/20 backdrop-blur-sm px-4 py-2 rounded-full text-sm font-bold">
                        <?= htmlspecialchars($Vehicle["categorie"]) ?>
                    </span>
                    <span class="flex items-center gap-2 bg-yellow-500/20 px-4 py-2 rounded-full text-sm">
                        <i class="fas fa-star text-yellow-400"></i>
                        <?= htmlspecialchars($Vehicle["note_moyenne"] ?? "4.5") ?> / 5
                    </span>
                </div>
                <h1 class="text-5xl md:text-6xl font-extrabold mb-4 leading-tight">
                    <?= htmlspecialchars($Vehicle["marque"]) ?>
                    <span class="text-blue-200"><?= htmlspecialchars($Vehicle["modele"]) ?></span>
                </h1>
                <p class="text-xl text-white/90 max-w-2xl">
                    <?= htmlspecialchars($Vehicle["annee"]) ?> •
                    <?= htmlspecialchars(ucfirst($Vehicle["carburant"])) ?> •
                    <?= htmlspecialchars($Vehicle["nb_places"]) ?> places
                </p>
            </div>

            <div class="floating-badge bg-white text-slate-900 px-8 py-6 rounded-2xl shadow-2xl">
                <div class="text-center">
                    <p class="text-sm font-bold text-slate-500 mb-1">À partir de</p>
                    <p class="text-4xl font-extrabold text-blue-600"><?= htmlspecialchars($Vehicle["prix_journalier"]) ?>€</p>
                    <p class="text-sm font-medium text-slate-500">/ jour</p>
                </div>
            </div>
        </div>
    </div>
</section>

<main class="max-w-7xl mx-auto px-4 -mt-10 relative z-10">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Gallery -->
            <div class="gallery-main rounded-3xl overflow-hidden shadow-2xl">
                <img src="<?= htmlspecialchars($Vehicle["image_url"]) ?>"
                    alt="<?= htmlspecialchars($Vehicle["marque"] . " " . $Vehicle["modele"]) ?>"
                    class="w-full h-full object-cover">
                <div class="absolute bottom-6 left-6 flex gap-3">
                    <span class="bg-white/90 backdrop-blur-sm px-4 py-2 rounded-full text-sm font-bold shadow-xl">
                        <i class="fas fa-gas-pump mr-2"></i><?= htmlspecialchars(ucfirst($Vehicle["carburant"])) ?>
                    </span>
                    <span class="bg-green-500 text-white px-4 py-2 rounded-full text-sm font-bold shadow-xl">
                        <i class="fas fa-check mr-1"></i>Disponible
                    </span>
                </div>
            </div>

            <!-- Specifications Grid -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="spec-card p-6 rounded-3xl text-center">
                    <i class="fas fa-cogs text-3xl mb-3 text-blue-300"></i>
                    <p class="text-sm font-bold uppercase tracking-wider opacity-90">Transmission</p>
                    <p class="text-xl font-bold"><?= htmlspecialchars($Vehicle["transmission"] ?? "Automatique") ?></p>
                </div>
                <div class="spec-card p-6 rounded-3xl text-center">
                    <i class="fas fa-chair text-3xl mb-3 text-blue-300"></i>
                    <p class="text-sm font-bold uppercase tracking-wider opacity-90">Places</p>
                    <p class="text-xl font-bold"><?= htmlspecialchars($Vehicle["nb_places"]) ?> sièges</p>
                </div>
                <div class="spec-card p-6 rounded-3xl text-center">
                    <i class="fas fa-suitcase text-3xl mb-3 text-blue-300"></i>
                    <p class="text-sm font-bold uppercase tracking-wider opacity-90">Bagages</p>
                    <p class="text-xl font-bold"><?= htmlspecialchars($Vehicle["nb_bagages"] ?? "3") ?> valises</p>
                </div>
                <div class="spec-card p-6 rounded-3xl text-center">
                    <i class="fas fa-tachometer-alt text-3xl mb-3 text-blue-300"></i>
                    <p class="text-sm font-bold uppercase tracking-wider opacity-90">Consommation</p>
                    <p class="text-xl font-bold"><?= htmlspecialchars($Vehicle["consommation"] ?? "5.2") ?> L/100km</p>
                </div>
            </div>

            <!-- Description -->
            <div class="bg-white rounded-3xl p-8 shadow-xl border border-slate-100">
                <h2 class="text-2xl font-extrabold text-slate-900 mb-6 flex items-center gap-3">
                    <i class="fas fa-info-circle text-blue-600"></i>
                    À propos de ce véhicule
                </h2>
                <div class="prose prose-lg max-w-none">
                    <p class="text-slate-700 leading-relaxed text-lg mb-6">
                        <?= htmlspecialchars($Vehicle["description"] ?? "Ce véhicule offre un excellent rapport qualité/prix avec toutes les options modernes pour votre confort et sécurité.") ?>
                    </p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-8">
                        <div class="space-y-3">
                            <h4 class="font-bold text-slate-900 text-lg">Équipements inclus</h4>
                            <ul class="space-y-2">
                                <li class="feature-bullet">Climatisation automatique</li>
                                <li class="feature-bullet">GPS intégré</li>
                                <li class="feature-bullet">Caméra de recul</li>
                                <li class="feature-bullet">Régulateur de vitesse</li>
                            </ul>
                        </div>
                        <div class="space-y-3">
                            <h4 class="font-bold text-slate-900 text-lg">Sécurité</h4>
                            <ul class="space-y-2">
                                <li class="feature-bullet">Airbags multiples</li>
                                <li class="feature-bullet">ABS avec ESP</li>
                                <li class="feature-bullet">Aide au stationnement</li>
                                <li class="feature-bullet">Feux LED automatiques</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Booking Sidebar -->
        <div class="lg:col-span-1">
            <div class="sticky top-28 price-card p-8 rounded-3xl border border-slate-100">
                <div class="flex justify-between items-center mb-8">
                    <div>
                        <h3 class="text-2xl font-extrabold text-slate-900">Réservez maintenant</h3>
                        <p class="text-slate-500 text-sm mt-1">Paiement 100% sécurisé</p>
                    </div>
                    <button class="w-12 h-12 rounded-full border border-slate-200 flex items-center justify-center hover:bg-red-50 hover:text-red-500 transition-all group hover:border-red-200">
                        <i class="far fa-heart text-xl group-hover:fas"></i>
                    </button>
                </div>

                <form class="space-y-6" method="post">
                    <div class="space-y-2">
                        <label class="text-sm font-bold text-slate-700 flex items-center gap-2">
                            <i class="fas fa-map-marker-alt text-blue-600"></i>
                            Lieu de prise en charge
                        </label>
                        <div class="relative">
                            <select name="prise" class="w-full pl-12 pr-4 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition font-medium text-sm appearance-none hover:bg-slate-100">
                                <option value="Paris_Aéroport_CDG">Paris — Aéroport CDG</option>
                                <option value="Lyon_Gare_Part_Dieu">Lyon — Gare Part-Dieu</option>
                                <option value="Bordeaux_Centre">Bordeaux — Centre</option>
                            </select>
                            <i class="fas fa-chevron-down absolute right-5 top-1/2 -translate-y-1/2 text-slate-400"></i>
                        </div>
                    </div>


                    <div class="space-y-2">
                        <label class="text-sm font-bold text-slate-700 flex items-center gap-2">
                            <i class="fas fa-map-marker-alt text-blue-600"></i>
                            Lieu de retour
                        </label>
                        <div class="relative">
                            <select name="retour" class="w-full pl-12 pr-4 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-blue-600 focus:border-blue-600 transition font-medium text-sm appearance-none hover:bg-slate-100">
                                <option value="Paris_Aéroport_CDG">Paris — Aéroport CDG</option>
                                <option value="Lyon_Gare_Part_Dieu">Lyon — Gare Part-Dieu</option>
                                <option value="Bordeaux_Centre">Bordeaux — Centre</option>
                            </select>
                            <i class="fas fa-chevron-down absolute right-5 top-1/2 -translate-y-1/2 text-slate-400"></i>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label class="text-sm font-bold text-slate-700 flex items-center gap-2">
                                <i class="fas fa-calendar-plus text-blue-600"></i>
                                Début
                            </label>
                            <input type="date" name="dateDebut" class="w-full p-4 bg-slate-50 border border-slate-200 rounded-2xl font-medium text-sm focus:ring-2 focus:ring-blue-600 focus:border-blue-600 hover:bg-slate-100">
                        </div>
                        <div class="space-y-2">
                            <label class="text-sm font-bold text-slate-700 flex items-center gap-2">
                                <i class="fas fa-calendar-minus text-blue-600"></i>
                                Fin
                            </label>
                            <input type="date" name="dateFin" class="w-full p-4 bg-slate-50 border border-slate-200 rounded-2xl font-medium text-sm focus:ring-2 focus:ring-blue-600 focus:border-blue-600 hover:bg-slate-100">
                        </div>
                    </div>

                    <!-- Price Summary -->
                    <div class="pt-6 border-t border-slate-200 space-y-3">
                        <div class="flex justify-between items-center text-sm text-slate-600">
                            <span>3 jours × <?= htmlspecialchars($Vehicle["prix_journalier"]) ?>€</span>
                            <span class="font-bold"><?= 3 * $Vehicle["prix_journalier"] ?>€</span>
                        </div>
                        <div class="flex justify-between items-center text-sm text-slate-600">
                            <span>Options</span>
                            <span class="font-bold">0€</span>
                        </div>
                        <div class="flex justify-between items-center text-lg font-bold text-slate-900 pt-3 border-t">
                            <span>Total</span>
                            <span class="text-2xl text-blue-600"><?= 3 * $Vehicle["prix_journalier"] ?>€</span>
                        </div>
                    </div>

                    <!-- CTA Button -->
                    <button type="submit" name="reserver" class="w-full bg-gradient-to-r from-blue-600 to-purple-600 text-white py-5 rounded-2xl font-extrabold text-lg shadow-xl shadow-blue-200 hover:shadow-2xl hover:shadow-blue-300 transition-all transform hover:-translate-y-1 active:scale-95">
                        <i class="fas fa-lock mr-3"></i>
                        Réserver maintenant
                    </button>

                    <p class="text-center text-xs text-slate-500 mt-4">
                        <i class="fas fa-shield-alt mr-1"></i>
                        Réservation sécurisée SSL • Annulation gratuite 48h avant
                    </p>
                </form>

                <!-- Payment Methods -->
                <div class="mt-8 pt-6 border-t border-slate-200">
                    <p class="text-sm font-bold text-slate-700 mb-4">Moyens de paiement acceptés</p>
                    <div class="flex items-center justify-center gap-6 opacity-70">
                        <i class="fab fa-cc-visa text-3xl text-blue-900"></i>
                        <i class="fab fa-cc-mastercard text-3xl text-red-900"></i>
                        <i class="fab fa-cc-amex text-3xl text-blue-800"></i>
                        <i class="fab fa-apple-pay text-3xl text-slate-900"></i>
                    </div>
                </div>
            </div>

            <!-- Assurance Badge -->
            <div class="mt-6 bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 rounded-2xl p-6">
                <div class="flex items-start gap-4">
                    <div class="bg-green-500 text-white p-3 rounded-xl">
                        <i class="fas fa-shield-alt text-xl"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-slate-900">Inclus dans votre réservation</h4>
                        <ul class="mt-2 space-y-1 text-sm text-slate-600">
                            <li class="flex items-center gap-2">
                                <i class="fas fa-check text-green-500"></i>
                                <span>Assurance responsabilité civile</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <i class="fas fa-check text-green-500"></i>
                                <span>Assistance dépannage 24h/24</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <i class="fas fa-check text-green-500"></i>
                                <span>Kilométrage illimité</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<footer class="bg-slate-900 text-slate-400 mt-20 py-12">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <p class="text-sm font-bold uppercase tracking-wider mb-4">Ma<span class="text-blue-400">Bagnole</span></p>
        <p class="text-xs opacity-75">© 2024 Location de véhicules premium. Tous droits réservés.</p>
    </div>
</footer>

<script>
    // Heart toggle animation
    document.querySelector('.fa-heart').parentElement.addEventListener('click', function(e) {
        e.preventDefault();
        const icon = this.querySelector('i');
        icon.classList.toggle('far');
        icon.classList.toggle('fas');

        if (icon.classList.contains('fas')) {
            this.classList.add('bg-red-50', 'text-red-500', 'border-red-200');
            this.classList.remove('border-slate-200');
        } else {
            this.classList.remove('bg-red-50', 'text-red-500', 'border-red-200');
            this.classList.add('border-slate-200');
        }
    });

    // Form validation and calculation
    const form = document.querySelector('form');
    const startDate = form.querySelector('input[type="date"]:first-of-type');
    const endDate = form.querySelector('input[type="date"]:last-of-type');
    const checkboxes = form.querySelectorAll('input[type="checkbox"]');
    const priceElement = form.querySelector('.text-2xl.text-blue-600');
    const basePricePerDay = <?= $Vehicle["prix_journalier"] ?>;

    function calculateTotal() {
        let total = 0;
        const days = Math.max(1, Math.ceil((new Date(endDate.value) - new Date(startDate.value)) / (1000 * 60 * 60 * 24)));

        total += days * basePricePerDay;

        checkboxes.forEach(checkbox => {
            if (checkbox.checked) {
                const priceText = checkbox.closest('label').querySelector('.text-blue-600').textContent;
                const price = parseInt(priceText.match(/\d+/)[0]);
                total += days * price;
            }
        });

        priceElement.textContent = total + '€';
    }

    startDate.addEventListener('change', calculateTotal);
    endDate.addEventListener('change', calculateTotal);
    checkboxes.forEach(checkbox => checkbox.addEventListener('change', calculateTotal));

    // Set default dates (tomorrow and 3 days after)
    const tomorrow = new Date();
    tomorrow.setDate(tomorrow.getDate() + 1);
    startDate.valueAsDate = tomorrow;

    const inThreeDays = new Date();
    inThreeDays.setDate(inThreeDays.getDate() + 4);
    endDate.valueAsDate = inThreeDays;

    // Initialize calculation
    calculateTotal();
</script>

</body>

</html>