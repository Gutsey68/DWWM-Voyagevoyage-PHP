{extends file="views/layout.tpl"}

{block name="contenu"}
    {if (count($arrErrors) >0) }
        <div class="alert alert-danger form-container mt-5 mb-3">
            {foreach from=$arrErrors item=strError}
                <p>{$strError}</p>
            {/foreach}
        </div>
    {/if}
    <form class="mt-5 mb-5" action="" method="post">
        <div class="form-container mt-3 row">
            <fieldset class="col-12">
                <legend class="green-title">Modification de l'article</legend>
                {foreach from=$arrUtripImgs item=image}
                    <div class="position-relative">
                        <div class="palette"><img class="img-fluid" src="uploads/{$image.img_link}" alt=""></div>
                        <a href="{$base_url}utrip/deleteImage?id={$image.img_id}" class="btn-close position-absolute top-0 end-0">X</a>
                    </div>
                {/foreach}

            <!-- nom de l'article -->
            <div class="container mb-3  form-bg">
                <div class="row">
                    <div class="col-md-6 col-12"><label class="form-label" for="articleName">Titre :</label></div>
                    <div class="col-md-6 col-12"><input class="form-control" type="text" id="articleName" name="name"
                            value="{$objUtrip->getName()}" ></div>
                </div>
            </div>
            <!-- contenu de l'article -->
            <div class="container mb-3  form-bg">
                <div class="row">
                    <div class="col-md-6 col-12"><label class="form-label" for="articleContent">Contenu de l'article  :</label></div>
                    <div class="col-md-6 col-12"><textarea class="form-control" id="articleContent" name="description"
                            value=""rows="8">{$objUtrip->getDescription()}</textarea></div>
                </div>
            </div>
            <!-- catégories -->
            <div class="container mb-3  form-bg">
                <div class="row">
                    <div class="col-md-6 col-12"><label class="form-label" for="articleCategory">Catégorie <span class="text-danger">*</span> :</label></div>
                    <div class="col-md-6 col-12"><select class="form-select" id="articleCategory" name="cat">
                            <option value="">--</option>
                            {foreach from=$arrCatsToDisplay item=objUtrip}
                                <option value="{$objUtrip->getCatId()}">{$objUtrip->getCat()}</option>
                            {/foreach}
                        </select>
                    </div>
                </div>
            </div>
            <!-- budget -->
            <div class="container mb-5  form-bg">
                <div class="row ">
                    <div class="col-md-6 col-12g"><label for="articleBudget">Budget approximatif (en €) :</label></div>
                    <div class="col-md-6 col-12"><input class="form-control" type="text" id="articleBudget"
                             value="{$objUtrip->getBudget()}" name="budget"></div>
                </div>
            </div>
            </fieldset>
            <div class="text-center mt-4">
                <input type="submit" class="btn green-btn" value="Valider">
            </div>
        </div>
    </form>
{/block}