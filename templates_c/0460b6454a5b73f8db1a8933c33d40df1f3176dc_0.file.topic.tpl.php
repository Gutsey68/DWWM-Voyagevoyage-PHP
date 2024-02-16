<?php
/* Smarty version 4.3.4, created on 2024-02-16 10:09:29
  from 'C:\wamp64\www\projet_2\projet_2\views\topic.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_65cf3459e41218_92913318',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0460b6454a5b73f8db1a8933c33d40df1f3176dc' => 
    array (
      0 => 'C:\\wamp64\\www\\projet_2\\projet_2\\views\\topic.tpl',
      1 => 1708078098,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_65cf3459e41218_92913318 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="col-12 resume-topic mt-3 mb-3">
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
