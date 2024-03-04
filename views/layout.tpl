{* La view qui appelle header/footer/scripts etc...  *}

{include file="views/_partial/header.tpl"}

{block name="js_footer" append}
	<script src="assets/script/bootstrap.bundle.js"></script>
	<script src="assets/script/dnd.js"></script>

{/block}

{block name="contenu"}
	<p>Hello</p>
{/block}

{include file="views/_partial/footer.tpl"}