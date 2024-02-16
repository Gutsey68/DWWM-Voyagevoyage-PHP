<?php
/* Smarty version 4.3.4, created on 2024-02-16 10:09:29
  from 'C:\wamp64\www\projet_2\projet_2\views\layout.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_65cf3459becda4_74534016',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '05b45df290fc1ad0d9435f19a9b3b788e2435d61' => 
    array (
      0 => 'C:\\wamp64\\www\\projet_2\\projet_2\\views\\layout.tpl',
      1 => 1708078098,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:views/_partial/header.tpl' => 1,
    'file:views/_partial/footer.tpl' => 1,
  ),
),false)) {
function content_65cf3459becda4_74534016 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>

<?php $_smarty_tpl->_subTemplateRender("file:views/_partial/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_209998482165cf3459be9965_13604484', "js_footer");
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_56189850365cf3459beb0c9_32866182', "contenu");
?>


<?php $_smarty_tpl->_subTemplateRender("file:views/_partial/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
/* {block "js_footer"} */
class Block_209998482165cf3459be9965_13604484 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'js_footer' => 
  array (
    0 => 'Block_209998482165cf3459be9965_13604484',
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
class Block_56189850365cf3459beb0c9_32866182 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'contenu' => 
  array (
    0 => 'Block_56189850365cf3459beb0c9_32866182',
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
