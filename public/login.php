<?php
include "../classes/Utilisateur.php";
session_start();
$errors = null;
$general_error = null;
$success_message = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email)) {
        $errors['email'] = 'L\'email est requis';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Email invalide';
    }

    if (empty($password)) {
        $errors['password'] = 'Le mot de passe est requis';
    }

    if (empty($errors)) {
        $user = Utilisateur::seConnecter($email, $password);
        // print_r($user);
        if ($user) {
            $success_message = 'Connexion réussie !';
            $_SESSION["user_id"] = $user->__get("id");
            $_SESSION["user_nom"] = $user->__get("nom");
            $_SESSION["user_email"] = $user->__get("email");
            $_SESSION["user_permis_numero"] = $user->__get("permisNumero");
            $_SESSION["user_role"] = $user->__get("role");
            $_SESSION["user_adresse"] = $user->__get("adress");
            $_SESSION["user_telephone"] = $user->__get("telephone");
            $_SESSION["user_creation_date"] = $user->__get("dateInscription");

            print_r($_SESSION);

            if($user->__get("role") == "client"){
                header("location: ../client/dashboard.php");
                exit;
            }else{
                header("location: ../admin/dashboard.php");
                exit;
            }
            
        } else {
            $general_error = 'Email ou mot de passe incorrect';
        }
    }
}

// echo password_hash("ME551234", PASSWORD_BCRYPT);

// Inclure la vue HTML
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - MaBagnole</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .login-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .error-placeholder {
            min-height: 24px;
        }
    </style>
</head>

