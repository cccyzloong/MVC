<!DOCTYPE html>
<html lang="de" class="bg-black">
	<head>
		<meta charset="UTF-8">
		
        <title>{$metaTitle} | Backend</title>
        
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- bootstrap 3.0.2 -->
        <link href="/theme/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="/theme/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="/theme/css/AdminLTE.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->        
	</head>
	
	<body class="bg-black">        
		<div class="form-box" id="login-box">
			
			{if isset($alert) && !empty($alert)}
				<div class="alert alert-danger alert-dismissable">
		        	<i class="fa fa-ban"></i>
		        	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		        	{$alert}
		        </div>
	        {/if}
			
	        <div class="header bg-blue">Anmeldung</div>
	        <form method="post">
	            <div class="body bg-gray">
	                <div class="form-group">
	                    <input type="email" name="username" class="form-control" placeholder="E-Mail"/>
	                </div>
	                <div class="form-group">
	                    <input type="password" name="password" class="form-control" placeholder="Kennwort"/>
	                </div>
	            </div>
	            <div class="footer">                                                               
	                <button type="submit" class="btn bg-blue btn-block">Anmelden</button>
	            </div>
	        </form>
	        <span class="text pull-right">Copyright &copy; {$smarty.now|date_format:"%Y"} Davor Bešlić</span>
	    </div>	    
		
		{if $session}
			<pre>SESSION
				{print_r($session)}
			</pre>
		{/if}
	
		<!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="/theme/js/bootstrap.min.js" type="text/javascript"></script>
	</body>
</html>