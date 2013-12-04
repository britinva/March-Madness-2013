<!DOCTYPE html>
<html lang="en">
<?php
	include_once("data/teams.php");
	$currGame = 0;
?>
<head>
	<link href='css/george.css' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:800,600' rel='stylesheet' type='text/css'>
	<title>Scoreboard</title>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
	<style>
		.tails .fixture {
			-moz-transform: rotateX(-180deg);
			-webkit-transform: rotateX(-180deg);
			transform: rotateX(-180deg);
		}

		.tails .team1-logo, .tails .stats {
			-moz-transform: rotateY(180deg);
			-webkit-transform: rotateY(180deg);
			transform: rotateY(180deg);
			width: 100%;
			height: 100%;
		}

		.tails .team2-logo {
			-moz-transform: rotateY(-180deg);
			-webkit-transform: rotateY(-180deg);
			transform: rotateY(-180deg);
			width: 100%;
			height: 100%;
		}

		.fixture, .team1-logo, .team2-logo, .stats {
			-moz-transition: 1s;
			-webkit-transition: 1s;
			transition: 1s;
			-moz-transform-style: preserve-3d;
			-webkit-transform-style: preserve-3d;
			transform-style: preserve-3d;
			width: 100%;
			height: 100%;
		}
		
		.front, .back {
			position: absolute;
			top: 0;
			left: 0;
			-moz-backface-visibility: hidden;
			-webkit-backface-visibility: hidden;
			backface-visibility: hidden;
		}
		
		.front {
			z-index: 2;
		}
		
		.game .back {
			-moz-transform: rotateX(-180deg);
			-webkit-transform: rotateX(-180deg);
			transform: rotateX(-180deg);
		}

		.logo-placeholder .back,
		.stat-placeholder .back {
			-moz-transform: rotateY(-180deg);
			-webkit-transform: rotateY(-180deg);
			transform: rotateY(-180deg);
		}

	</style>	
	
	<script>
		var featuredGame = 0;

		function flipScores() {
			$('.game').each(function(index) {
				setTimeout(
					function(){
						$('.game:nth-child('+index+')').toggleClass('tails');
					},
				index*100);
			});
		}

		function flipFeatured() {
			$('.logo-placeholder').toggleClass('tails');
		}

		function flipStats() {
			$('.stat-placeholder').toggleClass('tails');
		}
	
		$(function() {
			var scoreFlip = setInterval(function(){
				flipScores();
			},5000);
			var scoreFlip = setInterval(function(){
				flipFeatured();
			},20000);
			var statFlip = setInterval(function(){
				setTimeout("flipStats()", 250);
			},10000);
		});
	</script>
	
