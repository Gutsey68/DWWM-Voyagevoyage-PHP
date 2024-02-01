{* La view de la page entière Explorez avec tous les articles *}

{extends file="views/layout.tpl"}

{block name="contenu"}
    <section id="recit">
        <div class="container">
            <div class="row text-center">
                <div class="col-12">
                    <h1 class="pb-2">Explorez des récits <span class="fst-italic">inoubliables</span></h1>
                    <p class="pb-2">
                        Découvrez des aventures uniques racontées par des voyageurs passionnés. Laissez-vous inspirer par
                        leurs expériences et partagez les vôtres.
                    </p>
                    <div class="button-center">
                        <a class="green-btn" href="index.php?action=raconte&ctrl=utrip"><i class="fa-solid fa-feather"></i>
                            Je raconte la mienne</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
{/block}