{extends file="views/layout.tpl"}

{block name="js_head" append}
	<script src="assets/js/period.js"></script>
{/block}

{block name="js_footer" append}
<script>
	changePeriod();
</script>	
{/block}

{block name="contenu"}
<div class="row mb-2">
	<form name="formSearch" method="post" action="#">
		<fieldset>
			<legend>Rechercher des articles</legend>
			<p><label for="keywords">Mots clés</label>
				<input id="keywords" type="text" name="keywords" value="{$strKeywords}" />
			</p>
			<p>	<input type="radio" name="period" checked value="0" onclick="changePeriod()" /> Par date exacte
				<input type="radio" name="period" value="1" onclick="changePeriod()" /> Par période
			</p>
			<p id="uniquedate">
				<label for="date">Date</label>
				<input id="date" type="date" name="date" />
			</p>
			<p id="period">
				<label for="startdate">Date de début</label>
				<input id="startdate" type="date" name="startdate" />
				<label for="enddate">Date de fin</label>
				<input id="enddate" type="date" name="enddate" />
			</p>
			<p>
				<label for="author">Auteur</label>
				<select id="author">
					<option>christel</option>
					<option>test</option>
				</select>
			</p>
			<p><input type="submit" value="Rechercher" /> <input type="reset" value="Réinitialiser" /></p>
		</fieldset>
	</form>
			
	{foreach from=$arrArticlesToDisplay item=objArticle}
		{include file="views/article.tpl"}
	{foreachelse}
		<p>Pas de résultat</p>
	{/foreach} 
			</div>
{/block}			