</head>
<body>
<h1><img src="images/logo.png" alt="NCAA Tweet Madness" id="main-logo" /></h1>
<div class="container">
	<section class="score-column west">
		<h2>West Region</h2>
		<ul>
			<?php $i=0; for ($a=0; $a < 16; $a=$a+4): ?>
			<li class="game">
				<div class="fixture">
					<div class="front">
						<div class="team1">
							<img src="http://a.espncdn.com/combiner/i?img=/i/teamlogos/ncaa/500/<?=$espn_ids[$a]?>.png?w=60&h=60&transparent=true" alt="team name" /><br />
							<span class="team-score">0</span>
						</div>
						<div class="team2">
							<img src="http://a.espncdn.com/combiner/i?img=/i/teamlogos/ncaa/500/<?=$espn_ids[$a+1]?>.png?w=60&h=60&transparent=true" alt="team name" /><br />
							<span class="team-score">0</span>
						</div>
					</div>
					<div class="back">
						<div class="team1">
							<img src="http://a.espncdn.com/combiner/i?img=/i/teamlogos/ncaa/500/<?=$espn_ids[$a+2]?>.png?w=60&h=60&transparent=true" alt="team name" /><br />
							<span class="team-score">0</span>
						</div>
						<div class="team2">
							<img src="http://a.espncdn.com/combiner/i?img=/i/teamlogos/ncaa/500/<?=$espn_ids[$a+3]?>.png?w=60&h=60&transparent=true" alt="team name" /><br />
							<span class="team-score">0</span>
						</div>
					</div>
				</div>
			</li>
			<?php endfor; ?>
		</ul>
	</section>
	
	<section class="main-scoreboard">

		<div class="logo-placeholder">
			<div class="team1-logo">
				<div class="front">
					<img src="http://a.espncdn.com/combiner/i?img=/i/teamlogos/ncaa/500/<?=$espn_ids[$currGame*2]?>.png?w=200&h=200&transparent=true" class="logo-1" alt="team name" /><br />
					<span class="team-score">0</span>
				</div>		
				<div class="back">
					<img src="http://a.espncdn.com/combiner/i?img=/i/teamlogos/ncaa/500/<?=$espn_ids[($currGame+1)*2]?>.png?w=200&h=200&transparent=true" class="logo-1" alt="team name" /><br />
					<span class="team-score">0</span>
				</div>		
			</div>
		</div>

		<div class="logo-placeholder">
			<div class="team2-logo">
				<div class="front">
					<img src="http://a.espncdn.com/combiner/i?img=/i/teamlogos/ncaa/500/<?=$espn_ids[($currGame*2)+1]?>.png?w=200&h=200&transparent=true" class="logo-2" alt="team name" /><br />	
					<span class="team-score">0</span>
				</div>
				<div class="back">
					<img src="http://a.espncdn.com/combiner/i?img=/i/teamlogos/ncaa/500/<?=$espn_ids[(($currGame+1)*2)+1]?>.png?w=200&h=200&transparent=true" class="logo-2" alt="team name" /><br />	
					<span class="team-score">0</span>
				</div>
			</div>
		</div>

		<div class="stat-placeholder">
			<div class="stats">			
				<div class="front team1-tweets">
					<h3>Tweets (<strong class="team-score">127</strong>)</h3>
					<ul>
						<li><strong>@gmoney61</strong> Filled out my March Madness bracket.. As much as I hated doing it, I got Duke winning the title. Who y'all got? My upset team -- VCU! #havoc</li>
					</ul>
				</div>
				<div class="back team1-tweets">
					<h3>Top Scorers</h3>
					<ul>
						<li><strong>@gmoney61</strong> Filled out my March Madness bracket.. As much as I hated doing it, I got Duke winning the title. Who y'all got? My upset team -- VCU! #havoc</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="stat-placeholder">				
			<div class="stats">			
				<div class="front team2-tweets">
					<h3>Tweets (<strong class="team-score">127</strong>)</h3>
					<ul>
						<li><strong>@gmoney61</strong> Rams are in stride!</li>
						<li><strong>@gmoney61</strong> Rams are in stride!</li>
						<li><strong>@gmoney61</strong> Rams are in stride!</li>
					</ul>
				</div>
				<div class="back team2-tweets">
					<h3>Top Scorers</h3>
					<ul>
						<li><strong>@gmoney61</strong> Rams are in stride!</li>
						<li><strong>@gmoney61</strong> Rams are in stride!</li>
						<li><strong>@gmoney61</strong> Rams are in stride!</li>
					</ul>
				</div>
			</div>
		</div>
			
		<img src="images/vs.png" alt="versus" class="versus" />
	</section>
	
	<section class="score-column east">
		<h2>East Region</h2>
		<ul>
			<?php $i=0; for ($a=16; $a < 32; $a=$a+4): ?>
			<li class="game">
				<div class="fixture">
					<div class="front">
						<div class="team1">
							<img src="http://a.espncdn.com/combiner/i?img=/i/teamlogos/ncaa/500/<?=$espn_ids[$a]?>.png?w=60&h=60&transparent=true" alt="team name" /><br />
							<span class="team-score">0</span>
						</div>
						<div class="team2">
							<img src="http://a.espncdn.com/combiner/i?img=/i/teamlogos/ncaa/500/<?=$espn_ids[$a+1]?>.png?w=60&h=60&transparent=true" alt="team name" /><br />
							<span class="team-score">0</span>
						</div>
					</div>
					<div class="back">
						<div class="team1">
							<img src="http://a.espncdn.com/combiner/i?img=/i/teamlogos/ncaa/500/<?=$espn_ids[$a+2]?>.png?w=60&h=60&transparent=true" alt="team name" /><br />
							<span class="team-score">0</span>
						</div>
						<div class="team2">
							<img src="http://a.espncdn.com/combiner/i?img=/i/teamlogos/ncaa/500/<?=$espn_ids[$a+3]?>.png?w=60&h=60&transparent=true" alt="team name" /><br />
							<span class="team-score">0</span>
						</div>
					</div>
				</div>
			</li>
			<?php endfor; ?>
		</ul>
	</section>
</div>




</body>
</html>