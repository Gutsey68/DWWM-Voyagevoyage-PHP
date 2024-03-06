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
    {* Affichage de l'article *}
    <article class="mt-3 mb-5 p-5 container ">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-xs-12 pt-4 pb-5">
                    {* Titre et contenu *}
                    <h1 class=" green-title">{$objUtrip->getName()}</h1>
                    <p>Publié le <span>{$objUtrip->getDateFr()}</span> par <a href="{$base_url}user/user?id={$objUtrip->getCreatorId()}">{$objUtrip->getCreator()}</a></p>

                    <ul class="list-unstyled">
                        <li><i class="fa-solid fa-city"></i> : {$objUtrip->getCity()},  {$objUtrip->getCountry()} ({$objUtrip->getCont()})</li>
                        <li><i class="fa-solid fa-list"></i>: {$objUtrip->getCat()}</li>
                        <li><i class="fa-solid fa-wallet"></i> : {$objUtrip->getBudget()} €</li>
                    </ul>
                    <div class="pb-3"> {$objUtrip->getDescription()} </div>

                    <div class="row">
                        <div class="col-12"><p class="">{count($arrLikes)}<i class="fa-solid fa-heart p-1"></i></p></div>
                        {if (isset($smarty.session.user.user_id))}
                            <div class="col-12 button-left"><a class="green-btn pe-5" href="{$base_url}utrip/like?id={$objUtrip->getId()}" alt="Supprimer l'article">
                                <i class="fa-solid fa-heart ps-3"></i> J'aime</a></div>
                        {/if}
                    </div>
                        {* Modifier / supprimer l'article  *}
                        {if ( isset($user.user_id) && $user.user_id != '' ) 
                            && 
                            ( $user.user_role == 'admin' || $objUtrip->getCreatorId() == $user.user_id || $user.user_role == 'modo') }
                            <div class="container">
                                <div class="row mt-3">
                                    <div class="col-6 button-center">
                                        <a class="green-btn" href="{$base_url}utrip/edit_utrip?id={$objUtrip->getId()}" alt="Modifier l'article"><i class="ps-1 fa-solid fa-pen-to-square"></i> Modifier l'article</a>
                                    </div>
                                    <div class="col-6 button-center">
                                            <a class="green-btn" href="{$base_url}utrip/delete?id={$objUtrip->getId()}" onclick="return confirmDelete()" alt="Supprimer l'article"><i class="ps-1 fa-solid fa-trash"></i>Supprimer l'article</i></a>
                                    </div>
                                </div>
                            </div>
                        {/if}
                </div>
                <div class="col-md-6 col-xs-12 text-end mt-5">
                    <img height="500px" width="600px" src="uploads/{$objUtrip->getImg()}" alt="">
                </div>  
            </div>
        </div>
    </article>
    {* Boucle pour afficher les images *}
    <div class="container mt-5 mb-5">
        <div class="row">
                {foreach from=$arrUtripImgs item=$image}
                    <div class="col-3">
                        <img height="200px" width="300px" src="uploads/{$image.img_link}" alt="">
                    </div>
                {/foreach}
        </div>
    </div>
    {* Partie modération *}
    <div class="container">
        <div class="row">
            {if (isset($smarty.session.user.user_id))}
                {if ($smarty.session.user.user_role == "modo") || ($smarty.session.user.user_role == "admin") }
                <div class="container p-5   col-6">
                    <h2 class="green-title">Modération</h2>
                    <form method="post" action="utrip/utrip?id={$objUtrip->getId()}">
                        <p>
                            <label>Accepté</label>
                            <input type="radio" name="moderation" value="1" {if ($objUtrip->getValid() == 1) } checked {/if}> Oui
                            <input type="radio" name="moderation" value="0" {if ($objUtrip->getValid() == 0) } checked {/if}> Non
                        </p>
                        <p>
                            <label>Commentaire</label>
                            <textarea name="comment" class="form-control">{$objUtrip->getComment()}</textarea>
                        </p>
                        <input type="submit" class="green-btn">
                    </form>
                </div>
                {/if}
            {/if}
            
            <div class="col-6"></div>
        </div>

    </div>
    {* ajouter un commentaire  *}
    {if ( isset($user.user_id) && $user.user_id != '' )}
        <section id="ad-comment" class="mt-3">
            <div class="form-container ">
                <div class="row ps-3 pe-3 pb-3">
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
        <section id="ad-comment">
            <div class="form-container ">
                <div class="row ps-3 pe-3">
                    <div class="col-12">
                        <h3>Vous devez être inscrit pour écrire un commentaire</h3>
                    </div>
                </div>
            </div>
        </section>
    {/if}
    {* boucle des commentaires *}
    <section id="utrip-comments" class="mb-5">
        <div class="form-container ">
            <div class="row ps-3 pe-3">
                <div class="col-12">
                    <h3>Commentaires</h3>
                </div>
                <div class="col-12">
                    {foreach from=$arrComments item=comment}
                        <div class="position-relative p-1 m-1">
                            <div class="comment ">
                                <p class="padding-bottom0"><strong>Commentaire de :</strong> <a href="{$base_url}user/user?id={$comment.com_creatorId}">{$comment.com_creator}</a></p>
                                <p><small>Posté le {$comment.com_date|date_format:"%d-%m-%Y- %H:%M:%S"}</small></p>
                                <p>{$comment.com_content}</p>
                            </div>
                            {if ( isset($user.user_id) && $user.user_id != '' )}
                                {if ($smarty.session.user.user_role == "admin") || ($smarty.session.user.user_role == "modo") || ($user.user_id == $comment.com_creatorId)}
                                    <form action="" method="post" class="pb-5 position-absolute top-0 end-0">
                                        <input type="hidden" name="commentaireId" value="{$comment.com_id}">
                                        <button type="submit" class="btn btn-danger ">X</button>
                                    </form>
                                {/if}
                            {/if}
                        </div>
                    {/foreach}
                </div>
            </div>
        </div>
    </section>
    {* 2 derniers articles ajoutés de la cat *}
    <section class="mb-5">
        <div class="container pt-3 pb-3">
            <div class="row">
                <div class="col-12" >
                    <h3 class="fs-3 orange">Découvrez plus de récits captivants dans cette catégorie ! Cliquez pour explorer et vous laisser inspirer.</h3>
                    {foreach from=$arrUtripsCatToDisplay item=objUtrip}
                        {include file="views/utrip_summary.tpl"}
                    {/foreach}
                </div>
            </div>
        </div>
    </section>
{/block}