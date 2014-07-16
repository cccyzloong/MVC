<!DOCTYPE html>
<html lang="de">
	<head>
		<title>PHP MVC</title>
		
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		
		<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
		
		<link href="/css/style.css" rel="stylesheet">
		
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	</head>
	
	<body>
		<div class="container-fluid m-top-15">
			<div class="panel panel-default">
				<div class="panel-heading">
					Controller: {$controller}, action: {$action}
					
					<div class="pull-right col-lg-1">
						<form role="form" method="post" class="form-login">
							{if !$isLoggedIn}
								<a href="/login" class="btn btn-xs btn-success form-submit">Login</a>
							{else}
								<div class="form-group">
									<input type="hidden" name="logout" value="1" />
									<button type="submit" class="btn btn-xs btn-success form-submit">Logout</button>
								</div>
							{/if}
						</form>
					</div>
				</div>
				<div class="panel-body">
			    	{block name="body"}{/block}
				</div>
			</div>
		</div>
	</body>
</html>