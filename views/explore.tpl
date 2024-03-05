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
                    <input type="search" class="form-control" id="keywords" name="keywords"
                        placeholder="Recherchez un article..." value="{$strKeywords}">
                </div>
            </div>
            <!-- Filtres -->
            <div class="row g-3 mb-4">
                <!-- Filtres par continent -->
                <div class="col-md">
                    <label for="cont" class="form-label">Continent</label>
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
                <!-- Budget -->
                <div class="col-md-auto">
                    <label for="startbudget" class="form-label">Budget minimal (en €)</label>
                    <input type="text" class="form-control" id="startbudget" name="startbudget" value="{$strStartBudget}">
                </div>
                <div class="col-md-auto">
                    <label for="endbudget" class="form-label">Budget maximal (en €)</label>
                    <input type="text" class="form-control" id="endbudget" name="endbudget" value="{$strEndBudget}">
                </div>
                <!-- date -->
                <div class="col-md-auto">
                    <label for="startdate" class="form-label">Date de début</label>
                    <input type="date" class="form-control" id="startdate" name="startdate" value="{$strStartDate}">
                </div>
                <div class="col-md-auto">
                    <label for="enddate" class="form-label">Date de fin</label>
                    <input type="date" class="form-control" id="enddate" name="enddate" value="{$strEndDate}">
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
            <!-- tri par date / likes -->
            <div><input type="radio" name="sorting" checked value="0"  /> Par date
                <input type="radio" name="sorting" value="1"  /> Par like
            </div>
            <!-- Bouton de recherche -->
            <div class="row">
                <div class="col">
                    <input type="submit" value="Rechercher" class="green-btn">
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
                    <a class="green-btn" href="{$base_url}utrip/raconte"><i class="fa-solid fa-feather"></i>
                        Je raconte la mienne</a>
                </div>
            </div>
        </div>
    </section>
{/block}