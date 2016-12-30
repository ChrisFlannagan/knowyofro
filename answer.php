<?php
/**
 * Answers are submitted to this page.  You can also use this page to clear your cookie and start over.
 *
 * $_POST['f'] is the image file name from the question submitted.
 * I used this "starting;" value for initiating the cookie at the very beginning of coding.
 * Probably not necessary anymore but fuck it, not fucking anything up so let's leave it
 */
require_once( 'includes/functions.php' );
$unanswered = array();
$reply = 'correct=false';
if ( isset ( $_GET['clear'] ) ) {
	setcookie( 'fromage', 'starting;', time() + (86400 * 30), "/");
	$reply = '';
} elseif ( isset( $_POST['f'] ) ) {
	/** Gather all options */
	$ops = get_all_options_shuffled();
	$fin     = explode( ';', $_COOKIE['fromage'] );
	foreach ( $ops as $op ) {
		foreach ( $op as $key => $val ) {
			//echo $key . '-' . $_POST['answer'] . '-' . $val . '-' . $_POST['f'] . '<hr />';
			if ( $key == $_POST['answer'] && $val == $_POST['f'] ) {
				$correct = 'true';
				$reply = 'correct=true';
			}

			// If not answered yet and not previous question
			if ( $val != $_POST['f'] && ! array_search( $val . '|true', $fin ) || ! array_search( $val . '|false', $fin ) ) {
				$unanswered[] = $key . ';' . $val;
			}
		}
	}

	setcookie( 'fromage', implode( ';', $fin ) . ';' . $_POST['f'] . '|' . $correct . ';', time() + (86400 * 30), "/");
}
?>
<script>location.href="index.php?count=<?php echo time(); ?>&<?php echo $reply; ?>";</script>
