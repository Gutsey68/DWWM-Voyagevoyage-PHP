{* La view d'un résumé d'un article *}

<div class="col-md-3 resume-utrip">
	<div>
		<img class="resume-img" src="assets/images/{$objUtrip->getImg()}" alt="{$objUtrip->getName()}">
	</div>
	<p class="margin0">Le voyage de {$objUtrip->getCreator()}</p>
	<p>à <span class="fst-italic">{$objUtrip->getCity()}</span></p>
</div>