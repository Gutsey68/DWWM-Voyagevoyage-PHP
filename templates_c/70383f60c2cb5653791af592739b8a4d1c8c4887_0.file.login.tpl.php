<?php
/* Smarty version 4.3.4, created on 2024-02-14 14:52:36
  from 'C:\wamp64\www\projet_2\views\login.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_65ccd3b48972f7_71432148',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '70383f60c2cb5653791af592739b8a4d1c8c4887' => 
    array (
      0 => 'C:\\wamp64\\www\\projet_2\\views\\login.tpl',
      1 => 1707922352,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_65ccd3b48972f7_71432148 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>



<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_199694463365ccd3b4886f63_32215019', "contenu");
$_smarty_tpl->inheritance->endChild($_smarty_tpl, "views/layout.tpl");
}
/* {block "contenu"} */
class Block_199694463365ccd3b4886f63_32215019 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'contenu' => 
  array (
    0 => 'Block_199694463365ccd3b4886f63_32215019',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <?php if ((count($_smarty_tpl->tpl_vars['arrErrors']->value) > 0)) {?>
        <div class="alert alert-danger">
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['arrErrors']->value, 'strError');
$_smarty_tpl->tpl_vars['strError']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['strError']->value) {
$_smarty_tpl->tpl_vars['strError']->do_else = false;
?>
                <p><?php echo $_smarty_tpl->tpl_vars['strError']->value;?>
</p>
            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </div>
    <?php }?>
    <form action="user/login" method="post">
        <p>
            <label for="email">E-mail</label>
            <input id="email" type="email" name="email" value="">
        </p>
        <p>
            <label for="password">Password</label>
            <input id="password" type="password" name="password">
        </p>
        <p>
            <input type="submit" value="Se connecter">
        </p>
    </form>
<?php
}
}
/* {/block "contenu"} */
}
