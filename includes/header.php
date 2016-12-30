<!DOCTYPE html>
<html lang="en">
<head>
	<title>Know Yo Fro</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel='stylesheet' href='includes/style.css' type='text/css' media='all' />
	<script
		src="https://code.jquery.com/jquery-3.1.1.min.js"
		integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
		crossorigin="anonymous"></script>
	<!--[if lt IE 9]>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
	<script src="includes/scripts.js"></script>
</head>
<body>
<script>
	window.fbAsyncInit = function() {
		FB.init({
			appId      : '356480544721988',
			xfbml      : true,
			version    : 'v2.8'
		});
		FB.AppEvents.logPageView();
	};

	(function(d, s, id){
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) {return;}
		js = d.createElement(s); js.id = id;
		js.src = "//connect.facebook.net/en_US/sdk.js";
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));
</script>
<a href="answer.php?clear=true" class="startover">Start Over, GET FRESH!</a>
<div class="container-fluid">
	<div class="row header">
		<div class="col-xs-12 text-center">
			KNOW YO FRO
		</div>
	</div>
</div>