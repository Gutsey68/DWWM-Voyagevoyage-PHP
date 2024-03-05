{extends file="views/layout.tpl"}

{block name="js_head"}
	<link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.dataTables.min.css" />
	<link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.0/css/buttons.dataTables.css" />
	<script src="https://code.jquery.com/jquery-3.7.1.js"> </script>
	<script src="https://cdn.datatables.net/2.0.0/js/dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/3.0.0/js/dataTables.buttons.js"></script>

	<script src="https://cdn.datatables.net/buttons/3.0.0/js/buttons.dataTables.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
	<script src="https://cdn.datatables.net/buttons/3.0.0/js/buttons.html5.min.js"></script>
{/block}

{block name="contenu"}
	<div class="container mt-5 mb-5 alert alert-light">
		<table id="list_user">
			<thead>
				<tr>
					<th>id</th>
					<th>img</th>
					<th>pseudo</th>
					<th>rôle</th>
					<th>email</th>
					<th>ban</th>
					<th>actions</th>
				</tr>
			</thead>
			<tbody>
				{foreach $arrUsersToDisplay as $objUser}
					<tr>
						<td class="text-center">{$objUser->getId()}</td>
						<td class="text-center"><img class="img-thumbnail convertTo64" src="uploads/{$objUser->getPp()}"
								alt="{$objUser->getPseudo()}"></td>
						<td>{$objUser->getPseudo()}</td>
						<td>{$objUser->getRole()}</td>
						<td>{$objUser->getEmail()}</td>
						<td class="text-center">
							{if $objUser->getBan()}
								<i class="text-success fa fa-check"></i>
							{else}
								<i class="text-danger fa fa-xmark"></i>
							{/if}
						</td>
						<td class="text-center">
						<div class="row">
							<div class="col-4"><a class="btn btn-secondary" href="{$base_url}user/user?id={$objUser->getId()}"
								alt="Modérer l'utilisateur"><i class="fa fa-check-double"></i></a></div>
							{if $user.user_role == "admin"}
								<div class="col-8">
									<form action="" method="POST">
										<input type="hidden" name="userId" value="{$objUser->getId()}">
										<label for="userRole"></label>
										<select name="userRole" id="userRole">
											<option value="{if ($objUser->getRole() == "admin")}admin{elseif ($objUser->getRole() == "modo")}modo{else}user{/if}">{if ($objUser->getRole() == "admin")}Admin{elseif ($objUser->getRole() == "modo")}Modo{else}User{/if}</option>
											<option value="{if ($objUser->getRole() == "admin")}modo{elseif ($objUser->getRole() == "modo")}admin{else}modo{/if}">{if ($objUser->getRole() == "admin")}Modo{elseif ($objUser->getRole() == "modo")}Admin{else}Modo{/if}</option>
											<option value="{if ($objUser->getRole() == "admin")}user{elseif ($objUser->getRole() == "modo")}user{else}admin{/if}">{if ($objUser->getRole() == "admin")}User{elseif ($objUser->getRole() == "modo")}User{else}Admin{/if}</option>
										</select>
										<button class="btn btn-primary" type="submit">Modifier le rôle</button>
									</form>
								</div>
							{/if}
						</div>
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
			var table = new DataTable('#list_user', {
				layout: {
					topStart: {
						buttons: ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pdfHtml5']
					}
				},
				language: {
					url: '//cdn.datatables.net/plug-ins/2.0.0/i18n/fr-FR.json',
				},
				columns: [{width: '5%'}, {width: '10%'}, {width: '10%'}, {width: '5%'}, {width: '20%'}, {width: '5%'}, {width: '55%'}],
				ordering: false,

			});
		</script>
	{/literal}
{/block}