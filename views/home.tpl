{* La page d'acceuil VoyageVoyage *}

{extends file="views/layout.tpl"}

{block name="contenu"}

<!-- voyage -->
<section id="voyage">
    <div class="container">
        <div class="row">
            <div id='raconte-voyage' class="col-md-6 col-12">
                <h1 class="pb-2">Et si vous nous racontiez <span class="fst-italic">votre voyage</span> ?</h1>
                <p>Partagez vos aventures uniques et découvrez comment votre périple inspire et émerveille notre
                    communauté.</p>
                <div class="button-left">
                    <a class="green-btn" href="utrip/raconte"><i class="fa-solid fa-feather"></i>Je raconte mon
                        voyage</a>
                </div>
            </div>
            <div class="col-md-3 col-12 text-center pt-3 pt-md-0"><img class="resume-img pt-2  "
                    src="assets/images/italie.jpg" alt="jolie ruelle italienne"></div>
            <div class="col-md-3 col-12 text-center">
                <img class="resume-img pt-2 d-none d-md-block" src="assets/images/zanzibar.jpg"
                    alt="magnifique plage à zanzibar">
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
                    <a class="orange-btn" href="utrip/explore"><i class="fa-solid fa-suitcase-rolling"></i> J'explore
                            les histoires</a>
                    </div>
                </div>
            </div>
            <article>
                <div class="container">
                    <div class="row ">
                        {foreach from=$arrUtripsToDisplay item=objUtrip}
                            {include file="views/utrip.tpl"}
                        {/foreach}
                    </div>
                </div>
            </article>
        </div>
    </section>
    <!-- Echangez -->
    <section id="echange">
        <div class="container">
            <div class="row">
                <div id='echange-voyage' class="col-md-6 col-12">
                    <h2 class="pb-2"><span class="fst-italic">Échangez</span> <br> avec les autres voyageurs</h2>
                    <p>Rejoignez notre forum et connectez-vous avec une communauté passionnée pour partager conseils et
                        expériences de voyage.</p>
                    <div class="button-left">
                        <a class="green-btn" href="forum/home"><i class="fa-solid fa-comments"></i> Je
                            découvre le forum</a>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <section class="pb-5">
                        {foreach from=$arrForumsToDisplay item=objForum}
                            {include file="views/topic.tpl"}
                        {/foreach}
                    </section>
                </div>
            </div>
        </div>
    </section>


{/block}