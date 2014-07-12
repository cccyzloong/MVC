{extends file="../document.tpl"}

{block name="body"}

	<div class="alert alert-danger">Controller: {$controller} not found</div>
	
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