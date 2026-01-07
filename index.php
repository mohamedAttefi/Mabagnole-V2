<?php
include "classes/Vehicle.php";
include "includes/header.php";
$vehicles = Vehicle::all();
?>



    <section class="hero-mesh min-h-screen flex items-center pt-20 px-4">
        <div class="max-w-7xl mx-auto w-full">
            <div class="max-w-3xl animate-fade-in-up">
                <span class="inline-block px-4 py-2 rounded-full bg-blue-500/20 text-blue-400 text-sm font-bold mb-6 backdrop-blur-md">
                    ✨ Plus de 500 véhicules disponibles
                </span>
                <h1 class="text-5xl md:text-7xl font-extrabold text-white leading-tight mb-8">
                    La liberté n'a jamais été aussi <span class="text-blue-500">proche.</span>
                </h1>

                <div class="bg-white p-4 md:p-2 rounded-3xl md:rounded-full shadow-2xl flex flex-col md:flex-row gap-2 max-w-4xl">
                    <div class="flex-1 flex items-center px-6 border-b md:border-b-0 md:border-r border-slate-100 py-3">
                        <i class="fas fa-location-dot text-blue-600 mr-3"></i>
                        <input type="text" placeholder="Ville ou Agence" class="w-full focus:outline-none font-medium">
                    </div>
                    <div class="flex-1 flex items-center px-6 py-3">
                        <i class="fas fa-calendar text-blue-600 mr-3"></i>
                        <input type="text" onfocus="(this.type='date')" placeholder="Date de départ" class="w-full focus:outline-none font-medium">
                    </div>
                    <button class="bg-blue-600 hover:bg-blue-700 text-white px-10 py-4 rounded-2xl md:rounded-full font-bold transition flex items-center justify-center gap-2">
                        <i class="fas fa-magnifying-glass"></i> Rechercher
                    </button>
                </div>
            </div>
        </div>
    </section>

    <section class="relative -mt-16 z-10 max-w-6xl mx-auto px-4">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="bg-white p-6 rounded-2xl shadow-xl text-center">
                <p class="text-3xl font-black text-blue-600">4.9/5</p>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mt-1">Avis Clients</p>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-xl text-center border-t-4 border-blue-600">
                <p class="text-3xl font-black text-slate-800">24/7</p>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mt-1">Assistance</p>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-xl text-center">
                <p class="text-3xl font-black text-blue-600">0€</p>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mt-1">Frais Cachés</p>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow-xl text-center border-t-4 border-blue-600">
                <p class="text-3xl font-black text-slate-800">100%</p>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mt-1">Digital</p>
            </div>
        </div>
    </section>

    <section class="py-24 max-w-7xl mx-auto px-4">
        <div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-4">
            <div>
                <h2 class="text-4xl font-extrabold text-slate-900 mb-4 tracking-tight">Nos pépites du moment</h2>
                <p class="text-slate-500 max-w-lg">Des citadines agiles aux SUV familiaux, trouvez le compagnon idéal pour votre prochain voyage.</p>
            </div>
            <a href="public/vehiculeListing.php" class="group flex items-center gap-3 font-bold text-blue-600 hover:text-blue-800 transition">
                Voir tout le parc
                <span class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center group-hover:translate-x-2 transition-transform">
                    <i class="fas fa-arrow-right text-sm"></i>
                </span>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
            <?php for ($i = 0; $i < 3; $i++) { ?>

                <div class="bg-white rounded-[2rem] p-4 shadow-sm border border-slate-100 card-hover transition-all group">
                    <div class="relative rounded-[1.5rem] overflow-hidden aspect-[4/3] mb-6">
                        <img src="<?= $vehicles[$i]["image_url"] ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                    </div>
                    <div class="px-2">
                        <h3 class="text-xl font-bold mb-2"><?= $vehicles[$i]["marque"] ?> <?= $vehicles[$i]["modele"] ?></h3>
                        <div class="flex gap-4 text-slate-400 text-sm mb-6 font-medium">
                            <span><i class="fas fa-gas-pump text-blue-500 mr-2"></i><?= $vehicles[$i]["carburant"] ?></span>
                            <span><i class="fas fa-users text-blue-500 mr-2"></i><?= $vehicles[$i]["nb_places"] ?> Places</span>
                        </div>
                        <div class="flex justify-between items-center pt-4 border-t border-slate-50">
                            <p class="text-2xl font-black"><?= $vehicles[$i]["prix_journalier"] ?>€<span class="text-sm text-slate-400 font-bold">/j</span></p>
                            <button class="bg-slate-900 text-white p-4 rounded-2xl hover:bg-blue-600 transition">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
            <?php } ?>

        </div>
    </section>

    <footer class="bg-slate-900 text-slate-400 pt-24 pb-12">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 pb-16 border-b border-slate-800">
                <div class="col-span-1 md:col-span-1">
                    <a href="#" class="flex items-center gap-2 mb-8">
                        <div class="bg-blue-600 p-2 rounded-lg"><i class="fas fa-car-side text-white"></i></div>
                        <span class="text-2xl font-bold text-white">MaBagnole</span>
                    </a>
                    <p class="leading-relaxed mb-6">Redéfinir la mobilité urbaine par la simplicité et le plaisir de conduire.</p>
                    <div class="flex gap-4">
                        <a href="#" class="w-10 h-10 rounded-full border border-slate-700 flex items-center justify-center hover:bg-blue-600 hover:border-blue-600 transition-all text-white"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="w-10 h-10 rounded-full border border-slate-700 flex items-center justify-center hover:bg-blue-600 hover:border-blue-600 transition-all text-white"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>

                <div>
                    <h4 class="text-white font-bold mb-8 uppercase tracking-widest text-xs">Explorez</h4>
                    <ul class="space-y-4 font-medium">
                        <li><a href="#" class="hover:text-blue-400 transition">Véhicules de luxe</a></li>
                        <li><a href="#" class="hover:text-blue-400 transition">Électriques</a></li>
                        <li><a href="#" class="hover:text-blue-400 transition">Le Blog</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-white font-bold mb-8 uppercase tracking-widest text-xs">Aide</h4>
                    <ul class="space-y-4 font-medium">
                        <li><a href="#" class="hover:text-blue-400 transition">Assurance</a></li>
                        <li><a href="#" class="hover:text-blue-400 transition">FAQ</a></li>
                        <li><a href="#" class="hover:text-blue-400 transition">Contact</a></li>
                    </ul>
                </div>

                <div class="bg-slate-800/50 p-8 rounded-3xl border border-slate-700/50">
                    <h4 class="text-white font-bold mb-4">Newsletter</h4>
                    <p class="text-sm mb-6 italic">Promos exclusives & Tips de voyage.</p>
                    <form class="flex flex-col gap-3">
                        <input type="email" placeholder="Votre email" class="bg-slate-900 border border-slate-700 px-5 py-3 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none text-white">
                        <button class="bg-blue-600 text-white font-bold py-3 rounded-xl hover:bg-blue-700 transition">S'inscrire</button>
                    </form>
                </div>
            </div>
            <p class="text-center mt-12 text-sm font-bold opacity-50 uppercase tracking-[0.2em]">
                &copy; 2026 MaBagnole. Conçu pour la route.
            </p>
        </div>
    </footer>

</body>

</html>