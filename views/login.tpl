{* Page de connexion /  de création de compte *}

{extends file="views/layout.tpl"}

{block name="contenu"}

    {if (count($arrErrors) >0) }
        <div class="alert alert-danger">
            {foreach from=$arrErrors item=strError}
                <p>{$strError}</p>
            {/foreach}
        </div>
    {/if}

    <div class="container mb-5">
        <h1 class="mt-5 mb-3">Se connecter</h1>
        <div class="phppot-container">
        <a href="user/create_account">Pas de compte ? Inscrivez vous !</a>
    </div>



        <form action="" method="post">
            <div class="mb-3">
                <label class="form-label" for="email">E-mail <span class="text-danger">*</span></label>
                <input class="form-control" id="email" type="email" name="email" value="{$email}">
            </div>
            <div class="mb-3">
                <label class="form-label" for="password">Password <span class="text-danger">*</span></label>
                <input class="form-control" id="password" type="password" name="password">
            </div>
            <input class="btn green-btn" type="submit" value="Se connecter">
        </form>
    </div>

{/block}