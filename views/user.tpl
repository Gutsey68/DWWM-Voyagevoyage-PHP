{extends file="views/layout.tpl"}

{block name="contenu"}

	{if (count($arrErrors) >0) }
		<div class="alert alert-danger">
		{foreach from=$arrErrors item=strError}
			<p>{$strError}</p>
		{/foreach}
		</div>
	{/if}	
	{*assigner des variables en direct*}
	{assign var="modo" value=(isset($user.user_role) 
			&& ($user.user_role == "modo" || $user.user_role == "admin") )}


		<div class="container mt-5">
			<div class="row">
				<div class="col-md-4">
					<!-- Section Photo de Profil -->
					<img src="uploads/{$objUser->getPp()}" class="img-fluid rounded-circle" alt="{$objUser->getPseudo()}">
				</div>
				<div class="col-md-8">
					<h1>{$objUser->getPseudo()}</h1>
					<p><strong>Bio:</strong> {$objUser->getBio()}</p>
					<p><strong>Nom:</strong> {$objUser->getName()}</p>
					<p><strong>Prénom:</strong> {$objUser->getFirstname()}</p>
					<p><strong>Email:</strong> {$objUser->getEmail()}</p>
					<p><strong>Date de Création:</strong> {$objUser->getRegisdateFr()}</p>
				</div>
			</div>
		</div>

		{if (isset($smarty.session.user.user_id))}
			{if ($user.user_id == $objUser->getId())}
				<div class="container">
					<div class="col-12 button-center pb-5">
						<a href="{$base_url}user/edit_pp" title="Modifier ma photo" class="green-btn"> Modifier ma photo de profil </a>
					</div>
					<div class="col-12 button-center pb-5">
						<a href="{$base_url}user/edit_profile" title="Modifier mon compte" class="green-btn">Modifier mon profil / Modifier mes informations personnelles</a>
					</div>
					{* <div class="col-12 button-center pb-5">
						<button type="submit" title="Modifier mon compte" class="orange-btn" name="delete">Supprimer mes informations personnelles</button>
					</div> *}
				</div>
			{/if}
		{/if}


		{if ($modo) }
		<div class="col-6">
			<h2>Modération</h2>
			<form method="post" action="user/user?id={$objUser->getId()}">
				<p>
					<label>Bannir</label>
					<input type="radio" name="moderation" value="1" {if ($objUser->getBan() == 1) } checked {/if} >
				</p>
				<p>
					<label>Commentaire</label>
					<textarea name="comment">{$objUser->getComment()}</textarea>
				</p>
				<input type="submit" >
			</form>
		</div>
		{/if}
{/block}