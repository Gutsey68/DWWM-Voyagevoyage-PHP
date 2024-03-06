{extends file="views/layout.tpl"}

{block name="contenu"}
	{if (count($arrErrors) >0) }
		<div class="alert alert-danger">
			{foreach from=$arrErrors item=strError}
				<p>{$strError}</p>
			{/foreach}
		</div>
	{/if}
	<div class="container mt-3 mb-5">
		<div class="row">
			{* Information profil *}
			<div class="col-4">
				<div class="row">
					<div class="rounded-5 brown-div shadow-lg mt-5 mb-5 p-5">
						{* Photo de profil *}
						<div class="col-12 text-center">
							<div class="position-relative d-inline-block">
								<a data-fslightbox="gallery" href="uploads/{$objUser->getPp()}">
									<img src="uploads/{$objUser->getPp()}" height="250px" width="250px"
										class="img-fluid rounded-circle" alt="{$objUser->getPseudo()}">
								</a>
								{if (isset($smarty.session.user.user_id))}
									{if ($user.user_id == $objUser->getId()) || ($smarty.session.user.user_role == "modo") || ($smarty.session.user.user_role == "admin") }
										<a href="{$base_url}user/edit_pp" title="Modifier ma photo"
											class=" absolut-btn position-absolute top-0 end-0">
											<i class="fa-solid fa-camera"></i>
										</a>
									{/if}
								{/if}
							</div>
						</div>
						{* Informations du compte *}
						<div class="col-12 pt-3 ">
							<h1 class="text-center mb-5 orange">{$objUser->getPseudo()}</h1>
							<p>Bio : {$objUser->getBio()}</p>
							<p>Date de création de compte :{$objUser->getRegisdateFr()}</p>
							<p>Rôle :
								{if ({$objUser->getRole()}=="user")}Utilisateur{elseif ({$objUser->getRole()}=="modo")}Modérateur{elseif ({$objUser->getRole()}=="admin")}Administrateur{/if}
							</p>
							{if ( isset($user.user_id) && $user.user_id != '' )
									&&
									( $user.user_role == 'admin' || $objUser->getId() == $user.user_id || $user.user_role == 'modo') }
							<p>Email : <a href="mailto:{$objUser->getEmail()}">{$objUser->getEmail()}</a></p>
						{/if}
					</div>
					{* Partie modification de profil *}
					{if (isset($smarty.session.user.user_id))}
						{if ($user.user_id == $objUser->getId()) || ($smarty.session.user.user_role == "modo") || ($smarty.session.user.user_role == "admin") }
							<div class="row mt-4">
								<div class="col button-center pb-1 ">
									<a href="{$base_url}user/edit_profile" title="Modifier mon compte" class="orange-btn"><i
											class="pe-2 fa-solid fa-pen-to-square"> </i>Modifier le profil</a>
								</div>
							</div>
						{/if}
					{/if}
				</div>
				{* Partie modération *}
				{if (isset($user.user_role) && (($user.user_role == "admin" && $user.user_id != $objUser->getId()) || ($user.user_role == "modo" && $objUser->getRole() != "modo" && $objUser->getRole() != "admin")) )}
					<div class="rounded-5 brown-div shadow-lg mt-5 mb-5 p-5">
						<div class="row">
							<div class="col-12 text-center mb-5">
								<h3 class="fs-3 orange">Modération</h3>
							</div>
							<form method="post" action="user/user?id={$objUser->getId()}" class="pb-5 row">
								<div class="col-12">
									<div class="mb-1">
										<label class="form-label">Bannir</label>
										<input type="radio" name="moderation" value="1" {if ($objUser->getBan() == 1)}
											checked {/if}>
									</div>
									<div class="mb-3">
										<label class="form-label">Commentaire</label>
										<textarea class="form-control" name="comment">{$objUser->getComment()}</textarea>
									</div>
								</div>
								<div class="col-12 mt-2">
									<input class="orange-btn" type="submit">
								</div>
							</form>
						</div>
					</div>
				{/if}
			</div>
		</div>
		<div class="col-8">
			{* 2 derniers articles ajoutés par le user *}
			<div class="row rounded-5 brown-div shadow-lg mt-5 mb-5 ms-5 p-5">
				{if $arrUtripsToDisplay|@count < 0}
					<h2 class="fs-3 orange">Derniers articles publiés</h2>
					{foreach from=$arrUtripsToDisplay item=objUtrip}
						{include file="views/utrip_summary.tpl"}
					{/foreach}
				{else}
					<p>Vous n'avez pas encore publié d'articles</p>
					<div class="button-left">
						<a class="orange-btn" href="{$base_url}utrip/raconte"><i class="fa-solid fa-feather"></i>Je raconte
							mon
							voyage</a>
					</div>
				{/if}
			</div>
			<!-- 2 derniers topics ajoutés par le user -->
			<div class="row rounded-5 brown-div shadow-lg mt-5 mb-5 p-5 ms-5">
				{if $arrForumsToDisplay|@count  >0}
					<div class="mb-5">
						<h2 class="fs-3 orange">Derniers topics publiés</h2>
					</div>
					{else} 
						<p class="mt-4">Vous n'avez pas encore publié de topics</p>
					<div class="button-left mb-5">
						<a class="orange-btn" href="{$base_url}forum/create_topic"><i class="fa-solid fa-comments"></i> Je
							crée un topic</a>
					</div>
				{/if}
				<div>
					{foreach from=$arrForumsToDisplay item=objForum}
						{include file="views/topic_summary.tpl"}
					{/foreach}
				</div>
			</div>
		</div>
	</div>
</div>
{/block}