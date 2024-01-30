<?php
/* Smarty version 4.3.4, created on 2024-01-30 19:00:02
  from 'C:\wamp64\www\projet_2\views\show404.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_65b947321f1613_52440040',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1f0c6f3fdfb83fecce0fc1355e54219f774bd24c' => 
    array (
      0 => 'C:\\wamp64\\www\\projet_2\\views\\show404.tpl',
      1 => 1706641200,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_65b947321f1613_52440040 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_188568837065b947321efde4_88303579', "contenu");
$_smarty_tpl->inheritance->endChild($_smarty_tpl, "views/layout.tpl");
}
/* {block "contenu"} */
class Block_188568837065b947321efde4_88303579 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'contenu' => 
  array (
    0 => 'Block_188568837065b947321efde4_88303579',
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
