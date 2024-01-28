<?php 
    $strPage = "raconte";
    $strTitle ="Racontez";
    include_once("views/_partial/header.php") 
?>
<!-- système de drag and drop -->
<div id="dragndrop" class="container mt-5 mb-5">
    <div class="row">
        <div class="col-12">
            <p>Ajoute jusqu'à 20 photos.</p>
        </div>
        <div class="col-12" id="drop-area">
            <form class="my-form">
                <input type="file" id="fileElem" multiple accept="image/*">
                <label class="button green-btn" for="fileElem"><i class="fa-solid fa-image"></i>Ajoute des photos</label>
                <div id="gallery"></div>
            </form>
        </div>
    </div>
</div>

<?php include("views/_partial/footer.php") ?>
