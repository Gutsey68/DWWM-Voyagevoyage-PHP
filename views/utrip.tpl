{* La view d'un résumé d'un article *}

<article>
	<div class="container">
		<div class="row">
			<div class="col-md-3">
				<img src="assets/images/{$objUtrip->getImg()}" alt="{$objUtrip->getName()}">
				<p class="margin0">Le voyage de {$objUtrip->getCreator()}</p>
				<p>à <span class="fst-italic">{$objUtrip->getCity()}</span></p>
			</div>
		</div>
	</div>
</article>