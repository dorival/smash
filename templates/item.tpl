{include file="header.tpl" title=$name}
  <div id="vote" class="detalhes">
    <div class="capa"><span class="mask300"></span><img class="mask300" src='uploads/{$imgFilename}'/> </div>
    <div class="info descricao">
		<h1>{$name}
				<a href="http://twitter.com/share"
					class="twitter-share-button"
					data-url="http://furries.com.br/item.php?id={$id}"
					data-count="horizontal"
					data-text="Eu quero! {$name|escape}" 
					data-via="LojaFurries">(Tweet)</a></h1>
      <ul>
        <li><span>Categorias:</span></li>
				{foreach from=$tags item=t}
					<li><a href='.?tag={$t.lcName}'>{$t.name}</a></li>
				{/foreach}
      </ul>
      <p class="dados">{$description|nl2br}</p> </div>
    <div class="dados">
      <ul>
        <li>
          <p>Sugerido em {$whenAdded|dateBR}{if $isAdmin}
						[<a href="edit.php?id={$id}"> modificar </a>]
						[<a href="del.php?id={$id}" onclick="return confirm('Certeza?')"> del </a>]
					{/if}</p>
        </li>
        <li class="votos_nun">
          <p><span>{$thumbsUp}</span> votos</p>
        </li>
      </ul>
      <a class="vote_button" rel="nofollow" href="vote.php?id={$id}">Votar</a>
		</div>
  </div>
{include file="footer.tpl"}
