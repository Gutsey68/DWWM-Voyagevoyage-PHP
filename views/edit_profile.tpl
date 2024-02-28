{extends file="views/layout.tpl"}

{block name="contenu"}
    {if (count($arrErrors) >0) }
        <div class="alert alert-danger">
            {foreach from=$arrErrors item=strError}
                <p>{$strError}</p>
            {/foreach}
        </div>
    {/if}

    <form action="user/edit_profile" method="post">
        <div class="container mt-3">
            <fieldset>
                <legend>Informations personnelles</legend>
                <div class="form-group">
                    <label for="name">Nom</label>
                    <input type="text" class="form-control" name="name" id="name" value="{$objUser->getName()}">
                </div>
                <div class="form-group">
                    <label for="firstname">Prénom</label>
                    <input type="text" class="form-control" name="firstname" id="firstname" value="{$objUser->getFirstname()}">
                </div>
                <div class="form-group">
                    <label for="mail">Email</label>
                    <input type="email" class="form-control" name="mail" id="mail" value="{$objUser->getEmail()}">
                </div>
            </fieldset>

            <fieldset>
                <legend>Informations de connexion</legend>
                <div class="form-group">
                    <label for="password_old">Mot de passe actuel</label>
                    <input type="password" class="form-control" name="oldpwd" id="password_old">
                </div>
                <div class="form-group">
                    <label for="password">Nouveau mot de passe</label>
                    <input type="password" class="form-control" name="password" id="password">
                </div>
                <div class="form-group">
                    <label for="passwd_confirm">Confirmation du mot de passe</label>
                    <input type="password" class="form-control" name="passwd_confirm" id="passwd_confirm">
                </div>
            </fieldset>

            <div class="text-center">
                <input type="submit" value="Enregistrer les modifications" class="btn green-btn">
            </div>
        </div>
    </form>

{/block}