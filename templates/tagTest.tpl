{include file="header.tpl" title="Tags"}
<form method='post' action='?'>
	<input name='name'>
	<input type='submit'>
</form>

<table border='1' cellspacing='0' cellpadding='4'>
	<tbody>
		{foreach from=$tags item=t}
		<tr>
			<td>{$t.id}</td>
			<td>{$t.name}</td>
			<td>{$t.lcName}</td>
		</tr>
		{/foreach}
	</tbody>
</table>
{include file="footer.tpl"}
