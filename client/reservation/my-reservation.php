<?php
require_once '../../classes/Reservation.php';
require_once '../../classes/Vehicle.php';
require_once '../../includes/header.php';

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$userId = $_SESSION['user_id'];

$filter = $_GET['filter'] ?? 'all';
$statusMap = [
    'all' => null,
    'pending' => 'pending',
    'active' => 'confirmed',
    'completed' => 'completed',
    'cancelled' => 'cancelled'
];

$reservations = Reservation::findByUser($userId);


// Statistiques
$stats = [
    'all' => count($reservations),
    'pending' => count(Reservation::countByStatusAndUser($userId, 'en_attente')),
    'active' => count(Reservation::countByStatusAndUser($userId, 'confirmee')),
    'completed' => count(Reservation::countByStatusAndUser($userId, 'annulee'))
];
?>

<!DOCTYPE html>
<html lang="fr" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes réservations - MaBagnole</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #F8FAFC;
        }

        .glass-nav {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
        }

        .reservation-card {
            transition: all 0.3s ease;
            border-left: 4px solid transparent;
        }

        .reservation-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
        }

        .status-en_attente {
            border-left-color: #f59e0b;
            background: linear-gradient(to right, #fffbeb, #ffffff);
        }

        .status-confirmee {
            border-left-color: #3b82f6;
            background: linear-gradient(to right, #eff6ff, #ffffff);
        }


        .status-cancelled {
            border-left-color: #ef4444;
            background: linear-gradient(to right, #fef2f2, #ffffff);
        }

        .empty-state {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .filter-active {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            color: white;
            border-color: #3b82f6;
        }

        .progress-bar {
            transition: width 0.6s ease;
        }

        .card-hover:hover {
            transform: translateY(-5px);
        }
    </style>
</head>

<body class="bg-[#F8FAFC] text-slate-900">
    <main class="pt-24 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

            <!-- Sidebar Navigation -->
            <aside class="lg:col-span-3">
                <div class="space-y-6 sticky top-24">
                    <!-- User Profile Card -->
                    <div class="bg-gradient-to-br from-blue-600 to-purple-600 rounded-2xl p-6 text-white shadow-xl">
                        <div class="flex items-center gap-4 mb-6">
                            <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center">
                                <i class="fas fa-user text-2xl"></i>
                            </div>
                            <div>
                                <h2 class="text-xl font-bold">Bonjour, <?php echo htmlspecialchars($_SESSION['user_nom'] ?? 'Utilisateur'); ?></h2>
                                <p class="text-blue-100 text-sm">Client depuis <?php echo date('Y', strtotime($_SESSION['date_creation'] ?? '2024')); ?></p>
                            </div>
                        </div>
                        <div class="grid grid-cols-3 gap-4 text-center">
                            <div>
                                <div class="text-2xl font-bold"><?php echo $stats['all']; ?></div>
                                <div class="text-xs opacity-90">Total</div>
                            </div>
                            <div>
                                <div class="text-2xl font-bold"><?php echo $stats['active']; ?></div>
                                <div class="text-xs opacity-90">Actives</div>
                            </div>
                            <div>
                                <div class="text-2xl font-bold"><?php echo $stats['pending']; ?></div>
                                <div class="text-xs opacity-90">En attente</div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Stats -->
                    <div class="bg-white rounded-2xl shadow-lg border border-slate-100 p-6">
                        <h3 class="font-bold text-slate-900 mb-4">Vue d'ensemble</h3>
                        <div class="space-y-4">
                            <div>
                                <div class="flex justify-between text-sm mb-1">
                                    <span class="text-slate-600">Confirmées</span>
                                    <span class="font-bold"><?php echo $stats['active']; ?></span>
                                </div>
                                <div class="w-full bg-slate-200 rounded-full h-2">
                                    <div class="bg-blue-500 h-2 rounded-full" style="width: <?php echo ($stats['active'] / max($stats['all'], 1)) * 100; ?>%"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between text-sm mb-1">
                                    <span class="text-slate-600">En attente</span>
                                    <span class="font-bold"><?php echo $stats['pending']; ?></span>
                                </div>
                                <div class="w-full bg-slate-200 rounded-full h-2">
                                    <div class="bg-amber-500 h-2 rounded-full" style="width: <?php echo ($stats['pending'] / max($stats['all'], 1)) * 100; ?>%"></div>
                                </div>
                            </div>
                            <div>
                                <div class="flex justify-between text-sm mb-1">
                                    <span class="text-slate-600">Terminées</span>
                                    <span class="font-bold"><?php echo $stats['completed']; ?></span>
                                </div>
                                <div class="w-full bg-slate-200 rounded-full h-2">
                                    <div class="bg-green-500 h-2 rounded-full" style="width: <?php echo ($stats['completed'] / max($stats['all'], 1)) * 100; ?>%"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Help Card -->
                    <div class="bg-gradient-to-r from-emerald-500 to-green-600 text-white rounded-2xl p-6">
                        <div class="flex items-start gap-4">
                            <div class="bg-white/20 p-3 rounded-xl">
                                <i class="fas fa-question-circle text-xl"></i>
                            </div>
                            <div>
                                <h4 class="font-bold mb-2">Besoin d'aide ?</h4>
                                <p class="text-sm opacity-90 mb-3">Notre équipe est là pour vous accompagner</p>
                                <a href="contact.php" class="inline-block bg-white text-emerald-600 px-4 py-2 rounded-lg text-sm font-bold hover:bg-emerald-50 transition">
                                    Contactez-nous
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </aside>

            <!-- Main Content -->
            <div class="lg:col-span-9 space-y-8">
                <!-- Header -->
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                    <div>
                        <h1 class="text-3xl font-extrabold text-slate-900">Mes réservations</h1>
                        <p class="text-slate-600 mt-2">Gérez et suivez toutes vos locations</p>
                    </div>

                    <div class="flex flex-wrap gap-3">
                        <a href="vehicles.php"
                            class="px-5 py-2.5 bg-blue-600 text-white rounded-xl font-bold hover:bg-blue-700 transition flex items-center gap-2 shadow-lg shadow-blue-200">
                            <i class="fas fa-plus"></i>
                            Nouvelle réservation
                        </a>
                        <a href="pending-reservations.php"
                            class="px-5 py-2.5 bg-amber-500 text-white rounded-xl font-bold hover:bg-amber-600 transition flex items-center gap-2 shadow-lg shadow-amber-200">
                            <i class="fas fa-clock"></i>
                            En attente (<?php echo $stats['pending']; ?>)
                        </a>
                    </div>
                </div>



                <!-- Reservations List -->
                <div class="space-y-6">
                    <?php if (empty($reservations)): ?>
                        <!-- Empty State -->
                        <div class="empty-state text-white rounded-2xl p-12 text-center shadow-xl">
                            <div class="max-w-md mx-auto">
                                <div class="w-24 h-24 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-6">
                                    <i class="fas fa-calendar-times text-4xl"></i>
                                </div>
                                <h3 class="text-2xl font-bold mb-4">Aucune réservation trouvée</h3>
                                <p class="text-white/90 mb-8">
                                    <?php if ($filter != 'all'): ?>
                                        Vous n'avez aucune réservation avec le statut "<?php echo $filter; ?>".
                                    <?php else: ?>
                                        Vous n'avez pas encore effectué de réservation.
                                    <?php endif; ?>
                                </p>
                                <a href="vehicles.php"
                                    class="inline-block bg-white text-slate-900 px-8 py-4 rounded-xl font-bold text-lg hover:bg-slate-100 transition shadow-lg">
                                    <i class="fas fa-car mr-3"></i>
                                    Explorer les véhicules
                                </a>
                            </div>
                        </div>
                    <?php else: ?>

                        <?php foreach ($reservations as $reservation):
                            $vehicle = Vehicle::find($reservation['vehicule_id']);
                            $status = $reservation['statut'];
                            $statusClass = 'status-' . $status;
                            $days = ceil((strtotime($reservation['date_fin']) - strtotime($reservation['date_debut'])) / (60 * 60 * 24)) + 1;
                            $now = time();
                            $pickupTime = strtotime($reservation['date_debut']);
                            $returnTime = strtotime($reservation['date_fin']);
                            $progressPercent = 0;

                            if ($now >= $pickupTime && $now <= $returnTime) {
                                $totalDuration = $returnTime - $pickupTime;
                                $elapsed = $now - $pickupTime;
                                $progressPercent = min(100, max(0, ($elapsed / $totalDuration) * 100));
                            } elseif ($now > $returnTime) {
                                $progressPercent = 100;
                            }
                        ?>
                            <div class="reservation-card <?php echo $statusClass; ?> bg-white rounded-2xl p-6 shadow-lg border border-slate-100">
                                <div class="flex flex-col md:flex-row gap-6">
                                    <!-- Vehicle Image -->
                                    <div class="md:w-1/4">
                                        <div class="relative rounded-xl overflow-hidden h-48">
                                            <?php if ($vehicle && !empty($vehicle['image_url'])): ?>
                                                <img src="<?php echo htmlspecialchars($vehicle['image_url']); ?>"
                                                    alt="<?php echo htmlspecialchars($vehicle['marque'] . ' ' . $vehicle['modele']); ?>"
                                                    class="w-full h-full object-cover hover:scale-105 transition duration-500">
                                            <?php else: ?>
                                                <div class="w-full h-full bg-gradient-to-r from-blue-100 to-purple-100 flex items-center justify-center">
                                                    <i class="fas fa-car text-slate-400 text-4xl"></i>
                                                </div>
                                            <?php endif; ?>
                                            <div class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm text-slate-900 text-xs font-bold px-3 py-1.5 rounded-full">
                                                <?php echo strtoupper($status); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Reservation Details -->
                                    <div class="md:w-2/3 space-y-4">
                                        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                                            <div>
                                                <h3 class="text-xl font-bold text-slate-900">
                                                    <?php echo $vehicle ? htmlspecialchars($vehicle['marque'] . ' ' . $vehicle['modele']) : 'Véhicule inconnu'; ?>
                                                    <span class="text-slate-500 font-normal text-sm">#<?php echo htmlspecialchars($reservation['id']); ?></span>
                                                </h3>
                                                <p class="text-slate-600 text-sm mt-1">
                                                    <?php echo date('d/m/Y', strtotime($reservation['date_debut'])); ?>
                                                    →
                                                    <?php echo date('d/m/Y', strtotime($reservation['date_fin'])); ?>
                                                    (<?php echo $days; ?> jours)
                                                </p>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <span class="text-2xl font-extrabold text-blue-600">
                                                    <?php echo number_format($reservation['prix_total'], 0, ',', ' '); ?>€
                                                </span>
                                            </div>
                                        </div>

                                        <!-- Details Grid -->
                                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                            <div class=" space-y-1">
                                                <p class="text-xs text-slate-500">Lieu de départ</p>
                                                <p class="text-sm flex items-center gap-2">
                                                    <i class="fas fa-map-marker-alt text-blue-600"></i>
                                                    <?php echo htmlspecialchars($reservation['lieu_priseencharge']); ?>
                                                </p>
                                            </div>

                                            <div class="ml-[50px] space-y-1">
                                                <p class="text-xs text-slate-500">Créée le</p>
                                                <p class="text-sm">
                                                    <?php echo date('d/m/Y', strtotime($reservation['date_creation'])); ?>
                                                </p>
                                            </div>

                                        </div>

                                        <?php if ($status == 'confirmee'): ?>
                                            <div class="pt-4">
                                                <div class="flex justify-between text-sm text-slate-600 mb-2">
                                                    <span>Début: <?php echo date('d/m', strtotime($reservation['date_debut'])); ?></span>
                                                    <span>Fin: <?php echo date('d/m', strtotime($reservation['date_fin'])); ?></span>
                                                </div>
                                                <div class="w-full bg-slate-200 rounded-full h-2">
                                                    <div class="progress-bar bg-green-500 h-2 rounded-full" style="width: <?php echo $progressPercent; ?>%"></div>
                                                </div>
                                                <?php if ($progressPercent > 0 && $progressPercent < 100): ?>
                                                    <p class="text-xs text-slate-500 mt-2 text-center">
                                                        <?php echo round($progressPercent); ?>% du temps écoulé
                                                    </p>
                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                    <!-- Actions -->
                                    <div class="md:w-1/4 border-t md:border-t-0 md:border-l border-slate-200 md:pl-6 pt-6 md:pt-0">
                                        <div class="space-y-3">
                                            <a href="reservation-details.php?id=<?php echo $reservation['id']; ?>"
                                                class="w-full bg-blue-600 text-white py-3 rounded-xl font-bold hover:bg-blue-700 transition flex items-center justify-center gap-2">
                                                <i class="fas fa-eye"></i>
                                                Voir détails
                                            </a>

                                            <?php if ($status == 'en_attente'): ?>
                                                <button onclick="cancelReservation(<?php echo $reservation['id']; ?>)"
                                                    class="w-full bg-white border border-red-200 text-red-600 py-3 rounded-xl font-bold hover:bg-red-50 transition flex items-center justify-center gap-2">
                                                    <i class="fas fa-times"></i>
                                                    Annuler
                                                </button>
                                            <?php elseif ($status == 'confirmee'): ?>
                                                <a href="review.php?reservation_id=<?php echo $reservation['id']; ?>"
                                                    class="w-full bg-amber-500 text-white py-3 rounded-xl font-bold hover:bg-amber-600 transition flex items-center justify-center gap-2">
                                                    <i class="fas fa-star"></i>
                                                    Noter
                                                </a>
                                                <a href="invoice.php?id=<?php echo $reservation['id']; ?>"
                                                    class="w-full bg-slate-900 text-white py-3 rounded-xl font-bold hover:bg-slate-800 transition flex items-center justify-center gap-2">
                                                    <i class="fas fa-download"></i>
                                                    Facture
                                                </a>
                                            <?php elseif ($status == 'confirmee'): ?>
                                                <a href="vehicles.php?vehicle_id=<?php echo $reservation['vehicule_id']; ?>"
                                                    class="w-full bg-slate-100 text-slate-700 py-3 rounded-xl font-bold hover:bg-slate-200 transition flex items-center justify-center gap-2">
                                                    <i class="fas fa-car"></i>
                                                    Relouer
                                                </a>

                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

                <!-- Pagination -->

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

    <script>
        // Gestion de l'annulation de réservation
        function cancelReservation(reservationId) {
            if (confirm("Êtes-vous sûr de vouloir annuler cette réservation ? Cette action est irréversible.")) {
                fetch(`cancel-reservation.php?id=${reservationId}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert(data.message);
                            window.location.reload();
                        } else {
                            alert('Erreur: ' + data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Une erreur est survenue lors de l\'annulation.');
                    });
            }
        }

        // Animation des barres de progression
        document.addEventListener('DOMContentLoaded', function() {
            const progressBars = document.querySelectorAll('.progress-bar');
            progressBars.forEach(bar => {
                const width = bar.style.width;
                bar.style.width = '0%';
                setTimeout(() => {
                    bar.style.width = width;
                }, 300);
            });

            // Animation des cartes
            const cards = document.querySelectorAll('.reservation-card');
            cards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    card.style.transition = 'all 0.6s ease';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, index * 100);
            });
        });

        // Toggle mobile menu (si présent dans cette page)
        const mobileMenuToggle = document.getElementById('mobileMenuToggle');
        const mobileMenu = document.getElementById('mobileMenu');

        if (mobileMenuToggle && mobileMenu) {
            mobileMenuToggle.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
            });

            // Close mobile menu when clicking outside
            document.addEventListener('click', function(event) {
                if (!mobileMenu.contains(event.target) && !mobileMenuToggle.contains(event.target) && !mobileMenu.classList.contains('hidden')) {
                    mobileMenu.classList.add('hidden');
                }
            });
        }

        // Update progress bars in real-time for active reservations
        setInterval(() => {
            const activeBars = document.querySelectorAll('.progress-bar[style*="width:"]');
            activeBars.forEach(bar => {
                const currentWidth = parseFloat(bar.style.width);
                if (currentWidth < 100) {
                    const newWidth = Math.min(100, currentWidth + 0.1);
                    bar.style.width = newWidth + '%';

                    // Update percentage text if exists
                    const parentDiv = bar.closest('div');
                    const percentText = parentDiv?.querySelector('.text-xs.text-center');
                    if (percentText && percentText.textContent.includes('%')) {
                        percentText.textContent = Math.round(newWidth) + '% du temps écoulé';
                    }
                }
            });
        }, 60000); // Update every minute
    </script>

</body>

</html>