{extends file="../document.tpl"}

{block name="body"}	
	<div class="col col-lg-2 col-lg-offset-5">
		<form role="form" method="post" class="form-login">
			<div class="form-group">
		    	<input type="email" class="form-control" name="username" placeholder="Username (E-Mail)" />
		    	<input type="password" class="form-control" name="password" placeholder="Password" />
			</div>
			<div class="form-group">
				<button type="submit" class="btn btn-success form-submit">Login</button>
			</div>
		</form>
	</div>
	
	{if $session}
		<pre>SESSION
			{print_r($session)}
		</pre>
	{/if}
{/block}