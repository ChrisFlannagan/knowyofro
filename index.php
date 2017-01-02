<?php
require_once( 'includes/functions.php' );

$ops = get_all_options_shuffled();
$unanswered = array();

/**
 * START NEW QUIZ IF NO COOKIE
 * ******** ELSE *************
 * STORE ALL UNANSWERED INTO ARRAY
 * THEY WERE SHUFFLED ALREADY SO ITS
 * RANDOM ORDER HERE NOW
 *
 * This is ugly as shit but I did it fast as fuck and it works so.. yea, don't touch it
 */
if ( ! isset( $_COOKIE['fromage'] ) ) {
	setcookie( 'fromage', '', time() + (86400 * 30), "/");
	foreach ( $ops as $op ) {
		foreach ( $op as $key => $val ) {
			$unanswered[] = $key . ';' . $val;
		}
	}
} else {
	foreach ( $ops as $op ) {
		foreach ( $op as $key => $val ) {
			if ( strpos( $_COOKIE['fromage'], ';' . $val . '|' ) === false ) {
				$unanswered[] = $key . ';' . $val;
			}
		}
	}
}

/** If none left to answer head on over to done */
if ( count ( $unanswered ) == 0 ) {
	header( "Location: done.php" );
}

/** Grab a random fro, yo */
$rnd = explode( ';', $unanswered[ mt_rand( 0, count( $unanswered ) - 1 ) ] );
/** FROYO!!!

  C,
 ( ~)
 ( ~)
 (~ )
 \~~/
  \/

 */
require_once( 'includes/header.php' );

$cnt = 0; // Only want 5 of em
$final_ops = array(); // These ops will be what we loop through to display multiple choice
/** We have to make sure our random selected guy is in this final array */
$final_op = '<li class="list-group-item"><input id="' . str_replace(' ', '', $rnd[0] ) . '" type="radio" name="answer" value="' . $rnd[0] . '">';
$final_op .= ' <label for="' . str_replace(' ', '', $rnd[0] ) . '">' . $rnd[0] . '</label></li>';
$show = $rnd[1]; // let's get that image for the correct choice
$final_ops[] = $final_op; // Ok, start our new array with the random fro we selected to be the current question
foreach( $ops as $op ) { // Loop through all our options
	foreach( $op as $key => $val ) { // Loop through the single item so we can get key, I fucked up the original json and didn't feel like fixing late in the game
		if ( $cnt < 5 ) { // We only need 5 of em
			/** Build our quiz options */
			$next = '<li class="list-group-item"><input id="' . str_replace(' ', '', $key ) . '" type="radio" name="answer" value="' . $key . '">';
			$next .= ' <label for="' . str_replace(' ', '', $key )  . '">' . $key  . '</label></li>';
			if ( $next != $final_op ) { // We don't want to add the one we already added that's the right one
				$final_ops[] = $next;
				$cnt ++;
			}
		}
	}
}
?>
<div class="container">
	<div class="row">
		<div class="col-xs-12 text-center counter">
			<?php
				if ( isset( $_GET['correct'] ) ) {
					$correct = "CORRECT";
					?>
					<p class="reply" style="<?php
					if ( $_GET['correct'] == 'false' ) {
						echo 'color: Red;';
						$correct = "INCORRECT";
					}
					?>">Last answer was <?php echo $correct; ?></p>
					<p class="minireply">See all answers when you finish</p>
					<?php
				}
			?>
			Fro <?php echo count( $ops ) - count( $unanswered ) + 1; ?> of <?php echo count( $ops ); ?>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-2"><script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
			<!-- KnowYoFro - Responsive -->
			<ins class="adsbygoogle"
			     style="display:block"
			     data-ad-client="ca-pub-9432753157740043"
			     data-ad-slot="4421994971"
			     data-ad-format="auto"></ins>
			<script>
				(adsbygoogle = window.adsbygoogle || []).push({});
			</script></div>
		<div class="col-sm-4 frobox">
			<img src="fros/<?php echo $show; ?>" class="img-responsive" />
		</div>
		<div class="col-sm-4 vertical-align select-ops">
			<form action="answer.php" method="post">
				<ul class="list-group">
				<?php
				shuffle( $final_ops ); // MIX THEM BITCHES UP
				foreach( $final_ops as $op ) {
					echo $op; // Show our options
				}
				?>
				</ul>
				<input type="hidden" name="f" value="<?php echo $show; ?>" />
				<input type="submit" class="btn btn-info" style="display:none;" />
			</form>
			<button onclick="window.location.href='answer.php?clear=true';" class="btn btn-primary">Start Over, GET FRESH!</button>
		</div>
		<div class="col-sm-2"><script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
			<!-- KnowYoFro - Responsive -->
			<ins class="adsbygoogle"
			     style="display:block"
			     data-ad-client="ca-pub-9432753157740043"
			     data-ad-slot="4421994971"
			     data-ad-format="auto"></ins>
			<script>
				(adsbygoogle = window.adsbygoogle || []).push({});
			</script></div>
	</div>
</div>
<?php require_once( 'includes/footer.php' );