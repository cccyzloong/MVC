{extends file="../document.tpl"}

{block name="body"}
	We are in {$smarty.template}<br /><br />
	
	{if !empty($get)}
		<pre>GET 
			{print_r($get)}
		</pre>
	{/if}
	
	{if !empty($post)}
		<pre>POST 
			{print_r($post)}
		</pre>
	{/if}
{/block}