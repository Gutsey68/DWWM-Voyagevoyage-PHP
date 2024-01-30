<?php
/* Smarty version 4.3.4, created on 2024-01-30 19:10:30
  from 'C:\wamp64\www\projet_2\views\raconte.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_65b949a6d07116_63455530',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'da3b614a8f032271c2cdf328de9b6b4a73e721d6' => 
    array (
      0 => 'C:\\wamp64\\www\\projet_2\\views\\raconte.tpl',
      1 => 1706641798,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_65b949a6d07116_63455530 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_115069059965b949a6d022d8_67603750', "js_footer");
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_195784457465b949a6d04e21_00094036', "contenu");
$_smarty_tpl->inheritance->endChild($_smarty_tpl, "views/layout.tpl");
}
/* {block "js_footer"} */
class Block_115069059965b949a6d022d8_67603750 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'js_footer' => 
  array (
    0 => 'Block_115069059965b949a6d022d8_67603750',
  ),
);
public $append = 'true';
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <?php echo '<script'; ?>
 src="assets/script/dnd.js"><?php echo '</script'; ?>
>
<?php
}
}
/* {/block "js_footer"} */
/* {block "contenu"} */
class Block_195784457465b949a6d04e21_00094036 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'contenu' => 
  array (
    0 => 'Block_195784457465b949a6d04e21_00094036',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <!-- système de drag and drop -->
    <div id="dragndrop" class="container mt-5 mb-5">
        <div class="row">
            <div class="col-12">
                <p>Ajoute jusqu'à 20 photos.</p>
            </div>
            <div class="col-12" id="drop-area">
                <form class="my-form pt-5">
                    <input type="file" id="fileElem" multiple accept="image/*">
                    <label class="button green-btn" for="fileElem"><i class="fa-solid fa-image"></i>Ajoute des
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
