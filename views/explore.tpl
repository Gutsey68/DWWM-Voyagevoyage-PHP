La view de la page entière Explorez avec tous les articles

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
    <form name="formSearch" method="post" action="" class="mb-5">
        <div class="container">
            <!-- Barre de recherche -->
            <div class="row mb-4">
                <div class="col">
                    <div class="input-group">
                        <input type="search" class="form-control" id="searchBox" name="keywords"
                            placeholder="Recherchez un article...">
                    </div>
                </div>
            </div>

            <!-- Filtres -->
            <div class="row g-3 align-items-center mb-4">
                <!-- Filtres par continent -->
                <div class="col-md">
                    <label for="continentSelect" class="form-label">Continent</label>
                    <div class="col">
                        <select class="form-select" id="continentSelect" name="continent">
                            <option value="">Choisissez un continent...</option>
                            {foreach from=$arrUtripsToDisplay item=objUtrip}
                                <option value="{$objUtrip->getCont()}">{$objUtrip->getCont()}</option>
                            {/foreach}
                        </select>
                    </div>
                </div>
                <!-- Filtre par date d'ajout -->
                <div class="col-md">
                    <label for="dateAdded" class="form-label">Date d'ajout</label>
                    <input type="date" class="form-control" id="dateAdded" name="date">
                </div>
                <!-- Filtre par catégorie -->
                <div class="col-md">
                    <label for="categorySelect" class="form-label">Catégorie</label>
                    <select class="form-select" id="categorySelect" name="categorie">
                        <option>Choisissez une catégorie...</option>
                        {foreach from=$arrUtripsToDisplay item=objUtrip}
                            <option value="{$objUtrip->getCat()}">{$objUtrip->getCat()}</option>
                        {/foreach}
                    </select>
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
    <!-- Grille des articles -->
    <div id="explore-utrips">
        <div class="container">
            <div class="row">
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
        </div>
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