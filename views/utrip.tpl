{* La view d'un article *}

{extends file="views/layout.tpl"}

{block name="contenu"}
    <article id="utrip">
        <section id="utrip-title">
            <div class="container pb-3 pt-3">
                <div class="row">
                    <div class="col-12">
                        <h1 class="pb-3">{$objUtrip->getName()}</h1>
                        <p>Publié le <span>{$objUtrip->getDateFr()}</span> par <a href="">{$objUtrip->getCreator()}</a></p>
                        <p><i class="fa-solid fa-list"></i>  Catégorie : {$objUtrip->getCat()}</p>
                        <p><i class="fa-solid fa-wallet"></i>  Budget approximatif : {$objUtrip->getBudget()}</p>
                        <p><i class="fa-solid fa-city"></i> Ville : {$objUtrip->getCity()}, {$objUtrip->getCountry()} ({$objUtrip->getCont()})</p>
                    </div>
                </div>
            </div>
        </section>
        <section id="utrip-content">
            <div class="container pt-3">
                <div class="row">
                    <div class="col-12"> {$objUtrip->getDescription()} </div>
                </div>
            </div>
        </section>
        <div id="utrip-img">
            <div class="container pb-3">
                <div class="row">
                    <div class="col-12">
                        <img class="resume-img" src="uploads/{$objUtrip->getImg()}" alt="{$objUtrip->getName()}">
                        <img class="resume-img" src="uploads/{$objUtrip->getImg()}" alt="{$objUtrip->getName()}">
                        <img class="resume-img" src="uploads/{$objUtrip->getImg()}" alt="{$objUtrip->getName()}">
                        <img class="resume-img" src="uploads/{$objUtrip->getImg()}" alt="{$objUtrip->getName()}">
                    </div>
                </div>
                <div class="row">
                    <div class="col-2">
                    <button class="green-btn"><i class="fa-solid fa-heart"></i>J'aime</button> 
                    </div>
                    <div class="col-2">
                        <span>1 <i class="fa-solid fa-heart"></i> (c'est moi)</span>
                    </div>
                    <div class="col-8"></div>
                </div>
            </div>
        </div>
        <section id="utrip-comment">
            <div class="container pb-3 pt-3">
                <div class="row">
                    <div class="col-12">
                        <h3>Commentaires</h3>
                        <div>
                            <div>
                                <h4>acoubidou</h4>
                                <p>Publié le <time datetime="YYYY-MM-DD">2024-01-19</time></p>
                            </div>
                            <p>Salut combien de mcdo as tu vu ?</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </article>

{/block}