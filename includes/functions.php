<?php
function shuffle_assoc( &$array ) {
	$keys = array_keys( $array );

	shuffle( $keys );

	foreach( $keys as $key ) {
		$new[ $key ] = $array[ $key ];
	}

	$array = $new;

	return true;
}

function get_all_options_shuffled() {
	$ops = json_decode( file_get_contents( dirname(__FILE__) . '/../fros/fros.json' ), true );
	shuffle_assoc( $ops );
	return $ops;
}
?>