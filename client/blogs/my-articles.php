<?php
include "../../includes/header.php";
include "../../classes/Article.php";
include "../../classes/Utilisateur.php";

$user_email = $_SESSION["user_email"];
$userId = $_SESSION["user_id"];
$user = Utilisateur::findByEmail($user_email);
$articles = Article::findByUser($userId);
$totalArticles = count($articles);

echo "<br><br><br><br><br>". $totalArticles;

?>


    <main class="max-w-7xl mx-auto pt-24 px-4 py-8">
        <!-- User Profile Header -->
        <div class="gradient-bg rounded-2xl p-8 mb-10 shadow-lg">
            <div class="flex flex-col md:flex-row items-center md:items-start gap-6">
                <div class="relative">
                    <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&q=80&w=150" 
                         class="w-32 h-32 rounded-full object-cover border-4 border-white shadow-lg">
                    <div class="absolute -bottom-2 -right-2 bg-blue-600 text-white rounded-full w-10 h-10 flex items-center justify-center">
                        <i class="fas fa-pen-nib"></i>
                    </div>
                </div>
                
                <div class="flex-1 text-center md:text-left">
                    <h1 class="text-3xl md:text-4xl font-bold mb-2"><?= htmlspecialchars($user->__get('nom') ?? 'Auteur') ?></h1>
                    <div class="flex flex-wrap justify-center md:justify-start gap-6 mb-6">
                        <div class="text-center">
                            <div class="text-2xl font-bold text-blue-700"><?= $totalArticles ?></div>
                            <div class="text-sm text-gray-500">Articles</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-blue-700">
                                <?= array_sum(array_column($articles, 'total_comments')) ?>
                            </div>
                            <div class="text-sm text-gray-500">Commentaires</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-blue-700">
                                <?= (new DateTime ($user->__get('dateInscription')))->format('Y-m-d') ?? '2023' ?>
                            </div>
                            <div class="text-sm text-gray-500">Membre depuis</div>
                        </div>
                    </div>
                    
                    <div class="flex flex-wrap gap-3 justify-center md:justify-start">
                        <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">Automobile</span>
                        <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">Voyage</span>
                        <span class="bg-purple-100 text-purple-800 px-3 py-1 rounded-full text-sm font-medium">Conseils</span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Stats and Filter Section -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Articles publiés</h2>
                <p class="text-gray-600">Découvrez tous les articles écrits par <?= htmlspecialchars($user->__get('nom') ?? 'cet auteur') ?></p>
            </div>
            
            <div class="flex gap-4">
                <div class="relative">
                    <select class="appearance-none bg-white border border-gray-300 rounded-lg px-4 py-2 pr-10 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="newest">Plus récents</option>
                        <option value="oldest">Plus anciens</option>
                        <option value="popular">Plus populaires</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <i class="fas fa-chevron-down"></i>
                    </div>
                </div>
                
                <div class="relative">
                    <select class="appearance-none bg-white border border-gray-300 rounded-lg px-4 py-2 pr-10 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="all">Tous les thèmes</option>
                        <option value="road-trip">Road trip</option>
                        <option value="tips">Conseils</option>
                        <option value="review">Tests</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <i class="fas fa-chevron-down"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Articles Grid -->
        <?php if ($totalArticles > 0): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                <?php foreach ($articles as $article): ?>
                    <article class="article-card bg-white rounded-2xl overflow-hidden shadow-lg border border-gray-100 transition-all duration-300">
                        <!-- Article Image -->
                        <div class="relative h-48 overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1549399542-7e3f8b79c341?auto=format&fit=crop&q=80&w=800" 
                                 alt="<?= htmlspecialchars($article['title']) ?>" 
                                 class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
                            <div class="absolute top-4 left-4">
                                <span class="bg-blue-600 text-white px-3 py-1 rounded-full text-xs font-bold">
                                    <?= htmlspecialchars($article['theme_name']) ?>
                                </span>
                            </div>
                        </div>
                        
                        <!-- Article Content -->
                        <div class="p-6">
                            <h3 class="text-xl font-bold mb-3 line-clamp-2">
                                <a href="article.php?id=<?= $article['id'] ?>" class="hover:text-blue-600 transition">
                                    <?= htmlspecialchars($article['title']) ?>
                                </a>
                            </h3>
                            
                            <p class="text-gray-600 mb-4 line-clamp-3">
                                <?= substr(strip_tags($article['content']), 0, 150) ?>...
                            </p>
                            
                            <!-- Article Meta -->
                            <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                                <div class="flex items-center gap-2">
                                    <i class="far fa-calendar"></i>
                                    <span><?= date('d/m/Y', strtotime($article['created_at'])) ?></span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <i class="far fa-comment"></i>
                                    <span><?= $article['total_comments'] ?></span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <i class="far fa-clock"></i>
                                    <span><?= ceil(strlen($article['content']) / 1500) ?> min</span>
                                </div>
                            </div>
                            
                            <!-- Read More Button -->
                            <a href="article.php?id=<?= $article['id'] ?>" 
                               class="block w-full text-center bg-blue-50 text-blue-700 font-semibold py-3 rounded-lg hover:bg-blue-100 transition">
                                Lire l'article
                            </a>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
            
            <!-- Pagination (if needed) -->
            <div class="flex justify-center items-center gap-2 mb-12">
                <button class="w-10 h-10 flex items-center justify-center rounded-lg border border-gray-300 hover:bg-gray-50">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button class="w-10 h-10 flex items-center justify-center rounded-lg bg-blue-600 text-white font-bold">1</button>
                <button class="w-10 h-10 flex items-center justify-center rounded-lg border border-gray-300 hover:bg-gray-50">2</button>
                <button class="w-10 h-10 flex items-center justify-center rounded-lg border border-gray-300 hover:bg-gray-50">3</button>
                <span class="px-2">...</span>
                <button class="w-10 h-10 flex items-center justify-center rounded-lg border border-gray-300 hover:bg-gray-50">8</button>
                <button class="w-10 h-10 flex items-center justify-center rounded-lg border border-gray-300 hover:bg-gray-50">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
            
        <?php else: ?>
            <!-- Empty State -->
            <div class="text-center py-16 bg-white rounded-2xl shadow-sm border border-gray-200">
                <div class="w-24 h-24 bg-blue-50 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-pen-nib text-blue-500 text-4xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-3">Aucun article publié</h3>
                <p class="text-gray-600 max-w-md mx-auto mb-8">
                    <?= htmlspecialchars($user->__get('nom') ?? 'Cet auteur') ?> n'a pas encore publié d'articles sur MaBagnole.
                </p>
                <a href="write-article.php" class="inline-flex items-center gap-2 bg-blue-600 text-white px-6 py-3 rounded-lg font-bold hover:bg-blue-700 transition">
                    <i class="fas fa-plus"></i>
                    Écrire un article
                </a>
            </div>
        <?php endif; ?>
        
        <!-- User Stats Summary -->
        <div class="stats-card rounded-2xl p-8 mb-12">
            <h3 class="text-2xl font-bold mb-6">Statistiques de publication</h3>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="text-center p-6 bg-blue-50 rounded-xl">
                    <div class="text-3xl font-bold text-blue-700 mb-2"><?= $totalArticles ?></div>
                    <div class="text-gray-600">Articles écrits</div>
                </div>
                <div class="text-center p-6 bg-green-50 rounded-xl">
                    <div class="text-3xl font-bold text-green-700 mb-2">
                        <?= array_sum(array_column($articles, 'total_comments')) ?>
                    </div>
                    <div class="text-gray-600">Commentaires reçus</div>
                </div>
                <div class="text-center p-6 bg-purple-50 rounded-xl">
                    <div class="text-3xl font-bold text-purple-700 mb-2">
                        <?= count(array_unique(array_column($articles, 'theme_id'))) ?>
                    </div>
                    <div class="text-gray-600">Thèmes abordés</div>
                </div>
                <div class="text-center p-6 bg-amber-50 rounded-xl">
                    <div class="text-3xl font-bold text-amber-700 mb-2">
                        <?= $totalArticles > 0 ? date('F Y', strtotime(min(array_column($articles, 'created_at')))) : '--' ?>
                    </div>
                    <div class="text-gray-600">Première publication</div>
                </div>
            </div>
        </div>
    </main>
    
    <footer class="bg-gray-50 border-t py-12 text-center text-gray-400 text-sm">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-center mb-8">
                <div class="mb-6 md:mb-0">
                    <div class="text-2xl font-bold text-gray-800 mb-2">MaBagnole</div>
                    <p class="text-gray-600 max-w-md">La plateforme de référence pour les passionnés d'automobile et de road trips.</p>
                </div>
                
                <div class="flex gap-6">
                    <a href="#" class="text-gray-600 hover:text-blue-600 transition">
                        <i class="fab fa-facebook text-xl"></i>
                    </a>
                    <a href="#" class="text-gray-600 hover:text-blue-600 transition">
                        <i class="fab fa-twitter text-xl"></i>
                    </a>
                    <a href="#" class="text-gray-600 hover:text-blue-600 transition">
                        <i class="fab fa-instagram text-xl"></i>
                    </a>
                </div>
            </div>
            
            <div class="border-t pt-8">
                &copy; 2024 MaBagnole. Tous droits réservés.
            </div>
        </div>
    </footer>

    <script>
        // Simple script for interactive elements
        document.addEventListener('DOMContentLoaded', function() {
            // Article card hover effect enhancement
            const articleCards = document.querySelectorAll('.article-card');
            articleCards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-8px)';
                });
                
                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });
            
            // Filter functionality (basic example)
            const filterSelects = document.querySelectorAll('select');
            filterSelects.forEach(select => {
                select.addEventListener('change', function() {
                    console.log('Filter changed:', this.value);
                    // Here you would typically reload the page with new parameters
                    // or make an AJAX request to filter articles
                });
            });
            
            // Simulate loading for pagination
            const paginationButtons = document.querySelectorAll('.pagination-button');
            paginationButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    if (!this.classList.contains('bg-blue-600')) {
                        // This would be where you load the new page of articles
                        console.log('Loading page:', this.textContent);
                    }
                });
            });
        });
    </script>
</body>
</html>