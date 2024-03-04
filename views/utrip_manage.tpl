{extends file="views/layout.tpl"}

{block name="js_head"}
	<link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.dataTables.min.css" />
	<link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.0/css/buttons.dataTables.css" />
	<script src="https://code.jquery.com/jquery-3.7.1.js"> </script>
	<script src="https://cdn.datatables.net/2.0.0/js/dataTables.min.js" ></script>
	<script src="https://cdn.datatables.net/buttons/3.0.0/js/dataTables.buttons.js"></script>
	
	<script src="https://cdn.datatables.net/buttons/3.0.0/js/buttons.dataTables.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
	<script src="https://cdn.datatables.net/buttons/3.0.0/js/buttons.html5.min.js"></script>
{/block}

{block name="contenu"}
	<div class="container mt-5 mb-5 alert alert-light">
		<table id="list_article">
			<thead>
				<tr>
					<th>id</th>
					<th>img</th>
					<th>titre</th>
					<th>contenu</th>
					<th>validé</th>
					<th>actions</th>
				</tr>
			</thead>
			<tbody>
				{foreach $arrUtripsToDisplay as $objUtrip}
				<tr>
					<td class="text-center">{$objUtrip->getId()}</td>
					<td class="text-center"><img class="img-thumbnail convertTo64" src="uploads/{$objUtrip->getImg()}" alt="{$objUtrip->getName()}" ></td>
					<td>{$objUtrip->getName()}</td>
					<td>{$objUtrip->getDescriptionSummary(80)}</td>
					<td class="text-center">
						{if $objUtrip->getValid()}
						<i class="text-success fa fa-check"></i>
						{else}
						<i class="text-danger fa fa-xmark"></i>
						{/if}
					</td>
					<td class="text-center">
						<a class="btn btn-primary" href="{$base_url}utrip/edit_utrip?id={$objUtrip->getId()}" alt="Modifier l'article"><i class="fa fa-edit"></i></a>
						{if (isset($smarty.session.user.user_id) && ($smarty.session.user.user_role == "modo") || ($smarty.session.user.user_role == "admin"))}
						<a class="btn btn-secondary" href="{$base_url}utrip/utrip?id={$objUtrip->getId()}" alt="Modérer l'article"><i class="fa fa-check-double"></i></a>
						{/if}
						<a class="btn btn-danger" href="{$base_url}utrip/delete?id={$objUtrip->getId()}" onclick="return confirmDelete()" alt="Supprimer l'article"><i class="fa fa-trash"></i></a>
					</td>
				</tr>
				{/foreach}
			</tbody>
		</table>
	</div>
{/block}

{block name="js_footer"}
	{literal}
		<script>
		var table = new DataTable('#list_article', {
			layout: {
				topStart: {
					buttons: ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdfHtml5']
				}
			},
			language: {
				url: '//cdn.datatables.net/plug-ins/2.0.0/i18n/fr-FR.json',
			},
			columns: [{width: '5%'}, {width: '10%'}, {width: '30%'}, {width: '30%'}, {width: '5%'}, {width: '20%'}],
			ordering:  false,
			
		});
		</script>
	{/literal}
{/block}