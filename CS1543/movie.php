<?php
	$film = $_GET["film"];
	$directory = "moviefiles/" . $film;
	$info = file($directory . "/info.txt");
	$title = $info[0];
	$titleHeader = "Rancid Tomatoes";
	if ($title != "") {
		$titleHeader .= " - " . $title;
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title><?= $titleHeader ?></title>

		<meta charset="utf-8" />
		<meta name="description" content="Rancid Tomatoes web site for movie ratings and reviews." />
		<meta name="keywords" content="Rancid Tomatoes, movie reviews, movie ratings, TMNT, TMNT 2, The Princess Bride, Mortal Kombat, The Dark Knight Rises" />
 		<link href="movie.css" type="text/css" rel="stylesheet" />
		<link href="<?= $favIcon ?>" type="image/gif" rel="icon" />
	</head>
	<body>
		<?php 
			if (!isset($_GET["film"]) || $title == "") {
				include("error.php");
			} else {
				$year = $info[1];
				$rating = $info[2];
				$image = "images/rottenlarge.png";
				$favIcon = "images/rotten.gif";
				if ($rating >= 60) {
					$image = "images/freshlarge.png";
					$favIcon = "images/fresh.gif";
				} 

				$reviews = array();
				foreach (scandir($directory) as $file) {
					if (substr($file, 0, strlen("review")) == "review" && $file != "." && $file != "..") {
						array_push($reviews, $file);
					}

				}

				$actualReviewsCount = count($reviews);
				$reviewsCount = count($reviews);
				$firstPage = 1;
				if (isset($_GET["reviews"])) {
					if ($_GET["reviews"] < $reviewsCount) {
						if ($_GET["reviews"] <= 0) {
							$reviewsCount = 0;
							$firstPage = 0;
						} else {
							$reviewsCount = $_GET["reviews"];
						}

					}

				}

				$leftReviewsCount = $reviewsCount;
				if ($reviesCount > 1) {
					$leftReviewsCount = $reviewsCount / 2 + $reviewsCount % 2;
				} else {
					$leftReviewsCount = $reviewsCount / 2;
				}
			?>

				<div id="banner">
					<?php
						include("banner.php");
					?>
				</div>

				<h1><?= $title . " (" . substr($year, 0, strlen($year - 2)) . ")" .  $starring ?></h1>
				
				<div id="contentArea">
					<div id="sections">
						<div id="rightSection">
							<div>
								<img src="<?= $directory . "/" . "overview.png" ?>" alt="general overview" />
							</div>

							<dl>
								<?php
									$overview = file($directory . "/overview.txt");
									foreach ($overview as $overviewItem) {
										?>
										<dt><?= explode(":", $overviewItem)[0] ?></dt>
										<dd><?= explode(":", $overviewItem)[1] ?></dd>
									<?php
									}
								?>
							</dl>
						</div>

						<div id="leftSection">
							<?php
								include("rottenRating.php");
							?>
							
							<div class="reviewColumns">
								<?php
									for ($i = 0; $i < $leftReviewsCount; $i++) {
										$reviewFile = file($directory . "/" . $reviews[$i], FILE_IGNORE_NEW_LINES);
										$reviewImage = "images/rotten.gif";
										$reviewAlt = "Rotten";
										if ($reviewFile[1] == "FRESH") {
											$reviewImage = "images/fresh.gif";
											$reviewAlt = "Fresh";
										}
										?>
										<p class="quoteBoxes">
											<img src="<?= $reviewImage ?>" alt="<?= $reviewAlt ?>" />
											<q><?= $reviewFile[0] ?></q>
										</p>
										<p class="critics">
											<img src="images/critic.gif" alt="Critic" />
											<?= $reviewFile[2] ?> <br />
											<span class="publication"><?= $reviewFile[3] ?></span>
										</p>
										<?php
									}
								?>
							</div>

							<div class="reviewColumns">
								<?php
									for ($i = $reviewsCount / 2 + $reviewsCount % 2; $i < $reviewsCount; $i++) {
										$reviewFile = file($directory . "/" . $reviews[$i], FILE_IGNORE_NEW_LINES);
										$reviewImage = "images/rotten.gif";
										$reviewAlt = "Rotten";
										if ($reviewFile[1] == "FRESH") {
											$reviewImage = "images/fresh.gif";
											$reviewAlt = "Fresh";
										}
										?>
										<p class="quoteBoxes">
											<img src="<?= $reviewImage ?>" alt="<?= $reviewAlt ?>" />
											<q><?= $reviewFile[0] ?></q>
										</p>
										<p class="critics">
											<img src="images/critic.gif" alt="Critic" />
											<?= $reviewFile[2] ?> <br />
											<span class="publication"><?= $reviewFile[3] ?></span>
										</p>
										<?php
									}
								?>
							</div>
						</div>
						
						<div id="bottom">
							<p><?= "(" . $firstPage . "-" . $reviewsCount . ") of " . $actualReviewsCount ?></p>
							<?php
								include("rottenRating.php");
							?>
						</div>
					</div>
				</div>

				<div id="validators">
					<a href="http://validator.w3.org/check?uri=referer"><img src="images/w3c-html.png" alt="Valid HTML5" /></a><br />
					<a href="http://jigsaw.w3.org/css-validator/check/referer"><img src="images/vcss-blue.gif" alt="Valid CSS" /></a>
				</div>

				<div id="bottomBanner">
					<?php
						include("banner.php");
					?>
				</div>
			<?php
			}
		?>
	</body>
</html>
