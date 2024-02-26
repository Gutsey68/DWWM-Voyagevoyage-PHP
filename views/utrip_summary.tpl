{* La view d'un résumé d'un article *}

<div class="col-md-3 resume-utrip">
	<div>
		<a href="utrip/utrip?id={$objUtrip->getId()}"><img class="resume-img" src="uploads/{$objUtrip->getImg()}" alt="{$objUtrip->getName()}"></a>
	</div>
	<p class="margin0">Le voyage de {$objUtrip->getCreator()}</p>
	<p>à <span class="fst-italic">{$objUtrip->getCity()}</span></p>
</div>