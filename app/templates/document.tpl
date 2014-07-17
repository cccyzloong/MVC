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
			{if $controller != $smarty.const.LOGIN_CONTROLLER}
				<div class="panel panel-default">
					<div class="panel-heading">
						Controller: {$controller}, action: {$action}
											
						<div class="pull-right">
							<form role="form" method="post" class="form-login">
								<div class="form-group">
									<input type="hidden" name="logout" value="1" />
									<button type="submit" title="Logout" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-off"></span></button>
								</div>
							</form>
						</div>					
					</div>
					<div class="panel-body">
				    	{block name="body"}{/block}
					</div>			
				</div>
			{else}
				{block name="body"}{/block}
			{/if}
		</div>
	</body>
</html>