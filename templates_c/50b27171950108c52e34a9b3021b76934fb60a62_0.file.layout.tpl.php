<?php
/* Smarty version 4.3.4, created on 2024-02-01 13:52:21
  from 'C:\wamp64\www\projet_2\views\layout.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_65bba215a71086_94529534',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '50b27171950108c52e34a9b3021b76934fb60a62' => 
    array (
      0 => 'C:\\wamp64\\www\\projet_2\\views\\layout.tpl',
      1 => 1706795531,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:views/_partial/header.tpl' => 1,
    'file:views/_partial/footer.tpl' => 1,
  ),
),false)) {
function content_65bba215a71086_94529534 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
$_smarty_tpl->_subTemplateRender("file:views/_partial/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_196698874865bba215a6cf98_52184340', "js_footer");
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_85259747765bba215a6ede5_20208998', "contenu");
?>


<?php $_smarty_tpl->_subTemplateRender("file:views/_partial/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
/* {block "js_footer"} */
class Block_196698874865bba215a6cf98_52184340 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'js_footer' => 
  array (
    0 => 'Block_196698874865bba215a6cf98_52184340',
  ),
);
public $append = 'true';
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	<?php echo '<script'; ?>
 src="assets/script/bootstrap.bundle.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="assets/script/dnd.js"><?php echo '</script'; ?>
>
<?php
}
}
/* {/block "js_footer"} */
/* {block "contenu"} */
class Block_85259747765bba215a6ede5_20208998 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'contenu' => 
  array (
    0 => 'Block_85259747765bba215a6ede5_20208998',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

	<p>Hello</p>
<?php
}
}
/* {/block "contenu"} */
}
