<?php
require_once( 'includes/header.php' );
$final = array();
foreach ( $ops as $op ) {
	foreach ( $op as $key => $val ) {
		$final[ $val ] = $key;
	}
}
?>
<div class="container">
	<div class="row">
		<div class="col-sm-2"></div>
		<div class="col-sm-4">
			<?php
			$correct = array();
			$incorrect = array();
			foreach ( explode( ';', $_COOKIE['fromage'] ) as $answered ) {
				if ( strpos( $answered, '|false' ) !== false ) {
					$incorrect[ str_replace( '|false', '', $answered ) ] = $final[ str_replace( '|false', '', $answered ) ];
				}
				if ( strpos( $answered, '|true' ) !== false ) {
					$correct[ str_replace( '|true', '', $answered ) ] = $final[ str_replace( '|true', '', $answered ) ];
				}
			}
			?>

			<h2>You scored: <?php echo count( $correct ); ?> out of <?php echo count( $correct ) + count( $incorrect ); ?></h2>

			<ul class="list-group">
			<?php
			foreach ( $correct as $img => $name ) {
				?>
				<li class="list-group-item correct ">
					<img class="img-responsive" src="fros/<?php echo $img; ?>" /> <?php echo $name; ?> - CORRECT!
				</li>
				<?php
			}
			foreach ( $incorrect as $img => $name ) {
				?>
				<li class="list-group-item incorrect">
					<img class="img-responsive" src="fros/<?php echo $img; ?>" /> <?php echo $name; ?> - INCORRECT!
				</li>
				<?php
			}
			?>
			</ul>
		</div>
		<div class="col-sm-4">
			Share on FB!
		</div>
		<div class="col-sm-2"></div>
	</div>
</div>
<?php require_once( 'includes/footer.php' );