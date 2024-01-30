<?php
/* Smarty version 4.3.4, created on 2024-01-30 14:59:36
  from 'C:\wamp64\www\projet_2\views\home.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_65b90ed860b114_71950701',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0c8bee41614906dc2365b499f9ec625b3497ea3c' => 
    array (
      0 => 'C:\\wamp64\\www\\projet_2\\views\\home.tpl',
      1 => 1706626517,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_65b90ed860b114_71950701 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_133502942565b90ed86093d9_63336506', "contenu");
$_smarty_tpl->inheritance->endChild($_smarty_tpl, "views/layout.tpl");
}
/* {block "contenu"} */
class Block_133502942565b90ed86093d9_63336506 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'contenu' => 
  array (
    0 => 'Block_133502942565b90ed86093d9_63336506',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


	<!-- voyage -->
    <section id="voyage">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-12">
                    <h1 class="pb-2">Et si vous nous racontiez <span class="fst-italic">votre voyage</span>  ?</h1>
                    <p>Partagez vos aventures uniques et découvrez comment votre périple inspire et émerveille notre communauté.</p>
                    <button class="green-btn"><i class="fa-solid fa-feather"></i>Je raconte mon voyage</button>
                </div>
                <div class="col-md-6 col-12">
                    <img src="assets/images/italie.jpg" alt="jolie ruelle italienne">
                    <img src="assets/images/zanzibar.jpg" alt="magnifique plage à zanzibar">
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
                    <p>Plongez dans un monde de récits captivants où chaque destination dévoile ses mystères et ses merveilles.</p>
                    <div class="button-center">
                        <button class="orange-btn"><i class="fa-solid fa-suitcase-rolling"></i> J'explore les histoires</button>
                    </div>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-md-3">
                    <img src="assets/images/italie.jpg" alt="">
                    <p class="margin0">Le voyage de kerim68</p>
                    <p>à <span class="fst-italic">Rio de Janeiro</span></p>
                </div>
                <div class="col-md-3">
                    <img src="assets/images/italie.jpg" alt="">
                    <p class="margin0">Le voyage de kerim68</p>
                    <p>à <span class="fst-italic">Rio de Janeiro</span></p>
                </div>
                <div class="col-md-3">
                    <img src="assets/images/italie.jpg" alt="">
                    <p class="margin0">Le voyage de kerim68</p>
                    <p>à <span class="fst-italic">Rio de Janeiro</span></p>
                </div>
                <div class="col-md-3">
                    <img src="assets/images/italie.jpg" alt="">
                    <p class="margin0">Le voyage de kerim68</p>
                    <p>à <span class="fst-italic">Rio de Janeiro</span></p>
                </div>
            </div>
        </div>
    </section>
<!-- Echangez -->
    <section id="echange">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-12">
                    <h2 class="pb-2"><span class="fst-italic">Échangez</span> <br> avec les autres voyageurs</h2>
                    <p>Rejoignez notre forum et connectez-vous avec une communauté passionnée pour partager conseils et expériences de voyage.</p>
                    <button class="green-btn"><i class="fa-solid fa-comments"></i> Je découvre le forum</button>
                </div>
                <div class="col-md-6 col-12">
                    <div class="card mb-3">
                        <div class="card-header">
                            <p>MichelZora</p>
                        </div>
                        <div class="card-body">
                            <h3 class="card-title">Recherche d'Endroits Inspirés par Zelda pour Mon Voyage au Japon</h3>
                            <p class="card-text">Étant un grand fan de Zelda, je cherche des lieux au Japon qui me rappelleraient les paysages du jeu. Des suggestions pour des lieux magiques et mystérieux ?</p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            Kerim68
                        </div>
                        <div class="card-body">
                            <h3 class="card-title">Conseils pour Rencontrer des Gens Lors de Voyages Solo</h3>
                            <p class="card-text">Je voyage seul en Europe et je cherche des conseils sur les meilleures façons de rencontrer de nouvelles personnes et peut-être même de faire de nouvelles rencontres amicales. Des idées ?</p>
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
