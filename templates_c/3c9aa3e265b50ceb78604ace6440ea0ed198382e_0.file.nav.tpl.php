<?php
/* Smarty version 4.3.4, created on 2024-02-16 10:21:37
  from 'C:\wamp64\www\projet_2\views\_partial\nav.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_65cf3731f30cf8_46057139',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3c9aa3e265b50ceb78604ace6440ea0ed198382e' => 
    array (
      0 => 'C:\\wamp64\\www\\projet_2\\views\\_partial\\nav.tpl',
      1 => 1708078895,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_65cf3731f30cf8_46057139 (Smarty_Internal_Template $_smarty_tpl) {
?><nav class="navbar navbar-expand-lg">
    <div class="container-fluid ">
        <div class="col-md-3">
            <a class="<?php if (($_smarty_tpl->tpl_vars['strPage']->value == "home")) {?> active<?php }?>" href="index.php">
                <div class="row">
                    <div class="col-2"><img width="50px" height="50px" src="assets/images/logo-projet-2.png" alt="">
                    </div>
                    <div class="col-8">
                        <p>Voyage<span class="fst-italic">Voyage</span></p>
                    </div>
                </div>
            </a>
        </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse col-md-9" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 nav-fill">
                <li class="nav-item">
                    <a class="nav-link flex-fill <?php if (($_smarty_tpl->tpl_vars['strPage']->value == "explore")) {?> active<?php }?>"
                        href="index.php?action=explore&ctrl=utrip"><i class="fa-solid fa-compass"></i> Explorez</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link flex-fill <?php if (($_smarty_tpl->tpl_vars['strPage']->value == "raconte")) {?> active<?php }?>"
                        href="index.php?action=raconte&ctrl=utrip">Racontez</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link flex-fill <?php if (($_smarty_tpl->tpl_vars['strPage']->value == "forum")) {?> active<?php }?>"
                        href="index.php?action=home&ctrl=forum">Forum</a>
                </li>
                <li class="nav-item">
                    <div id="nav-form">
                        <form class="my-lg-0">
                            <div class="inputgroup col-12">
                                <input type="text" id="navinput" placeholder="Rechercher un voyage"
                                    aria-label="Rechercher un voyage">
                                <button id="navbutton">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </li>
                <li class="nav-item ">
                    <div class="button-center">
                        <a class="green-btn" href="index.php?action=login&ctrl=user"><i
                                class="fa-solid fa-user"></i>S'enregistrer / Se connecter</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav><?php }
}
