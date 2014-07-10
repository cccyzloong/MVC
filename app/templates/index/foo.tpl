{extends file="../document.tpl"}

{block name="body"}
	We are in {$smarty.template}<br /><br />
	<pre>
		{print_r($get)}
	</pre>
	
	<pre>
		{print_r($post)}
	</pre>
	
	<div>
		<form method="post">
			<input type="text" name="foo" />
			<input type="text" name="bar" />
			<input type="submit" value="Send" />
		</form>
	</div>
{/block}