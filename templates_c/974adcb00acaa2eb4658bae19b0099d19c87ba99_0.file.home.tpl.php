<?php
/* Smarty version 4.3.4, created on 2024-02-16 10:09:29
  from 'C:\wamp64\www\projet_2\projet_2\views\home.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_65cf3459b48959_83125659',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '974adcb00acaa2eb4658bae19b0099d19c87ba99' => 
    array (
      0 => 'C:\\wamp64\\www\\projet_2\\projet_2\\views\\home.tpl',
      1 => 1708078098,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:views/utrip.tpl' => 1,
    'file:views/topic.tpl' => 1,
  ),
),false)) {
function content_65cf3459b48959_83125659 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>



<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_185940874465cf3459b361b2_35300793', "contenu");
$_smarty_tpl->inheritance->endChild($_smarty_tpl, "views/layout.tpl");
}
/* {block "contenu"} */
class Block_185940874465cf3459b361b2_35300793 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'contenu' => 
  array (
    0 => 'Block_185940874465cf3459b361b2_35300793',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


    <!-- voyage -->
    <section id="voyage">
        <div class="container">
            <div class="row">
                <div id='raconte-voyage' class="col-md-6 col-12">
                    <h1 class="pb-2">Et si vous nous racontiez <span class="fst-italic">votre voyage</span> ?</h1>
                    <p>Partagez vos aventures uniques et découvrez comment votre périple inspire et émerveille notre
                        communauté.</p>
                    <div class="button-left">
                        <a class="green-btn" href="index.php?action=raconte&ctrl=utrip"><i
                                class="fa-solid fa-feather"></i>Je raconte mon voyage</a>
                    </div>
                </div>
                <div class="col-md-3 col-12 text-center pt-3 pt-md-0"><img class="resume-img pt-2  "
                        src="assets/images/italie.jpg" alt="jolie ruelle italienne"></div>
                <div class="col-md-3 col-12 text-center">
                    <img class="resume-img pt-2 d-none d-md-block" src="assets/images/zanzibar.jpg"
                        alt="magnifique plage à zanzibar">
                </div>
            </div>
        </div>
    </section>
    <!-- histoire -->
    <section id="histoire">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h2 class="pb-2">Chaque voyage <span class="fst-italic">a son histoire</span>...</h2>
                    <p>Plongez dans un monde de récits captivants où chaque destination dévoile ses mystères et ses
                        merveilles.</p>
                    <div class="button-center">
                        <a class="orange-btn" href="index.php?action=explore&ctrl=utrip"><i
                                class="fa-solid fa-suitcase-rolling"></i> J'explore les
                        histoires</a>
                </div>
            </div>
        </div>
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
</section>
<!-- Echangez -->
<section id="echange">
    <div class="container">
        <div class="row">
            <div id='echange-voyage' class="col-md-6 col-12">
                    <h2 class="pb-2"><span class="fst-italic">Échangez</span> <br> avec les autres voyageurs</h2>
                    <p>Rejoignez notre forum et connectez-vous avec une communauté passionnée pour partager conseils et
                        expériences de voyage.</p>
                    <div class="button-left">
                        <a class="green-btn" href="index.php?action=home&ctrl=forum"><i class="fa-solid fa-comments"></i> Je
                            découvre le forum</a>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <section class="pb-5">
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
                    </section>
                </div>
            </div>
        </div>
    </section>


<?php
}
}
/* {/block "contenu"} */
}
