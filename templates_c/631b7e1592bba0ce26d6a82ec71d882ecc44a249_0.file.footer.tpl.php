<?php
/* Smarty version 4.3.4, created on 2024-02-16 10:09:29
  from 'C:\wamp64\www\projet_2\projet_2\views\_partial\footer.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_65cf3459ebb1d9_63431775',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '631b7e1592bba0ce26d6a82ec71d882ecc44a249' => 
    array (
      0 => 'C:\\wamp64\\www\\projet_2\\projet_2\\views\\_partial\\footer.tpl',
      1 => 1708078098,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_65cf3459ebb1d9_63431775 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>
<footer>
    <div class="container text-center pt-5 pb-2">
        <div id="border-bottom" class="row">
            <div class="col-md-4 col-12 pb-3">
                <h3 class="pb-3">Nos coordonnées :</h3>
                <a href="mailto:voyagevoyage@email.fr" class="coordonnées">
                    <p><i class="fa-solid fa-envelope"></i> voyagevoyage@email.fr</p>
                </a>
                <a href="callto:voyagevoyage@email.fr" class="coordonnées">
                    <p><i class="fa-solid fa-phone"></i> 07 88 48 64 97</p>
                </a>
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
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_109676883265cf3459eba254_67514203', "js_footer");
?>



</body>

</html><?php }
/* {block "js_footer"} */
class Block_109676883265cf3459eba254_67514203 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'js_footer' => 
  array (
    0 => 'Block_109676883265cf3459eba254_67514203',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<?php
}
}
/* {/block "js_footer"} */
}
