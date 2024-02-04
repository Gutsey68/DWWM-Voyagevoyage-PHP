<?php
/* Smarty version 4.3.4, created on 2024-02-04 09:35:21
  from 'C:\wamp64\www\projet_2\views\explore.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_65bf5a593bbf51_01900712',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fc8284bb958e131ad8fd99730d6316feae1d05f3' => 
    array (
      0 => 'C:\\wamp64\\www\\projet_2\\views\\explore.tpl',
      1 => 1707039319,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:views/utrip.tpl' => 1,
  ),
),false)) {
function content_65bf5a593bbf51_01900712 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>



<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_21153710465bf5a593b6289_67157754', "contenu");
$_smarty_tpl->inheritance->endChild($_smarty_tpl, "views/layout.tpl");
}
/* {block "contenu"} */
class Block_21153710465bf5a593b6289_67157754 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'contenu' => 
  array (
    0 => 'Block_21153710465bf5a593b6289_67157754',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <section id="recit">
        <div class="container">
            <div class="row text-center">
                <div class="col-12">
                    <h1 class="pb-2">Explorez des récits <span class="fst-italic">inoubliables</span></h1>
                    <p class="pb-2">
                        Découvrez des aventures uniques racontées par des voyageurs passionnés. Laissez-vous inspirer par
                        leurs expériences et partagez les vôtres.
                    </p>
                    <div class="button-center">
                        <a class="green-btn" href="index.php?action=raconte&ctrl=utrip"><i class="fa-solid fa-feather"></i>
                            Je raconte la mienne</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="explore-utrips">
        <div class="container">
            <div class="row">
                <article>
                    <div class="container">
                        <div class="row ">
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['arrUtripsToDisplay']->value, 'objUtrip');
$_smarty_tpl->tpl_vars['objUtrip']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['objUtrip']->value) {
$_smarty_tpl->tpl_vars['objUtrip']->do_else = false;
?>
                                <?php $_smarty_tpl->_subTemplateRender("file:views/utrip.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="row">
                toto
            </div>
        </div>
    </section>
<?php
}
}
/* {/block "contenu"} */
}
