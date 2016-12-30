<?php
require_once( 'includes/functions.php' );
require_once( 'includes/header.php' );

$ops = get_all_options_shuffled();
$final = array();
foreach ( $ops as $op ) {
	foreach ( $op as $key => $val ) {
		$final[ $val ] = $key;
	}
}
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
<script>
	function fb_share() {
		FB.ui({
			method: 'share_open_graph',
			action_type: 'og.likes',
			action_properties: JSON.stringify({
				object:'https://knowyofro.com/share.php?c=<?php echo count( $correct ); ?>',
			})
		}, function(response){
			// Debug response (optional)
			console.log(response);
		});
	}
</script>
<div class="container">
	<div class="row">
		<div class="col-sm-2"></div>
		<div class="col-sm-4 top-mobile">
			<h3>You scored: <?php echo count( $correct ); ?> out of <?php echo count( $correct ) + count( $incorrect ); ?></h3>
			<p>Scroll To See Correct Answers</p>
			<p>
				<a href="#" onclick="fb_share();">
					<img src="https://knowyofro.com/assets/sharefb.jpg" />
					<img src="https://knowyofro.com/assets/<?php echo count( $correct ); ?>.jpg" />
				</a>
			</p>
			<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
			<!-- KnowYoFro - Results Square -->
			<ins class="adsbygoogle"
			     style="display:block"
			     data-ad-client="ca-pub-9432753157740043"
			     data-ad-slot="4421994971"
			     data-ad-format="auto"></ins>
			<script>
				(adsbygoogle = window.adsbygoogle || []).push({});
			</script>
		</div>
		<div class="col-sm-4">
			<h2>Your Results</h2>

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
		<div class="col-sm-2"></div>
	</div>
</div>
<?php require_once( 'includes/footer.php' );