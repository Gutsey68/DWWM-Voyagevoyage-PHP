{* La view d'un résumé d'un article *}

<div class="row col-md-{if ($strPage == "user")}6{else}3{/if} resume-utrip">
	<div>
		<a href="{$base_url}utrip/utrip?id={$objUtrip->getId()}"><img class="resume-img" src="uploads/{$objUtrip->getImg()}" alt="{$objUtrip->getName()}"></a>
	</div>
	<div class="col-8">
		<p class="margin0">Le voyage de <a href="{$base_url}user/user?id={$objUtrip->getCreatorId()}">{$objUtrip->getCreator()}</a></p>
		<p>à <span class="fst-italic">{$objUtrip->getCity()}</span></p>
	</div>
	<div class="col-4">
		<p>{$objUtrip->getLike()}<i class="ps-1 fa-solid fa-heart"> </i></p>
	</div>
	{if ( isset($user.user_id) && $user.user_id != '' ) 
		&& 
		( $user.user_role == 'admin' || $objUtrip->getCreatorId() == $user.user_id || $user.user_role == 'modo') }
		<a href="{$base_url}utrip/edit_utrip?id={$objUtrip->getId()}" alt="Modifier l'article">Modifier l'article</a>
	{/if}
</div>