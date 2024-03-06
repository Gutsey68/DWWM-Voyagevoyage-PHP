{extends file="views/layout.tpl"}

{block name="contenu"}
	<div class="text-center mt-5 mb-5">
		<img height="500" width="500" src="assets/images/50426.jpg" alt="" class="img-fluid rounded-5">
	</div>
	<div class="row g-5">
		<div class="col-md-4 col-12 p-5 button-center">
			<a class="green-btn" href="{$base_url}utrip/manage" alt="Gérer les articles" >Gérer les articles</a>
		</div>
		<div class="col-md-4 col-12 p-5 button-center">
			<a class="green-btn" href="{$base_url}forum/manage" alt="Gérer les topics" >Gérer les topics</a>
		</div>
		<div class="col-md-4 col-12 p-5 button-center">
			<a class="green-btn" href="{$base_url}user/manage" alt="Gérer les utilisateurs" >Gérer les utilisateurs</a>
		</div>
	</div>
{/block}