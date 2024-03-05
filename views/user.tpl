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
					<a data-fslightbox="gallery" href="uploads/{$objUser->getPp()}"><img src="uploads/{$objUser->getPp()}" class="img-fluid rounded-circle" alt="{$objUser->getPseudo()}"></a>
				</div>
				<div class="col-md-8">
					<h1>{$objUser->getPseudo()}</h1>
					<p><strong>Bio:</strong> {$objUser->getBio()}</p>
					<p><strong>Date de création de compte:</strong> {$objUser->getRegisdateFr()}</p>
					<p><strong>Rôle:</strong> {if ({$objUser->getRole()}=="user")}Utilisateur{elseif ({$objUser->getRole()}=="modo")}Modérateur{elseif ({$objUser->getRole()}=="admin")}Administrateur{/if} </p>
					{if ( isset($user.user_id) && $user.user_id != '' ) 
						&& 
						( $user.user_role == 'admin' || $objUser->getId() == $user.user_id || $user.user_role == 'modo') }
							<p><strong>Email:</strong> {$objUser->getEmail()}</p>
					{/if}
				</div>
			</div>
		</div>

		{if (isset($smarty.session.user.user_id))}
			{if ($user.user_id == $objUser->getId()) || ($smarty.session.user.user_role == "modo") || ($smarty.session.user.user_role == "admin") }
				<div class="container">
					<div class="col-12 button-center pb-5">
						<a href="{$base_url}user/edit_pp" title="Modifier ma photo" class="green-btn"> Modifier ma photo de profil </a>
					</div>
					<div class="col-12 button-center pb-5">
						<a href="{$base_url}user/edit_profile" title="Modifier mon compte" class="green-btn">Modifier le profil / Modifier les informations personnelles</a>
					</div>
					<div class="col-12 button-center pb-5">
						<button type="submit" title="Supprimer mon compte" onclick="return confirmDelete()" class="orange-btn" name="delete">Supprimer les informations personnelles</button>
					</div>
				</div>
			{/if}
		{/if}
		{if ($modo) }
		<div class="container">
			<div class="col-6">
				<h2>Modération</h2>
				<form method="post" action="user/user?id={$objUser->getId()}"  class="pb-5">
					<p>
						<label>Bannir</label>
						<input type="radio" name="moderation" value="1" {if ($objUser->getBan() == 1) } checked {/if} >
					</p>
					<p>
						<label>Commentaire</label>
						<textarea name="comment">{$objUser->getComment()}</textarea>
					</p>
					<input type="submit">
				</form>
			</div>
		</div>
		{/if}
{/block}