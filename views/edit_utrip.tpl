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
        <div class="container mt-3 row">
                <div class="text-center col-md-6">
                    <legend class="green-title">Modification de l'article</legend>
                    <div class="palette"><img class="img-fluid" width="300px" height="300px"
                        src="uploads/{$objUtrip->getImg()}" alt="">
                    </div>
                </div>
            <div class="col-md-6">
                <!-- nom de l'article -->
                    <div class="container mb-3  form-bg pt-3">
                        <div class="row">
                            <div class="col-md-6 col-12"><label class="form-label" for="articleName">Titre :</label></div>
                            <div class="col-md-6 col-12"><input class="form-control" type="text" id="articleName"
                                    name="name" value="{$objUtrip->getName()}"></div>
                        </div>
                    </div>
                    <!-- contenu de l'article -->
                    <div class="container mb-3  form-bg">
                        <div class="row">
                            <div class="col-md-6 col-12"><label class="form-label" for="articleContent">Contenu de l'article
                                    :</label></div>
                            <div class="col-md-6 col-12"><textarea class="form-control" id="articleContent"
                                    name="description" value="" rows="8">{$objUtrip->getDescription()}</textarea></div>
                        </div>
                    </div>
                    <!-- catégories -->
                    <div class="container mb-3  form-bg">
                        <div class="row">
                            <div class="col-md-6 col-12"><label class="form-label" for="articleCategory">Catégorie <span
                                        class="text-danger">*</span> :</label></div>
                            <div class="col-md-6 col-12"><select class="form-select" id="articleCategory" name="cat">

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
                            <div class="col-md-6 col-12g"><label for="articleBudget">Budget approximatif (en €) :</label>
                            </div>
                            <div class="col-md-6 col-12"><input class="form-control" type="text" id="articleBudget"
                                    value="{$objUtrip->getBudget()}" name="budget"></div>
                        </div>
                    </div>
            <div class="text-center mt-4">
                <input type="submit" class="btn green-btn" value="Valider">
            </div>
        </div>
        </div>
    </form>
{/block}