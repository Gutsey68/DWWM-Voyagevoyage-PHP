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
    <form name="formSearch" method="post" action="" class="mb-5">
        <div class="container">
            <!-- Barre de recherche -->
            <div class="row mb-4">
                <div class="col">
                    <div class="input-group">
                        <input type="search" class="form-control" name="keywords" placeholder="Recherchez un topic...">
                    </div>
                </div>
            </div>
            <!-- Bouton de recherche -->
            <div class="row">
                <div class="col">
                    <button type="submit" value="Rechercher" class="btn green-btn">
                        <i class="fa-solid fa-magnifying-glass"></i> Rechercher
                    </button>
                </div>
            </div>
        </div>
    </form>
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