<?php
/* Smarty version 4.3.4, created on 2024-02-02 07:53:18
  from 'C:\wamp64\www\projet_2\views\plan.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_65bc9f6e2e5ff5_06712102',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '098b18b616d3b69fd7839a8c4dfdbba3ca3d97e8' => 
    array (
      0 => 'C:\\wamp64\\www\\projet_2\\views\\plan.tpl',
      1 => 1706860331,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_65bc9f6e2e5ff5_06712102 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>



<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1452754465bc9f6e2e4fe5_73644133', "contenu");
$_smarty_tpl->inheritance->endChild($_smarty_tpl, "views/layout.tpl");
}
/* {block "contenu"} */
class Block_1452754465bc9f6e2e4fe5_73644133 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'contenu' => 
  array (
    0 => 'Block_1452754465bc9f6e2e4fe5_73644133',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <div>plan du site</div>
<?php
}
}
/* {/block "contenu"} */
}
