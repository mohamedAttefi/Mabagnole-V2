<?php
include "../classes/Utilisateur.php";


echo $_SERVER["PHP_SELF"];


session_start();
$field_errors = [];
$success_message = null;
$general_error = null;
$validation_errors = [];

if (isset($_POST["register"])) {
    $nom = $_POST["nom"];
    $email = $_POST["email"];
    $telephone = $_POST["telephone"];
    $adresse = $_POST["adresse"];
    $permis_numero = $_POST["permis_numero"];
    $mot_de_passe = $_POST["mot_de_passe"];
    $password_confirmation = $_POST["password_confirmation"];

    $validation_patterns = [
        'nom' => "/^[a-zA-ZÀ-ÿ\s\-\']{2,50}$/u",
        'email' => "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/",
        'telephone' => "/^(?:(?:\+|212|0)\s*[1-9](?:[\s.-]*\d{2}){4})$/",
        'mot_de_passe' => "/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/",
        'adresse' => "/^[a-zA-Z0-9À-ÿ\s\-\',.°]{5,100}$/u",
        'ville' => "/^[a-zA-ZÀ-ÿ\s\-]{2,50}$/u",
        'permis_numero' => "/^[A-Z0-9]{12,15}$/"
    ];


    foreach ($validation_patterns as $field => $pattern) {
        // echo $field;
        if ($field === 'mot_de_passe') {
            if (!preg_match($pattern, $_POST[$field])) {
                $validation_errors[$field] = true;
                $field_errors[$field] = "Le mot de passe doit contenir au moins 8 caractères, une majuscule, une minuscule, un chiffre et un caractère spécial";
            }
        } elseif (isset($_POST[$field]) && !empty($_POST[$field])) {
            if (!preg_match($pattern, $_POST[$field])) {
                $validation_errors[$field] = true;

                switch ($field) {
                    case 'nom':
                        $field_errors[$field] = "Le nom doit contenir uniquement des lettres (2-50 caractères)";
                        break;
                    case 'email':
                        $field_errors[$field] = "Format d'email invalide";
                        break;
                    case 'telephone':
                        $field_errors[$field] = "Format de téléphone invalide (ex: +33 6 12 34 56 78 ou 06 12 34 56 78)";
                        break;
                    case 'adresse':
                        $field_errors[$field] = "L'adresse doit contenir entre 5 et 100 caractères";
                        break;
                    case 'permis_numero':
                        $field_errors[$field] = "Le numéro de permis doit contenir 12 à 15 caractères (lettres majuscules et chiffres)";
                        break;
                }

                // print_r($validation_errors);
            }
        }
    }

    if (empty($validation_errors)) {
        $user = new Utilisateur($nom, $email, $mot_de_passe, "client", $telephone, $adresse, $permis_numero);
        $resultat = $user->sInscrire();
        echo "xi";

        if (!$resultat) {
            $general_error = "Email already exists!";
            echo "xi";
        } else {
            header("location: login.php");
            exit;
        }
    }
}

function get_field_class($field_name)
{
    global $field_errors;
    return isset($field_errors[$field_name]) ? 'border-red-500' : 'border-gray-300';
}

function display_field_error($field_name)
{
    global $field_errors;
    if (isset($field_errors[$field_name])) {
        echo '<p class="mt-1 text-sm text-red-600">' . $field_errors[$field_name] . '</p>';
    }
}


?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - MaBagnole</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .register-bg {
            background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
        }

        .error-placeholder {
            min-height: 20px;
        }

        /* Custom scrollbar pour le formulaire si nécessaire */
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #3b82f6;
            border-radius: 10px;
        }
    </style>
</head>

