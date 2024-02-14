<?php
/* Smarty version 4.3.4, created on 2024-02-14 14:49:19
  from 'C:\wamp64\www\projet_2\views\show404.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_65ccd2efe2df78_75728378',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1f0c6f3fdfb83fecce0fc1355e54219f774bd24c' => 
    array (
      0 => 'C:\\wamp64\\www\\projet_2\\views\\show404.tpl',
      1 => 1707835273,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_65ccd2efe2df78_75728378 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>



<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_78233106265ccd2efe2d066_29409434', "contenu");
$_smarty_tpl->inheritance->endChild($_smarty_tpl, "views/layout.tpl");
}
/* {block "contenu"} */
class Block_78233106265ccd2efe2d066_29409434 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'contenu' => 
  array (
    0 => 'Block_78233106265ccd2efe2d066_29409434',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <div>Error 404</div>
<?php
}
}
/* {/block "contenu"} */
}
