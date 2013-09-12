{include file="header.tpl" title=""}
{if $tag}
<p class="categorizado">Listando apenas categoria "{$tag.name}" | <a href=".">Listar tudo</a></p>
{/if}
{if $isAdmin}
<a href="edit.php">= ADICIONAR NOVO ITEM PARA SER VOTADO =</a>
{/if}
{foreach from=$items item=s}
  <div id="vote">
    <div class="capa"><a href="item.php?id={$s.id}"><span></span><img border="0" src="uploads/{$s.thumbFilename}" alt="{$s.name}" /></a></div>
    <div class="info">
      <h2>{$s.name}</h2>
      <ul>
        <li><span>Categorias:</span></li>
				{foreach from=$s.tags item=t}
					<li><a href="?tag={$t.lcName}">{$t.name}</a></li>
				{/foreach}
      </ul>
		{if $isAdmin}
			[<a href="edit.php?id={$s.id}"> modificar </a>]
			[<a href="del.php?id={$s.id}" onclick="return confirm('Certeza?')"> del </a>]
		{/if}
      <a class="more" href="item.php?id={$s.id}">Saiba mais sobre esta sugestão</a> </div>
    <div class="dados">
      <ul>
        <li>
          <p><a href="http://twitter.com/share"
					class="twitter-share-button"
					data-url="http://furries.com.br/item.php?id={$s.id}"
					data-count="none"
					data-text="Eu quero! {$s.name|escape}" 
					data-via="LojaFurries">(Tweet)</a>
					Sugerido em {$s.whenAdded|dateBR}</p>
        </li>
        <li class="votos_nun">
          <p><span>{$s.thumbsUp}</span> votos</p>
        </li>
      </ul>
      <a class="vote_button" rel="nofollow" href="vote.php?id={$s.id}">Votar</a>
		</div>
  </div>
{/foreach}
{include file="footer.tpl"}
