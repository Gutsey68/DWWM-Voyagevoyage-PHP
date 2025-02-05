{* Page de connexion /  de création de compte *}

{extends file="views/layout.tpl"}

{block name="contenu"}
    <div class="form-container mb-5">
        <h1 class="mt-5 mb-3 green-title">Se connecter</h1>
        {if (count($arrErrors) >0) }
            <div class="alert alert-danger form-container mt-3 mb-3">
                {foreach from=$arrErrors item=strError}
                    <p>{$strError}</p>
                {/foreach}
            </div>
        {/if}
        <form action="{$base_url}user/login" method="post">
            <div class="mb-3">
                <label class="form-label" for="email">E-mail <span class="text-danger">*</span></label>
                <input class="form-control" id="email" type="email" name="email" value="{$email}">
            </div>
            <div class="mb-4">
                <label class="form-label" for="password">Password <span class="text-danger">*</span></label>
                <input class="form-control" id="password" type="password" name="password">
            </div>
            <input class="fw-bold btn green-btn" type="submit" value="Se connecter">
        </form>
        <div class=" mt-3 mb-3 form-container blue-link"><a href="user/create_account">
        Vous ne possédez pas de compte ? Enregistrez-vous dès à présent.</a></div>
        <a class=" blue-link" href="{$base_url}user/forgetPwd">Mot de passe oublié</a>
    </div>

{/block}