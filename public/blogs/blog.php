<?php
include "../../includes/header.php";
include "../../classes/Article.php";
include "../../classes/Theme.php";

$themes = Theme::all();

$page = $_GET['page'] ?? 1;
$limit = 6; 

$articles = Article::paginate($page, $limit);
$totalArticles = count(Article::all());
$totalPages = ceil($totalArticles / $limit);





// print_r($articles);
// print_r($themes);

?>

<header class="max-w-7xl mx-auto px-6 pt-20 pb-12">
    <div class="text-center space-y-4">
        <span class="text-blue-600 font-black text-xs uppercase tracking-[0.4em]">Le Journal de Bord</span>
        <h1 class="text-4xl md:text-6xl font-black tracking-tighter text-slate-900">Explorer. <span class="text-blue-600">Rouler.</span> Partager.</h1>
        <p class="text-slate-500 max-w-xl mx-auto font-medium">Découvrez les meilleures astuces, destinations et actualités automobiles sélectionnées par notre communauté.</p>
    </div>

    <div class="flex flex-wrap justify-center gap-3 mt-12">
        <form>
            <button class="px-6 py-2.5 rounded-full bg-slate-900 text-white font-bold text-sm shadow-xl shadow-slate-200">Tous les articles</button>
            <?php foreach ($themes as $theme) { ?>
                <button class="px-6 py-2.5 rounded-full bg-white border border-slate-100 text-slate-500 font-bold text-sm hover:border-blue-200 hover:text-blue-600 transition" value="<?= $theme["id"] ?></button>"><?= $theme["name"] ?></button>
            <?php } ?>
        </form>
    </div>
</header>

<main class="max-w-7xl mx-auto px-6 py-12">
    <?php if (empty($articles)): ?>
        <div class="text-center py-20">
            <div class="w-24 h-24 mx-auto mb-6 bg-slate-100 rounded-full flex items-center justify-center">
                <i class="far fa-newspaper text-3xl text-slate-400"></i>
            </div>
            <h3 class="text-xl font-bold text-slate-700 mb-2">Aucun article pour le moment</h3>
            <p class="text-slate-500 mb-6">Revenez bientôt pour découvrir nos nouveaux articles !</p>
        </div>
    <?php else: ?>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            <?php foreach ($articles as $article) { ?>
                <article class="blog-card group bg-white rounded-[2.5rem] overflow-hidden border border-slate-100 shadow-sm hover:shadow-2xl hover:shadow-blue-100/50">

                    <div class="p-8">
                        <div class="flex items-center gap-2 text-slate-400 text-[10px] font-bold uppercase tracking-widest mb-4">
                            <i class="far fa-calendar"></i> <?= $article["created_at"] ?> <i class="far fa-clock"></i>
                        </div>
                        <h2 class="text-xl font-black mb-4 leading-tight group-hover:text-blue-600 transition">
                            <a href="blog-article.php?id=<?= $article["article_id"] ?>"><?= $article["title"] ?></a>
                        </h2>
                        <p class="text-slate-500 text-sm leading-relaxed mb-8 line-clamp-3"><?= $article["content"] ?></p>
                        <div class="flex items-center justify-between pt-6 border-t border-slate-50">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold text-[10px]">ML</div>
                                <span class="text-xs font-bold text-slate-700"><?= $article["user_name"] ?></span>
                            </div>
                            <i class="fas fa-arrow-right text-slate-300 group-hover:text-blue-600 group-hover:translate-x-1 transition-all"></i>
                        </div>
                    </div>
                </article>
            <?php } ?>
            <?php if ($totalPages > 1): ?>
                <div class="mt-20 flex flex-col items-center gap-6">
                 
                    <div class="flex justify-center items-center gap-4">
                        <?php if ($page > 1): ?>
                            <a href="?page=<?= $page - 1 ?>"
                                class="w-12 h-12 rounded-2xl border border-slate-200 flex items-center justify-center text-slate-400 hover:bg-white hover:border-blue-600 hover:text-blue-600 transition shadow-sm">
                                <i class="fas fa-chevron-left"></i>
                            </a>
                        <?php else: ?>
                            <span class="w-12 h-12 rounded-2xl border border-slate-100 flex items-center justify-center text-slate-300 cursor-not-allowed">
                                <i class="fas fa-chevron-left"></i>
                            </span>
                        <?php endif; ?>

                        <span class="font-black text-slate-900 text-lg">
                            Page <?= $page ?> <span class="text-slate-300 mx-2">sur</span> <?= $totalPages ?>
                        </span>

                        <?php if ($page < $totalPages): ?>
                            <a href="?page=<?= $page + 1 ?>"
                                class="w-12 h-12 rounded-2xl border border-slate-200 flex items-center justify-center text-slate-400 hover:bg-white hover:border-blue-600 hover:text-blue-600 transition shadow-sm">
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        <?php else: ?>
                            <span class="w-12 h-12 rounded-2xl border border-slate-100 flex items-center justify-center text-slate-300 cursor-not-allowed">
                                <i class="fas fa-chevron-right"></i>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>

        </div>


</main>

<?php endif; ?>
<a href="../../client/blogs/write-article.php" class="fixed bottom-8 right-8 w-14 h-14 rounded-full bg-blue-600 text-white flex items-center justify-center shadow-2xl shadow-blue-300 hover:bg-blue-700 hover:scale-110 transition-all z-50">
    <i class="fas fa-pen text-lg"></i>
</a>

<footer class="bg-white border-t border-slate-100 py-12 text-center">
    <p class="text-slate-400 font-bold text-xs uppercase tracking-widest">© 2024 MaBagnole Mag — Tous droits réservés</p>
</footer>

</body>

</html>

