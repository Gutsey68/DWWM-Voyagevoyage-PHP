{* La view d'un message d'erreur 404 *}

{extends file="views/layout.tpl"}

{block name="contenu"}
    <section>
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h1 class="p-5">Oups... Cette page n'a pas été trouvé</h1>
                    <div class="button-center">
                    <a class="green-btn" href=""><i class="fa-solid fa-house"></i>Revenir à l'accueil</a>
                    </div>
                </div>
                </div>
                <div class="text-center  show404img">
                    <img src="assets/images/404.png">
                </div>
            </div>
        </div>
    </section>
{/block}