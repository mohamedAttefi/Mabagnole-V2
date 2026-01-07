<?php
require_once '../../classes/Reservation.php';
require_once '../../classes/Vehicle.php';
require_once '../../classes/Utilisateur.php';
require_once '../../includes/header.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$userId = $_SESSION['user_id'];
$pendingReservations = Reservation::findPendingByUser($userId);
?>



    <main class="max-w-7xl mx-auto px-4 py-8">
        <!-- Header -->
        <div class="mb-8">
            <nav class="flex mb-6 text-sm font-medium text-slate-500">
                <a href="../index.php" class="hover:text-blue-600 transition">Accueil</a>
                <span class="mx-3">/</span>
                <a href="profile.php" class="hover:text-blue-600 transition">Mon compte</a>
                <span class="mx-3">/</span>
                <span class="text-slate-900 font-bold">Réservations en attente</span>
            </nav>
            
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                <div>
                    <h1 class="text-3xl font-extrabold text-slate-900 mb-2">
                        <i class="fas fa-clock text-amber-500 mr-3"></i>
                        Réservations en attente
                    </h1>
                    <p class="text-slate-600">
                        Suivez l'état de vos demandes de réservation
                    </p>
                </div>
                
                <div class="flex items-center gap-4">
                    <a href="my-reservations.php"
                       class="bg-white border border-slate-200 text-slate-700 px-6 py-3 rounded-xl font-bold hover:bg-slate-50 transition flex items-center gap-2">
                        <i class="fas fa-list"></i>
                        Toutes mes réservations
                    </a>
                    <a href="vehicles.php" 
                       class="bg-blue-600 text-white px-6 py-3 rounded-xl font-bold hover:bg-blue-700 transition shadow-lg shadow-blue-200 flex items-center gap-2">
                        <i class="fas fa-plus"></i>
                        Nouvelle réservation
                    </a>
                </div>
            </div>
        </div>

        <!-- Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-gradient-to-r from-amber-500 to-yellow-500 text-white p-6 rounded-2xl shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-bold opacity-90">EN ATTENTE</p>
                        <p class="text-3xl font-extrabold mt-2">
                            <?php echo count($pendingReservations); ?>
                        </p>
                    </div>
                    <i class="fas fa-clock text-4xl opacity-80"></i>
                </div>
            </div>
            
            <div class="bg-gradient-to-r from-emerald-500 to-green-500 text-white p-6 rounded-2xl shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-bold opacity-90">CONFIRMÉES</p>
                        <p class="text-3xl font-extrabold mt-2">
                            <?php echo count(Reservation::countByStatusAndUser($userId, 'confirmee')); ?>
                        </p>
                    </div>
                    <i class="fas fa-check-circle text-4xl opacity-80"></i>
                </div>
            </div>
            
            <div class="bg-gradient-to-r from-slate-600 to-slate-800 text-white p-6 rounded-2xl shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-bold opacity-90">TOTAL</p>
                        <p class="text-3xl font-extrabold mt-2">
                            <?php echo count(Reservation::findByUser($userId)); ?>
                        </p>
                    </div>
                    <i class="fas fa-receipt text-4xl opacity-80"></i>
                </div>
            </div>
        </div>

        <!-- Liste des réservations -->
        <div class="space-y-6">
            <!-- En-tête -->
            <div class="flex items-center justify-between bg-slate-50 p-4 rounded-xl border border-slate-200">
                <div class="flex items-center gap-3">
                    <div class="pending-badge">
                        <span class="bg-amber-500 text-white text-xs font-bold px-3 py-1.5 rounded-full">
                            <i class="fas fa-clock mr-1"></i> EN ATTENTE
                        </span>
                    </div>
                    <p class="text-sm text-slate-600">
                        <span class="font-bold text-slate-900"><?php echo count($pendingReservations); ?></span> réservation(s) en attente de confirmation
                    </p>
                </div>
                
                <div class="text-sm text-slate-500">
                    <i class="fas fa-info-circle mr-2"></i>
                    Délai moyen : 24-48h
                </div>
            </div>

            <?php if (empty($pendingReservations)): ?>
            <!-- État vide -->
            <div class="empty-state text-white rounded-2xl p-12 text-center shadow-xl">
                <div class="max-w-md mx-auto">
                    <div class="w-24 h-24 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-calendar-check text-4xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-4">Aucune réservation en attente</h3>
                    <p class="text-white/90 mb-8">
                        Vous n'avez actuellement aucune réservation en attente de confirmation.
                        Profitez-en pour découvrir nos nouveaux véhicules !
                    </p>
                    <a href="vehicles.php" 
                       class="inline-block bg-white text-slate-900 px-8 py-4 rounded-xl font-bold text-lg hover:bg-slate-100 transition shadow-lg">
                        <i class="fas fa-car mr-3"></i>
                        Explorer les véhicules
                    </a>
                </div>
            </div>
            <?php else: ?>
            <!-- Liste des réservations -->
            <?php foreach ($pendingReservations as $reservation):
                $vehicle = Vehicle::find($reservation['vehicule_id']);
                $totalPrice = $reservation['prix_total'];
                $days = ceil((strtotime($reservation['date_fin']) - strtotime($reservation['date_debut'])) / (60 * 60 * 24)) + 1;
            ?>
            <div class="reservation-card status-pending bg-white rounded-2xl p-6 shadow-lg border border-slate-100">
                <div class="flex flex-col lg:flex-row gap-6">
                    <!-- Image du véhicule -->
                    <div class="lg:w-1/4">
                        <div class="rounded-xl overflow-hidden h-48">
                            <?php if ($vehicle && !empty($vehicle['image_url'])): ?>
                            <img src="<?php echo htmlspecialchars($vehicle['image_url']); ?>" 
                                 alt="<?php echo htmlspecialchars($vehicle['marque'] . ' ' . $vehicle['modele']); ?>"
                                 class="w-full h-full object-cover hover:scale-105 transition duration-500">
                            <?php else: ?>
                            <div class="w-full h-full bg-gradient-to-r from-blue-100 to-purple-100 flex items-center justify-center">
                                <i class="fas fa-car text-slate-400 text-4xl"></i>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <!-- Détails de la réservation -->
                    <div class="lg:w-2/4 space-y-4">
                        <!-- En-tête -->
                        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                            <div>
                                <h3 class="text-xl font-bold text-slate-900">
                                    <?php echo $vehicle ? htmlspecialchars($vehicle['marque'] . ' ' . $vehicle['modele']) : 'Véhicule inconnu'; ?>
                                </h3>
                                <p class="text-slate-500 text-sm mt-1">
                                    Réservation #<?php echo htmlspecialchars($reservation['id']); ?>
                                </p>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="bg-amber-100 text-amber-800 text-xs font-bold px-3 py-1.5 rounded-full">
                                    <i class="fas fa-clock mr-1"></i>
                                    <?php echo strtoupper($reservation['statut']); ?>
                                </span>
                            </div>
                        </div>
                        
                        <!-- Dates et lieux -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm font-bold text-slate-700 mb-1">Dates</p>
                                <div class="flex items-center gap-2 text-slate-600">
                                    <i class="fas fa-calendar-day text-blue-600"></i>
                                    <span>
                                        <?php echo date('d/m/Y', strtotime($reservation['date_debut'])); ?> 
                                        → 
                                        <?php echo date('d/m/Y', strtotime($reservation['date_fin'])); ?>
                                    </span>
                                    <span class="text-sm text-slate-500">(<?php echo $days; ?> jours)</span>
                                </div>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-slate-700 mb-1">Lieu</p>
                                <div class="flex items-center gap-2 text-slate-600">
                                    <i class="fas fa-map-marker-alt text-blue-600"></i>
                                    <span><?php echo htmlspecialchars($reservation['lieu_priseencharge']); ?></span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Informations supplémentaires -->
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            
                            <div class="text-center">
                                <p class="text-xs text-slate-500 mb-1">Total</p>
                                <p class="font-bold text-slate-900">
                                    <?php echo number_format($totalPrice, 0, ',', ' '); ?>€
                                </p>
                            </div>
                            <div class="text-center">
                                <p class="text-xs text-slate-500 mb-1">Créée le</p>
                                <p class="font-bold text-slate-900">
                                    <?php echo date('d/m/Y', strtotime($reservation['date_creation'])); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Actions -->
                    <div class="lg:w-1/4 border-t lg:border-t-0 lg:border-l border-slate-200 lg:pl-6 pt-6 lg:pt-0">
                        <div class="space-y-3">
                            <button onclick="viewReservationDetails(<?php echo $reservation['id']; ?>)"
                                    class="w-full bg-blue-600 text-white py-3 rounded-xl font-bold hover:bg-blue-700 transition flex items-center justify-center gap-2">
                                <i class="fas fa-eye"></i>
                                Voir les détails
                            </button>
                            
                            <button onclick="confirmCancellation(<?php echo $reservation['id']; ?>)"
                                    class="w-full bg-white border border-red-200 text-red-600 py-3 rounded-xl font-bold hover:bg-red-50 transition flex items-center justify-center gap-2">
                                <i class="fas fa-times"></i>
                                Annuler
                            </button>
                            
                            <a href="vehicles.php?vehicle_id=<?php echo $reservation['vehicule_id']; ?>" 
                               class="w-full bg-slate-100 text-slate-700 py-3 rounded-xl font-bold hover:bg-slate-200 transition flex items-center justify-center gap-2">
                                <i class="fas fa-car"></i>
                                Voir le véhicule
                            </a>
                            
                            <div class="pt-3 border-t border-slate-200">
                                <p class="text-xs text-slate-500 text-center">
                                    <i class="fas fa-info-circle mr-1"></i>
                                    En attente de confirmation
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <!-- Informations -->
        <div class="mt-12 bg-blue-50 border border-blue-200 rounded-2xl p-8">
            <h3 class="text-xl font-bold text-slate-900 mb-4 flex items-center gap-3">
                <i class="fas fa-question-circle text-blue-600"></i>
                Comment fonctionne le processus de réservation ?
            </h3>
            <div class="grid md:grid-cols-3 gap-6">
                <div class="space-y-3">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold">1</div>
                        <h4 class="font-bold text-slate-900">Demande soumise</h4>
                    </div>
                    <p class="text-slate-600 text-sm">
                        Votre demande est envoyée à notre équipe pour vérification de disponibilité.
                    </p>
                </div>
                <div class="space-y-3">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold">2</div>
                        <h4 class="font-bold text-slate-900">Vérification</h4>
                    </div>
                    <p class="text-slate-600 text-sm">
                        Nous vérifions la disponibilité du véhicule et vos informations.
                    </p>
                </div>
                <div class="space-y-3">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold">3</div>
                        <h4 class="font-bold text-slate-900">Confirmation</h4>
                    </div>
                    <p class="text-slate-600 text-sm">
                        Vous recevez une confirmation par email dans les 24-48 heures.
                    </p>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-slate-900 text-slate-400 mt-20 py-12">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p class="text-sm font-bold uppercase tracking-wider mb-4">Ma<span class="text-blue-400">Bagnole</span></p>
            <p class="text-xs opacity-75">© 2024 Location de véhicules premium. Tous droits réservés.</p>
        </div>
    </footer>

    <!-- Modals -->
    <div id="detailsModal" class="hidden fixed inset-0 bg-black/50 z-[1000] flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
            <div class="p-6">
                <!-- Modal content will be loaded via AJAX -->
            </div>
        </div>
    </div>

    <script>
        // Voir les détails d'une réservation
        function viewReservationDetails(reservationId) {
            // Simuler le chargement des détails
            const modal = document.getElementById('detailsModal');
            const modalContent = modal.querySelector('.p-6');
            
            modalContent.innerHTML = `
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-bold text-slate-900">Détails de la réservation</h3>
                    <button onclick="closeModal()" class="text-slate-400 hover:text-slate-600">
                        <i class="fas fa-times text-2xl"></i>
                    </button>
                </div>
                <div class="text-center py-12">
                    <i class="fas fa-spinner fa-spin text-4xl text-blue-600 mb-4"></i>
                    <p class="text-slate-600">Chargement des détails...</p>
                </div>
            `;
            
            modal.classList.remove('hidden');
            
            // Simuler une requête AJAX
            setTimeout(() => {
                modalContent.innerHTML = `
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-bold text-slate-900">Détails de la réservation #${reservationId}</h3>
                        <button onclick="closeModal()" class="text-slate-400 hover:text-slate-600">
                            <i class="fas fa-times text-2xl"></i>
                        </button>
                    </div>
                    <div class="space-y-4">
                        <div class="bg-slate-50 p-4 rounded-xl">
                            <h4 class="font-bold text-slate-900 mb-2">Statut actuel</h4>
                            <p class="text-amber-600 font-bold">
                                <i class="fas fa-clock mr-2"></i>
                                EN ATTENTE DE CONFIRMATION
                            </p>
                        </div>
                        <p>Les détails complets seront disponibles ici.</p>
                    </div>
                `;
            }, 1000);
        }

        // Confirmer l'annulation
        function confirmCancellation(reservationId) {
            if (confirm("Êtes-vous sûr de vouloir annuler cette réservation ?")) {
                // Simuler l'annulation
                alert(`Réservation #${reservationId} annulée avec succès !`);
                // Rediriger ou recharger la page
                setTimeout(() => {
                    window.location.reload();
                }, 1500);
            }
        }

        // Fermer le modal
        function closeModal() {
            document.getElementById('detailsModal').classList.add('hidden');
        }

        // Fermer le modal en cliquant à l'extérieur
        document.getElementById('detailsModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });

        // Rafraîchir automatiquement toutes les 30 secondes
        setInterval(() => {
            const pendingBadges = document.querySelectorAll('.pending-badge');
            pendingBadges.forEach(badge => {
                badge.style.animation = 'none';
                setTimeout(() => {
                    badge.style.animation = 'pulse 2s infinite';
                }, 10);
            });
        }, 30000);
    </script>

</body>
</html>