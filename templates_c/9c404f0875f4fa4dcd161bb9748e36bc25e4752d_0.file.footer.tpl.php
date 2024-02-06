<?php
/* Smarty version 4.3.4, created on 2024-02-06 14:23:44
  from 'C:\wamp64\www\projet_2\views\_partial\footer.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_65c240f0d8bc38_01290721',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9c404f0875f4fa4dcd161bb9748e36bc25e4752d' => 
    array (
      0 => 'C:\\wamp64\\www\\projet_2\\views\\_partial\\footer.tpl',
      1 => 1707229423,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_65c240f0d8bc38_01290721 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>
<footer>
    <div class="container text-center pt-5 pb-2">
        <div id="border-bottom" class="row">
            <div class="col-md-4 col-12 pb-3">
                <h3 class="pb-3">Nos coordonnées :</h3>
                <p><i class="fa-solid fa-envelope"></i> voyagevoyage@email.fr</p>
                <p><i class="fa-solid fa-phone"></i> 07 88 48 64 97</p>
                <p><i class="fa-solid fa-house"></i> 30 rue kerim le fou</p>
            </div>
            <div class="col-md-4 col-12 pb-3">
                <h3 class="pb-3">Liens utiles :</h3>
                <ul>
                    <li class="footer-plan"><a href="index.php?action=plan&ctrl=page">Plan du site</a></li>
                    <li class="footer-plan"><a href="index.php?action=mentions&ctrl=page">Mentions légales</a></li>
                    <li class="footer-plan"><a href="index.php?action=contact&ctrl=page">Nous contacter</a></li>
                </ul>
            </div>
            <div class="col-md-4 col-12">
                <h3 class="pb-3">Nos résaux sociaux :</h3>
                <ul>
                    <li><a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" target="_blank"><i
                                class="fa-brands fa-facebook-f"></i></a></li>
                    <li><a href="https://www.instagram.com/guts.sey?igsh=MW54cDV5YjNlZ3FmYQ%3D%3D&utm_source=qr"
                            target="_blank"><i class="fa-brands fa-instagram"></i></a></li>
                    <li><a href="" target="_blank"><i class="fa-brands fa-x-twitter"></i></a></li>
                    <li><a href="" target="_blank"><i class="fa-brands fa-pinterest-p"></i></a></li>
                    <li><a href="" target="_blank"><i class="fa-brands fa-youtube"></i></a></li>
                </ul>
            </div>
        </div>
        <div id="copyright" class="col-12">
            <p>© <?php echo date("Y");?>
 VoyageVoyage Inc. Tous droits réservés</p>
        </div>
    </div>
</footer>
<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_155880231565c240f0d89247_38895388', "js_footer");
?>



</body>

</html><?php }
/* {block "js_footer"} */
class Block_155880231565c240f0d89247_38895388 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'js_footer' => 
  array (
    0 => 'Block_155880231565c240f0d89247_38895388',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<?php
}
}
/* {/block "js_footer"} */
}
