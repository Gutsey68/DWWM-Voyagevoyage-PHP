{* Page de Contact *}
{extends file="views/layout.tpl"}
{block name="contenu"}
	<div class="form-container mt-5 mb-5">
		<h1>Formulaire de Contact</h1>
		{if (count($arrErrors) >0) }
			<div class="alert alert-danger form-container mt-3 mb-3">
				{foreach from=$arrErrors item=strError}
					<p>{$strError}</p>
				{/foreach}
			</div>
		{/if}
		<form class="mt-3" action="" method="post">
			<div class="form-group mb-3">
				<label for="name">Nom <span class="text-danger">*</span></label>
				<input type="text" class="form-control" id="name" name="name" placeholder="Entrez votre nom">
			</div>
			<div class="form-group mb-3">
				<label for="mail">Email <span class="text-danger">*</span></label>
				<input type="email" class="form-control" id="mail" name="mail" placeholder="Entrez votre email">
			</div>
			<div class="form-group mb-3">
				<label for="title">Objet <span class="text-danger">*</span></label>
				<input type="text" class="form-control" id="title" name="title" placeholder="Objet de votre message">
			</div>
			<div class="form-group mb-4">
				<label for="content">Message <span class="text-danger">*</span></label>
				<textarea class="form-control" id="content" rows="5" name="content" placeholder="Votre message"></textarea>
			</div>
			<button type="submit" class="btn green-btn">Envoyer</button>
		</form>
	</div>
{/block}