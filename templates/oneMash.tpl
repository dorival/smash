<div class="direita">
	<p class="ringueTitulo">{$c1.name}</p>
	<div class="produto candidate" mashmyvote='{$c1.vote}'><span></span><img src='uploads/{$c1.imgFilename}' width='300' height='300' /></div>
	<ul>
	<li><span>Categorias:</span></li>
	{foreach from=$c1.tags item=t}
	<li> <a href='index.php?tag={$t.lcName}'>{$t.name}</a></li>
	{/foreach}
	</ul>
	<p class="ringueDescricao">{$c1.description|nl2br}</p>
	<a href='item.php?id={$c1.id}'>Página da sugestão</a>
</div>

<p class="versus"> VS</p>

<div class="esquerda">
	<p class="ringueTitulo">{$c2.name}</p>
	<div class="produto candidate" mashmyvote='{$c2.vote}'><span></span><img src='uploads/{$c2.imgFilename}' width='300' height='300' /></div>
	<ul>
	<li><span>Categorias:</span></li>
	{foreach from=$c2.tags item=t}
	<li> <a href='index.php?tag={$t.lcName}'>{$t.name}</a></li>
	{/foreach}
	</ul>
	<p class="ringueDescricao">{$c2.description|nl2br}</p>
	<a href='item.php?id={$c2.id}'>Página da sugestão</a>
</div>
