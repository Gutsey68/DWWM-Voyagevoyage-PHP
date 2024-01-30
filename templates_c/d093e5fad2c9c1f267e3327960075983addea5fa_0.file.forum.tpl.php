<?php
/* Smarty version 4.3.4, created on 2024-01-30 19:54:35
  from 'C:\wamp64\www\projet_2\views\forum.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_65b953fb7c62a8_27399641',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd093e5fad2c9c1f267e3327960075983addea5fa' => 
    array (
      0 => 'C:\\wamp64\\www\\projet_2\\views\\forum.tpl',
      1 => 1706644248,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_65b953fb7c62a8_27399641 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_82114546465b953fb7c4201_48590478', "contenu");
$_smarty_tpl->inheritance->endChild($_smarty_tpl, "views/layout.tpl");
}
/* {block "contenu"} */
class Block_82114546465b953fb7c4201_48590478 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'contenu' => 
  array (
    0 => 'Block_82114546465b953fb7c4201_48590478',
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
<?php
}
}
/* {/block "contenu"} */
}
