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
        <div class="phppot-container">
            <a href="user/login">Déja un compte ? Connectez-vous !</a>
        </div>
        <div class="">


            <div class="inline-block">
                <div class="form-label">
                    Name<span class="required error" id="username-info"></span>
                </div>
                <input class="input-box-330" type="text" name="name" id="name" value="{$objUser->getName()}">
            </div>

            <div class="inline-block">
                <div class="form-label">
                    Firstname<span class="required error" id="username-info"></span>
                </div>
                <input class="input-box-330" type="text" name="firstname" id="firstname" value="{$objUser->getFirstname()}">
            </div>


            <div class="inline-block">
                <div class="form-label">
                    Pseudo<span class="required error" id="username-info"></span>
                </div>
                <input class="input-box-330" type="text" name="pseudo" id="pseudo" value="{$objUser->getPseudo()}">
            </div>

            <div class="inline-block">
                <div class="form-label">
                    Email<span class="required error" id="email-info"></span>
                </div>
                <input class="input-box-330" type="email" name="email" id="email" value="{$objUser->getEmail()}">
            </div>


            <div class="inline-block">
                <div class="form-label">
                    Password<span class="required error" id="signup-password-info"></span>
                </div>
                <input class="input-box-330" type="password" name="password" id="password">
            </div>


            <div class="inline-block">
                <div class="form-label">
                    Confirm Password<span class="required error" id="confirm-password-info"></span>
                </div>
                <input class="input-box-330" type="password" name="passwd_confirm" id="passwd_confirm">
            </div>

            <p>
                <input type="submit" value="S'enregistrer">
            </p>
    </form>
    </div>
    </div>
    </div>


    </form>
{/block}