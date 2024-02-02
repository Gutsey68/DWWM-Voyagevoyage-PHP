<?php
/* Smarty version 4.3.4, created on 2024-02-02 07:45:03
  from 'C:\wamp64\www\projet_2\views\raconte.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_65bc9d7f0be403_72393520',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'da3b614a8f032271c2cdf328de9b6b4a73e721d6' => 
    array (
      0 => 'C:\\wamp64\\www\\projet_2\\views\\raconte.tpl',
      1 => 1706859901,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_65bc9d7f0be403_72393520 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_38808738465bc9d7f0bb837_45795775', "contenu");
$_smarty_tpl->inheritance->endChild($_smarty_tpl, "views/layout.tpl");
}
/* {block "contenu"} */
class Block_38808738465bc9d7f0bb837_45795775 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'contenu' => 
  array (
    0 => 'Block_38808738465bc9d7f0bb837_45795775',
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
