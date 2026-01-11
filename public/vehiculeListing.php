<?php
include "../classes/Vehicle.php";
include "../classes/Categorie.php";
include "../includes/header.php";

$vehicles = Vehicle::all();
$categories = Categorie::all();


?>

<header class="py-12 bg-white border-b border-slate-100">
    <div class="max-w-7xl mx-auto px-4">
        <nav class="flex mb-4 text-xs font-bold uppercase tracking-widest text-slate-400 gap-2">
            <a href="index.html" class="hover:text-blue-600">Accueil</a>
            <span>/</span>
            <span class="text-slate-900">Catalogue</span>
        </nav>
        <h1 class="text-4xl font-black text-slate-900 mb-2">Explorez notre flotte</h1>
        <p class="text-slate-500 font-medium">Plus de <span class="text-blue-600 font-bold"><?= count($vehicles) ?> véhicules</span> prêts pour votre prochaine aventure.</p>
    </div>
</header>

<main class="max-w-7xl mx-auto px-4 py-12">
    <div class="bg-white rounded-[2rem] p-6 shadow-sm border border-slate-100 mb-8">
        <form id=" filterForm">
            <div class="flex flex-col lg:flex-row gap-6 items-start lg:items-center">
                <div class="flex-1">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                        <div>
                            <label class="block text-xs font-bold uppercase tracking-widest text-slate-500 mb-2">
                                Catégorie
                            </label>
                            <select id="filterCategory" name="categorie" class="w-full px-4 py-3 bg-slate-50 border-none rounded-xl text-slate-700 font-medium focus:ring-2 focus:ring-blue-600 transition">
                                <option value="">Toutes les catégories</option>
                                <?php foreach ($categories as $categorie): ?>
                                    <option value="<?= htmlspecialchars($categorie["id"]) ?>"><?= htmlspecialchars($categorie["name"]) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-widest text-slate-500 mb-2">
                                <i class="fas fa-search mr-2"></i>Recherche
                            </label>
                            <input type="text"
                                id="searchInput"
                                name="search"
                                placeholder="Marque, modèle..."
                                class="w-full px-4 py-3 bg-slate-50 border-none rounded-xl text-slate-700 font-medium focus:ring-2 focus:ring-blue-600 transition">
                        </div>

                    </div>
                </div>

                <!-- Boutons d'action -->
                <div class="flex flex-col sm:flex-row gap-3">
                    <button id="resetFilters"
                        class="px-6 py-3 bg-slate-100 text-slate-700 font-bold rounded-xl hover:bg-slate-200 transition flex items-center justify-center gap-2">
                        <i class="fas fa-redo"></i>
                        Réinitialiser
                    </button>
                    <button id="applyFilters"
                        class="px-6 py-3 bg-blue-600 text-white font-bold rounded-xl hover:bg-blue-700 transition flex items-center justify-center gap-2 shadow-lg shadow-blue-100">
                        <i class="fas fa-filter"></i>
                        Appliquer
                    </button>
                </div>
            </div>
        </form>
    </div>

    <div class="bg-white rounded-[2rem] p-6 shadow-sm border border-slate-100">
        <table id="vehiclesTable" class="vehiclesContainer display min-w-full">
            <thead>
                <tr class="border-b border-slate-100">
                    <th class="text-left py-4 px-6 text-xs font-black uppercase tracking-widest text-slate-400">Image</th>
                    <th class="text-left py-4 px-6 text-xs font-black uppercase tracking-widest text-slate-400">Véhicule</th>
                    <th class="text-left py-4 px-6 text-xs font-black uppercase tracking-widest text-slate-400">Prix/Jour</th>
                    <th class="text-left py-4 px-6 text-xs font-black uppercase tracking-widest text-slate-400">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($vehicles as $vehicle): ?>
                    <tr class="border-b border-slate-50 hover:bg-slate-50 transition">
                        <td class="py-4 px-6">
                            <img src="<?= $vehicle['image_url'] ?>"
                                class="w-24 h-16 rounded-xl object-cover shadow-sm"
                                onerror="this.src='https://images.unsplash.com/photo-1549399542-7e3f8b79c341?w=120&h=80'">
                        </td>
                        <td class="py-4 px-6">
                            <div>
                                <h4 class="font-bold text-slate-900 text-lg"><?= htmlspecialchars($vehicle['marque']) ?> <?= htmlspecialchars($vehicle['modele']) ?></h4>
                                <p class="text-blue-600 text-xs font-bold uppercase tracking-widest mt-1"><?= $vehicle['categorie'] ?></p>
                                <div class="flex flex-wrap gap-2 mt-2">
                                    <span class="text-xs text-slate-500">
                                        <i class="fas fa-gas-pump mr-1"></i> <?= $vehicle['carburant'] ?>
                                    </span>
                                    <span class="text-xs text-slate-500">•</span>
                                    <span class="text-xs text-slate-500">
                                        <i class="fas fa-users mr-1"></i> <?= $vehicle['nb_places'] ?> places
                                    </span>
                                    <span class="text-xs text-slate-500">•</span>
                                    <span class="text-xs text-slate-500">
                                        <i class="fas fa-calendar mr-1"></i> <?= $vehicle['annee'] ?>
                                    </span>
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <div class="text-center">
                                <span class="text-2xl font-black text-slate-900 block"><?= number_format($vehicle['prix_journalier'], 2) ?>€</span>
                                <span class="text-xs text-slate-400">/ jour</span>
                                <div class="mt-2">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold
                                    <?= $vehicle['disponible']
                                        ? 'bg-emerald-100 text-emerald-800'
                                        : 'bg-red-100 text-red-800' ?>">
                                        <?= $vehicle['disponible'] ? 'Disponible' : 'Indisponible' ?>
                                    </span>
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <div class="flex flex-col gap-2">
                                <a href="detaill-vehicules.php?id=<?= $vehicle['id'] ?>"
                                    class="inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-blue-600 text-white text-sm font-bold rounded-xl hover:bg-blue-700 transition shadow-sm">
                                    <i class="fas fa-eye"></i> Voir détails
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
    
    $(document).ready(function() {
        var table = $('#vehiclesTable').DataTable({
            "searching": false,
            "info": true,
            "paging": true,
            "pageLength": 3,
            "lengthChange": true,
            "lengthMenu": [3, 6, 9, 12],

            "ordering": false,
            "filter": false,

            "language": {
                "lengthMenu": "Afficher _MENU_ véhicules par page",
                "zeroRecords": "Aucun véhicule trouvé",
                "info": "Affichage _START_ à _END_ sur _TOTAL_ véhicules",
                "infoEmpty": "Affichage 0 à 0 sur 0 véhicules",
                "infoFiltered": "",
                "paginate": {
                    "first": "Premier",
                    "last": "Dernier",
                    "next": "Suivant",
                    "previous": "Précédent"
                }
            },

            "drawCallback": function() {
                $('.paginate_button').addClass('px-4 py-2 mx-1 rounded-lg font-medium transition-all');
                $('.paginate_button.current').addClass('bg-blue-600 text-white shadow-md');
                $('.paginate_button:not(.current)').addClass('text-slate-700 hover:bg-slate-100');
                $('.paginate_button.disabled').addClass('text-slate-300 cursor-not-allowed hover:bg-transparent');
            }
        });

        $('.dataTables_length select').addClass('px-4 py-2 border border-slate-200 rounded-lg text-sm focus:border-blue-600 focus:ring-1 focus:ring-blue-600 outline-none');

        $('#applyFilters').on('click', function() {
            alert('Fonctionnalité de filtrage à implémenter ultérieurement.');
        });

        $('#resetFilters').on('click', function() {
            $('#filterCategory').val('');
            $('#filterDisponibility').val('');
            $('#filterPrice').val('');
            alert('Filtres réinitialisés.');
        });
    });
