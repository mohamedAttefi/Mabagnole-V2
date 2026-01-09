<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    header('Location: ../index.php');
    exit();
}
include "../../classes/Categorie.php";
include "../../classes/Vehicle.php";

$categories = Categorie::all();
$id = $_GET["id"];
$vehicle = Vehicle::find($id);

if (isset($_POST["submit"])) {
    $prix_jour = $_POST["prix_jour"];
    $nombre_places = $_POST["nombre_places"];
    $nombre_portes = $_POST["nombre_portes"];
    $type_moteur = $_POST["type_moteur"];
    $image_principale = $_POST["image_principale"];
    $description = $_POST["description"];
    $categorie_id = $_POST["categorie_id"];
    $immatriculation = $_POST["immatriculation"];
    $annee = $_POST["annee"];
    $modele = $_POST["modele"];
    $marque = $_POST["marque"];

    echo $categorie_id;

    $vehicule = new Vehicle(
        $marque,
        $modele,
        $annee,
        $immatriculation,
        $categorie_id,
        $prix_jour,
        $type_moteur,
        $nombre_places,
        $description,
        $image_principale,
        null,
        $id
    );
    $vehicule->updateVehicule();
    header("location: vehicles.php");
    exit;

}
include "../header.php";


?>

<main class="main-content">
    <div class="p-6 lg:p-8 pt-20 lg:pt-8">
        <!-- Page Header -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
            <div>
                <h1 class="text-2xl lg:text-3xl font-bold text-gray-800">Ajouter un Véhicule</h1>
                <p class="text-sm text-gray-500 mt-1">Remplissez les informations pour ajouter un nouveau véhicule à la flotte.</p>
            </div>
            <div class="flex gap-3">
                <a href="vehicles.php" class="bg-white border border-gray-200 px-5 py-2.5 rounded-xl text-sm font-bold flex items-center gap-2 hover:bg-gray-50 transition shadow-sm">
                    <i class="fas fa-arrow-left text-gray-600"></i> Retour
                </a>
            </div>
        </div>

        <!-- Progress Steps -->
        <div class="mb-10">
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <div class="w-8 h-8 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold">1</div>
                    <div class="ml-3">
                        <p class="text-sm font-bold text-gray-800">Informations de base</p>
                        <p class="text-xs text-gray-500">Marque, modèle, catégorie</p>
                    </div>
                </div>
                <div class="h-1 w-12 bg-blue-600"></div>
                <div class="flex items-center">
                    <div class="w-8 h-8 rounded-full bg-gray-200 text-gray-500 flex items-center justify-center font-bold">2</div>
                    <div class="ml-3">
                        <p class="text-sm font-bold text-gray-500">Caractéristiques</p>
                        <p class="text-xs text-gray-400">Moteur, transmission</p>
                    </div>
                </div>
                <div class="h-1 w-12 bg-gray-200"></div>
                <div class="flex items-center">
                    <div class="w-8 h-8 rounded-full bg-gray-200 text-gray-500 flex items-center justify-center font-bold">3</div>
                    <div class="ml-3">
                        <p class="text-sm font-bold text-gray-500">Équipements</p>
                        <p class="text-xs text-gray-400">Options & confort</p>
                    </div>
                </div>
                <div class="h-1 w-12 bg-gray-200"></div>
                <div class="flex items-center">
                    <div class="w-8 h-8 rounded-full bg-gray-200 text-gray-500 flex items-center justify-center font-bold">4</div>
                    <div class="ml-3">
                        <p class="text-sm font-bold text-gray-500">Prix & Disponibilité</p>
                        <p class="text-xs text-gray-400">Tarifs & statut</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Vehicle Form -->
        <form action="" method="POST" class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
            <!-- Basic Information Section -->
            <div class="mb-10">
                <h2 class="text-xl font-bold text-gray-800 mb-6 pb-4 border-b border-gray-100">
                    <i class="fas fa-info-circle text-blue-600 mr-2"></i> Informations de base
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <!-- Marque -->
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">
                            Marque <span class="text-red-500">*</span>
                        </label>
                        <select name="marque" value="<?= $vehicle["marque"] ?>" required class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600">
                            <option value="">Sélectionnez une marque</option>
                            <option value="Tesla">Tesla</option>
                            <option value="Audi">Audi</option>
                            <option value="BMW">BMW</option>
                            <option value="Mercedes">Mercedes</option>
                            <option value="Porsche">Porsche</option>
                            <option value="Volkswagen">Volkswagen</option>
                            <option value="Peugeot">Peugeot</option>
                            <option value="Renault">Renault</option>
                            <option value="Citroën">Citroën</option>
                            <option value="Ford">Ford</option>
                            <option value="Toyota">Toyota</option>
                            <option value="Honda">Honda</option>
                            <option value="Hyundai">Hyundai</option>
                            <option value="Kia">Kia</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">
                            Modèle <span class="text-red-500">*</span>
                        </label>
                        <input type="text" value="<?= $vehicle["modele"] ?>" name="modele" required
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600"
                            placeholder="Ex: Model 3, A3, Série 3">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <!-- Année -->
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">
                            Année <span class="text-red-500">*</span>
                        </label>
                        <select name="annee" value="<?= $vehicle["annee"] ?>" required class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600">
                            <option value="">Sélectionnez l'année</option>
                            <?php for ($i = date('Y'); $i >= 2010; $i--): ?>
                                <option value="<?= $i ?>"><?= $i ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">
                            Immatriculation <span class="text-red-500">*</span>
                        </label>
                        <input type="text" value="<?= $vehicle["immatriculation"] ?>" name="immatriculation" required
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600"
                            placeholder="Ex: AB-123-CD" maxlength="9">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">
                            Catégorie <span class="text-red-500">*</span>
                        </label>
                        <select name="categorie_id" required class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600">
                            <option value="">Sélectionnez une catégorie</option>
                            <?php foreach ($categories as $categorie) { ?>
                                <option value="<?= $categorie["id"] ?></option>"><?= $categorie["nom"] ?></option>
                            <?php } ?>

                        </select>
                    </div>
                </div>

                <!-- Description -->
                <div class="mb-6">
                    <label class="block text-sm font-bold text-gray-700 mb-2">
                        Description <span class="text-red-500">*</span>
                    </label>
                    <textarea name="description" value="<?= $vehicle["description"] ?>" required rows="4"
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600"
                        placeholder="Décrivez le véhicule, ses caractéristiques principales, son état..."></textarea>
                </div>
            </div>

            <div class="mb-10">
                <h2 class="text-xl font-bold text-gray-800 mb-6 pb-4 border-b border-gray-100">
                    <i class="fas fa-images text-blue-600 mr-2"></i> Images du véhicule (URL)
                </h2>

                <div class="mb-6">
                    <label class="block text-sm font-bold text-gray-700 mb-2">
                        URL de l'image principale <span class="text-red-500">*</span>
                        <span class="text-xs font-normal text-gray-500">(Collez l'URL complète de l'image)</span>
                    </label>
                    <div class="flex flex-col md:flex-row gap-4">
                        <div class="flex-1">
                            <input type="url" value="<?= $vehicle["image_url"] ?>" name="image_principale" required
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600"
                                placeholder="https://example.com/images/voiture-principale.jpg">
                            <p class="text-xs text-gray-500 mt-2">Ex: https://images.unsplash.com/photo-1494976388531-d1058494cdd8</p>
                        </div>
                        <div class="w-full md:w-64">
                            <div id="main-image-preview" class="w-full h-48 bg-gray-100 border border-gray-300 rounded-xl flex items-center justify-center overflow-hidden">
                                <i class="fas fa-car text-4xl text-gray-400"></i>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="mb-10">
                <h2 class="text-xl font-bold text-gray-800 mb-6 pb-4 border-b border-gray-100">
                    <i class="fas fa-cogs text-blue-600 mr-2"></i> Caractéristiques techniques
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <!-- Moteur -->
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">
                            Type de moteur <span class="text-red-500">*</span>
                        </label>
                        <select name="type_moteur" value="<?= $vehicle["carburant"] ?>" required class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600">
                            <option value="">Sélectionnez</option>
                            <option value="essence">Essence</option>
                            <option value="diesel">Diesel</option>
                            <option value="electrique">Électrique</option>
                            <option value="hybride">Hybride</option>
                        </select>
                    </div>




                </div>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">


                    <!-- Portes -->
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">
                            Nombre de portes
                        </label>
                        <select name="nombre_portes" class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600">
                            <option value="3">3 portes</option>
                            <option value="5" selected>5 portes</option>
                            <option value="2">2 portes</option>
                        </select>
                    </div>

                    <!-- Places -->
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">
                            Nombre de places <span class="text-red-500">*</span>
                        </label>
                        <select name="nombre_places" required class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600">
                            <option value="2">2 places</option>
                            <option value="4">4 places</option>
                            <option value="5" selected>5 places</option>
                            <option value="7">7 places</option>
                            <option value="9">9 places</option>
                        </select>
                    </div>
                </div>


            </div>



            <div class="mb-10">
                <h2 class="text-xl font-bold text-gray-800 mb-6 pb-4 border-b border-gray-100">
                    <i class="fas fa-euro-sign text-blue-600 mr-2"></i> Tarification
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">
                            Prix par jour (€) <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500">€</span>
                            </div>
                            <input type="number" value="<?= $vehicle["prix_journalier"] ?>" name="prix_jour" required min="20" max="1000" step="0.01"
                                class="w-full pl-8 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-sm outline-none focus:ring-2 focus:ring-blue-600 focus:border-blue-600"
                                placeholder="Ex: 89.99">
                        </div>
                    </div>




                </div>



            </div>

            <!-- Form Actions -->
            <div class="flex flex-col md:flex-row justify-between items-center gap-4 pt-8 border-t border-gray-100">
                <div class="text-sm text-gray-500">
                    <i class="fas fa-info-circle text-blue-600 mr-2"></i>
                    Tous les champs marqués d'un <span class="text-red-500">*</span> sont obligatoires
                </div>
                <div class="flex gap-3">
                    <button type="reset" class="bg-white border border-gray-200 px-8 py-3 rounded-xl text-sm font-bold hover:bg-gray-50 transition shadow-sm">
                        Réinitialiser
                    </button>
                    <button type="submit" name="submit" class="bg-blue-600 text-white px-8 py-3 rounded-xl text-sm font-bold hover:bg-blue-700 transition shadow-lg shadow-blue-200 flex items-center gap-2">
                        <i class="fas fa-plus"></i> Ajouter le véhicule
                    </button>
                </div>
            </div>
        </form>
    </div>
