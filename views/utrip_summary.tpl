{* La view d'un résumé d'un article *}

<div class="row col-md-{if ($strPage == "user")}6{else}3{/if} resume-utrip">
	<div class="position-relative">
		<a href="{$base_url}utrip/utrip?id={$objUtrip->getId()}">
			<img class="resume-img img-fluid" src="uploads/{$objUtrip->getImg()}" alt="{$objUtrip->getName()}">
		</a>
		<div class="edit position-absolute top-0 end-0">{if (isset($user.user_id) && $user.user_id != '' && ($user.user_role == 'admin' || $objUtrip->getCreatorId() == $user.user_id || $user.user_role == 'modo'))}
			<a class="mt-2 " href="{$base_url}utrip/edit_utrip?id={$objUtrip->getId()}" alt="Modifier l'article">
				<i class="  pe-2 fa-solid fa-pen-to-square"> </i>
			</a>
		{/if}</div>
	</div>
	<div class="col-8">
		<p class="margin0">Le voyage de <a
				href="{$base_url}user/user?id={$objUtrip->getCreatorId()}">{$objUtrip->getCreator()}</a></p>
		<p>à <span class="fst-italic">{$objUtrip->getCity()}</span></p>
	</div>

	<div class="col-4 text-end pt-1">
		<div class="col-6"><p>{$objUtrip->getLike()}<i class="ps-1 fa-solid fa-heart"> </i></p></div>
	</div>

</div>