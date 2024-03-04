{extends file="views/layout.tpl"}

{block name="contenu"}
    {if (count($arrErrors) >0) }
        <div class="alert alert-danger form-container mt-5 mb-3">
            {foreach from=$arrErrors item=strError}
                <p>{$strError}</p>
            {/foreach}
        </div>
    {/if}
    <form class="mt-5 mb-5" action="user/edit_profile" method="post">
        <div class="form-container mt-3 row">
            <fieldset class="col-12">
                <legend class="green-title">Modification du profil</legend>
                <div class="form-group mt-3">
                    <label for="pseudo">Pseudo</label>
                    <input type="text" class="form-control" name="pseudo" id="pseudo" value="{$objUser->getPseudo()}">
                </div>
                <div class="form-group mt-3">
                    <label for="bio">Bio</label>
                    <textarea class="form-control" rows="3" name="bio" id="bio" value="{$objUser->getBio()}"></textarea>
                </div>
            </fieldset>
            <fieldset class="col-6">
                <legend class="green-title">Informations personnelles</legend>
                <div class="form-group mt-3">
                    <label for="name">Nom</label>
                    <input type="text" class="form-control" name="name" id="name" value="{$objUser->getName()}">
                </div>
                <div class="form-group mt-3">
                    <label for="firstname">Prénom</label>
                    <input type="text" class="form-control" name="firstname" id="firstname" value="{$objUser->getFirstname()}">
                </div>
                <div class="form-group mt-3">
                    <label for="mail">Email</label>
                    <input type="email" class="form-control" name="mail" id="mail" value="{$objUser->getEmail()}">
                </div>
            </fieldset>

            <fieldset class="col-6">
                <legend class="green-title">Informations de connexion</legend>
                <div class="form-group mt-3">
                    <label for="password_old">Mot de passe actuel</label>
                    <input type="password" class="form-control" name="oldpwd" id="password_old">
                </div>
                <div class="form-group mt-3">
                    <label for="password">Nouveau mot de passe</label>
                    <input type="password" class="form-control" name="password" id="password">
                </div>
                <div class="form-group mt-3">
                    <label for="passwd_confirm">Confirmation du mot de passe</label>
                    <input type="password" class="form-control" name="passwd_confirm" id="passwd_confirm">
                </div>
            </fieldset>
            <div class="text-center mt-4">
                <input type="submit" value="Enregistrer les modifications" class="btn green-btn">
            </div>
            <div class="pt-5">
                <p>Pour supprimer vos données personnelles veuillez remplir un formulaire de contact et nous les effacerons dans les plus brefs délais.</p>
            </div>
        </div>
    </form>
{/block}