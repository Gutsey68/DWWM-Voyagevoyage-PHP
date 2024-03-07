{extends file="views/layout.tpl"}
{block name="contenu"}
    <div class="form-container">
        <h1 class="mt-5 green-title">Créer un compte</h1>
    </div>
    {if (count($arrErrors) >0) }
        <div class="alert alert-danger form-container mt-3 mb-3">
            {foreach from=$arrErrors item=strError}
                <p>{$strError}</p>
            {/foreach}
        </div>
    {/if}
    <form class="form-container mt-4 mb-4" action="" method="post">
        <div class="">
            <div class="form-group mb-3">
                <label for="firstname">Prénom <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="firstname" id="firstname" value="">
            </div>
            <div class="form-group mb-3">
                <label for="name">Nom <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="name" id="name" value="">
            </div>
            <div class="form-group mb-3">
                <label for="pseudo">Pseudo <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="pseudo" id="pseudo" value="">
            </div>
            <div class="form-group mb-3">
                <label for="email">Email <span class="text-danger">*</span></label>
                <input type="email" class="form-control" name="email" id="email" value="">
            </div>
            <div class="form-group mb-3">
                <label for="password">Mot de passe <span class="text-danger">*</span></label>
                <input type="password" class="form-control" name="password" id="password">
            </div>
            <div class="form-group">
                <label for="passwd_confirm">Confirmer le mot de passe <span class="text-danger">*</span></label>
                <input type="password" class="form-control" name="passwd_confirm" id="passwd_confirm">
            </div>
            <div class="text-center mt-4">
                <input type="submit" value="S'enregistrer" class="btn green-btn">
            </div>
        </div>
    </form>
    <div class="form-container mb-5">
        <a href="{$base_url}user/login" class="fw-bold mt-3 mb-3 form-container lead">Déjà inscrit ? Connectez-vous !</a>
    </div>
{/block}