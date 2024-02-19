{extends file="views/layout.tpl"}

{block name="contenu"}
    {if (count($arrErrors) >0) }
        <div class="alert alert-danger">
            {foreach from=$arrErrors item=strError}
                <p>{$strError}</p>
            {/foreach}
        </div>
    {/if}
    <form action="forum/addtopic" method="post" enctype="multipart/form-data">
        <p>
            <label for="titre">Titre du topic</label>
            <input id="titre" type="text" name="title" value="{$objArticle->getTitle()}" />
        </p>
        <p>
            <label for="contenu">Contenu du topic</label>
            <textarea id="contenu" name="content">{$objArticle->getContent()}</textarea>
        </p>
        <p>
            <input type="submit" />
        </p>
    </form>
{/block}