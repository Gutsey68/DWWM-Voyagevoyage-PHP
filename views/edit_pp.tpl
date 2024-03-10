{extends file="views/layout.tpl"}

{block name="contenu"}
    {if (count($arrErrors) >0) }
        <div class="alert alert-danger form-container mt-5 mb-3">
            {foreach from=$arrErrors item=strError}
                <p>{$strError}</p>
            {/foreach}
        </div>
    {/if}
    <div class="container text-center mt-5 ">
    <a data-fslightbox="gallery" href="uploads/{$objUser->getPp()}"><img class="img-fluid rounded-circle" height="300px" width="300px" src="uploads/{$objUser->getPp()}" alt=""></a>
    </div>
    <form class="mt-3 mb-5 form-container p-5" action="user/edit_pp " method="post" enctype="multipart/form-data">
        <div class="">
            <legend class="green-title">Ajouter une Image</legend>
            <div class="mb-3">
                <label for="imageUpload" class="form-label custom-file-input">Choisir une image</label>
                <input type="file" class="form-control custom-file-label" id="imageUpload" name="pp" accept="image/*" onchange="previewImage()">
            </div>
            <div class="mb-3">
                <img id="imagePreview" src="#" alt="Prévisualisation de l'image" style="display: none; max-width: 100%; height: auto;"/>
            </div>
        </div>
        <div class="text-center mt-4">
            <input type="submit" value="Enregistrer les modifications" class="btn green-btn">
        </div>
    </form>
{/block}