<?php
function share_buttons_checkbot() {

	$crawlers = [
		'facebookexternalhit/1.1',
		'facebookexternalhit/1.1 (+http://www.facebook.com/externalhit_uatext.php)',
		'Facebot',
		'Twitterbot',
	];

	$user_agent = $_SERVER['HTTP_USER_AGENT'];

	foreach( $crawlers as $bot ) {
		if ( strpos( $user_agent, $bot ) !== false ) {
			return true;
		}
	}

	if ( isset( $_GET['get'] ) ) {
		return true;
	}

	return false;

}

if ( ! isset( $_GET['c'] ) || ! share_buttons_checkbot() ) {
	header("Location: http://knowyofro.com");
	exit();
}
?>
<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<title>KnowYoFro.com Play Now!</title>
	<meta name="description" content="I Knew <?php echo intval( $_GET['c'] ); ?> out of 13 FROs!" />
	<meta property="fb:app_id" content="356480544721988" />
	<meta property="og:title" content="Do You KnowYoFro?" />
	<meta property="og:url" content="http://knowyofro.com/share.php?c=<?php echo intval( $_GET['c'] ); ?>" />
	<meta property="og:description" content="I Knew <?php echo intval( $_GET['c'] ); ?> out of 13 FROs!" />
	<meta property="og:type" content="article" />
	<meta property="og:image" content="http://knowyofro.com/assets/<?php echo intval( $_GET['c'] ); ?>.jpg" />
	<meta property="og:image:width" content="477" />
	<meta property="og:image:height" content="249" />
	<link rel="img_src" href="http://knowyofro.com/assets/<?php echo intval( $_GET['c'] ); ?>.jpg" />
</head>
<body>
<div id="wrapper">
	<h1><?php echo $output['title'] ?></h1>
	<img src="http://knowyofro.com/assets/<?php echo intval( $_GET['c'] ); ?>.jpg" alt="I Knew <?php echo intval( $_GET['c'] ); ?> out of 13 FROs!" />
	<a href="http://knowyofro.com/share.php?c=<?php echo intval( $_GET['c'] ); ?>" title="KnowYoFro.com Play Now!">I Knew <?php echo intval( $_GET['c'] ); ?> out of 13 FROs!</a>
</div>
</body>
</html>