{* La view d'un topic *}

{extends file="views/layout.tpl"}

{block name="contenu"}
    {if (count($arrErrors) >0) }
        <div class="alert alert-danger form-container mt-3 mb-3">
            {foreach from=$arrErrors item=strError}
                <p>{$strError}</p>
            {/foreach}
        </div>
    {/if}
        <section>
            <div class="container pb-3 pt-3">
                <div class="row">
                    <div class="col-12">
                        <h1 class="pb-3">{$objForum->getTitle()}</h1>
                        <p>Publié le <span>{$objForum->getDateFr()}</span> par <a href="{$base_url}user/user?id={$objForum->getCreatorId()}">{$objForum->getCreator()}</a></p>
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="container pt-3">
                <div class="row">
                    <div class="col-12"> {$objForum->getContent()} </div>
                </div>
            </div>
        </section>
        {if (isset($smarty.session.user.user_id))}
            {if ($smarty.session.user.user_role == "admin") || ($smarty.session.user.user_role == "modo") || ($smarty.session.user_id == $commenttopic.comt_creatorId)}
                <div class="container pt-3">
                <a class="btn btn-danger" onclick="return confirmDelete()"
                    href="{$base_url}forum/delete?id={$objForum->getId()}" alt="Supprimer le topic"><i class="fa fa-trash">
                        Supprimer le topic</i></a>
                </div>
            {/if}
        {/if}
         {* ajouter un commentaire  *}
         {if ( isset($user.user_id) && $user.user_id != '' )}
            <section id="add-comment">
                <div class="container pb-3 pt-3">
                    <div class="row">
                        <div class="col-12">
                            <h3>Ajouter un commentaire</h3>
                            <form method="post" action="">
                                <div class="form-group pb-3">
                                    <label for="comment">Votre commentaire</label>
                                    <textarea name="answer" id="comment" class="form-control"></textarea>
                                </div>
                                <input type="submit" class="btn green-btn" value="Poster">
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        {else}
            <div class="container pt-5">
            <h3>Vous devez être inscrit pour écrire un commentaire</h3>
            </div>
        {/if}
            <section id="forum-comments">
                <div class="container pb-3 pt-3">
                    <div class="row">
                        <div class="col-12">
                            <h3>Commentaires</h3>
                            {foreach from=$arrCommentsTopic item=commenttopic}
                                <div class="comment">
                                    <p><strong>Commentaire de :</strong> <a href="{$base_url}user/user?id={$commenttopic.comt_creatorId}">{$commenttopic.comt_creator}</a></p>
                                    <p>{$commenttopic.comt_content}</p>
                                    <p><small>Posté le {$commenttopic.comt_date|date_format:"%d-%m-%Y- %H:%M:%S %H:%M:%S"}</small></p>
                                </div>
                                {if ( isset($user.user_id) && $user.user_id != '' )}
                                    {if ($smarty.session.user.user_role == "admin") || ($smarty.session.user.user_role == "modo") || ($user.user_id == $commenttopic.comt_creatorId)}
                                        <form action="" method="post">
                                            <input type="hidden" name="comtopicId" value="{$commenttopic.comt_id}">
                                            <button type="submit" class="orange-btn" onclick="return confirmDelete()" >Supprimer</button>

                                        </form>
                                    {/if}
                                {/if}
                            {/foreach}
                        </div>
                    </div>
                </div>
            </section>
    {if (isset($smarty.session.user.user_id))}
        {if ($smarty.session.user.user_role == "modo") || ($smarty.session.user.user_role == "admin")}
            <div class="container">
                <div class="col-6">
                    <h2>Modération</h2>
                    <form method="post" action="forum/topic?id={$objForum->getId()}" class="pb-5">
                        <p>
                            <label>Accepté</label>
                            <input type="radio" name="moderation" value="1" {if ($objForum->getValid() == 1) } checked {/if} > Oui
                            <input type="radio" name="moderation" value="0" {if ($objForum->getValid() == 0) } checked {/if} > Non
                        </p>
                        <p>
                            <label>Commentaire</label>
                            <textarea name="comment" class="form-control">{$objForum->getComment()}</textarea>
                        </p>
                        <input class="green-btn" type="submit" >
                    </form>
                </div>
            </div>
        {/if}
    {/if}
{/block}