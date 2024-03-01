{extends file="views/layout.tpl"}

{block name="contenu"}
	<div class="row g-5">
		<div class="col-md-12">
			<ul>
				<li class="nav-item ">
					<a class="nav-link flex-fill" href="{$base_url}utrip/manage" alt="Gérer les articles" >Gérer les articles</a>
				</li>
				<li class="nav-item ">
					<a class="nav-link flex-fill" href="{$base_url}forum/manage" alt="Gérer les topics" >Gérer les topics</a>
				</li>
				<li class="nav-item ">
					<a class="nav-link flex-fill" href="{$base_url}user/manage" alt="Gérer les utilisateurs" >Gérer les utilisateurs</a>
				</li>
			</ul>
		</div>
	</div>
{/block}