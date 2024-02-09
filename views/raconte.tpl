{extends file="views/layout.tpl"}

{block name="contenu"}

    <div class="container pt-5 pb-3">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="mb-3" id="raconte-h1">Racontez l'histoire de <span class="fst-italic">votre voyage</span></h1>
            <p>Partagez vos découvertes, inspirez les autres. Chaque aventure compte et enrichit notre monde.</p>
        </div>
    </div>
</div>
<section id='raconte-form'>
    <form action="" method="post" class="">
        <!-- photos système de drag and drop -->
        <div id="dragndrop" class="container mt-5 mb-5  form-bg">
            <div class="row">
                <div class="col-12">
                    <p>Ajoutez jusqu'à 20 photos.</p>
                    </div>
                    <div class="col-12" id="drop-area">
                        <div class="my-form pt-5">
                            <input type="file" id="fileElem" multiple accept="image/*">
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
                    <div class="col-md-6 col-12"><label class="form-label" for="articleName">Titre:</label></div>
                    <div class="col-md-6 col-12"><input class="form-control" type="text" id="articleName" name="articleName"
                            required></div>
                </div>
            </div>
            <!-- contenu de l'article -->
            <div class="container mb-3  form-bg">
                <div class="row">
                    <div class="col-md-6 col-12"><label class="form-label" for="articleContent">Décrivez votre
                            voyage:</label></div>
                    <div class="col-md-6 col-12"><textarea class="form-control" id="articleContent" name="articleContent"
                            required></textarea></div>
                </div>
            </div>
            <!-- catégories -->
            <div class="container mb-3  form-bg">
                <div class="row">
                    <div class="col-md-6 col-12"><label class="form-label" for="articleCategory">Catégorie:</label></div>
                    <div class="col-md-6 col-12"><select class="form-select" id="articleCategory" name="articleCategory">
                            <option value="">--</option>
                        </select>
                    </div>
                </div>
            </div>
            <!-- ville -->
            <div class="container mb-3  form-bg">
                <div class="row ">
                    <div class="col-md-6 col-12g"><label for="articleCity">Ville:</label></div>
                    <div class="col-md-6 col-12"><input class="form-control" type="text" id="articleCity" name="articleCity"
                            required></div>
                </div>
            </div>
            <!-- budget -->
            <div class="container mb-5  form-bg">
                <div class="row ">
                    <div class="col-md-6 col-12g"><label for="articleBudget">Budget approximatif:</label></div>
                    <div class="col-md-6 col-12"><input class="form-control" type="text" id="articleBudget"
                            name="articleBudget" required></div>
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