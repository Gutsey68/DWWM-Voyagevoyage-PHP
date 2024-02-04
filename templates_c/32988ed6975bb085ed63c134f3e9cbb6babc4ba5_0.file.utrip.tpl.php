<?php
/* Smarty version 4.3.4, created on 2024-02-04 09:31:58
  from 'C:\wamp64\www\projet_2\views\utrip.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_65bf598e3b71a7_00096859',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '32988ed6975bb085ed63c134f3e9cbb6babc4ba5' => 
    array (
      0 => 'C:\\wamp64\\www\\projet_2\\views\\utrip.tpl',
      1 => 1707039116,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_65bf598e3b71a7_00096859 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="col-md-3 resume-utrip">
	<img class="resume-img" src="assets/images/<?php echo $_smarty_tpl->tpl_vars['objUtrip']->value->getImg();?>
" alt="<?php echo $_smarty_tpl->tpl_vars['objUtrip']->value->getName();?>
">
	<p class="margin0">Le voyage de <?php echo $_smarty_tpl->tpl_vars['objUtrip']->value->getCreator();?>
</p>
	<p>à <span class="fst-italic"><?php echo $_smarty_tpl->tpl_vars['objUtrip']->value->getCity();?>
</span></p>
</div><?php }
}
