<?php
session_start();
include "../../classes/Article.php";
include "../../classes/ArticlesTag.php";
include "../../classes/Theme.php";
include "../../classes/Tag.php";

if (!isset($_SESSION["user_id"])) {
    header("location: ../../public/login.php");
    exit;
}

$themes = Theme::all();
$tags = Tag::all();

if (isset($_POST["add"])) {
    $tags = $_POST["tags"];
    $title = $_POST["title"];
    $theme_id = $_POST["theme"];
    $content = $_POST["content"];
    $user_id = $_SESSION["user_id"];
    $article_id = (new Article(null, $title, $content, $user_id, $theme_id))->addArticle();

    foreach ($tags as $tag) {
        $result =  (new ArticlesTag($article_id, $tag))->add();
    }

    if ($result == true) {
        header("location: my_articles.php");
        exit;
    }
}
include "../../includes/header.php";

?>

<main class="max-w-4xl mx-auto px-4 py-10">
    <form class="space-y-8" method="post">
        <div class="relative group">
            <div class="w-full h-64 bg-gray-100 rounded-xl border-2 border-dashed border-gray-300 flex flex-col items-center justify-center transition group-hover:bg-gray-200 group-hover:border-blue-400">
                <i class="fas fa-image text-4xl text-gray-400 mb-2"></i>
                <p class="text-sm text-gray-500 font-medium">Ajouter une image de couverture</p>
                <input type="file" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
            </div>
        </div>

        <div class="space-y-4">
            <input type="text" name="title" placeholder="Titre de l'article..." class="w-full text-4xl font-bold bg-transparent border-none outline-none placeholder-gray-300 focus:ring-0">

            <div class="flex flex-wrap gap-4 items-center border-y py-4 border-gray-100">
                <div class="flex items-center gap-2">
                    <span class="text-sm font-bold text-gray-400">Catégorie :</span>
                    <select name="theme" class="bg-blue-50 text-blue-600 font-bold text-sm rounded-lg px-3 py-1 outline-none">
                        <?php foreach ($themes as $theme) { ?>
                            <option value="<?= $theme["id"] ?>"><?= $theme["name"] ?></option>
                        <?php } ?>
                    </select>
                </div>

                <!-- Available Tags Section -->
                <div class="flex-1">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm font-bold text-gray-400">Tags disponibles :</span>

                    </div>

                    <div class="flex flex-wrap gap-2 mb-4" id="tagsContainer">
                        <?php
                        $colors = ['blue', 'purple', 'green', 'yellow', 'red', 'indigo', 'pink'];
                        $colorIndex = 0;
                        foreach ($tags as $tag) {
                            $color = $colors[$colorIndex % count($colors)];
                            $colorClass = "bg-{$color}-100 text-{$color}-800 hover:bg-{$color}-200";
                            $selectedClass = "bg-{$color}-600 text-white";
                            $colorIndex++;
                        ?>
                            <label class="tag-label cursor-pointer" data-tag-id="<?= $tag['id'] ?>">
                                <input type="checkbox"
                                    name="tags[]"
                                    value="<?= $tag['id'] ?>"
                                    class="tag-checkbox hidden"
                                    id="tag_<?= $tag['id'] ?>">
                                <span class="inline-flex items-center gap-1 px-3 py-1.5 rounded-full text-xs font-medium transition tag-button <?= $colorClass ?>">
                                    <i class="fas fa-tag text-xs"></i>
                                    <?= htmlspecialchars($tag['name']) ?>
                                    <span class="tag-check-icon hidden ml-1">
                                        <i class="fas fa-check text-xs"></i>
                                    </span>
                                </span>
                            </label>
                        <?php } ?>
                    </div>

                    <!-- Selected Tags Counter -->
                    <div class="mt-4 flex items-center justify-between mb-2">
                        <div class="text-sm text-gray-500">
                            <span id="selectedCount">0</span> tags sélectionnés
                        </div>

                    </div>

                    <!-- Selected Tags Preview -->
                    <div class="flex flex-wrap gap-2 p-3 bg-gray-50 rounded-lg min-h-12" id="selectedTags">
                        <!-- Selected tags will appear here -->
                        <div class="text-gray-400 text-sm" id="noTagsMessage">
                            Aucun tag sélectionné. Cliquez sur les tags ci-dessus pour les ajouter.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white border rounded-xl shadow-sm overflow-hidden">
            <div class="bg-gray-50 border-b p-3 flex gap-4 text-gray-500 overflow-x-auto">
                <button type="button" class="hover:text-blue-600"><i class="fas fa-bold"></i></button>
                <button type="button" class="hover:text-blue-600"><i class="fas fa-italic"></i></button>
                <button type="button" class="hover:text-blue-600"><i class="fas fa-heading"></i></button>
                <span class="w-px h-4 bg-gray-300 self-center"></span>
                <button type="button" class="hover:text-blue-600"><i class="fas fa-list-ul"></i></button>
                <button type="button" class="hover:text-blue-600"><i class="fas fa-link"></i></button>
                <button type="button" class="hover:text-blue-600"><i class="fas fa-quote-right"></i></button>
                <button type="button" class="ml-auto hover:text-blue-600"><i class="fas fa-question-circle"></i></button>
            </div>
            <textarea name="content" rows="15" placeholder="Commencez à écrire votre histoire..." class="w-full p-6 outline-none resize-none text-lg leading-relaxed"></textarea>
        </div>

        <button name="add" type="submit" class="inline-flex items-center gap-2 bg-blue-600 text-white px-6 py-3 rounded-lg font-bold hover:bg-blue-700 transition">
            <i class="fas fa-plus"></i>
            Écrire un article
        </button>
    </form>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tagLabels = document.querySelectorAll('.tag-label');
        const tagCheckboxes = document.querySelectorAll('.tag-checkbox');
        const selectedTagsContainer = document.getElementById('selectedTags');
        const noTagsMessage = document.getElementById('noTagsMessage');
        const selectedCount = document.getElementById('selectedCount');
        const selectAllBtn = document.getElementById('selectAllTags');
        const deselectAllBtn = document.getElementById('deselectAllTags');
        const clearSelectionBtn = document.getElementById('clearSelection');

        // Store selected tags
        let selectedTags = new Set();

        // Initialize from existing checkboxes (in case of form reload)
        tagCheckboxes.forEach(checkbox => {
            if (checkbox.checked) {
                selectedTags.add(checkbox.value);
            }
        });
        updateDisplay();

        // Handle tag click
        tagLabels.forEach(label => {
            const checkbox = label.querySelector('.tag-checkbox');
            const tagButton = label.querySelector('.tag-button');
            const tagId = label.getAttribute('data-tag-id');
            const tagName = tagButton.textContent.trim();

            label.addEventListener('click', function(e) {
                e.preventDefault();

                // Toggle checkbox
                checkbox.checked = !checkbox.checked;

                if (checkbox.checked) {
                    selectedTags.add(tagId);
                    tagButton.classList.remove('bg-blue-100', 'text-blue-800', 'bg-purple-100', 'text-purple-800', 'bg-green-100', 'text-green-800', 'bg-yellow-100', 'text-yellow-800', 'bg-red-100', 'text-red-800', 'bg-indigo-100', 'text-indigo-800', 'bg-pink-100', 'text-pink-800');
                    tagButton.classList.add('bg-blue-600', 'text-white');

                    // Show check icon
                    const checkIcon = tagButton.querySelector('.tag-check-icon');
                    if (checkIcon) {
                        checkIcon.classList.remove('hidden');
                    }
                } else {
                    selectedTags.delete(tagId);

                    // Get original color classes
                    const originalClasses = tagButton.className.split(' ');
                    const colorClass = originalClasses.find(cls => cls.includes('bg-') && cls.includes('100'));
                    const textClass = originalClasses.find(cls => cls.includes('text-') && cls.includes('800'));

                    // Reset to original color
                    tagButton.className = 'inline-flex items-center gap-1 px-3 py-1.5 rounded-full text-xs font-medium transition tag-button hover:bg-opacity-80';
                    if (colorClass) tagButton.classList.add(colorClass);
                    if (textClass) tagButton.classList.add(textClass);

                    // Hide check icon
                    const checkIcon = tagButton.querySelector('.tag-check-icon');
                    if (checkIcon) {
                        checkIcon.classList.add('hidden');
                    }
                }

                // Update display
                updateDisplay();

                // Visual feedback
                tagButton.style.transform = 'scale(0.95)';
                setTimeout(() => {
                    tagButton.style.transform = 'scale(1)';
                }, 150);
            });
        });

        // Select all tags
        selectAllBtn.addEventListener('click', function() {
            tagCheckboxes.forEach(checkbox => {
                checkbox.checked = true;
                selectedTags.add(checkbox.value);

                // Update visual state
                const label = checkbox.closest('.tag-label');
                const tagButton = label.querySelector('.tag-button');
                tagButton.classList.remove('bg-blue-100', 'text-blue-800', 'bg-purple-100', 'text-purple-800', 'bg-green-100', 'text-green-800', 'bg-yellow-100', 'text-yellow-800', 'bg-red-100', 'text-red-800', 'bg-indigo-100', 'text-indigo-800', 'bg-pink-100', 'text-pink-800');
                tagButton.classList.add('bg-blue-600', 'text-white');

                // Show check icon
                const checkIcon = tagButton.querySelector('.tag-check-icon');
                if (checkIcon) {
                    checkIcon.classList.remove('hidden');
                }
            });

            updateDisplay();
        });

        // Deselect all tags
        deselectAllBtn.addEventListener('click', function() {
            tagCheckboxes.forEach(checkbox => {
                checkbox.checked = false;
                selectedTags.clear();

                // Update visual state
                const label = checkbox.closest('.tag-label');
                const tagButton = label.querySelector('.tag-button');

                // Reset to original color
                const originalClasses = tagButton.className.split(' ');
                const colorClass = originalClasses.find(cls => cls.includes('bg-') && cls.includes('100'));
                const textClass = originalClasses.find(cls => cls.includes('text-') && cls.includes('800'));

                tagButton.className = 'inline-flex items-center gap-1 px-3 py-1.5 rounded-full text-xs font-medium transition tag-button hover:bg-opacity-80';
                if (colorClass) tagButton.classList.add(colorClass);
                if (textClass) tagButton.classList.add(textClass);

                // Hide check icon
                const checkIcon = tagButton.querySelector('.tag-check-icon');
                if (checkIcon) {
                    checkIcon.classList.add('hidden');
                }
            });

            updateDisplay();
        });

        // Clear selection
        clearSelectionBtn.addEventListener('click', function() {
            // Same as deselect all
            deselectAllBtn.click();
        });

        // Function to update the display
        function updateDisplay() {
            // Update counter
            selectedCount.textContent = selectedTags.size;

            // Clear selected tags container
            selectedTagsContainer.innerHTML = '';

            if (selectedTags.size > 0) {
                // Hide no tags message
                noTagsMessage.style.display = 'none';

                // Add each selected tag
                selectedTags.forEach(tagId => {
                    // Find the tag name
                    const tagLabel = document.querySelector(`[data-tag-id="${tagId}"]`);
                    if (tagLabel) {
                        const tagButton = tagLabel.querySelector('.tag-button');
                        const tagName = tagButton.textContent.trim().replace(/\s+/g, ' ');
                        const tagText = tagName.replace('✓', '').trim();

                        const selectedTagElement = document.createElement('span');
                        selectedTagElement.className = 'inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-medium bg-blue-600 text-white';
                        selectedTagElement.innerHTML = `
                        ${tagText}
                        <button type="button" class="ml-1 hover:text-blue-200 remove-tag" data-tag-id="${tagId}">
                            <i class="fas fa-times text-xs"></i>
                        </button>
                    `;
                        selectedTagsContainer.appendChild(selectedTagElement);

                        // Add remove functionality
                        const removeBtn = selectedTagElement.querySelector('.remove-tag');
                        removeBtn.addEventListener('click', function(e) {
                            e.stopPropagation();
                            const tagIdToRemove = this.getAttribute('data-tag-id');

                            // Uncheck the checkbox
                            const checkbox = document.querySelector(`#tag_${tagIdToRemove}`);
                            if (checkbox) {
                                checkbox.checked = false;
                            }

                            // Remove from selected tags
                            selectedTags.delete(tagIdToRemove);

                            // Update visual state of the tag button
                            const tagLabel = document.querySelector(`[data-tag-id="${tagIdToRemove}"]`);
                            if (tagLabel) {
                                const tagButton = tagLabel.querySelector('.tag-button');

                                // Reset to original color
                                const originalClasses = tagButton.className.split(' ');
                                const colorClass = originalClasses.find(cls => cls.includes('bg-') && cls.includes('100'));
                                const textClass = originalClasses.find(cls => cls.includes('text-') && cls.includes('800'));

                                tagButton.className = 'inline-flex items-center gap-1 px-3 py-1.5 rounded-full text-xs font-medium transition tag-button hover:bg-opacity-80';
                                if (colorClass) tagButton.classList.add(colorClass);
                                if (textClass) tagButton.classList.add(textClass);

                                // Hide check icon
                                const checkIcon = tagButton.querySelector('.tag-check-icon');
                                if (checkIcon) {
                                    checkIcon.classList.add('hidden');
                                }
                            }

                            // Update display
                            updateDisplay();
                        });
                    }
                });
            } else {
                // Show no tags message
                noTagsMessage.style.display = 'block';
                selectedTagsContainer.appendChild(noTagsMessage);
            }
        }

        // Form submission validation (optional)
        const form = document.querySelector('form');
        form.addEventListener('submit', function(e) {
            // Optional: Add validation here
            console.log('Submitting with tags:', Array.from(selectedTags));
        });
    });
