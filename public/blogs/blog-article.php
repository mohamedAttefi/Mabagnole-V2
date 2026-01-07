<?php
include "../../includes/header.php";
include "../../classes/Article.php";
include "../../classes/BlogComment.php";
include "../../classes/ArticlesTag.php";

$id = $_GET["id"];
$article = Article::find($id);
// var_dump($article);
$comments = BlogComment::findByArticle($id);
$tags = ArticlesTag::getTagForArticle($id);
// var_dump($tags);
$error_message = null;
// print_r($article);



?>

<article class="max-w-4xl mx-auto pt-20 px-4 py-12">
    <div class="text-center mb-10">
        <span class="text-blue-600 font-bold text-sm tracking-widest uppercase mb-4 block"><?= $article["theme_name"] ?></span>
        <h1 class="text-3xl md:text-5xl font-bold mb-6 leading-tight"><?= $article["title"] ?></h1>
        <div class="flex items-center justify-center gap-4 text-gray-500 text-sm">
            <div class="flex items-center gap-2">
                <img src="https://i.pinimg.com/736x/07/fb/34/07fb3452c4640d881a16d08c2e314f3e.jpg" class="w-10 h-10 rounded-full object-cover">
                <span class="font-semibold text-gray-800">Par <?= $article["user_name"] ?></span>
            </div>
            <span>•</span>
            <span>Publié le <?= $article["created_at"] ?></span>
        </div>
    </div>


    <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed space-y-6">


        <div class="bg-gray-50 border-l-4 border-blue-600 p-6 my-8 rounded-r-lg">
            <p><?= $article["content"] ?></p>
            <p class="font-medium">Astuce MaBagnole : Pour cette route, privilégiez une voiture maniable comme une citadine premium.</p>

        </div>
    </div>

    <!-- Section des Tags -->
    <div class="mb-10">
        <h4 class="text-lg font-semibold text-gray-800 mb-4">Tags associés</h4>
        <div class="flex flex-wrap gap-3">
            <!-- Exemple de tags - À remplacer par vos données réelles -->
            <?php foreach ($tags as $tag) { ?>
                <span class="px-4 py-2 bg-blue-100 text-blue-700 rounded-full text-sm font-medium hover:bg-blue-200 transition cursor-pointer">
                    <?= $tag["name"] ?>
                </span>
            <?php } ?>
            <!-- <span class="px-4 py-2 bg-blue-100 text-blue-700 rounded-full text-sm font-medium hover:bg-blue-200 transition cursor-pointer">
                #Conseils
            </span>
            <span class="px-4 py-2 bg-blue-100 text-blue-700 rounded-full text-sm font-medium hover:bg-blue-200 transition cursor-pointer">
                #Sécurité
            </span>
            <span class="px-4 py-2 bg-blue-100 text-blue-700 rounded-full text-sm font-medium hover:bg-blue-200 transition cursor-pointer">
                #Entretien
            </span>
            <span class="px-4 py-2 bg-blue-100 text-blue-700 rounded-full text-sm font-medium hover:bg-blue-200 transition cursor-pointer">
                #Voyage
            </span> -->
        </div>
    </div>

    <div class="flex items-center gap-6 py-10 border-t border-b my-12">

        <button class="flex items-center gap-2 text-gray-600 hover:text-blue-600 transition font-bold">
            <i class="far fa-comment text-xl"></i> <?= $article["total_comments"] ?>
        </button>
        <button class="ml-auto bg-gray-100 p-2 rounded-lg hover:bg-gray-200 transition">
            <i class="fas fa-share-alt"></i>
        </button>
    </div>

    <section id="comments" class="space-y-10">
        <h3 class="text-2xl font-bold">Commentaires (<?= $article["total_comments"] ?>)</h3>

        <!-- No comments message -->
        <?php if (!$comments): ?>
            <div class="text-center py-12 bg-gray-50 rounded-xl border-2 border-dashed border-gray-200">
                <div class="mx-auto w-20 h-20 bg-blue-100 rounded-full flex items-center justify-center mb-6">
                    <i class="far fa-comment text-3xl text-blue-600"></i>
                </div>
                <h4 class="text-xl font-bold text-gray-800 mb-3">Aucun commentaire pour le moment</h4>
                <p class="text-gray-600 max-w-md mx-auto mb-6">
                    Soyez le premier à partager votre avis sur cet article. Votre expérience peut aider d'autres lecteurs !
                </p>
            </div>
        <?php endif; ?>

        <form class="bg-gray-50 p-6 rounded-xl border border-gray-100" action="add_comment.php" method="post">
            <input type="hidden" name="article_id" value="<?= $id ?>">
            <h4 class="font-bold mb-4">Laissez un commentaire</h4>
            <textarea rows="4" name="content" class="w-full p-4 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-600 outline-none mb-4" placeholder="Votre avis nous intéresse..."></textarea>
            <button name="addComment" type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg font-bold hover:bg-blue-700 transition">Publier</button>
        </form>

        <div class="space-y-6">
            <?php foreach ($comments as $comment) { ?>
                <div class="flex gap-4 border p-5 rounded-xl bg-blue-200 shadow-md">
                    <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center font-bold text-blue-600">JD</div>
                    <div class="flex-grow">
                        <div class="flex justify-between mb-1">
                            <h5 class="font-bold"><?= $comment["user_name"] ?></h5>
                        </div>
                        <p class="text-gray-600 text-sm"><?= $comment["commentaire"] ?></p>
                        <button class="text-xs text-blue-600 font-bold mt-2">Répondre</button>
                    </div>
                </div>
            <?php } ?>

        </div>

    </section>
</article>

<footer class="bg-gray-50 border-t py-12 text-center text-gray-400 text-sm">
    &copy; 2024 MaBagnole.
</footer>

</body>

</html>