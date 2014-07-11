{extends file="../document.tpl"}

{block name="body"}
	We are in {$smarty.template}<br /><br />
	
	<div class="col-lg-12">
		<form method="post" role="form" class="form-horizontal">
			<div class="form-group">
				<label>Firstname</label>
				<input type="text" class="form-control" name="firstname" />
			</div>
			<div class="form-group">
				<label>Lastname</label>
				<input type="text" class="form-control" name="lastname" />
			</div>
			
			<div class="form-group">
				<button type="submit" class="btn btn-default">Send</button>
			</div>
		</form>
	</div>

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