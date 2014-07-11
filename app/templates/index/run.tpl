{extends file="../document.tpl"}

{block name="body"}
	We are in {$smarty.template}<br /><br />
	<pre>
		{print_r($get)}
	</pre>
	
	<pre>
		{print_r($post)}
	</pre>
{/block}