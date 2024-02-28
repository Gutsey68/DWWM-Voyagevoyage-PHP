{extends file="views/layout.tpl"}
{block name="contenu"}
    <div class="container mb-5">
        <h1 class="mt-5 mb-3">Nouveau sujet</h1>
        {if (count($arrErrors) >0) }
            <div class="alert alert-danger form-container mt-5 mb-3">
                {foreach from=$arrErrors item=strError}
                    <p>{$strError}</p>
                {/foreach}
            </div>
        {/if}
        <form action="" method="post">
            <div class="mb-3">
                <label for="topicName" class="form-label">Saisir le titre du sujet <span class="text-danger">*</span></label>
                <input name="title" type="text" class="form-control" id="topicName" placeholder="Entrez le nom du sujet">
            </div>
            <div class="mb-3">
                <label for="topicContent" class="form-label">Contenu <span class="text-danger">*</span></label>
                <textarea name="content" class="form-control" id="topicContent" rows="3"
                    placeholder="Entrez le contenu du sujet"></textarea>
            </div>
            <button type="submit" class="btn green-btn">Envoyer</button>
        </form>
    </div>
{/block}