</main>

<script>
    // Mobile sidebar toggle functionality
    const mobileMenuToggle = document.getElementById('mobileMenuToggle');
    const sidebar = document.querySelector('.sidebar');
    const overlay = document.getElementById('overlay');

    if (mobileMenuToggle && sidebar && overlay) {
        mobileMenuToggle.addEventListener('click', function() {
            sidebar.classList.toggle('active');
            overlay.classList.toggle('hidden');
        });

        overlay.addEventListener('click', function() {
            sidebar.classList.remove('active');
            overlay.classList.add('hidden');
        });

        // Close sidebar when clicking on a link (mobile)
        sidebar.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', function() {
                if (window.innerWidth < 1024) {
                    sidebar.classList.remove('active');
                    overlay.classList.add('hidden');
                }
            });
        });
    }

    // Show other brand input when "Autre..." is selected
    document.querySelector('select[name="marque"]').addEventListener('change', function() {
        const otherInput = document.getElementById('other-marque');
        if (this.value === 'other') {
            otherInput.classList.remove('hidden');
        } else {
            otherInput.classList.add('hidden');
        }
    });

    let marque = document.querySelector('select[name="marque"]')
    let annee = document.querySelector('select[name="annee"]')
    let categorie = document.querySelector('select[name="categorie_id"]')
    let carburant = document.querySelector('select[name="type_moteur"]')
    let nombre_portes = document.querySelector('select[name="nombre_portes"]')
    let nombre_places = document.querySelector('select[name="nombre_places"]')
    marque.value = "<?= $vehicle["marque"] ?>"
    annee.value = "<?= $vehicle["annee"] ?>"
    categorie.value = "<?= $vehicle["categorie_id"] ?>"
    carburant.value = "<?= $vehicle["carburant"] ?>"
    nombre_places.value = "<?= $vehicle["nb_places"] ?>"

    const mainImageInput = document.querySelector('input[name="image_principale"]');
    const mainImagePreview = document.getElementById('main-image-preview');

    if (mainImageInput && mainImagePreview) {
        mainImageInput.addEventListener('input', function() {
            if (this.value) {
                mainImagePreview.innerHTML = `
                    <img src="${this.value}" class="w-full h-full object-cover"
                         onerror="this.onerror=null; this.src='data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' width='100' height='100' viewBox='0 0 100 100'><rect width=\"100\" height=\"100\" fill=\"%23f3f4f6\"/><text x=\"50\" y=\"50\" font-family=\"Arial\" font-size=\"14\" fill=\"%239ca3af\" text-anchor=\"middle\" dy=\".3em\">Image non trouvée</text></svg>'; this.classList.remove(\"object-cover\"); this.classList.add(\"object-contain\");">
                `;
            } else {
                mainImagePreview.innerHTML = '<i class="fas fa-car text-4xl text-gray-400"></i>';
            }
        });
    }
</script>

</body>

</html>