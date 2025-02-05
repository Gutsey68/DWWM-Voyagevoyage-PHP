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
    <article class="mt-3 mb-5 p-5 container mobile-mb-0 mobile-mt-0">
        <div>
            <div class="row">
                <div class="col-md-6 col-xs-12 pt-4 pb-5 mobile-mb-0">
                    {* Titre et contenu *}
                    <h1 class=" green-title">{$objUtrip->getName()}</h1>
                    <p>Publié le <span>{$objUtrip->getDateFr()}</span> par <a href="{$base_url}user/user?id={$objUtrip->getCreatorId()}"><span class="poppins blue-link">{$objUtrip->getCreator()}<span></a></p>

                    <ul class="list-unstyled">
                        <li><i class="fa-solid fa-city"></i> : {$objUtrip->getCity()},  {$objUtrip->getCountry()} ({$objUtrip->getCont()})</li>
                        <li><i class="fa-solid fa-list"></i>: {$objUtrip->getCat()}</li>
                        {* Si le budget n'est pas renseigné il n'est pas affiché *}
                        {if $objUtrip->getBudget() neq ""}
                            <li><i class="fa-solid fa-wallet"></i> : {$objUtrip->getBudget()} €</li>
                        {/if}
                        <div class="col-12"><p class="">{count($arrLikes)}<i class="fa-solid fa-heart p-1"></i></p></div>
                    </ul>
                    <div class="pb-3"> {$objUtrip->getDescription()|nl2br} </div>
                    <div class="row">
                        {if (isset($smarty.session.user.user_id))}
                            <div class="col-12 button-left"><a class="green-btn pe-5" href="{$base_url}utrip/like?id={$objUtrip->getId()}" alt="Supprimer l'article">
                                <i class="fa-solid fa-heart ps-3"></i> J'aime</a></div>
                        {/if}
                    </div>
                </div>
                <div class="col-md-6 col-xs-12 text-end mt-5">
                <a class="d-none d-md-block" data-fslightbox="gallery" href="uploads/{$objUtrip->getImg()}"><img class="img-fluid" height="500px" width="600px" src="uploads/{$objUtrip->getImg()}" alt=""></a>
                        {* Modifier / supprimer l'article  *}
                        {if ( isset($user.user_id) && $user.user_id != '' ) 
                        && 
                        ( $user.user_role == 'admin' || $objUtrip->getCreatorId() == $user.user_id || $user.user_role == 'modo') }
                        <div>
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
            </div>
        </div>
    </article>
    {* Boucle pour afficher les images seulement si 2 images au moins *}
    {if $arrUtripImgs|@count > 1}
        <div class="container mt-5 mb-5 mobile-mb-0">
            <div class="row">
                {foreach from=$arrUtripImgs item=$image}
                    <div class="col-12 col-md-3 pb-4">
                        <a data-fslightbox="gallery" href="uploads/{$image.img_link}"><img class="img-fluid" height="200px" width="300px" src="uploads/{$image.img_link}" alt=""></a>
                    </div>
                {/foreach}
            </div>
        </div>
    {/if}
    <div class="row">
        <div class="col-12">
            {* ajouter un commentaire  *}
            {if ( isset($user.user_id) && $user.user_id != '' )}
                <section id="ad-comment" class="mt-3">
                    <div class="form-container ">
                        <div class="row ps-3 pe-3 pb-3 mobile-mb-0">
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
                            <div class="col-12 text-center mb-4 mobile-mb-0">
                                <h3 class="fs-5 green-title poppins"><i class="pe-1 fa-solid fa-circle-info"></i>Vous devez être inscrit pour écrire un commentaire</h3>
                            </div>
                        </div>
                    </div>
                </section>
            {/if}
            {* boucle des commentaires *}
            <section id="utrip-comments" class="mb-5">
                <div class="form-container ">
                    <div class="row ps-3 pe-3">
                        <div class="col-12 pb-2">
                        {if $arrComments|@count > 0}
                            <h3>Commentaires</h3>
                        {/if}
                        </div>
                        <div class="col-12">
                            {foreach from=$arrComments item=comment}
                                <div class="position-relative p-1 m-1">
                                    <div class="comment ">
                                        <p class="padding-bottom0"><strong>Commentaire de :</strong> <a class="blue-link"
                                                href="{$base_url}user/user?id={$comment.com_creatorId}">{$comment.com_creator}</a>
                                        </p>
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
        </div>
        <div class="col-12">
            {* Partie modération *}
            <div class="form-container">
                <div class="row">
                    {if (isset($smarty.session.user.user_id))}
                        {if ($smarty.session.user.user_role == "modo") || ($smarty.session.user.user_role == "admin") }
                            <div class="p-5   col-12">
                                <h2 class="green-title">Modération</h2>
                                <form method="post" action="utrip/utrip?id={$objUtrip->getId()}">
                                    <p>
                                        <label>Accepté</label>
                                        <input type="radio" name="moderation" value="1" {if ($objUtrip->getValid() == 1) } checked
                                            {/if}> Oui
                                        <input type="radio" name="moderation" value="0" {if ($objUtrip->getValid() == 0) } checked
                                            {/if}> Non
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
        </div>
    </div>
    {* 2 derniers articles ajoutés de la cat *}
    <section class="mb-5">
        <div class="container pt-3 pb-3">
            <div class="row ">
            {if $arrUtripsCatToDisplay|@count > 0}
                <h2 class="green-title text-center padding-bottom0"> Découvrez d'autres récits dans le même thème</h2>
            {/if}
                {foreach from=$arrUtripsCatToDisplay item=objUtrip}
                    {include file="views/utrip_summary.tpl"}
                {/foreach}
            </div>
        </div>
    </section>
{/block}