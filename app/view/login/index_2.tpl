{extends file="../_main/document.tpl"}

{block name="body"}	
	<div class="col col-lg-2 col-lg-offset-5 m-top-20p">
		<form role="form" method="post" class="form-login">
			{if !$isLoggedIn}
				<div class="form-group">
			    	<input type="email" class="form-control" name="username" placeholder="Username (E-Mail)" />
			    	<input type="password" class="form-control" name="password" placeholder="Password" />
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-default form-submit">Login</button>
				</div>
			{else}
				<div class="form-group">
					<input type="hidden" name="logout" value="1" />
					<button type="submit" class="btn btn-danger form-submit">Logout</button>
				</div>
			{/if}
		</form>
	</div>
	
	{if $session}
		<pre>SESSION
			{print_r($session)}
		</pre>
	{/if}
{/block}