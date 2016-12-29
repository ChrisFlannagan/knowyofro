<?php
require_once( 'includes/functions.php' );
if ( isset ( $_GET['clear'] ) ) {
	setcookie( 'fromage', 'starting;', time() + (86400 * 30), "/");
} elseif ( isset( $_POST['f'] ) ) {
	$ops = json_decode( file_get_contents( 'fros/fros.json' ), true );
	shuffle_assoc( $ops );
	$correct = 'false';
	$fin     = explode( ';', $_COOKIE['fromage'] );
	foreach ( $ops as $op ) {
		foreach ( $op as $key => $val ) {
			//echo $key . '-' . $_POST['answer'] . '-' . $val . '-' . $_POST['f'] . '<hr />';
			if ( $key == $_POST['answer'] && $val == $_POST['f'] ) {
				$correct = 'true';
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
<script>location.href="index.php";</script>
