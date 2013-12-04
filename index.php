<!DOCTYPE html>
<html lang="en">
<?php
	include_once("data/teams.php");
	$currGame = 0;
?>
<head>
	<link href='css/paul.css' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:800,600' rel='stylesheet' type='text/css'>
	<title>Scoreboard</title>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
	<script>
		<?php
		include_once("data/array.php");
		?>				
	</script>
	<script src="js/tweetmadness.js" type="text/javascript"></script>
	
	
</head>
<body id="tweet-madness">
<h1><img src="images/logo.png" alt="NCAA Tweet Madness" id="main-logo" onclick="goFullscreen('tweet-madness'); return false" /></h1>
<div class="container">
	<section class="score-column west">
		<ul>
			<?php $i=0; for ($a=0; $a < 16; $a=$a+4): ?>
			<li class="game">
				<div class="fixture">
					<div class="front" id="game<?=$i?>">
						<div class="team1" id="<?=$acronyms[$a]?>">
							<img src="http://a.espncdn.com/combiner/i?img=/i/teamlogos/ncaa/500/<?=$espn_ids[$a]?>.png?w=70&h=70&transparent=true" alt="team name" />
							<span class="team-acronym"><?=$acronyms[$a]?></span>
							<span class="team-score">0</span>
						</div>
						<div class="team2" id="<?=$acronyms[$a+1]?>">
							<img src="http://a.espncdn.com/combiner/i?img=/i/teamlogos/ncaa/500/<?=$espn_ids[$a+1]?>.png?w=70&h=70&transparent=true" alt="team name" /> 
							<span class="team-acronym"><?=$acronyms[$a+1]?></span>
							<span class="team-score">0</span>
						</div>
					</div>
					<?php $i++ ?>
					<div class="back" id="game<?=$i?>">
						<div class="team1" id="<?=$acronyms[$a+2]?>">
							<img src="http://a.espncdn.com/combiner/i?img=/i/teamlogos/ncaa/500/<?=$espn_ids[$a+2]?>.png?w=70&h=70&transparent=true" alt="team name" />
							<span class="team-acronym"><?=$acronyms[$a+2]?></span>
							<span class="team-score">0</span>
						</div>
						<div class="team2" id="<?=$acronyms[$a+3]?>">
							<img src="http://a.espncdn.com/combiner/i?img=/i/teamlogos/ncaa/500/<?=$espn_ids[$a+3]?>.png?w=70&h=70&transparent=true" alt="team name" />
							<span class="team-acronym"><?=$acronyms[$a+3]?></span>
							<span class="team-score">0</span>
						</div>
					</div>
					<?php $i++ ?>				
				</div>
			</li>
			<?php endfor; ?>
		</ul>
	</section>
	
	<section class="main-scoreboard">
		<div class="logo-placeholder">
			<div class="team1-logo">
				<div class="front" id="<?=$acronyms[$currGame*2]?>-logo">
					<img src="http://a.espncdn.com/combiner/i?img=/i/teamlogos/ncaa/500/<?=$espn_ids[$currGame*2]?>.png?w=200&h=200&transparent=true" class="logo" alt="team name" /><br />
					<span class="team-score"><img src="images/numbers/0.jpg" alt="0" /></span>
				</div>		
				<div class="back" id="<?=$acronyms[($currGame+1)*2]?>-logo">
					<img src="http://a.espncdn.com/combiner/i?img=/i/teamlogos/ncaa/500/<?=$espn_ids[($currGame+1)*2]?>.png?w=200&h=200&transparent=true" class="logo" alt="team name" /><br />
					<span class="team-score"><img src="images/numbers/0.jpg" alt="0" /></span>
				</div>		
			</div>
		</div>

		<div class="logo-placeholder">
			<div class="team2-logo">
				<div class="front" id="<?=$acronyms[($currGame*2)+1]?>-logo">
					<img src="http://a.espncdn.com/combiner/i?img=/i/teamlogos/ncaa/500/<?=$espn_ids[($currGame*2)+1]?>.png?w=200&h=200&transparent=true" class="logo" alt="team name" /><br />	
					<span class="team-score"><img src="images/numbers/0.jpg" alt="0" /></span>
				</div>
				<div class="back" id="<?=$acronyms[(($currGame+1)*2)+1]?>-logo">
					<img src="http://a.espncdn.com/combiner/i?img=/i/teamlogos/ncaa/500/<?=$espn_ids[(($currGame+1)*2)+1]?>.png?w=200&h=200&transparent=true" class="logo" alt="team name" /><br />	
					<span class="team-score"><img src="images/numbers/0.jpg" alt="0" /></span>
				</div>
			</div>
		</div>

		<div class="stat-placeholder">
			<div class="stats team1-stats">			
				<div class="front" id="<?=$acronyms[$currGame*2]?>-stats">
					<h3><span class="hashtag">Latest</span> Tweets</h3>
					<ul class="tweets">
					</ul>
				</div>
				<div class="back" id="<?=$acronyms[($currGame+1)*2]?>-stats">
					<h3><span class="hashtag">Latest</span> Tweets</h3>
					<ul class="tweets">
					</ul>
				</div>
			</div>
		</div>
		
		<div class="stat-placeholder">				
			<div class="stats team2-stats">			
				<div class="front" id="<?=$acronyms[($currGame*2)+1]?>-stats">
					<h3><span class="hashtag">Latest</span> Tweets</h3>
					<ul class="tweets">
					</ul>
				</div>
				<div class="back" id="<?=$acronyms[(($currGame+1)*2)+1]?>-stats">
					<h3><span class="hashtag">Latest</span> Tweets</h3>
					<ul class="tweets">
					</ul>
				</div>
			</div>
		</div>

		<div class="top-scorer-placeholder">				
			<div class="top-scorer team1-top-scorer">
				<div class="front" id="<?=$acronyms[$currGame*2]?>-top-scorer">
					<img src="" class="twavatar" style="float: right" />
					<h3>TOP TWEETER</h3>
					<h4>@<span class="twusername"></span>: <span class="twscore"></span></h4>
				</div>
				<div class="back" id="<?=$acronyms[($currGame+1)*2]?>-top-scorer">
					<img src="" class="twavatar" style="float: right" />
					<h3>TOP TWEETER</h3>
					<h4>@<span class="twusername"></span>: <span class="twscore"></span></h4>
				</div>
			</div>
		</div>
	
		<div class="top-scorer-placeholder">				
			<div class="top-scorer team2-top-scorer">
				<div class="front" id="<?=$acronyms[($currGame*2)+1]?>-top-scorer">
					<img src="" class="twavatar" style="float: right" />
					<h3>TOP TWEETER</h3>
					<h4>@<span class="twusername"></span>: <span class="twscore"></span></h4>
				</div>
				<div class="back" id="<?=$acronyms[(($currGame+1)*2)+1]?>-top-scorer">
					<img src="" class="twavatar" style="float: right" />
					<h3>TOP TWEETER</h3>
					<h4>@<span class="twusername"></span>: <span class="twscore"></span></h4>
				</div>
			</div>
		</div>
		
		<img src="images/vs.png" alt="versus" class="versus" />

		<div id="icfi-top-scorer" style="position: relative;">
			<img src="images/logos/icfi.png" alt="ICFI" />
			<h2>Top<br />Scorer</h2>
			<p>
				@<span class="username"></span>: <span class="score"></span>
				<img src="http://placehold.it/50x50" class="avatar" />
				
			</p>
		</div>
	</section>

	
	<section class="score-column east">
		<ul>
			<?php $i=8; for ($a=16; $a < 32; $a=$a+4): ?>
			<li class="game">
				<div class="fixture">
					<div class="front" id="game<?=$i?>">
						<div class="team1" id="<?=$acronyms[$a]?>">
							<img src="http://a.espncdn.com/combiner/i?img=/i/teamlogos/ncaa/500/<?=$espn_ids[$a]?>.png?w=70&h=70&transparent=true" alt="team name" />
							<span class="team-acronym"><?=$acronyms[$a]?></span>
							<span class="team-score">0</span>
						</div>
						<div class="team2" id="<?=$acronyms[$a+1]?>">
							<img src="http://a.espncdn.com/combiner/i?img=/i/teamlogos/ncaa/500/<?=$espn_ids[$a+1]?>.png?w=70&h=70&transparent=true" alt="team name" /> 
							<span class="team-acronym"><?=$acronyms[$a+1]?></span>
							<span class="team-score">0</span>
						</div>
					</div>
					<?php $i++ ?>
					<div class="back" id="game<?=$i?>">
						<div class="team1" id="<?=$acronyms[$a+2]?>">
							<img src="http://a.espncdn.com/combiner/i?img=/i/teamlogos/ncaa/500/<?=$espn_ids[$a+2]?>.png?w=70&h=70&transparent=true" alt="team name" />
							<span class="team-acronym"><?=$acronyms[$a+2]?></span>
							<span class="team-score">0</span>
						</div>
						<div class="team2" id="<?=$acronyms[$a+3]?>">
							<img src="http://a.espncdn.com/combiner/i?img=/i/teamlogos/ncaa/500/<?=$espn_ids[$a+3]?>.png?w=70&h=70&transparent=true" alt="team name" />
							<span class="team-acronym"><?=$acronyms[$a+3]?></span>
							<span class="team-score">0</span>
						</div>
					</div>
					<?php $i++ ?>
				</div>
			</li>
			<?php endfor; ?>
		</ul>
	</section>
	<img src="images/logos/twitter-bird-light-bgs.png" alt="Powered by Twitter. Built by ICF Ironworks" class="twitter-bird" />
</div>
</body>
</html>