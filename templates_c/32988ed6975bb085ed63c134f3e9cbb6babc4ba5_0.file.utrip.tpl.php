<?php
/* Smarty version 4.3.4, created on 2024-02-16 12:35:54
  from 'C:\wamp64\www\projet_2\views\utrip.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_65cf56aa4985f1_72921494',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '32988ed6975bb085ed63c134f3e9cbb6babc4ba5' => 
    array (
      0 => 'C:\\wamp64\\www\\projet_2\\views\\utrip.tpl',
      1 => 1708086428,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_65cf56aa4985f1_72921494 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="col-md-3 resume-utrip">
	<div>
		<a href="#"><img class="resume-img" src="uploads/<?php echo $_smarty_tpl->tpl_vars['objUtrip']->value->getImg();?>
" alt="<?php echo $_smarty_tpl->tpl_vars['objUtrip']->value->getName();?>
"></a>
	</div>
	<p class="margin0">Le voyage de <?php echo $_smarty_tpl->tpl_vars['objUtrip']->value->getCreator();?>
</p>
	<p>à <span class="fst-italic"><?php echo $_smarty_tpl->tpl_vars['objUtrip']->value->getCity();?>
</span></p>
</div><?php }
}
