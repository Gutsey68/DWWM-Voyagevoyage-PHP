{extends file="views/layout.tpl"}

{block name="contenu"}

    {if (count($arrErrors) >0) }
        <div class="alert alert-danger">
            {foreach from=$arrErrors item=strError}
                <p>{$strError}</p>
            {/foreach}
        </div>
    {/if}

    <form action="" method="post">
        <div class="container mt-3">
            <div class="text-center mb-3">
                <a href="user/login" class="btn btn-link">Déjà un compte ? Connectez-vous !</a>
            </div>

            <div class="form-group">
                <label for="name">Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="name" id="name" value="{$objUser->getName()}">
            </div>

            <div class="form-group">
                <label for="firstname">Firstname <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="firstname" id="firstname" value="{$objUser->getFirstname()}">
            </div>

            <div class="form-group">
                <label for="pseudo">Pseudo <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="pseudo" id="pseudo" value="{$objUser->getPseudo()}">
            </div>

            <div class="form-group">
                <label for="email">Email <span class="text-danger">*</span></label>
                <input type="email" class="form-control" name="email" id="email" value="{$objUser->getEmail()}">
            </div>

            <div class="form-group">
                <label for="password">Password <span class="text-danger">*</span></label>
                <input type="password" class="form-control" name="password" id="password">
            </div>

            <div class="form-group">
                <label for="passwd_confirm">Confirm Password <span class="text-danger">*</span></label>
                <input type="password" class="form-control" name="passwd_confirm" id="passwd_confirm">
            </div>

            <div class="text-center">
                <input type="submit" value="S'enregistrer" class="btn green-btn">
            </div>
        </div>
    </form>

{/block}