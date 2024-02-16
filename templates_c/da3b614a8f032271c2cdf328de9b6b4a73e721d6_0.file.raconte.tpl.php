<?php
/* Smarty version 4.3.4, created on 2024-02-16 12:35:56
  from 'C:\wamp64\www\projet_2\views\raconte.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_65cf56accbaa32_46809784',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'da3b614a8f032271c2cdf328de9b6b4a73e721d6' => 
    array (
      0 => 'C:\\wamp64\\www\\projet_2\\views\\raconte.tpl',
      1 => 1708086950,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_65cf56accbaa32_46809784 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_184494407965cf56acc9a383_48705526', "contenu");
$_smarty_tpl->inheritance->endChild($_smarty_tpl, "views/layout.tpl");
}
/* {block "contenu"} */
class Block_184494407965cf56acc9a383_48705526 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'contenu' => 
  array (
    0 => 'Block_184494407965cf56acc9a383_48705526',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <?php if ((count($_smarty_tpl->tpl_vars['arrErrors']->value) > 0)) {?>
        <div class="alert alert-danger">
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['arrErrors']->value, 'strError');
$_smarty_tpl->tpl_vars['strError']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['strError']->value) {
$_smarty_tpl->tpl_vars['strError']->do_else = false;
?>
                <p><?php echo $_smarty_tpl->tpl_vars['strError']->value;?>
</p>
            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </div>
    <?php }?>

    <div class="container pt-5 pb-3">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="mb-3" id="raconte-h1">Racontez l'histoire de <span class="fst-italic">votre voyage</span></h1>
            <p>Partagez vos découvertes, inspirez les autres. Chaque aventure compte et enrichit notre monde.</p>
        </div>
    </div>
</div>
<section id='raconte-form'>
    <form action="index.php?action=raconte&ctrl=utrip" method="post" enctype="multipart/form-data">
        <!-- photos système de drag and drop -->
        <div id="dragndrop" class="container mt-5 mb-5  form-bg">
            <div class="row">
                <div class="col-12">
                    <p>Ajoutez jusqu'à 20 photos.</p>
                    </div>
                    <div class="col-12" id="drop-area">
                        <div class="my-form pt-5">
                            <input type="file" id="fileElem" multiple accept="image/*" value="image">
                            <label class="button green-btn" for="fileElem"><i class="fa-solid fa-image"></i>Ajoutez des
                                photos</label>
                            <div id="gallery" class="pt-5"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- nom de l'article -->
            <div class="container mb-3  form-bg">
                <div class="row">
                    <div class="col-md-6 col-12"><label class="form-label" for="articleName">Titre:</label></div>
                    <div class="col-md-6 col-12"><input class="form-control" type="text" id="articleName" name="articleName"
                            value="" placeholder="Titre" required></div>
                </div>
            </div>
            <!-- contenu de l'article -->
            <div class="container mb-3  form-bg">
                <div class="row">
                    <div class="col-md-6 col-12"><label class="form-label" for="articleContent">Décrivez votre
                            voyage:</label></div>
                    <div class="col-md-6 col-12"><textarea class="form-control" id="articleContent" name="articleContent"
                            value="" placeholder="Contenu" required><?php echo $_smarty_tpl->tpl_vars['objUtrip']->value->getDescription();?>
</textarea></div>
                </div>
            </div>
            <!-- catégories -->
            <div class="container mb-3  form-bg">
                <div class="row">
                    <div class="col-md-6 col-12"><label class="form-label" for="articleCategory">Catégorie:</label></div>
                    <div class="col-md-6 col-12"><select class="form-select" id="articleCategory" name="articleCategory">
                            <option value="">--</option>
                        </select>
                    </div>
                </div>
            </div>
            <!-- ville -->
            <div class="container mb-3  form-bg">
                <div class="row ">
                    <div class="col-md-6 col-12g"><label for="articleCity">Ville:</label></div>
                    <div class="col-md-6 col-12"><input class="form-control" type="text" id="articleCity" name="articleCity"
                            placeholder="Ville" required></div>
                </div>
            </div>
            <!-- budget -->
            <div class="container mb-5  form-bg">
                <div class="row ">
                    <div class="col-md-6 col-12g"><label for="articleBudget">Budget approximatif:</label></div>
                    <div class="col-md-6 col-12"><input class="form-control" type="text" id="articleBudget"
                            placeholder="Budget" value="" name="articleBudget" required></div>
                </div>
            </div>
            <div class="container mb-3">
                <div class="row">
                    <div><input class="green-btn" type="submit" value="Soumettre"></div>
                </div>
            </div>
        </form>
    </section>

<?php
}
}
/* {/block "contenu"} */
}
