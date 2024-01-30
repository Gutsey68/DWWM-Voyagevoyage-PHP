<?php
/* Smarty version 4.3.4, created on 2024-01-30 19:10:29
  from 'C:\wamp64\www\projet_2\views\explore.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_65b949a57ec175_80157268',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fc8284bb958e131ad8fd99730d6316feae1d05f3' => 
    array (
      0 => 'C:\\wamp64\\www\\projet_2\\views\\explore.tpl',
      1 => 1706641826,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_65b949a57ec175_80157268 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_57562260065b949a57ea8b6_26239155', "contenu");
$_smarty_tpl->inheritance->endChild($_smarty_tpl, "views/layout.tpl");
}
/* {block "contenu"} */
class Block_57562260065b949a57ea8b6_26239155 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'contenu' => 
  array (
    0 => 'Block_57562260065b949a57ea8b6_26239155',
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
                        <button class="green-btn"><i class="fa-solid fa-feather"></i> Je raconte la mienne</button>
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
