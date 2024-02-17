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
    <form class="mb-5">
        <div class="container">
            <!-- Barre de recherche -->
            <div class="row mb-3">
                <div class="col">
                    <input class="form-control" type="search" id="searchBox" name="search"
                        placeholder="Rechercher un article...">
                </div>
            </div>

            <!-- Filtres -->
            <div class="row g-3 align-items-center">
                <!-- Filtre par budget -->
                <div class="col-md">
                    <label for="budgetRange" class="form-label">Budget</label>
                    <select class="form-select" id="budgetRange" name="budget">
                        <option selected>Choisissez...</option>
                        <option value="1">€ - Abordable</option>
                        <option value="2">€€ - Modéré</option>
                        <option value="3">€€€ - Haut de gamme</option>
                    </select>
                </div>

                <!-- Filtre par date d'ajout -->
                <div class="col-md">
                    <label for="dateAdded" class="form-label">Date d'ajout</label>
                    <input type="date" class="form-control" id="dateAdded" name="dateAdded">
                </div>

                <!-- Filtre par nombre de likes -->
                <div class="col-md">
                    <label for="likes" class="form-label">Popularité</label>
                    <select class="form-select" id="likes" name="popularity">
                        <option selected>Choisissez...</option>
                        <option value="1">Les plus aimés</option>
                    </select>
                </div>
            </div>

            <!-- Bouton de recherche -->
            <div class="row mt-3">
                <div class="col">
                    <button type="submit" class="btn green-btn"><i
                            class="fa-solid fa-magnifying-glass"></i>Rechercher</button>
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
        <div id="marge" class="container mt-5 mb-5">
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