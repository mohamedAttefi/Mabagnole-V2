<?php
require_once '../../classes/Reservation.php';
require_once '../../classes/Vehicle.php';
require_once '../../includes/header.php';

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
            transform: translateY(-4px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.1);
        }

        .status-en_attente {
            border-left-color: #f59e0b;
            background: linear-gradient(to right, #fffbeb 1%, #ffffff 10%);
        }

        .status-en_attente .status-badge {
            background-color: #f59e0b;
            color: white;
        }

        .status-confirmee {
            border-left-color: #3b82f6;
            background: linear-gradient(to right, #eff6ff 1%, #ffffff 10%);
        }

        .status-confirmee .status-badge {
            background-color: #3b82f6;
            color: white;
        }

        .status-annulee {
            border-left-color: #ef4444;
            background: linear-gradient(to right, #fef2f2 1%, #ffffff 10%);
        }

        .status-annulee .status-badge {
            background-color: #ef4444;
            color: white;
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

        .animate-fade-in {
            animation: fadeIn 0.5s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body class="bg-[#F8FAFC] text-slate-900">
    <!-- Navigation -->
    <?php include '../../includes/navbar.php'; ?>

    <main class="pt-28 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-16">
        <!-- Header Section -->
        <div class="mb-10 animate-fade-in">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-8">
                <div>
                    <h1 class="text-3xl md:text-4xl font-extrabold text-slate-900 mb-3">Mes réservations</h1>
                    <p class="text-slate-600 text-lg">Gérez et suivez toutes vos locations</p>
                </div>

                <div class="flex flex-wrap gap-3">
                    <a href="vehicles.php"
                        class="px-6 py-3 bg-blue-600 text-white rounded-xl font-bold hover:bg-blue-700 transition flex items-center gap-2 shadow-lg shadow-blue-200 hover:shadow-blue-300">
                        <i class="fas fa-plus"></i>
                        Nouvelle réservation
                    </a>
                    <a href="pending-reservations.php"
                        class="px-6 py-3 bg-amber-500 text-white rounded-xl font-bold hover:bg-amber-600 transition flex items-center gap-2 shadow-lg shadow-amber-200">
                        <i class="fas fa-clock"></i>
                        En attente (<?php echo $stats['pending']; ?>)
                    </a>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
                <div class="bg-white p-5 rounded-2xl shadow-sm border border-slate-100">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                            <i class="fas fa-calendar-alt text-blue-600 text-lg"></i>
                        </div>
                        <div>
                            <p class="text-slate-500 text-sm">Total</p>
                            <p class="text-2xl font-bold text-slate-900"><?php echo $stats['all']; ?></p>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-5 rounded-2xl shadow-sm border border-slate-100">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 bg-amber-100 rounded-xl flex items-center justify-center">
                            <i class="fas fa-clock text-amber-600 text-lg"></i>
                        </div>
                        <div>
                            <p class="text-slate-500 text-sm">En attente</p>
                            <p class="text-2xl font-bold text-slate-900"><?php echo $stats['pending']; ?></p>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-5 rounded-2xl shadow-sm border border-slate-100">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                            <i class="fas fa-check-circle text-green-600 text-lg"></i>
                        </div>
                        <div>
                            <p class="text-slate-500 text-sm">Confirmées</p>
                            <p class="text-2xl font-bold text-slate-900"><?php echo $stats['active']; ?></p>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-5 rounded-2xl shadow-sm border border-slate-100">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center">
                            <i class="fas fa-times-circle text-red-600 text-lg"></i>
                        </div>
                        <div>
                            <p class="text-slate-500 text-sm">Annulées</p>
                            <p class="text-2xl font-bold text-slate-900"><?php echo $stats['completed']; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Reservations List -->
        <div class="space-y-6 animate-fade-in" style="animation-delay: 0.2s;">
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
                            class="inline-block bg-white text-slate-900 px-8 py-4 rounded-xl font-bold text-lg hover:bg-slate-100 transition shadow-lg hover:scale-105 transform duration-300">
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
                    <div class="reservation-card <?php echo $statusClass; ?> bg-white rounded-2xl p-6 shadow-lg border border-slate-100 animate-fade-in">
                        <div class="flex flex-col lg:flex-row gap-6">
                            <!-- Vehicle Image -->
                            <div class="lg:w-1/4">
                                <div class="relative rounded-xl overflow-hidden h-56">
                                    <?php if ($vehicle && !empty($vehicle['image_url'])): ?>
                                        <img src="<?php echo htmlspecialchars($vehicle['image_url']); ?>"
                                            alt="<?php echo htmlspecialchars($vehicle['marque'] . ' ' . $vehicle['modele']); ?>"
                                            class="w-full h-full object-cover hover:scale-105 transition duration-500">
                                    <?php else: ?>
                                        <div class="w-full h-full bg-gradient-to-r from-blue-100 to-purple-100 flex items-center justify-center">
                                            <i class="fas fa-car text-slate-400 text-5xl"></i>
                                        </div>
                                    <?php endif; ?>
                                    <div class="absolute top-3 left-3 status-badge text-xs font-bold px-3 py-1.5 rounded-full">
                                        <?php 
                                        $statusText = [
                                            'en_attente' => 'EN ATTENTE',
                                            'confirmee' => 'CONFIRMÉE',
                                            'annulee' => 'ANNULÉE'
                                        ];
                                        echo $statusText[$status] ?? strtoupper($status);
                                        ?>
                                    </div>
                                </div>
                            </div>

                            <!-- Reservation Details -->
                            <div class="lg:w-2/3">
                                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-4">
                                    <div>
                                        <h3 class="text-xl font-bold text-slate-900 mb-1">
                                            <?php echo $vehicle ? htmlspecialchars($vehicle['marque'] . ' ' . $vehicle['modele']) : 'Véhicule inconnu'; ?>
                                            <span class="text-slate-500 font-normal text-sm ml-2">#<?php echo htmlspecialchars($reservation['id']); ?></span>
                                        </h3>
                                        <div class="flex flex-wrap items-center gap-3 text-slate-600 text-sm">
                                            <span class="flex items-center gap-1">
                                                <i class="fas fa-calendar-alt text-blue-500"></i>
                                                <?php echo date('d/m/Y', strtotime($reservation['date_debut'])); ?>
                                            </span>
                                            <span class="text-slate-300">→</span>
                                            <span class="flex items-center gap-1">
                                                <i class="fas fa-calendar-check text-green-500"></i>
                                                <?php echo date('d/m/Y', strtotime($reservation['date_fin'])); ?>
                                            </span>
                                            <span class="bg-slate-100 px-2 py-1 rounded-lg text-xs">
                                                <?php echo $days; ?> jour<?php echo $days > 1 ? 's' : ''; ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="flex flex-col items-end">
                                        <span class="text-2xl font-extrabold text-blue-600">
                                            <?php echo number_format($reservation['prix_total'], 0, ',', ' '); ?>€
                                        </span>
                                        <span class="text-sm text-slate-500">Total</span>
                                    </div>
                                </div>

                                <!-- Details Grid -->
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                                    <div class="space-y-2">
                                        <p class="text-xs text-slate-500 uppercase tracking-wider font-semibold">Lieu de départ</p>
                                        <p class="text-sm flex items-center gap-2 bg-slate-50 p-3 rounded-lg">
                                            <i class="fas fa-map-marker-alt text-blue-600"></i>
                                            <?php echo htmlspecialchars($reservation['lieu_priseencharge']); ?>
                                        </p>
                                    </div>

                                    <div class="space-y-2">
                                        <p class="text-xs text-slate-500 uppercase tracking-wider font-semibold">Date de création</p>
                                        <p class="text-sm flex items-center gap-2 bg-slate-50 p-3 rounded-lg">
                                            <i class="far fa-calendar-plus text-blue-600"></i>
                                            <?php echo date('d/m/Y à H:i', strtotime($reservation['date_creation'])); ?>
                                        </p>
                                    </div>

                                    <div class="space-y-2">
                                        <p class="text-xs text-slate-500 uppercase tracking-wider font-semibold">Type de location</p>
                                        <p class="text-sm flex items-center gap-2 bg-slate-50 p-3 rounded-lg">
                                            <i class="fas fa-car text-blue-600"></i>
                                            Location standard
                                        </p>
                                    </div>
                                </div>

                                <?php if ($status == 'confirmee'): ?>
                                    <div class="mb-6">
                                        <div class="flex justify-between text-sm text-slate-600 mb-2">
                                            <span class="font-medium">Début: <?php echo date('d/m/Y', strtotime($reservation['date_debut'])); ?></span>
                                            <span class="font-medium">Fin: <?php echo date('d/m/Y', strtotime($reservation['date_fin'])); ?></span>
                                        </div>
                                        <div class="w-full bg-slate-200 rounded-full h-2">
                                            <div class="progress-bar bg-gradient-to-r from-green-400 to-green-600 h-2 rounded-full" style="width: <?php echo $progressPercent; ?>%"></div>
                                        </div>
                                        <?php if ($progressPercent > 0 && $progressPercent < 100): ?>
                                            <p class="text-xs text-slate-500 mt-2 text-center font-medium">
                                                <?php echo round($progressPercent); ?>% du temps écoulé
                                            </p>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <!-- Actions -->
                            <div class="lg:w-1/4 border-t lg:border-t-0 lg:border-l border-slate-200 lg:pl-6 pt-6 lg:pt-0">
                                <div class="space-y-3">
                                    <a href="reservation-details.php?id=<?php echo $reservation['id']; ?>"
                                        class="w-full bg-blue-600 text-white py-3 rounded-xl font-bold hover:bg-blue-700 transition flex items-center justify-center gap-2 shadow-md hover:shadow-lg">
                                        <i class="fas fa-eye"></i>
                                        Voir détails
                                    </a>

                                    <?php if ($status == 'en_attente'): ?>
                                        <button onclick="cancelReservation(<?php echo $reservation['id']; ?>)"
                                            class="w-full bg-white border border-red-200 text-red-600 py-3 rounded-xl font-bold hover:bg-red-50 transition flex items-center justify-center gap-2 shadow-sm">
                                            <i class="fas fa-times"></i>
                                            Annuler
                                        </button>
                                    <?php elseif ($status == 'confirmee'): ?>
                                        <a href="review.php?reservation_id=<?php echo $reservation['id']; ?>"
                                            class="w-full bg-gradient-to-r from-amber-500 to-amber-600 text-white py-3 rounded-xl font-bold hover:from-amber-600 hover:to-amber-700 transition flex items-center justify-center gap-2 shadow-md">
                                            <i class="fas fa-star"></i>
                                            Noter
                                        </a>
                                        <a href="invoice.php?id=<?php echo $reservation['id']; ?>"
                                            class="w-full bg-slate-900 text-white py-3 rounded-xl font-bold hover:bg-slate-800 transition flex items-center justify-center gap-2 shadow-md">
                                            <i class="fas fa-file-invoice-dollar"></i>
                                            Facture
                                        </a>
                                    <?php elseif ($status == 'annulee'): ?>
                                        <a href="vehicles.php?vehicle_id=<?php echo $reservation['vehicule_id']; ?>"
                                            class="w-full bg-slate-100 text-slate-700 py-3 rounded-xl font-bold hover:bg-slate-200 transition flex items-center justify-center gap-2">
                                            <i class="fas fa-redo-alt"></i>
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
        <?php if (!empty($reservations) && count($reservations) > 5): ?>
            <div class="mt-10 flex justify-center items-center gap-4">
                <button class="w-12 h-12 rounded-2xl border border-slate-200 flex items-center justify-center text-slate-400 hover:bg-white hover:border-blue-600 hover:text-blue-600 transition shadow-sm">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <span class="font-bold text-slate-900">
                    Page <span class="text-blue-600">1</span> sur <span class="text-slate-400"><?php echo ceil(count($reservations) / 5); ?></span>
                </span>
                <button class="w-12 h-12 rounded-2xl border border-slate-200 flex items-center justify-center text-slate-400 hover:bg-white hover:border-blue-600 hover:text-blue-600 transition shadow-sm">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        <?php endif; ?>
    </main>

    <!-- Footer -->
    <?php include '../../includes/footer.php'; ?>

    

</body>

</html>