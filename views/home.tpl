{* La page d'acceuil VoyageVoyage *}

{extends file="views/layout.tpl"}

{block name="contenu"}

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
                    <p>Plongez dans un monde de récits captivants où chaque destination dévoile ses mystères et ses
                        merveilles.</p>
                    <div class="button-center">
                        <a class="orange-btn" href="index.php?action=explore&ctrl=utrip"><i
                                class="fa-solid fa-suitcase-rolling"></i> J'explore les
                        histoires</a>
                </div>
            </div>
        </div>
        <div class="row text-center">
            {foreach from=$arrUtripsToDisplay item=objUtrip}
            {include file="views/_partial/header.tpl"}
            {include file="views/utrip.tpl"}
            {/foreach}
        </div>
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


{/block}