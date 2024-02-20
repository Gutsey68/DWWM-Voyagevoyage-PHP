<?php
/* Smarty version 4.3.4, created on 2024-02-19 14:33:33
  from 'C:\wamp64\www\projet_2-main\views\layout.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_65d366bd9813d1_88779820',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '65e3341f309bb525ed63b6702f01b82b6b6c69ae' => 
    array (
      0 => 'C:\\wamp64\\www\\projet_2-main\\views\\layout.tpl',
      1 => 1708353004,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:views/_partial/header.tpl' => 1,
    'file:views/_partial/footer.tpl' => 1,
  ),
),false)) {
function content_65d366bd9813d1_88779820 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>

<?php $_smarty_tpl->_subTemplateRender("file:views/_partial/header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_97343172865d366bd97e544_06091645', "js_footer");
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_118989234365d366bd97fab0_90463166', "contenu");
?>


<?php $_smarty_tpl->_subTemplateRender("file:views/_partial/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
/* {block "js_footer"} */
class Block_97343172865d366bd97e544_06091645 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'js_footer' => 
  array (
    0 => 'Block_97343172865d366bd97e544_06091645',
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
class Block_118989234365d366bd97fab0_90463166 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'contenu' => 
  array (
    0 => 'Block_118989234365d366bd97fab0_90463166',
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
