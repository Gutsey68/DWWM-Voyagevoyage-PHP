<?php
/* Smarty version 4.3.4, created on 2024-02-04 10:07:12
  from 'C:\wamp64\www\projet_2\views\topic.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_65bf61d08f8961_85485497',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5908a4f6f14a1b562e1d6a83e988b1bb8036fa32' => 
    array (
      0 => 'C:\\wamp64\\www\\projet_2\\views\\topic.tpl',
      1 => 1707041230,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_65bf61d08f8961_85485497 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="col-12 resume-topic mt-3 mb-3">
    <div class="card">
        <div class="card-header">
            <?php echo $_smarty_tpl->tpl_vars['objForum']->value->getCreator();?>

        </div>
        <div class="card-body">
            <h3 class="card-title"><?php echo $_smarty_tpl->tpl_vars['objForum']->value->getTitle();?>
</h3>
            <p class="card-text"><?php echo $_smarty_tpl->tpl_vars['objForum']->value->getContent();?>
</p>
        </div>
    </div>
</div><?php }
}
