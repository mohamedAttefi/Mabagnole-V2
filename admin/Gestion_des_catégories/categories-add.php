<?php
include "../../classes/Categorie.php";

if (isset($_POST["ajouter"])) {
    $categoryName = $_POST["categoryName"];
    $categoryDescription = $_POST["categoryDescription"];

    $categorie = new Categorie( $categoryName, $categoryDescription);
    $categorie->create();
    header("location: categories.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une catégorie | MaBagnole Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .text-primary {
            color: #2563eb;
        }

        .bg-primary {
            background-color: #2563eb;
        }

        .border-primary {
            border-color: #2563eb;
        }
    </style>
</head>

<body class="bg-gray-50">
    <!-- Header Admin -->
    <nav class="bg-white shadow">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <a href="dashboard.html" class="flex items-center">
                    <i class="fas fa-car text-primary text-xl mr-2"></i>
                    <span class="font-bold text-xl">MaBagnole <span class="text-sm text-gray-500">Admin</span></span>
                </a>
                <div class="flex items-center space-x-6">
                    <a href="admin-dashboard.html" class="text-gray-600 hover:text-primary">Tableau de bord</a>
                    <a href="admin-vehicules.html" class="text-gray-600 hover:text-primary">Véhicules</a>
                    <a href="admin-categories.html" class="text-primary font-semibold">Catégories</a>
                    <a href="admin-users.html" class="text-gray-600 hover:text-primary">Utilisateurs</a>
                    <a href="logout.html" class="text-gray-600 hover:text-primary">
                        <i class="fas fa-sign-out-alt"></i>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-4xl mx-auto pt-20 px-4 py-12">
        <!-- Breadcrumb -->
        <nav class="mb-8" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-2 text-sm text-gray-600">
                <li><a href="admin-dashboard.html" class="hover:text-blue-600">Admin</a></li>
                <li><i class="fas fa-chevron-right text-xs"></i></li>
                <li><a href="admin-categories.html" class="hover:text-blue-600">Catégories</a></li>
                <li><i class="fas fa-chevron-right text-xs"></i></li>
                <li class="text-gray-800 font-medium">Ajouter une catégorie</li>
            </ol>
        </nav>

        <!-- En-tête -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-gray-800 mb-2">Ajouter une nouvelle catégorie</h1>
                <p class="text-gray-600">Remplissez les informations pour créer une nouvelle catégorie de véhicule</p>
            </div>
            <a href="admin-categories.html" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition">
                <i class="fas fa-arrow-left mr-2"></i>Retour
            </a>
        </div>

        <!-- Formulaire -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <!-- Progrès -->
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                <div class="flex items-center">
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center mr-2">
                            1
                        </div>
                        <span class="font-medium text-blue-600">Informations de base</span>
                    </div>
                    <div class="h-0.5 flex-grow bg-gray-300 mx-4"></div>
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-gray-300 text-gray-600 rounded-full flex items-center justify-center mr-2">
                            2
                        </div>
                        <span class="text-gray-500">Caractéristiques</span>
                    </div>
                </div>
            </div>

            <!-- Contenu du formulaire -->
            <form id="addCategoryForm" class="space-y-8" method="post">
                <!-- Section 1: Informations de base -->
                <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
                    <div class="flex items-center mb-6">
                        <div class="w-10 h-10 bg-blue-600 text-white rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-info-circle"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800">Informations générales</h3>
                    </div>

                    <div class="space-y-6">
                        <!-- Nom de la catégorie -->
                        <div>
                            <label for="categoryName" class="block text-gray-700 font-medium mb-3 flex items-center">
                                <i class="fas fa-tag text-blue-600 mr-2 text-sm"></i>
                                Nom de la catégorie
                                <span class="text-red-500 ml-1">*</span>
                            </label>
                            <div class="relative">
                                <input type="text"
                                    id="categoryName"
                                    name="categoryName"
                                    class="w-full p-4 pl-11 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-600 focus:border-transparent outline-none transition-all duration-200"
                                    placeholder="Ex: SUV, Citadine, Berline..."
                                    required>
                                <div class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400">
                                    <i class="fas fa-car"></i>
                                </div>
                            </div>
                            <p class="text-sm text-gray-500 mt-2 ml-1">
                                <i class="fas fa-lightbulb mr-1 text-yellow-500"></i>
                                Nom affiché aux utilisateurs dans les listes de véhicules
                            </p>
                        </div>

                        <!-- Description -->
                        <div>
                            <label for="categoryDescription" class="block text-gray-700 font-medium mb-3 flex items-center">
                                <i class="fas fa-align-left text-blue-600 mr-2 text-sm"></i>
                                Description
                                <span class="text-red-500 ml-1">*</span>
                            </label>
                            <div class="relative">
                                <textarea id="categoryDescription"
                                    name="categoryDescription"
                                    rows="4"
                                    class="w-full p-4 pl-11 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-600 focus:border-transparent outline-none transition-all duration-200 resize-none"
                                    placeholder="Décrivez les caractéristiques principales de cette catégorie de véhicules..."
                                    required></textarea>
                                <div class="absolute left-3 top-4 text-gray-400">
                                    <i class="fas fa-file-alt"></i>
                                </div>
                            </div>
                            <div class="flex justify-between items-center mt-2">
                                <p class="text-sm text-gray-500 ml-1">
                                    <i class="fas fa-info-circle mr-1 text-blue-500"></i>
                                    Décrivez brièvement cette catégorie de véhicules
                                </p>
                                <span id="charCount" class="text-sm text-gray-400">0/500 caractères</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Aperçu en temps réel -->
                <div class="bg-blue-50 rounded-xl p-6 border border-blue-200">
                    <div class="flex items-center mb-4">
                        <div class="w-8 h-8 bg-blue-600 text-white rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-eye"></i>
                        </div>
                        <h3 class="text-lg font-bold text-gray-800">Aperçu de la catégorie</h3>
                    </div>

                    <div class="bg-white p-5 rounded-lg border border-blue-100 shadow-sm">
                        <div class="flex items-center mb-4">
                            <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-blue-700 text-white rounded-xl flex items-center justify-center mr-4 shadow">
                                <i class="fas fa-car text-xl"></i>
                            </div>
                            <div class="flex-grow">
                                <h4 id="previewName" class="font-bold text-xl text-gray-800 mb-1">Nom de la catégorie</h4>
                                <p id="previewDescription" class="text-gray-600 text-sm">Description apparaîtra ici...</p>
                            </div>
                            <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-sm font-semibold">
                                Nouveau
                            </span>
                        </div>
                        <div class="grid grid-cols-2 gap-3 text-sm">
                            <div class="flex items-center text-gray-600">
                                <i class="fas fa-calendar-plus text-blue-500 mr-2"></i>
                                <span>Créé aujourd'hui</span>
                            </div>
                            <div class="flex items-center text-gray-600">
                                <i class="fas fa-car text-blue-500 mr-2"></i>
                                <span>0 véhicules</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl p-6 border border-gray-200 shadow-sm">
                    <div class="flex flex-col sm:flex-row gap-4">
                        <button type="submit" name="ajouter"
                            class="group relative px-8 py-4 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-xl hover:from-blue-700 hover:to-blue-800 transition-all duration-300 font-bold shadow-md hover:shadow-lg flex-grow overflow-hidden">
                            <div class="absolute inset-0 bg-white opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>
                            <div class="relative flex items-center justify-center">
                                <i class="fas fa-plus-circle mr-3 text-lg"></i>
                                <span class="text-lg">Créer la catégorie</span>
                            </div>
                        </button>

                        <div class="flex gap-3">
                            <button type="button"
                                onclick="resetForm()"
                                class="group px-6 py-4 border-2 border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 hover:border-gray-400 transition-all duration-300 font-medium flex items-center justify-center flex-1">
                                <i class="fas fa-redo mr-2 group-hover:rotate-180 transition-transform duration-300"></i>
                                <span>Réinitialiser</span>
                            </button>

                            <a href="categories.php"
                                class="group px-6 py-4 border-2 border-red-200 text-red-600 rounded-xl hover:bg-red-50 hover:border-red-300 transition-all duration-300 font-medium flex items-center justify-center flex-1">
                                <i class="fas fa-times mr-2"></i>
                                <span>Annuler</span>
                            </a>
                        </div>
                    </div>
                    <div class="mt-6 pt-6 border-t border-gray-100">
                        <div class="flex items-start text-sm text-gray-500">
                            <i class="fas fa-exclamation-circle text-yellow-500 mt-0.5 mr-2"></i>
                            <p>Tous les champs marqués d'un <span class="text-red-500">*</span> sont obligatoires. La catégorie sera immédiatement disponible après création.</p>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Aide -->
        <div class="mt-8 bg-blue-50 border-l-4 border-blue-600 p-6 rounded-r-lg">
            <div class="flex">
                <i class="fas fa-info-circle text-blue-600 text-2xl mr-4 mt-1"></i>
                <div>
                    <h4 class="font-bold mb-2">Conseils pour créer une catégorie</h4>
                    <ul class="text-sm text-gray-700 space-y-2">
                        <li>• <strong>Nom clair :</strong> Utilisez un nom simple et compréhensible par les utilisateurs</li>
                        <li>• <strong>Description précise :</strong> Décrivez le type de véhicules inclus dans cette catégorie</li>
                        <li>• <strong>Prix réaliste :</strong> Définissez un prix journalier moyen conforme au marché</li>
                        <li>• <strong>Caractéristiques par défaut :</strong> Ces valeurs seront suggérées lors de l'ajout de nouveaux véhicules</li>
                    </ul>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-50 border-t py-12 text-center text-gray-400 text-sm">
        &copy; 2024 MaBagnole.
    </footer>

    <script>
        // Compteur de caractères pour la description
        const descriptionTextarea = document.getElementById('categoryDescription');
        const charCount = document.getElementById('charCount');

        descriptionTextarea.addEventListener('input', function() {
            const length = this.value.length;
            charCount.textContent = `${length}/500 caractères`;

            // Changer la couleur si approche de la limite
            if (length > 450) {
                charCount.classList.remove('text-gray-400');
                charCount.classList.add('text-yellow-500');
            } else if (length > 480) {
                charCount.classList.remove('text-yellow-500');
                charCount.classList.add('text-red-500');
            } else {
                charCount.classList.remove('text-yellow-500', 'text-red-500');
                charCount.classList.add('text-gray-400');
            }

            // Mettre à jour l'aperçu
            updatePreview();
        });

        // Mise à jour de l'aperçu en temps réel
        function updatePreview() {
            const name = document.getElementById('categoryName').value;
            const description = document.getElementById('categoryDescription').value;

            if (name) {
                document.getElementById('previewName').textContent = name;
                document.getElementById('previewName').classList.remove('text-gray-400');
                document.getElementById('previewName').classList.add('text-gray-800');
            } else {
                document.getElementById('previewName').textContent = 'Nom de la catégorie';
                document.getElementById('previewName').classList.remove('text-gray-800');
                document.getElementById('previewName').classList.add('text-gray-400');
            }

            if (description) {
                document.getElementById('previewDescription').textContent = description.length > 100 ? description.substring(0, 100) + '...' : description;
                document.getElementById('previewDescription').classList.remove('text-gray-400');
                document.getElementById('previewDescription').classList.add('text-gray-600');
            } else {
                document.getElementById('previewDescription').textContent = 'Description apparaîtra ici...';
                document.getElementById('previewDescription').classList.remove('text-gray-600');
                document.getElementById('previewDescription').classList.add('text-gray-400');
            }
        }

        // Écouter les changements sur le nom
        document.getElementById('categoryName').addEventListener('input', updatePreview);

        // Validation du formulaire
        

        function showError(message) {
            // Créer une alerte d'erreur temporaire
            const alert = document.createElement('div');
            alert.className = 'fixed top-4 right-4 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg shadow-lg z-50 max-w-sm';
            alert.innerHTML = `
            <div class="flex items-center">
                <i class="fas fa-exclamation-triangle mr-3"></i>
                <div>
                    <p class="font-medium">Erreur</p>
                    <p class="text-sm">${message}</p>
                </div>
            </div>
        `;
            document.body.appendChild(alert);

            // Supprimer après 5 secondes
            setTimeout(() => {
                alert.remove();
            }, 5000);
        }

        function showSuccess(message) {
            const alert = document.createElement('div');
            alert.className = 'fixed top-4 right-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-lg z-50 max-w-sm';
            alert.innerHTML = `
            <div class="flex items-center">
                <i class="fas fa-check-circle mr-3"></i>
                <div>
                    <p class="font-medium">Succès !</p>
                    <p class="text-sm">${message}</p>
                </div>
            </div>
        `;
            document.body.appendChild(alert);

            // Supprimer après 5 secondes
            setTimeout(() => {
                alert.remove();
            }, 5000);
        }

        function resetForm() {
            if (confirm('Êtes-vous sûr de vouloir réinitialiser le formulaire ? Toutes les données seront perdues.')) {
                document.getElementById('addCategoryForm').reset();
                document.getElementById('iconPreview').classList.add('hidden');
                selectColor('#2563eb');
                updatePreview();
            }
        }
    </script>
</body>

</html>