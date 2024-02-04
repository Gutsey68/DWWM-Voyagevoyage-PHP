{extends file="views/layout.tpl"}

{block name="contenu"}
    <section id="forum">
        <div class="container">
            <div class="row text-center">
                <div class="col-12">
                    <h1 class="">Bienvenue sur le forum des <span class="fst-italic">voyageurs</span></h1>
                    <p class="">
                        Échangez conseils et histoires avec une communauté qui partage votre passion pour l'aventure et la
                        découverte.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section class="pb-5">
        <div class="container">
            <div class="row ">
                {foreach from=$arrForumsToDisplay item=objForum}
                    {include file="views/topic.tpl"}
                {/foreach}
            </div>
        </div>
    </section>
{/block}