{extends file="views/layout.tpl"}

{block name="contenu"}
    <div class="container pt-5 pb-3">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="mb-3" id="raconte-h1">Racontez l'histoire de <span class="fst-italic">votre voyage</span></h1>
            <p>Partagez vos découvertes, inspirez les autres. Chaque aventure compte et enrichit notre monde.</p>
            <p>Vous devez être connecté pour publier.</p>
            <p>Les articles doivent être validés par les modérateurs avant d'être publiés.</p>
            </div>
        </div>
    </div>
    {if (count($arrErrors) >0) }
        <div class="alert alert-danger form-container mt-3 mb-3">
            {foreach from=$arrErrors item=strError}
                <p>{$strError}</p>
            {/foreach}
        </div>
    {/if}
    <section id='raconte-form' class="form-container">
        <form action="index.php?action=raconte&ctrl=utrip" method="post" enctype="multipart/form-data">
            <!-- photos système de drag and drop -->
            <div id="dragndrop" class="container mt-5 mb-5  form-bg">
                <div class="row">
                    <div class="col-12">
                        <p>Ajoutez jusqu'à 20 photos.</p>
                    </div>
                    <div class="col-12" id="drop-area">
                        <div class="my-form pt-5">
                            <input type="file" id="fileElem" multiple name="image[]">
                            <label class="button green-btn" for="fileElem"><i class="fa-solid fa-image"></i>Ajoutez des
                                photos</label>
                            <div id="gallery" class="pt-5"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- nom de l'article -->
            <div class="container mb-3  form-bg">
                <div class="row">
                    <div class="col-md-6 col-12"><label class="form-label" for="articleName">Titre <span class="text-danger">*</span> :</label></div>
                    <div class="col-md-6 col-12"><input class="form-control" type="text" id="articleName" name="name"
                            value="" placeholder="Titre"></div>
                </div>
            </div>
            <!-- contenu de l'article -->
            <div class="container mb-3  form-bg">
                <div class="row">
                    <div class="col-md-6 col-12"><label class="form-label" for="articleContent">Décrivez votre
                            voyage <span class="text-danger">*</span> :</label></div>
                    <div class="col-md-6 col-12"><textarea class="form-control" id="articleContent" name="description"
                            value="" placeholder="Contenu" rows="8"></textarea></div>
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
            <!-- ville -->
            <div class="container mb-3  form-bg">
                <div class="row ">
                    <div class="col-md-6 col-12g"><label for="articleCity">Ville <span class="text-danger">*</span> :</label></div>
                    <div class="col-md-6 col-12g">
                        <input class="form-control" autocomplete="off" type="text" id="articleCity" name="city" value="{$objUtrip->getCity()}">
                        <!-- Champ caché pour stocker l'ID de la ville sélectionnée -->
                        <input type="hidden" id="articleCityId" name="cityId" value="{$objUtrip->getCityId()}">
                    </div>

                </div>
            </div>
            <!-- budget -->
            <div class="container mb-5  form-bg">
                <div class="row ">
                    <div class="col-md-6 col-12g"><label for="articleBudget">Budget approximatif (en €) :</label></div>
                    <div class="col-md-6 col-12"><input class="form-control" type="text" id="articleBudget"
                            placeholder="exemple : 1000" value="" name="budget"></div>
                </div>
            </div>
            <div class="container mb-3">
                <div class="row">
                    <div><input class="green-btn" type="submit" value="Soumettre"></div>
                </div>
            </div>
        </form>
    </section>
{/block}