<?php
/* Smarty version 4.3.4, created on 2024-02-01 15:01:24
  from 'C:\wamp64\www\projet_2\views\raconte.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_65bbb244065a05_24927210',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'da3b614a8f032271c2cdf328de9b6b4a73e721d6' => 
    array (
      0 => 'C:\\wamp64\\www\\projet_2\\views\\raconte.tpl',
      1 => 1706799399,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_65bbb244065a05_24927210 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>



<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_40718908665bbb2440648c1_80716725', "contenu");
$_smarty_tpl->inheritance->endChild($_smarty_tpl, "views/layout.tpl");
}
/* {block "contenu"} */
class Block_40718908665bbb2440648c1_80716725 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'contenu' => 
  array (
    0 => 'Block_40718908665bbb2440648c1_80716725',
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

<?php
}
}
/* {/block "contenu"} */
}
