<?php
/* Smarty version 4.3.4, created on 2024-02-04 10:08:11
  from 'C:\wamp64\www\projet_2\views\forum.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_65bf620b1ee1d5_64624308',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd093e5fad2c9c1f267e3327960075983addea5fa' => 
    array (
      0 => 'C:\\wamp64\\www\\projet_2\\views\\forum.tpl',
      1 => 1707041289,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:views/topic.tpl' => 1,
  ),
),false)) {
function content_65bf620b1ee1d5_64624308 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_8376701365bf620b1e56e5_44811212', "contenu");
$_smarty_tpl->inheritance->endChild($_smarty_tpl, "views/layout.tpl");
}
/* {block "contenu"} */
class Block_8376701365bf620b1e56e5_44811212 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'contenu' => 
  array (
    0 => 'Block_8376701365bf620b1e56e5_44811212',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <section id="forum">
        <div class="container">
            <div class="row text-center">
                <div class="col-12">
                    <h1 class="">Bienvenue sur le forum des <span class="fst-italic">voyageurs</span></h1>
                    <p class="">
                        Échangez conseils et histoires avec une communauté qui partage votre passion pour l'aventure et la
                        découverte.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section class="pb-5">
        <div class="container">
            <div class="row ">
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['arrForumsToDisplay']->value, 'objForum');
$_smarty_tpl->tpl_vars['objForum']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['objForum']->value) {
$_smarty_tpl->tpl_vars['objForum']->do_else = false;
?>
                    <?php $_smarty_tpl->_subTemplateRender("file:views/topic.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </div>
        </div>
    </section>
<?php
}
}
/* {/block "contenu"} */
}
