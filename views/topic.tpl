{extends file="views/layout.tpl"}

{block name="contenu"}
    {if (count($arrErrors) >0) }
        <div class="alert alert-danger mt-3 mb-3">
            {foreach from=$arrErrors item=strError}
                <p>{$strError}</p>
            {/foreach}
        </div>
    {/if}
        <section class="mb-4">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-12">
                        <h1 class="mb-3 green-title">{$objForum->getTitle()}</h1>
                        <p>Publié le <span>{$objForum->getDateFr()}</span> par <a href="{$base_url}user/user?id={$objForum->getCreatorId()}">{$objForum->getCreator()}</a></p>
                    </div>
                </div>
            </div>
        </section>
        <section class="mb-4">
            <div class="container">
                <div class="row">
                    <div class="col-12"> {$objForum->getContent()} </div>
                </div>
            </div>
        </section>
        {if ( isset($user.user_id) && $user.user_id != '' )}
            {if ($smarty.session.user.user_role == "admin") || ($smarty.session.user.user_role == "modo") || ($user.user_id == $objForum->getCreatorId())}
                <div class="container my-3">
                <a class="btn btn-danger" onclick="return confirmDelete()"
                    href="{$base_url}forum/delete?id={$objForum->getId()}" alt="Supprimer le topic"><i class="fa fa-trash">
                        </i> Supprimer le topic</a>
                </div>
            {/if}
        {/if}
        {if ( isset($user.user_id) && $user.user_id != '' )}
            <section id="add-comment" class="mb-4">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <h3>Ajouter un commentaire</h3>
                            <form method="post" action="">
                                <div class="form-group mb-3">
                                    <label for="comment">Votre commentaire</label>
                                    <textarea name="answer" id="comment" class="form-control"></textarea>
                                </div>
                                <input type="submit" class="green-btn" value="Poster">
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        {else}
            <div class="container my-5">
            <h3 class="fs-4 green-title poppins"><i class="pe-1 fa-solid fa-circle-info"></i>Vous devez être inscrit pour écrire un commentaire</h3>
            </div>
        {/if}
        <section id="forum-comments" class="mb-4">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                    {if $arrCommentsTopic|@count > 0}
                        <h3 class="mb-3 green-title">Commentaires</h3>
                    {/if}
                        {foreach from=$arrCommentsTopic item=commenttopic}
                            <div class="position-relative">
                            <div class="mb-3">
                                <p class="padding-bottom0"><strong>Commentaire de :</strong> <a href="{$base_url}user/user?id={$commenttopic.comt_creatorId}">{$commenttopic.comt_creator}</a></p>
                                <p><small>Posté le {$commenttopic.comt_date|date_format:"%d-%m-%Y %H:%M:%S"}</small></p>
                                <p>{$commenttopic.comt_content}</p>
                            </div>
                            {if ( isset($user.user_id) && $user.user_id != '' )}
                                {if ($smarty.session.user.user_role == "admin") || ($smarty.session.user.user_role == "modo") || ($user.user_id == $commenttopic.comt_creatorId)}
                                    <form class="position-absolute top-0 end-0" action="" method="post">
                                        <input type="hidden" name="comtopicId" value="{$commenttopic.comt_id}">
                                        <button type="submit" class="btn btn-danger" onclick="return confirmDelete()" >X</button>
                                    </form>
                                {/if}
                            {/if}
                        </div>
                        {/foreach}
                    </div>
                </div>
            </div>
        </section>
    {if (isset($smarty.session.user.user_id))}
        {if ($smarty.session.user.user_role == "modo") || ($smarty.session.user.user_role == "admin")}
            <div class="container my-4">
                <div class="row">
                    <div class="col-md-6">
                        <h2>Modération</h2>
                        <form method="post" action="forum/topic?id={$objForum->getId()}">
                            <div class="mb-3">
                                <label>Accepté</label>
                                <input type="radio" name="moderation" value="1" {if ($objForum->getValid() == 1) } checked {/if} > Oui
                                <input type="radio" name="moderation" value="0" {if ($objForum->getValid() == 0) } checked {/if} > Non
                            </div>
                            <div class="mb-3">
                                <label>Commentaire</label>
                                <textarea name="comment" class="form-control"></textarea>
                            </div>
                            <input type="submit" class="green-btn" value="Envoyer">
                        </form>
                    </div>
                </div>
            </div>
        {/if}
    {/if}
{/block}
