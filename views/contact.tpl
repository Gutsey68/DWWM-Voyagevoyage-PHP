{* Page de Contact *}

{extends file="views/layout.tpl"}

{block name="contenu"}

	{if (count($arrErrors) >0) }
        <div class="alert alert-danger">
            {foreach from=$arrErrors item=strError}
                <p>{$strError}</p>
            {/foreach}
        </div>
    {/if}
	
	<div class="container mt-5 mb-5">
	<h2>Formulaire de Contact</h2>
	<form action="" method="post">
		<div class="form-group mb-3">
			<label for="name">Nom</label>
			<input type="text" class="form-control" id="name" name="name" placeholder="Entrez votre nom"> 
		</div>
		<div class="form-group mb-3">
			<label for="mail">Email</label>
			<input type="email" class="form-control" id="mail" name="mail" placeholder="Entrez votre email">
		</div>
		<div class="form-group mb-3">
			<label for="title">Object</label>
			<input type="text" class="form-control" id="title" name="title" placeholder="Object de votre message">
		</div>
		<div class="form-group mb-3">
			<label for="content">Message</label>
			<textarea class="form-control" id="content" rows="5" name="content" placeholder="Votre message ici"></textarea>
		</div>
		<button type="submit" class="btn green-btn" name="envoyer">Envoyer</button>
	</form>
</div>
{/block}