</script>

<style>
    .dataTables_wrapper .dataTables_paginate {
        @apply flex items-center gap-1;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button {
        @apply min-w-[44px] h-11 flex items-center justify-center rounded-xl text-sm font-semibold transition-all duration-200;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        @apply bg-blue-600 text-white shadow-lg !important;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button:hover:not(.current) {
        @apply bg-slate-100 text-blue-600;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled {
        @apply text-slate-300 cursor-not-allowed hover:bg-transparent;
    }

    /* Info texte */
    .dataTables_wrapper .dataTables_info {
        @apply text-slate-500 text-sm font-medium;
    }

    /* Sélecteur d'éléments par page */
    .dataTables_length {
        @apply mb-4;
    }

    .dataTables_length label {
        @apply flex items-center gap-3 text-slate-600 text-sm font-medium;
    }

    /* Cacher complètement la recherche */
    .dataTables_filter {
        display: none !important;
    }

    /* Pas de tri au clic sur les en-têtes */
    table.dataTable thead th.sorting {
        cursor: default !important;
    }

    table.dataTable thead th.sorting:after {
        display: none !important;
    }

    /* Styles pour la barre de filtres */
    #filterPrice::-webkit-outer-spin-button,
    #filterPrice::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    #filterPrice {
        -moz-appearance: textfield;
    }
</style>

<footer class="bg-slate-900 text-slate-400 py-12 mt-20">
    <div class="max-w-7xl mx-auto px-4 text-center">
        <div class="flex items-center justify-center gap-2 mb-6 opacity-50">
            <i class="fas fa-car-side text-blue-500"></i>
            <span class="text-xl font-black text-white tracking-tighter">MaBagnole</span>
        </div>
        <p class="text-xs font-bold uppercase tracking-[0.3em]">© 2026 Tous droits réservés.</p>
    </div>
</footer>

</body>

</html>