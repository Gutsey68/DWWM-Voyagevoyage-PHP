{* La view d'un article *}

{extends file="views/layout.tpl"}

{block name="contenu"}

    {if (count($arrErrors) >0) }
        <div class="alert alert-danger form-container mt-3 mb-3">
            {foreach from=$arrErrors item=strError}
                <p>{$strError}</p>
            {/foreach}
        </div>
    {/if}

    <article id="utrip">
        <section id="utrip-title">
            <div class="container pb-3 pt-3">
                <div class="row">
                    <div class="col-6">
                        <h1 class=" green-title">{$objUtrip->getName()}</h1>
                        <p>Publié le <span>{$objUtrip->getDateFr()}</span> par <a
                                href="{$base_url}user/user?id={$objUtrip->getCreatorId()}">{$objUtrip->getCreator()}</a></p>
                        <p><i class="fa-solid fa-list"></i> Catégorie : {$objUtrip->getCat()}</p>
                        <p><i class="fa-solid fa-wallet"></i> Budget approximatif : {$objUtrip->getBudget()}</p>
                        <p><i class="fa-solid fa-city"></i> Ville : {$objUtrip->getCity()}, {$objUtrip->getCountry()}
                            ({$objUtrip->getCont()})</p>
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
                        {foreach from=$arrUtripImgs item=$image}
                            <a data-fslightbox="gallery" href="uploads/{$image.img_link}"><img class="resume-img" src="uploads/{$image.img_link}" alt=""></a>

                        {/foreach}

                    </div>
                </div>
                <div class="row">
                    <div class="col-2">
                        {if (isset($smarty.session.user.user_id))}
                            <a class="green-btn pe-5" href="{$base_url}utrip/like?id={$objUtrip->getId()}" alt="Supprimer l'article">
                                <i class="fa-solid fa-heart ps-3"></i> J'aime</a>
                        {/if}
                    </div>
                    <div class="col-2">
                        <p class="pt-2">{count($arrLikes)}<i class="fa-solid fa-heart p-1"></i></p>
                    </div>
                    <div class="col-8"></div>
                </div>
            </div>
        </div>
    {if ( isset($user.user_id) && $user.user_id != '' ) 
            && 
            ( $user.user_role == 'admin' || $objUtrip->getCreatorId() == $user.user_id || $user.user_role == 'modo') }
        <div class="container">
            <div class="row">
                <div class="col-2">
                    <a class="green-btn" href="{$base_url}utrip/edit_utrip?id={$objUtrip->getId()}" alt="Modifier l'article">Modifier l'article</a>
                </div>
                <div class="pt-3">
						<a class="btn btn-danger" href="{$base_url}utrip/delete?id={$objUtrip->getId()}" onclick="return confirmDelete()" alt="Supprimer l'article">Supprimer l'article</i></a>
                </div>
                <div class="col-10"></div>
            </div>
        </div>
        {/if}
    {if (isset($smarty.session.user.user_id))}
    {if ($smarty.session.user.user_role == "modo") || ($smarty.session.user.user_role == "admin") }
    <div class="container mb-5">
        <h2 class="green-title">Modération</h2>
        <form method="post" action="utrip/utrip?id={$objUtrip->getId()}">
            <p>
                <label>Accepté</label>
                <input type="radio" name="moderation" value="1" {if ($objUtrip->getValid() == 1) } checked {/if}> Oui
                <input type="radio" name="moderation" value="0" {if ($objUtrip->getValid() == 0) } checked {/if}> Non
            </p>
            <p>
                <label>Commentaire</label>
                <textarea name="comment">{$objUtrip->getComment()}</textarea>
            </p>
            <input type="submit">
        </form>
    </div>
    {/if}
    {/if}

    {* ajouter un commentaire  *}
    {if ( isset($user.user_id) && $user.user_id != '' )}
        <section id="ad-comment">
            <div class="container pb-3 pt-3">
                <div class="row">
                    <div class="col-12">
                        <h3>Ajouter un commentaire</h3>
                        <form method="post" action="">
                            <div class="form-group">
                                <label for="comment">Votre commentaire</label>
                                <textarea name="com" id="comment" class="form-control"></textarea>
                            </div>
                            <div class="pt-4">
                            <input type="submit" class="btn green-btn">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    {else}
        <div class="container">
        <p>Vous devez être inscrit pour écrire un commentaire</p>
        </div>
    {/if}
    {* boucle des commentaires *}
    <section id="utrip-comments">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3>Commentaires</h3>
                    {foreach from=$arrComments item=comment}
                    <div class="comment">
                        <p><strong>Commentaire de :</strong> <a
                                href="{$base_url}user/user?id={$comment.com_creatorId}">{$comment.com_creator}</a></p>
                        <p>{$comment.com_content}</p>
                        <p><small>Posté le {$comment.com_date|date_format:"%d-%m-%Y- %H:%M:%S"}</small></p>
                    </div>
                    {if ( isset($user.user_id) && $user.user_id != '' )}
                    {if ($smarty.session.user.user_role == "admin") || ($smarty.session.user.user_role == "modo") || ($user.user_id == $comment.com_creatorId)}
                    <form action="" method="post" class="pb-5">
                        <input type="hidden" name="commentaireId" value="{$comment.com_id}">
                        <button type="submit" class="orange-btn">Supprimer</button>
                            </form>
                        {/if}
                    {/if}

                    {/foreach}
                </div>
            </div>
        </div>
    </section>

{/block}