</script>

<style>
    .tag-button {
        transition: all 0.2s ease;
        user-select: none;
    }

    .tag-button:hover {
        transform: translateY(-1px);
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    /* Color variations for different tag categories */
    .bg-blue-100 {
        background-color: #dbeafe;
    }

    .text-blue-800 {
        color: #1e40af;
    }

    .hover\:bg-blue-200:hover {
        background-color: #bfdbfe;
    }

    .bg-purple-100 {
        background-color: #e9d5ff;
    }

    .text-purple-800 {
        color: #6b21a8;
    }

    .hover\:bg-purple-200:hover {
        background-color: #d8b4fe;
    }

    .bg-green-100 {
        background-color: #d1fae5;
    }

    .text-green-800 {
        color: #065f46;
    }

    .hover\:bg-green-200:hover {
        background-color: #a7f3d0;
    }

    .bg-yellow-100 {
        background-color: #fef3c7;
    }

    .text-yellow-800 {
        color: #92400e;
    }

    .hover\:bg-yellow-200:hover {
        background-color: #fde68a;
    }

    .bg-red-100 {
        background-color: #fee2e2;
    }

    .text-red-800 {
        color: #991b1b;
    }

    .hover\:bg-red-200:hover {
        background-color: #fecaca;
    }

    .bg-indigo-100 {
        background-color: #e0e7ff;
    }

    .text-indigo-800 {
        color: #3730a3;
    }

    .hover\:bg-indigo-200:hover {
        background-color: #c7d2fe;
    }

    .bg-pink-100 {
        background-color: #fce7f3;
    }

    .text-pink-800 {
        color: #9d174d;
    }

    .hover\:bg-pink-200:hover {
        background-color: #fbcfe8;
    }
</style>

</body>

</html>