<?php
include "../classes/Vehicle.php";
include "../includes/header.php";

$vehicles = Vehicle::all();
?>



    <header class="py-12 bg-white border-b border-slate-100">
        <div class="max-w-7xl mx-auto px-4">
            <nav class="flex mb-4 text-xs font-bold uppercase tracking-widest text-slate-400 gap-2">
                <a href="index.html" class="hover:text-blue-600">Accueil</a>
                <span>/</span>
                <span class="text-slate-900">Catalogue</span>
            </nav>
            <h1 class="text-4xl font-black text-slate-900 mb-2">Explorez notre flotte</h1>
            <p class="text-slate-500 font-medium">Plus de <span class="text-blue-600 font-bold">150 véhicules</span> prêts pour votre prochaine aventure.</p>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 py-12">
        <div class="flex flex-col lg:flex-row gap-10">

            <aside class="w-full lg:w-1/4">
                <div class="sticky top-28 space-y-6">
                    <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-slate-100">
                        <div class="flex items-center justify-between mb-8">
                            <h2 class="text-xl font-extrabold flex items-center gap-3 text-slate-800">
                                <i class="fas fa-sliders text-blue-600"></i> Filtres
                            </h2>
                            <button class="text-xs font-bold text-blue-600 hover:underline">Reset</button>
                        </div>

                        <div class="mb-8">
                            <label class="block text-xs font-black uppercase tracking-widest text-slate-400 mb-4">Recherche libre</label>
                            <div class="relative">
                                <input type="text" placeholder="Marque ou modèle..." class="w-full pl-12 pr-4 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-blue-600 transition font-medium text-sm">
                                <i class="fas fa-search absolute left-5 top-1/2 -translate-y-1/2 text-slate-400"></i>
                            </div>
                        </div>

                        <div class="mb-8">
                            <label class="block text-xs font-black uppercase tracking-widest text-slate-400 mb-4">Catégories</label>
                            <div class="grid grid-cols-1 gap-3">
                                <label class="flex items-center p-3 rounded-xl hover:bg-slate-50 cursor-pointer transition group">
                                    <input type="checkbox" class="custom-checkbox hidden" checked>
                                    <div class="w-10 h-10 rounded-lg bg-blue-50 flex items-center justify-center mr-4 group-hover:bg-blue-600 group-hover:text-white transition">
                                        <i class="fas fa-car-side text-sm"></i>
                                    </div>
                                    <span class="text-sm font-medium text-slate-600">Citadines</span>
                                </label>
                                <label class="flex items-center p-3 rounded-xl hover:bg-slate-50 cursor-pointer transition group">
                                    <input type="checkbox" class="custom-checkbox hidden">
                                    <div class="w-10 h-10 rounded-lg bg-slate-100 flex items-center justify-center mr-4 group-hover:bg-blue-600 group-hover:text-white transition">
                                        <i class="fas fa-truck-pickup text-sm"></i>
                                    </div>
                                    <span class="text-sm font-medium text-slate-600">SUV & 4x4</span>
                                </label>
                            </div>
                        </div>

                        <div class="mb-8">
                            <label class="block text-xs font-black uppercase tracking-widest text-slate-400 mb-4 flex justify-between">
                                Budget max <span>150€/j</span>
                            </label>
                            <input type="range" min="30" max="500" class="w-full h-1.5 bg-slate-100 rounded-lg appearance-none cursor-pointer accent-blue-600">
                        </div>

                        <button class="w-full bg-blue-600 text-white py-4 rounded-2xl font-bold shadow-xl shadow-blue-100 hover:bg-blue-700 transition transform active:scale-95">
                            Appliquer les filtres
                        </button>
                    </div>
                </div>
            </aside>

            <div class="w-full lg:w-3/4">
                <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4 px-2">
                    <p class="text-slate-500 font-semibold">Affichage de <span class="text-slate-900 font-black">1-12</span> sur 158 résultats</p>
                    <div class="flex items-center bg-white p-1 rounded-xl border border-slate-100 shadow-sm">
                        <span class="text-xs font-black uppercase px-4 text-slate-400">Trier:</span>
                        <select class="bg-transparent border-none text-sm font-bold text-slate-700 focus:ring-0 cursor-pointer pr-8">
                            <option>Prix croissant</option>
                            <option>Mieux notés</option>
                            <option>Nouveautés</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
                    <?php foreach ($vehicles as $vehicle) { ?>

                        <div class="bg-white rounded-[2.5rem] p-4 shadow-sm border border-slate-100 hover:shadow-2xl hover:shadow-slate-200 transition-all group overflow-hidden relative">
                            <div class="absolute top-8 left-8 z-10">
                                <span class="bg-emerald-500 text-white text-[10px] font-black uppercase px-3 py-1.5 rounded-full shadow-lg shadow-emerald-200"><?php echo $vehicle["disponible"] ? "Disponible" : "Indisponible" ?></span>
                            </div>

                            <div class="rounded-[2rem] overflow-hidden aspect-[4/3] mb-6 relative">
                                <img src="<?= $vehicle["image_url"] ?>" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                                <div class="absolute inset-0 bg-blue-900/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                    <a href="detaill-vehicules.php?id=<?= $vehicle["id"] ?>" class="bg-white text-slate-900 px-6 py-3 rounded-full font-bold text-sm transform translate-y-4 group-hover:translate-y-0 transition">Voir les détails</a>
                                </div>
                            </div>

                            <div class="px-3 pb-4">
                                <div class="flex justify-between items-start mb-2">
                                    <div>
                                        <h3 class="text-xl font-black text-slate-900"><?= $vehicle["marque"] ?> <?= $vehicle["modele"] ?></h3>
                                        <p class="text-blue-600 text-xs font-bold uppercase tracking-widest"><?= $vehicle["categorie"] ?></p>
                                    </div>
                                    <div class="text-right">
                                        <span class="text-2xl font-black text-slate-900"><?= $vehicle["prix_journalier"] ?>€</span>
                                        <span class="text-xs font-bold text-slate-400 block">/ jour</span>
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 gap-3 mt-6 pt-6 border-t border-slate-50">
                                    <div class="flex items-center gap-2 text-xs font-bold text-slate-500 bg-slate-50 p-2 rounded-xl">
                                        <i class="fas fa-gas-pump text-blue-500"></i> <?= $vehicle["carburant"] ?>
                                    </div>
                                    <div class="flex items-center gap-2 text-xs font-bold text-slate-500 bg-slate-50 p-2 rounded-xl">
                                        <i class="fas fa-users text-blue-500"></i> <?= $vehicle["nb_places"] ?> places
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php } ?>



                </div>

                <div class="mt-20 flex justify-center">
                    <nav class="flex items-center gap-3 bg-white p-2 rounded-[2rem] border border-slate-100 shadow-sm">
                        <button class="w-12 h-12 flex items-center justify-center rounded-2xl text-slate-400 hover:bg-slate-50 transition">
                            <i class="fas fa-chevron-left text-xs"></i>
                        </button>
                        <button class="w-12 h-12 flex items-center justify-center rounded-2xl bg-blue-600 text-white font-black shadow-lg shadow-blue-200">1</button>
                        <button class="w-12 h-12 flex items-center justify-center rounded-2xl text-slate-600 font-bold hover:bg-slate-50 transition">2</button>
                        <button class="w-12 h-12 flex items-center justify-center rounded-2xl text-slate-600 font-bold hover:bg-slate-50 transition">3</button>
                        <span class="px-2 text-slate-300">...</span>
                        <button class="w-12 h-12 flex items-center justify-center rounded-2xl text-slate-400 hover:bg-slate-50 transition">
                            <i class="fas fa-chevron-right text-xs"></i>
                        </button>
                    </nav>
                </div>
            </div>
        </div>
    </main>

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