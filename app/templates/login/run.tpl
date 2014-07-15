{extends file="../document.tpl"}

{block name="body"}	
	<div class="col col-lg-3">
		<form role="form" method="post">
			<div class="form-group">
		    	<input type="email" class="form-control" name="username" placeholder="Username (E-Mail)" />
			</div>
			<div class="form-group">
		    	<input type="password" class="form-control" name="password" placeholder="Password" />
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-success">Login</button>
			</div>
		</form>
	</div>
	
	{if $session}
		<pre>SESSION
			{print_r($session)}
		</pre>
	{/if}
{/block}