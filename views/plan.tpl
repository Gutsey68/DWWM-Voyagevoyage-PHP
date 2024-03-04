{* La page du plan du site *}

{extends file="views/layout.tpl"}

{block name="contenu"}
    <div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="text-center p-5">Plan du site</h1>
                    <section>
                        <div class="container">
                            <div class="row">
                                <div class="col-12 pb-5 plan">
                                    <h2 class="pb-2">Page d'accueil</h2>
                                    <p><a href="{$base_url}">Voyage Voyage</a></p>
                                    <p><a href="{$base_url}page/about">A propos de nous</a></p>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section>
                        <div class="container">
                            <div class="row">
                                <div class="col-12 pb-5 plan">
                                    <h2 class="pb-2">Racontez / créer Utrip</h2>
                                    <p><a href="{$base_url}utrip/explore">Explorer les utrip</a></p>
                                    <p><a href="{$base_url}utrip/raconte">Raconter son utrip</a></p>
                                    <p><a href="{$base_url}utrip/utrip?id=1">Détail d'un utrip</a></p>
                                    <p><a href="{$base_url}forum/home">Forum</a></p>
                                    <p><a href="{$base_url}forum/create_topic">Créer un topic</a></p>
                                    <p><a href="{$base_url}forum/topic?id=1">Détail d'un topic</a></p>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section>
                        <div class="container">
                            <div class="row">
                                <div class="col-12 pb-5 plan">
                                    <h2 class="pb-2">Connexion utilisateur</h2>
                                    <p><a href="{$base_url}user/create_account">S'enregistrer</a></p>
                                    <p><a href="{$base_url}user/login">Se connecter</a></p>
                                    <p><a href="{$base_url}user/forgetPwd">Mot de pass oblié</a></p>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section>
                        <div class="container">
                            <div class="row">
                                <div class="col-12 pb-5 plan">
                                    <h2 class="pb-2">Contact</h2>
                                    <p><a href="{$base_url}page/contact">Nous contacter</a></p>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section>
                        <div class="container">
                            <div class="row">
                                <div class="col-12 pb-5 plan">
                                    <h2 class="pb-2">Autre</h2>
                                    <p><a href="{$base_url}page/mentions">Mentions légales</a></p>
                                    <p><a href="{$base_url}page/plan">Plan du site</a></p>
                                    <p><a href="{$base_url}page/aide_site">Aide du site</a></p>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    
    </div>
{/block}