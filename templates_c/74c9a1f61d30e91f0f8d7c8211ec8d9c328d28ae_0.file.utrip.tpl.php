<?php
/* Smarty version 4.3.4, created on 2024-02-16 10:09:29
  from 'C:\wamp64\www\projet_2\projet_2\views\utrip.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_65cf3459d5d663_11093265',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '74c9a1f61d30e91f0f8d7c8211ec8d9c328d28ae' => 
    array (
      0 => 'C:\\wamp64\\www\\projet_2\\projet_2\\views\\utrip.tpl',
      1 => 1708078098,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_65cf3459d5d663_11093265 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="col-md-3 resume-utrip">
	<div>
		<img class="resume-img" src="uploads/<?php echo $_smarty_tpl->tpl_vars['objUtrip']->value->getImg();?>
" alt="<?php echo $_smarty_tpl->tpl_vars['objUtrip']->value->getName();?>
">
	</div>
	<p class="margin0">Le voyage de <?php echo $_smarty_tpl->tpl_vars['objUtrip']->value->getCreator();?>
</p>
	<p>à <span class="fst-italic"><?php echo $_smarty_tpl->tpl_vars['objUtrip']->value->getCity();?>
</span></p>
</div><?php }
}
