 <!-- movie.html
	Mengyuan Huang CSE154 AJ 
	#HW3
	This is a movie review website
	Extra Features: change page title, fixed banners, meta tags-->
<!DOCTYPE html>
<html>
		<?php $movie = $_GET["film"]; ?>
		<?php list($name, $year, $rate) = file("$movie/info.txt"); ?>
	<head>
		<title>Rancid Tomatoes - <?= $name ?></title>
		<meta charset="utf-8" />
		<meta name="description" content="a movie review website">
		<meta name="keywords" content="movie, rating, reviews">
		<link href="movie.css" type="text/css" rel="stylesheet" />
		<link href="https://webster.cs.washington.edu/images/rotten.gif" type="image/gif" rel="shortcut icon" />
	</head>
	<body>
		<div id="bannerTop">
			<img src="https://webster.cs.washington.edu/images/rancidbanner.png" alt="image banner" />
		</div>
		<h1><?= "$name" ?>(<?= trim($year) ?>)</h1>
		<?php function rate($rate){
			if($rate < 60){ ?>
				<img src="https://webster.cs.washington.edu/images/rottenlarge.png" alt="rottenlarge" />
				<?php } else {?>
				<img src="https://webster.cs.washington.edu/images/freshlarge.png" alt="freshlarge" />
				<?php } 
				print $rate;?>%
		<?php }?>
		<div id="content">
			<div class="rating">
				<?php rate($rate)?>
			</div>
			<?php $reviewsTexts = glob("$movie/review*"); 
					$numberReviews = count($reviewsTexts); ?>
			<div id="left">
				<?php function reviewColumn($text){ ?>
						<p class = "review">
						<?php if(strcmp("ROTTEN", trim($text[1])) == 0){ ?>
								<img src="https://webster.cs.washington.edu/images/rotten.gif" alt="rottens" />
							<?php } else{ ?>
								<img src="https://webster.cs.washington.edu/images/fresh.gif" alt="fresh" />
							<?php } ?> 
							"<?= trim($text[0]) ?>"</p>
							<p class = "reviewer">
								<img src="https://webster.cs.washington.edu/images/critic.gif" alt="critic" />
								<?= $text[2] ?> <br /> <span class="from"><?= $text[3] ?></span>
							</p>
				<?php }?>
				<div class="column">
					<?php for($i = 0; $i < $numberReviews/2 ; $i++){ 
							$text = file("$reviewsTexts[$i]");
							reviewColumn($text);
						 } ?>
				</div>
				<div class="column">
					<?php for($i = $numberReviews/2 + $numberReviews % 2; $i < $numberReviews; $i++){ 
							$text = file("$reviewsTexts[$i]");
							reviewColumn($text);
						 } ?>
				</div>
			</div>
			<div id="right">
				<img src= "<?= $movie?>/overview.png" alt="overview" />
				<?php $lines = file("$movie/overview.txt");
				foreach ($lines as $line){ 
					$tokens = explode(":", $line); ?>
					<dl>
						<dt><?php print $tokens[0]; ?></dt>
						<dd><?php print $tokens[1]; ?> <br /></dd>
					</dl>
				<?php } ?>
			</div>
			<p id="page">(1-<?= $numberReviews ?>) of <?= $numberReviews ?></p>
			<div class="rating">
				<?php rate($rate)?>
			</div>
		</div>
		<div id="w3c">
			<a href="https://webster.cs.washington.edu/validate-html.php"><img src="https://webster.cs.washington.edu/images/w3c-html.png" alt="Valid HTML5" /></a><br />
			<a href="https://webster.cs.washington.edu/validate-css.php"><img src="https://webster.cs.washington.edu/images/w3c-css.png" alt="Valid CSS" /></a>
		</div>
		<div id="bannerBottom">
			<img src="https://webster.cs.washington.edu/images/rancidbanner.png" alt="image banner" />
		</div>
	</body>
</html>