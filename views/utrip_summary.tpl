{* La view d'un résumé d'un article *}

<div class="col-md-3 resume-utrip">
	<div>
		<a href="utrip/utrip?id={$objUtrip->getId()}"><img class="resume-img" src="uploads/{$objUtrip->getImg()}" alt="{$objUtrip->getName()}"></a>
	</div>
	<p class="margin0">Le voyage de {$objUtrip->getCreator()}</p>
	<p>à <span class="fst-italic">{$objUtrip->getCity()}</span></p>
	{if ( isset($user.user_id) && $user.user_id != '' ) 
		&& 
		( $user.user_role == 'admin' || $objUtrip->getCreator() == $user.user_id ) }
		<a href="{$base_url}utrip/raconte?id={$objUtrip->getId()}" alt="Modifier l'article">Modifier l'article</a>
	{/if}
</div>