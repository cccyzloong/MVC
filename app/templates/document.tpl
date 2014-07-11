<!DOCTYPE html>
<html lang="de">
	<head>
		<title>PHP MVC</title>
		
		<!-- link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script -->		
		
		<link href="/css/bootstrap.min.css" rel="stylesheet">
		<script src="/js/bootstrap.min.js"></script>
		
		<link href="/css/style.css" rel="stylesheet">
		
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	</head>
	
	<body>
		<div class="container-fluid m-top-15">
			<div class="panel panel-default">
				<div class="panel-heading">
					Controller: {$controller}, action: {$action}
				</div>
				<div class="panel-body">
			    	{block name="body"}{/block}
				</div>
			</div>
		</div>
	</body>
</html>