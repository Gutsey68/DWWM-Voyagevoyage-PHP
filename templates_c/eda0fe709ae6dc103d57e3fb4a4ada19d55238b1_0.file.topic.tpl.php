<?php
/* Smarty version 4.3.4, created on 2024-02-19 14:33:33
  from 'C:\wamp64\www\projet_2-main\views\topic.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_65d366bdaffb07_20656919',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'eda0fe709ae6dc103d57e3fb4a4ada19d55238b1' => 
    array (
      0 => 'C:\\wamp64\\www\\projet_2-main\\views\\topic.tpl',
      1 => 1708353004,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_65d366bdaffb07_20656919 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="col-12 resume-topic">
    <div class="card">
        <div class="card-header  topic">
            <?php echo $_smarty_tpl->tpl_vars['objForum']->value->getCreator();?>

        </div>
        <div class="card-body  topic">
            <h3 class="card-title"><?php echo $_smarty_tpl->tpl_vars['objForum']->value->getTitle();?>
</h3>
            <p class="card-text"><?php echo $_smarty_tpl->tpl_vars['objForum']->value->getContent();?>
</p>
        </div>
    </div>
</div><?php }
}
