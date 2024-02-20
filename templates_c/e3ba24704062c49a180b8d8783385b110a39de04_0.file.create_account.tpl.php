<?php
/* Smarty version 4.3.4, created on 2024-02-19 15:21:30
  from 'C:\wamp64\www\projet_2\views\create_account.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_65d371fa6ea6c6_83780076',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e3ba24704062c49a180b8d8783385b110a39de04' => 
    array (
      0 => 'C:\\wamp64\\www\\projet_2\\views\\create_account.tpl',
      1 => 1708356088,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_65d371fa6ea6c6_83780076 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_70577760865d371fa6ddae2_63150225', "contenu");
$_smarty_tpl->inheritance->endChild($_smarty_tpl, "views/layout.tpl");
}
/* {block "contenu"} */
class Block_70577760865d371fa6ddae2_63150225 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'contenu' => 
  array (
    0 => 'Block_70577760865d371fa6ddae2_63150225',
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
    <form action="" method="post">
    <div class="phppot-container">
        <a href="user/login">Déja un compte ? Connectez-vous !</a>
    </div>
        <div class="">


            <div class="inline-block">
                <div class="form-label">
                    Name<span class="required error" id="username-info"></span>
                </div>
                <input class="input-box-330" type="text" name="name" id="name" value="<?php echo $_smarty_tpl->tpl_vars['objUser']->value->getName();?>
">
            </div>

            <div class="inline-block">
                <div class="form-label">
                    Firstname<span class="required error" id="username-info"></span>
                </div>
                <input class="input-box-330" type="text" name="firstname" id="firstname" value="<?php echo $_smarty_tpl->tpl_vars['objUser']->value->getFirstname();?>
">
            </div>


            <div class="inline-block">
                <div class="form-label">
                    Pseudo<span class="required error" id="username-info"></span>
                </div>
                <input class="input-box-330" type="text" name="pseudo" id="pseudo" value="<?php echo $_smarty_tpl->tpl_vars['objUser']->value->getPseudo();?>
">
            </div>

            <div class="inline-block">
                <div class="form-label">
                    Email<span class="required error" id="email-info"></span>
                </div>
                <input class="input-box-330" type="email" name="email" id="email" value="<?php echo $_smarty_tpl->tpl_vars['objUser']->value->getEmail();?>
">
            </div>


            <div class="inline-block">
                <div class="form-label">
                    Password<span class="required error" id="signup-password-info"></span>
                </div>
                <input class="input-box-330" type="password"  name="password" id="password">
            </div>


            <div class="inline-block">
                <div class="form-label">
                    Confirm Password<span class="required error"
                        id="confirm-password-info"></span>
                </div>
                <input class="input-box-330" type="password" name="passwd_confirm" id="passwd_confirm">
            </div>

            <p>
                <input type="submit" value="S'enregistrer">
            </p>
            </form>
        </div>
    </div>
</div>


    </form>
<?php
}
}
/* {/block "contenu"} */
}
