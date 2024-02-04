<?php
/* Smarty version 4.3.4, created on 2024-02-04 09:10:30
  from 'C:\wamp64\www\projet_2\views\home.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_65bf54866d6b82_41382277',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0c8bee41614906dc2365b499f9ec625b3497ea3c' => 
    array (
      0 => 'C:\\wamp64\\www\\projet_2\\views\\home.tpl',
      1 => 1707037829,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:views/utrip.tpl' => 1,
  ),
),false)) {
function content_65bf54866d6b82_41382277 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>



<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_145554717465bf54866d0567_05641564', "contenu");
$_smarty_tpl->inheritance->endChild($_smarty_tpl, "views/layout.tpl");
}
/* {block "contenu"} */
class Block_145554717465bf54866d0567_05641564 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'contenu' => 
  array (
    0 => 'Block_145554717465bf54866d0567_05641564',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


    <!-- voyage -->
    <section id="voyage">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-12">
                    <h1 class="pb-2">Et si vous nous racontiez <span class="fst-italic">votre voyage</span> ?</h1>
                    <p>Partagez vos aventures uniques et découvrez comment votre périple inspire et émerveille notre
                        communauté.</p>
                    <div class="button-left">
                        <a class="green-btn" href="index.php?action=raconte&ctrl=utrip"><i
                                class="fa-solid fa-feather"></i>Je raconte mon voyage</a>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <img class="resume-img" src="assets/images/italie.jpg" alt="jolie ruelle italienne">
                    <img class="resume-img" src="assets/images/zanzibar.jpg" alt="magnifique plage à zanzibar">
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
            <div class="col-md-6 col-12">
                <h2 class="pb-2"><span class="fst-italic">Échangez</span> <br> avec les autres voyageurs</h2>
                <p>Rejoignez notre forum et connectez-vous avec une communauté passionnée pour partager conseils et
                    expériences de voyage.</p>
                <div class="button-left">
                    <a class="green-btn" href="index.php?action=home&ctrl=forum"><i class="fa-solid fa-comments"></i> Je
                        découvre le forum</a>
                </div>
            </div>
            <div class="col-md-6 col-12">
                <div class="card mb-3">
                    <div class="card-header">
                        <p>MichelZora</p>
                    </div>
                    <div class="card-body">
                        <h3 class="card-title">Recherche d'Endroits Inspirés par Zelda pour Mon Voyage au Japon</h3>
                            <p class="card-text">Étant un grand fan de Zelda, je cherche des lieux au Japon qui me
                                rappelleraient les paysages du jeu. Des suggestions pour des lieux magiques et mystérieux ?
                            </p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            Kerim68
                        </div>
                        <div class="card-body">
                            <h3 class="card-title">Conseils pour Rencontrer des Gens Lors de Voyages Solo</h3>
                            <p class="card-text">Je voyage seul en Europe et je cherche des conseils sur les meilleures
                                façons de rencontrer de nouvelles personnes et peut-être même de faire de nouvelles
                                rencontres amicales. Des idées ?</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


<?php
}
}
/* {/block "contenu"} */
}
