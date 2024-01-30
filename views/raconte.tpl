{extends file="views/layout.tpl"}

{block name="js_footer" append}
    <script src="assets/script/dnd.js"></script>	
    <script src="assets/script/bootstrap.bundle.js"></script>
{/block}

{block name="contenu"}
    <!-- système de drag and drop -->
<div id="dragndrop" class="container mt-5 mb-5">
    <div class="row">
        <div class="col-12">
            <p>Ajoute jusqu'à 20 photos.</p>
        </div>
        <div class="col-12" id="drop-area">
            <form class="my-form pt-5">
                <input type="file" id="fileElem" multiple accept="image/*">
                <label class="button green-btn" for="fileElem"><i class="fa-solid fa-image"></i>Ajoute des photos</label>
                <div id="gallery" class="pt-5"></div>
            </form>
        </div>
    </div>
</div>

{/block}			
