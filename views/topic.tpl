{* La view d'un topic *}

{extends file="views/layout.tpl"}

{block name="contenu"}
    <article>
        <section id="utrip-title">
            <div class="container pb-3 pt-3">
                <div class="row">
                    <div class="col-12">
                        <h1 class="pb-3">{$objForum->getTitle()}</h1>
                        <p>Publié le <span>{$objForum->getDateFr()}</span> par <a href="">{$objForum->getCreator()}</a></p>
                    </div>
                </div>
            </div>
        </section>
        <section id="utrip-content">
            <div class="container pt-3">
                <div class="row">
                    <div class="col-12"> {$objForum->getContent()} </div>
                </div>
            </div>
        </section>
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