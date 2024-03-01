{* La view d'un message d'erreur 403 *}

{extends file="views/layout.tpl"}

{block name="contenu"}
    <section>
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h1 class="p-5">Vous n'êtes pas autorisé à accéder à ce contenu !</h1>
                    <div class="button-center">
                    <a class="green-btn" href=""><i class="fa-solid fa-house"></i>Revenir à l'accueil</a>
                    </div>
                </div>
                </div>
                <div class="text-center">
                    <img src="assets/images/403.png">
                </div>
            </div>
        </div>
    </section>
{/block}