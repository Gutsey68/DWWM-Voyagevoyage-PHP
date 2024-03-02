{* La view de la page entière Explorez avec tous les articles *}

{extends file="views/layout.tpl"}

{block name="contenu"}
    <section id="recit">
        <div class="container">
            <div class="row text-center">
                <div class="col-12">
                    <h1 class="pb-2">Explorez des récits <span class="fst-italic">inoubliables</span></h1>
                    <p class="pb-2">
                        Découvrez des aventures uniques racontées par des voyageurs passionnés. Laissez-vous inspirer par
                        leurs expériences et partagez les vôtres.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- Tri articles -->
    <form name="formSearch" method="post" action="{$base_url}utrip/explore" class="mb-5">
        <div class="container">
            <!-- Barre de recherche -->
            <div class="row mb-4">
                <div class="col">
                    <div class="input-group">
                        <input type="search" class="form-control" id="keywords" name="keywords" value="{$strKeywords}"
                            placeholder="Recherchez un article...">
                    </div>
                </div>
            </div>
            <!-- Filtres -->
            <div class="row g-3 align-items-center mb-4">
                <!-- Filtres par continent -->
                <div class="col-md">
                    <label for="cont" class="form-label">Continent</label>
                    <div class="col">
                        <select class="form-select" id="cont" name="cont">
                            <option value="">Choisissez un continent</option>
                            <option>Afrique</option>
                            <option>Amérique</option>
                            <option>Asie</option>
                            <option>Europe</option>
                            <option>Océanie</option>
                            <option>Antarctique</option>
                        </select>
                    </div>
                </div>
                <!-- Filtre par date d'ajout -->
                <div class="col-md">
                    <label for="date" class="form-label">Date d'ajout</label>
                    <input type="date" class="form-control" id="date" value="{$strDate}" name="date">
                </div>
                <!-- Filtre par catégorie -->
                <div class="col-md">
                    <label for="cat" class="form-label">Catégorie</label>
                    <select class="form-select" id="cat" name="cat">
                        <option value="">Choisissez une catégorie...</option>
                        {foreach from=$arrCatsToDisplay item=objUtrip}
                            <option value="{$objUtrip->getCat()}">{$objUtrip->getCat()}</option>
                        {/foreach}
                    </select>
                </div>
            </div>
            <!-- Bouton de recherche -->
            <div class="row">
                <div class="">
                    <input type="submit" value="Rechercher" class="btn green-btn"></input>
                </div>
            </div>
        </div>
    </form>
    <!-- Grille des articles -->
    <div id="explore-utrips">
        <article>
            <div class="container">
                <div class="row ">
                    {foreach from=$arrUtripsToDisplay item=objUtrip}
                        {include file="views/utrip_summary.tpl"}
                    {foreachelse}
                        <p>Pas de résultat</p>
                    {/foreach}
                </div>
            </div>
        </article>
    </div>
    <section>
        <div id="marge" class="container mt-5 mb-5 text-center">
            <div class="row">
                <h2 class="pb-2">Partagez votre <span class="fst-italic">aventure</span></h2>
                <p class="pb-2">
                    Avez-vous récemment vécu un voyage exceptionnel? Nous aimerions entendre votre histoire! Rejoignez notre
                    communauté de voyageurs passionnés et partagez les moments qui ont rendu votre expérience inoubliable.
                </p>
                <div class="button-center">
                    <a class="green-btn" href="index.php?action=raconte&ctrl=utrip"><i class="fa-solid fa-feather"></i>
                        Je raconte la mienne</a>
                </div>
            </div>
        </div>
    </section>
{/block}