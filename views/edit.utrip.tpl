{extends file="views/layout.tpl"}

{block name="contenu"}
    {if (count($arrErrors) >0) }
        <div class="alert alert-danger form-container mt-5 mb-3">
            {foreach from=$arrErrors item=strError}
                <p>{$strError}</p>
            {/foreach}
        </div>
    {/if}
    <form class="mt-5 mb-5" action="utrip/edit_topic" method="post">
        <div>
            <p>toto</p>
        </div>
    </form>
{/block}