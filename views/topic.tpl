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
    <article>
        <section id="utrip-title">
            <div class="container pb-3 pt-3">
                <div class="row">
                    <div class="col-12">
                        <h1 class="pb-3">{$objForum->getTitle()}</h1>
                        <p>Publié le <span>{$objForum->getDateFr()}</span> par <a href="{$base_url}user/user?id={$objForum->getCreatorId()}">{$objForum->getCreator()}</a></p>
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
    {if ($smarty.session.user.user_role == "modo") }
		<div class="col-6">
			<h2>Modération</h2>
			<form method="post" action="forum/topic?id={$objForum->getId()}">
				<p>
					<label>Accepté</label>
					<input type="radio" name="moderation" value="1" {if ($objForum->getValid() == 1) } checked {/if} > Oui
					<input type="radio" name="moderation" value="0" {if ($objForum->getValid() == 0) } checked {/if} > Non
				</p>
				<p>
					<label>Commentaire</label>
					<textarea name="comment">{$objForum->getComment()}</textarea>
				</p>
				<input type="submit" >
			</form>
		</div>
    {/if}
{/block}