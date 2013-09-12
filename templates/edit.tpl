{include file="header.tpl" title="Editar/Novo"}
<div class="contact">
<form method='post' action='?' enctype='multipart/form-data' class='editForm'>
	<input type='hidden' name='id' value='{$id}'>

	<p><label for='name'>Nome</label>
	<span class="wpcf7-form-control-wrap your-name">
	<input id='name' name='name' value='{$name|escape}' />
	</span></p>

	<p><label for='whenAdded'>Data da sugestão (YYYY-MM-DD)</label>
	<span class="wpcf7-form-control-wrap your-name">
	<input id='whenAdded' name='whenAdded' value='{$whenAdded|escape}' />
	</span></p>

	<p><label for='image'>Imagem</label>
	<span class="wpcf7-form-control-wrap your-name">
	<input type='file' id='image' name='image' />
	{if $imgFilename != ''}
		<img src='uploads/{$imgFilename}' />
	{/if}
	</span></p>

	<p><label for='tags'>Categorias</label>
	<span class="wpcf7-form-control-wrap your-name">
	<input id='tags' name='tags' value="{foreach from=$tags item=t}{$t.name|escape}, {/foreach}" />
	</span></p>

	<p><label for='description'>Descrição</label>
	<span class="wpcf7-form-control-wrap your-message">
	<textarea id='description' name='description' rows='10'>{$description|escape}</textarea>
	</span></p>
	
	<p><input class="send" type="submit" value="Enviar" class="wpcf7-submit" /></p>
</form>
</div>
{include file="footer.tpl"}
