{extends file="views/layout.tpl"}

{block name="contenu"}

	{if (count($arrErrors) >0) }
		<div class="alert alert-danger">
		{foreach from=$arrErrors item=strError}
			<p>{$strError}</p>
		{/foreach}
		</div>
	{/if}
	<div class="container mt-3">
		<div class="row">
			{* Information profil *}
			<div class="col-4">
				<div class="row">
					<div class="border m-3 p-3">
						{* Photo de profil *}
						<div class="col-12 text-center">
							<div class="position-relative d-inline-block">
							<a data-fslightbox="gallery" href="uploads/{$objUser->getPp()}">
								<img src="uploads/{$objUser->getPp()}" height="250px" width="250px" class="img-fluid rounded-circle" alt="{$objUser->getPseudo()}">
							</a>
							<a href="{$base_url}user/edit_pp" title="Modifier ma photo" class="btn btn-primary position-absolute top-0 end-0">
								<i class="fa-solid fa-camera"></i>
							</a>
							</div>
						</div>
						{* Informations du compte *}
						<div class="col-12 pt-3">
							<h1 class="text-center">{$objUser->getPseudo()}</h1>
							<p><strong>Bio:</strong> {$objUser->getBio()}</p>
							<p><strong>Date de création de compte:</strong> {$objUser->getRegisdateFr()}</p>
							<p><strong>Rôle:</strong> {if ({$objUser->getRole()}=="user")}Utilisateur{elseif ({$objUser->getRole()}=="modo")}Modérateur{elseif ({$objUser->getRole()}=="admin")}Administrateur{/if} </p>
							{if ( isset($user.user_id) && $user.user_id != '' )
								&&
								( $user.user_role == 'admin' || $objUser->getId() == $user.user_id || $user.user_role == 'modo') }
									<p><strong>Email:</strong> <a href="mailto:{$objUser->getEmail()}">{$objUser->getEmail()}</a></p>
							{/if}
						</div>
						{* Partie modification de profil *}
						{if (isset($smarty.session.user.user_id))}
							{if ($user.user_id == $objUser->getId()) || ($smarty.session.user.user_role == "modo") || ($smarty.session.user.user_role == "admin") }
								<div class="row">
									<div class="col-6 button-center pb-1 ">
										<a href="{$base_url}user/edit_profile" title="Modifier mon compte" class="btn btn-primary">Modifier le profil</a>
									</div>
									<div class="col-6 button-center pb-1 ">
										<a href="{$base_url}user/edit_profile" title="Modifier mon compte" class="btn btn-primary">Modifier les informations personnelles</a>
									</div>
								</div>
							{/if}
						{/if}
					</div>
					{* Partie modération *}
					{if (isset($user.user_role) && ($user.user_role == "modo" || $user.user_role == "admin") ) }
						<div class="container border m-3 p-3">
							<div class="col-12">
							<div class="col-12 text-center"><h3>Modération</h3></div>
								<form method="post" action="user/user?id={$objUser->getId()}"  class="pb-5 row">
									<div class="col-8">
									<div class="col-12">										
										<label class="form-label">Bannir</label>
										<input type="radio" name="moderation" value="1" {if ($objUser->getBan() == 1) } checked {/if} >
									</div>
										<label class="form-label">Commentaire</label>
										<textarea name="comment">{$objUser->getComment()}</textarea>
									</div>
									<div class="col-4 mt-5">
										<div class="col-4"><input class="btn btn-primary" type="submit"></div>
									</div>
								</form>
							</div>
						</div>
					{/if}
				</div>
			</div>
			<div class="col-8">
				{* 2 derniers articles ajoutés par le user *}
				<div class="row border m-3 p-3" >
					<h2>Derniers articles publiés</h2>
					{foreach from=$arrUtripsToDisplay item=objUtrip}
						{include file="views/utrip_summary.tpl"}
					{/foreach}
				</div>
				<!-- 2 derniers topics ajoutés par le user -->
				<div class="row border m-3 p-3">
					<h2>Derniers topics publiés</h2>
					{foreach from=$arrForumsToDisplay item=objForum}
						{include file="views/topic_summary.tpl"}
					{/foreach}
				</div>
			</div>
		</div>
	</div>
{/block}