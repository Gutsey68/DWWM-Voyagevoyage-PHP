<?php
/* Smarty version 4.3.4, created on 2024-02-01 19:25:40
  from 'C:\wamp64\www\projet_2\views\raconte.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_65bbf034538dc2_15775370',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'da3b614a8f032271c2cdf328de9b6b4a73e721d6' => 
    array (
      0 => 'C:\\wamp64\\www\\projet_2\\views\\raconte.tpl',
      1 => 1706815538,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_65bbf034538dc2_15775370 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_164107884865bbf034537d42_41356880', "contenu");
$_smarty_tpl->inheritance->endChild($_smarty_tpl, "views/layout.tpl");
}
/* {block "contenu"} */
class Block_164107884865bbf034537d42_41356880 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'contenu' => 
  array (
    0 => 'Block_164107884865bbf034537d42_41356880',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <!-- système de drag and drop -->
    <div id="dragndrop" class="container mt-5 mb-5">
        <div class="row">
            <div class="col-12">
                <p>Ajoutez jusqu'à 20 photos.</p>
        </div>
        <div class="col-12" id="drop-area">
            <form class="my-form pt-5">
                <input type="file" id="fileElem" multiple accept="image/*">
                <label class="button green-btn" for="fileElem"><i class="fa-solid fa-image"></i>Ajoutez des
                    photos</label>
                <div id="gallery" class="pt-5"></div>
            </form>
        </div>
    </div>
</div>
<!-- Champ pour le nom du voyage -->
<input type="text" id="travelName" name="travelName" placeholder="Nom du voyage" required>

<!-- Champ pour le contenu de l'article -->
    <textarea id="articleContent" name="articleContent" placeholder="Contenu de l'article" rows="5" required></textarea>

    <!-- Champ pour le budget -->
    <input type="number" id="budget" name="budget" placeholder="Budget" required>

    <!-- Champ pour la date -->
    <input type="date" id="date" name="date" required>

    <!-- Champ pour les catégories -->
    <input type="text" id="categories" name="categories" placeholder="Catégories" required>

    <!-- Champ pour la ville -->
    <input type="text" id="city" name="city" placeholder="Ville" required>

    <!-- Champ pour le pays -->
    <input type="text" id="country" name="country" placeholder="Pays" required>

    <!-- Bouton de soumission -->
    <button type="submit" class="submit-btn">Publier l'article</button>
<?php
}
}
/* {/block "contenu"} */
}
