{* La page du plan du site *}

{extends file="views/layout.tpl"}

{block name="contenu"}
    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul>
                    <h5>Page d'accueil</h5>
                        <li><a href="">Voyage Voyage</a></li>
                        <li><a href="page/about">A propos de nous</a></li>
                        <h5>Racontez / créez Utrip</h5>
                        <li><a href="utrip/explore">Explorez</a></li>
                        <li><a href="utrip/raconte">Racontez</a></li>
                        <li><a href="forum/home">Forum</a></li>
                        <ul>
                            <li><a href="forum/create_topic">Créer un topic</a></li>
                        </ul>
                        <h5>Connexion utilisateur</h5>
                        <li><a href="user/login">S'enregistrer</a></li>
                        <ul>
                            <li><a href="user/create_account">Seconnecter</a></li>
                            <li><a href="http://localhost/projet_2/user/forgetPwd">Mot de pass oblié</a></li>
                        </ul>
                        <h5>Nous contacter</h5>
                        <li><a href="page/contact">Nous contacter</a></li>
                        <h5>Légales et politique</h5>
                        <li><a href="page/mentions">Mentions légales</a></li>
                        <li><a href="page/plan">Plan du site</a></li>
                    </ul>
                </div>
            </div>
        </div>
    
    </div>
{/block}