<body class="bg-gradient-to-br from-gray-50 to-blue-50 min-h-screen">

    <!-- Header -->
    <header class="py-4 px-4 sm:px-8">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <a href="index.html" class="flex items-center gap-3 group">
                <div class="bg-blue-600 p-2 rounded-xl">
                    <i class="fas fa-car text-white text-2xl"></i>
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Ma<span class="text-blue-600">Bagnole</span></h1>
                    <p class="text-xs text-gray-500">Location de véhicules premium</p>
                </div>
            </a>
            <a href="index.html" class="text-sm font-medium text-blue-600 hover:text-blue-800 transition flex items-center gap-2">
                <i class="fas fa-home"></i>
                <span>Retour à l'accueil</span>
            </a>
        </div>
    </header>

    <main class="flex-grow flex items-center justify-center px-4 py-8">
        <div class="w-full max-w-6xl">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-0 items-stretch bg-white rounded-3xl shadow-2xl overflow-hidden border border-gray-100">

                <div class="hidden lg:flex login-bg p-12 flex-col justify-between text-white relative overflow-hidden">
                    <div class="absolute top-0 right-0 -mr-20 -mt-20 w-64 h-64 bg-white opacity-10 rounded-full"></div>
                    <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-48 h-48 bg-white opacity-10 rounded-full"></div>

                    <div class="relative z-10">
                        <h2 class="text-4xl font-bold leading-tight mb-6">
                            Roulez avec <br>
                            <span class="text-blue-200">élégance et confort.</span>
                        </h2>
                        <p class="text-lg opacity-90 max-w-md">
                            Rejoignez la plus grande communauté de location de véhicules premium et profitez d'offres exclusives adaptées à votre style.
                        </p>
                    </div>

                    <div class="relative z-10">
                        <div class="flex items-center gap-4 mb-8">
                            <div class="flex -space-x-3">
                                <img class="w-10 h-10 rounded-full border-2 border-white" src="https://i.pravatar.cc/100?u=1" alt="User">
                                <img class="w-10 h-10 rounded-full border-2 border-white" src="https://i.pravatar.cc/100?u=2" alt="User">
                                <img class="w-10 h-10 rounded-full border-2 border-white" src="https://i.pravatar.cc/100?u=3" alt="User">
                            </div>
                            <p class="text-sm font-medium">+2,000 membres actifs ce mois-ci</p>
                        </div>

                        <div class="bg-white/10 backdrop-blur-md p-4 rounded-2xl border border-white/20">
                            <p class="text-sm italic">"La meilleure expérience de location que j'ai eue jusqu'à présent. Simple, rapide et des voitures incroyables !"</p>
                            <p class="text-xs font-bold mt-2">— Thomas D., Client fidèle</p>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col">
                    <div class="lg:hidden login-bg p-8 text-white text-center">
                        <h2 class="text-2xl font-bold mb-2">Bienvenue à bord !</h2>
                        <p class="opacity-90">Accédez à votre espace personnel</p>
                    </div>

                    <div class="p-8 md:p-12 lg:p-16 flex-grow flex flex-col justify-center">
                        <div class="mb-8 hidden lg:block">
                            <h2 class="text-3xl font-bold text-gray-800">Se connecter</h2>
                            <p class="text-gray-500 mt-2">Heureux de vous revoir parmi nous !</p>
                        </div>

                        <?php if (isset($general_error)): ?>
                            <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                                <div class="flex items-center gap-3 text-red-700">
                                    <i class="fas fa-exclamation-triangle text-lg"></i>
                                    <p class="font-medium"><?php echo htmlspecialchars($general_error); ?></p>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if (isset($success_message)): ?>
                            <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg">
                                <div class="flex items-center gap-3 text-green-700">
                                    <i class="fas fa-check-circle text-lg"></i>
                                    <p class="font-medium"><?php echo htmlspecialchars($success_message); ?></p>
                                </div>
                            </div>
                        <?php endif; ?>

                        <form action="login.php" method="POST" class="space-y-5">
                            <div class="space-y-2">
                                <label class="text-xs font-bold text-gray-500 uppercase tracking-widest">Email</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <i class="fas fa-envelope text-gray-400"></i>
                                    </div>
                                    <input type="email" name="email" id="email"
                                        value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>"
                                        required placeholder="votre@email.com"
                                        class="w-full pl-11 pr-4 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:bg-white outline-none transition-all shadow-sm">
                                </div>
                            </div>

                            <div class="space-y-2">
                                <div class="flex justify-between items-center">
                                    <label class="text-xs font-bold text-gray-500 uppercase tracking-widest">Mot de passe</label>
                                </div>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <i class="fas fa-lock text-gray-400"></i>
                                    </div>
                                    <input type="password" name="password" id="password"
                                        required placeholder="••••••••"
                                        class="w-full pl-11 pr-12 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:bg-white outline-none transition-all shadow-sm">
                                    <button type="button" onclick="togglePassword()" class="absolute inset-y-0 right-0 pr-4 flex items-center">
                                        <i id="eyeIcon" class="fas fa-eye text-gray-400 hover:text-blue-600"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="flex items-center justify-between">
                                <label class="flex items-center">
                                    <input type="checkbox" name="remember" id="remember" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                    <span class="ml-2 text-sm text-gray-600">Rester connecté</span>
                                </label>
                                <a href="forgot-password.php" class="text-sm font-semibold text-blue-600 hover:text-blue-800">Oublié ?</a>
                            </div>

                            <button type="submit" name="login" class="w-full bg-blue-600 text-white py-4 rounded-2xl font-bold text-lg hover:bg-blue-700 transition-all shadow-lg shadow-blue-200 flex items-center justify-center gap-3">
                                <span>Se connecter</span>
                                <i class="fas fa-arrow-right text-sm"></i>
                            </button>
                        </form>

                        <div class="mt-10 text-center">
                            <p class="text-gray-500">
                                Pas encore de compte ?
                                <a href="register.php" class="text-blue-600 font-bold hover:underline ml-1">Créer un compte</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        // Toggle password visibility
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.className = 'fas fa-eye-slash text-blue-500';
            } else {
                passwordInput.type = 'password';
                eyeIcon.className = 'fas fa-eye text-gray-400';
            }
        }
    </script>

</body>

</html>