<body class="bg-gradient-to-br from-gray-50 to-blue-50 min-h-screen flex flex-col">

    <header class="py-4 px-4 sm:px-8">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <a href="index.php" class="flex items-center gap-3 group">
                <div class="bg-blue-600 p-2 rounded-xl">
                    <i class="fas fa-car text-white text-2xl"></i>
                </div>
                <h1 class="text-2xl font-bold text-gray-800">Ma<span class="text-blue-600">Bagnole</span></h1>
            </a>
            <a href="login.php" class="text-sm font-bold text-blue-600 hover:text-blue-800 transition">
                Déjà membre ? Se connecter
            </a>
        </div>
    </header>

    <main class="flex-grow flex items-center justify-center px-4 py-6">
        <div class="w-full max-w-6xl bg-white rounded-3xl shadow-2xl overflow-hidden border border-gray-100">
            <div class="grid grid-cols-1 lg:grid-cols-2">

                <div class="hidden lg:flex register-bg p-12 flex-col justify-between text-white relative">
                    <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full -mr-32 -mt-32"></div>

                    <div class="relative z-10">
                        <h2 class="text-4xl font-bold mb-6 italic">Prêt pour l'aventure ?</h2>
                        <p class="text-blue-100 text-lg mb-10">En quelques clics, accédez à une flotte de véhicules d'exception.</p>

                        <div class="space-y-8">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center">
                                    <i class="fas fa-shield-check text-xl"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold">Protection Totale</h4>
                                    <p class="text-sm text-blue-100 italic">Données sécurisées & Assurances incluses.</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-full bg-white/20 flex items-center justify-center">
                                    <i class="fas fa-key text-xl"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold">Liberté Absolue</h4>
                                    <p class="text-sm text-blue-100 italic">Louez où vous voulez, quand vous voulez.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="relative z-10 bg-black/10 p-6 rounded-2xl border border-white/10">
                        <p class="text-sm leading-relaxed">
                            <i class="fas fa-info-circle mr-2"></i>
                            Votre **numéro de permis** et votre **adresse** sont nécessaires pour générer vos contrats de location instantanément.
                        </p>
                    </div>
                </div>

                <div class="p-8 lg:p-12 max-h-[85vh] overflow-y-auto custom-scrollbar">
                    <div class="mb-8">
                        <h2 class="text-3xl font-bold text-gray-800">Inscription</h2>
                        <p class="text-gray-500">Créez votre profil conducteur gratuitement.</p>
                    </div>

                    <?php if (!empty($general_error)): ?>
                        <div class="mb-6 p-4 bg-red-50 text-red-700 border-l-4 border-red-500 rounded flex items-center gap-3">
                            <i class="fas fa-times-circle"></i>
                            <p class="text-sm font-medium"><?= htmlspecialchars($general_error) ?></p>
                        </div>
                    <?php endif; ?>

                    <form id="registerForm" action="" method="POST" class="space-y-5">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div class="space-y-1">
                                <label class="text-xs font-bold text-gray-400 uppercase">Nom Complet</label>
                                <div class="relative">
                                    <i class="fas fa-user absolute left-4 top-4 text-gray-300"></i>
                                    <input type="text" name="nom" required placeholder="Jean Dupont"
                                        class="w-full pl-11 pr-4 py-3 bg-gray-50 border <?php echo get_field_class('nom'); ?> rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition-all">
                                </div>

                                <?php display_field_error('nom'); ?>


                            </div>
                            <div class="space-y-1">
                                <label class="text-xs font-bold text-gray-400 uppercase">Téléphone</label>
                                <div class="relative">
                                    <i class="fas fa-phone absolute left-4 top-4 text-gray-300"></i>
                                    <input type="tel" name="telephone" required placeholder="06 00 00 00 00"
                                        class="w-full pl-11 pr-4 py-3 bg-gray-50 border <?php echo get_field_class('telephone'); ?> rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition-all">
                                </div>

                                <?php display_field_error('telephone'); ?>


                            </div>
                        </div>

                        <div class="space-y-1">
                            <label class="text-xs font-bold text-gray-400 uppercase">Adresse Email</label>
                            <div class="relative">
                                <i class="fas fa-envelope absolute left-4 top-4 text-gray-300"></i>
                                <input type="email" name="email" required placeholder="jean@exemple.com"
                                    class="w-full pl-11 pr-4 py-3 bg-gray-50 border <?php echo get_field_class('email'); ?> rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition-all">
                            </div>

                            <?php display_field_error('email'); ?>

                        </div>

                        <div class="space-y-1">
                            <label class="text-xs font-bold text-gray-400 uppercase">Adresse Postale</label>
                            <div class="relative">
                                <i class="fas fa-map-marker-alt absolute left-4 top-4 text-gray-300"></i>
                                <input type="text" name="adresse" required placeholder="123 Rue de la Paix, Paris"
                                    class="w-full pl-11 pr-4 py-3 bg-gray-50 border <?php echo get_field_class('adresse'); ?> rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition-all">
                            </div>


                            <?php display_field_error('adresse'); ?>


                        </div>

                        <div class="space-y-1">
                            <label class="text-xs font-bold text-gray-400 uppercase">Numéro de Permis</label>
                            <div class="relative">
                                <i class="fas fa-id-card absolute left-4 top-4 text-gray-300"></i>
                                <input type="text" name="permis_numero" required placeholder="12 chiffres"
                                    class="w-full pl-11 pr-4 py-3 bg-gray-50 border <?php echo get_field_class('permis_numero'); ?> rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition-all">
                            </div>

                            <?php display_field_error('permis_numero'); ?>


                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div class="space-y-1">
                                <label class="text-xs font-bold text-gray-400 uppercase">Mot de passe</label>
                                <div class="relative">
                                    <input type="password" name="mot_de_passe" id="password" required
                                        class="w-full px-4 py-3 bg-gray-50 border <?php echo get_field_class('password'); ?> rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition-all">
                                    <button type="button" onclick="togglePassword('password')" class="absolute right-4 top-3.5 text-gray-400">
                                        <i class="fas fa-eye"></i>
                                    </button>

                                </div>
                                <?php display_field_error('password'); ?>
                            </div>
                            <div class="space-y-1">
                                <label class="text-xs font-bold text-gray-400 uppercase">Confirmation</label>
                                <div class="relative">
                                    <input type="password" name="password_confirmation" id="password_confirmation" required
                                        class="w-full px-4 py-3 bg-gray-50 border <?php echo get_field_class('password_confirmation'); ?> rounded-xl focus:ring-2 focus:ring-blue-500 outline-none transition-all">
                                </div>


                                <?php display_field_error('password_confirmation'); ?>


                            </div>
                        </div>

                        <div class="flex items-start gap-3 pt-2">
                            <input type="checkbox" name="conditions" required class="mt-1 w-4 h-4 text-blue-600 rounded">
                            <label class="text-xs text-gray-500 leading-tight">
                                J'accepte les <a href="#" class="text-blue-600 underline">Conditions Générales</a> et la
                                <a href="#" class="text-blue-600 underline">Politique de confidentialité</a>.
                            </label>
                        </div>

                        <button type="submit" name="register"
                            class="w-full bg-blue-600 text-white py-4 rounded-xl font-bold text-lg hover:bg-blue-700 transition-all shadow-lg shadow-blue-100 flex items-center justify-center gap-3">
                            <i class="fas fa-user-plus"></i>
                            Créer mon compte
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </main>

    <script>
        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            const icon = input.nextElementSibling?.querySelector('i') || input.parentElement.querySelector('i.fa-eye, i.fa-eye-slash');
            if (input.type === 'password') {
                input.type = 'text';
                icon.className = 'fas fa-eye-slash';
            } else {
                input.type = 'password';
                icon.className = 'fas fa-eye';
            }
        }
    </script>
</body>

</html>