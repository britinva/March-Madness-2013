<!DOCTYPE html>
<html lang="en">
<?php
$teams = array(
	"Valparaiso",
	"Michigan State",
	"Bucknell",
	"Butler",
	"Wichita State",
	"Pittsburgh",
	"New Mexico State",
	"Saint Louis",
	"Memphis",
	"Saint Mary’s",
	"Davidson",
	"Marquette",
	"Southern",
	"Gonzaga",
	"Oregon",
	"Oklahoma State",
	"North Carolina A&T",
	"Louisville",
	"South Dakota State",
	"Michigan",
	"Belmont",
	"Arizona",
	"California",
	"UNLV",
	"Missouri",
	"Colorado State",
	"Akron",
	"VCU"
);
$espn_ids = array(
	2674,
	127,
	2083,
	2086,
	2724,
	221,
	166,
	139,
	235,
	2608,
	2166,
	269,
	2582,
	2250,
	2483,
	197,
	2448,
	97,
	2571,
	130,
	130,
	12,
	25,
	2439,
	142,
	36,
	2006,
	2670
);
$acronyms = array(
	"VALP",
	"MSU",
	"BUCK",
	"BUT",
	"WICH",
	"PITT",
	"NMSU",
	"SLU",
	"MEM",
	"STM",
	"DAV",
	"MARQ",
	"SOU",
	"GONZ",
	"ORE",
	"OKST",
	"NCAT",
	"LOU",
	"SDST",
	"MICH",
	"BEL",
	"ARIZ",
	"CAL",
	"UNLV",
	"MIZZ",
	"CSU",
	"AKR",
	"VCU"
 );
?>
<head>
	<title>ICFI Sports</title>
	<link href='http://fonts.googleapis.com/css?family=Graduate' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Merriweather+Sans:400,700' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Roboto:400,900' rel='stylesheet' type='text/css'>
	<link href='css/style.css' rel='stylesheet' type='text/css'>

	<style>
		.player-stats {position: relative;}
		.card {width: 70%; background-color: #000; color: #fff; border: solid 3px white; margin-top: 50px; padding: 50px; position: absolute; top: 0; left: 15%;}
	</style>
	
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js" type="text/javascript"></script>
	<script>
		function goToGame(slideNum) {
			$('.scoreboard .plane').css('left', -slideNum * $('.arena').width() + 'px');
			// animation loop for stat screens
			$('.card:visible').css('opacity', 0);
			$('.team1-topplayer').css('opacity', 1);
			var card2 = setTimeout(function(){
				$('.card:visible').css('opacity', 0);
				$('.team1-tweets').css('opacity', 1);
			}, 5000);
			var card3 = setTimeout(function(){
				$('.card:visible').css('opacity', 0);
				$('.team2-topplayer').css('opacity', 1);
			}, 10000);
			var card4 = setTimeout(function(){
				$('.card:visible').css('opacity', 0);
				$('.team2-tweets').css('opacity', 1);
			}, 15000);
		}

		function tickerTape() {
			showNews();
			queueNews();
			setTimeout(function(){
				removeNews();
			},5000);
		}
		
		function removeNews() {
			$('.current').addClass("offscreen").removeClass("current");
		}

		function showNews() {
			$('.queued-up').addClass("current").removeClass("queued-up");
		}

		function queueNews() {
			$('.offscreen').addClass("queued-up").removeClass("offscreen");
		}

		function getScores() {
			$(".points").removeClass("updated");
			$.getJSON("data/getScores.php", function(data) {
				var items = [];
				var i = 0;
				$.each(data, function(key, val) {
					prevScore = $("."+val.name+"-score").html();
					newScore = val.score;
					if (newScore != prevScore) {
						$("."+val.name+"-score").html(val.score).addClass("updated");
					}
					i++;
					//alert(val.score);
				});
			});
		}



		function getTopScorers() {
			$.getJSON("data/getTopICF.php", function(data) {
				$.each(data, function(key, val) {
					//alert(val.school+"=>"+val.tweets[0].user+" ("+val.tweets[0].count+") "+val.tweets[0].avatar);
					$(".img-"+val.school+"-topplayer").attr("src", val.tweets[0].avatar);
					$(".user-"+val.school+"-topplayer").html(val.tweets[0].user);
					
				});
			});
		}


		function getLatestTweets() {
			$.getJSON('data/getAllICFtweets.php', function(data) {
				$.each(data, function(key, val) {
					alert(val.school);
					//alert(val.tweets[0].user);
				});
			});
		}
		
		
		$(function() {
			getScores();
			goToGame(0);
			getTopScorers();
			var updateScores = setInterval(function(){
				getScores();
			},5000);
			
			//fullScreen();
			var scrollGame = setInterval(function(){
				var game = Math.floor(Math.random()*16);
				goToGame(game);
			},20000);

			tickerTape();
			var tickerTimer = setInterval(function(){
				var game = Math.floor(Math.random()*16);
				tickerTape();
			},10000);
			
			$(".score").click(function(){
				var game = ($(this).attr("id"));
				goToGame(game.substr(5));
				clearInterval(myVar);
			});
		});
		
		
	</script>
	
</head>
<body>
<div class="display">
	<aside class="left">
		<h3>Tweet Madness</h3>
		<ul class="todays-games">
			<?php $i=0; for ($a=0; $a < 16; $a=$a+2): ?>
			<li class="score" id="game-<?=$i++ ?>">
				<div><img src="<?="http://a.espncdn.com/combiner/i?img=/i/teamlogos/ncaa/500/".$espn_ids[$a].".png?w=65&h=65&transparent=true"?>" alt="<?=$acronyms[$a]?>" class="logo" /><br /><span class="points <?=$acronyms[$a]?>-score">0</span></div>
				<div><img src="<?="http://a.espncdn.com/combiner/i?img=/i/teamlogos/ncaa/500/".$espn_ids[$a+1].".png?w=65&h=65&transparent=true"?>" alt="<?=$acronyms[$a+1]?>" class="logo" /><br /><span class="points <?=$acronyms[$a+1]?>-score">0</span></div>
			</li>
			<?php endfor; ?>
		</ul>
	</aside>
	<aside class="right">
		<h3>5:15 PM</h3>
		<ul class="todays-games">
			<?php $i=8; for ($a=16; $a < 32; $a=$a+2): ?>
			<li class="score" id="game-<?=$i++ ?>">
				<div><img src="<?="http://a.espncdn.com/combiner/i?img=/i/teamlogos/ncaa/500/".$espn_ids[$a].".png?w=65&h=65&transparent=true"?>" alt="<?=$acronyms[$a]?>" class="logo" /><br /><span class="points <?=$acronyms[$a]?>-score">0</span></div>
				<div><img src="<?="http://a.espncdn.com/combiner/i?img=/i/teamlogos/ncaa/500/".$espn_ids[$a+1].".png?w=65&h=65&transparent=true"?>" alt="<?=$acronyms[$a+1]?>" class="logo" /><br /><span class="points <?=$acronyms[$a+1]?>-score">0</span></div>
			</li>
			<?php endfor; ?>
		</ul>
	</aside>
	<section class="main">
		<div class="scoreboard">
			<div class="plane">
				<?php $i=0; for ($a=0; $a < 32; $a=$a+2): ?>			
				<div class="arena">
					<div class="court">
						<img src="<?="http://a.espncdn.com/combiner/i?img=/i/teamlogos/ncaa/500/".$espn_ids[$a].".png?w=150&h=150&transparent=true"?>" alt="<?=$teams[$a]?>" class="logo" />
						<img src="<?="http://a.espncdn.com/combiner/i?img=/i/teamlogos/ncaa/500/".$espn_ids[$a+1].".png?w=150&h=150&transparent=true"?>" alt="<?=$teams[$a+1]?>" class="logo" />
						<table class="latest-score">
							<tr>
								<td class="team"><?=$teams[$a]?></td>
								<td class="points <?=$acronyms[$a]?>-score">0</td>
							</tr>
							<tr>
								<td class="team"><?=$teams[$a+1]?></td>
								<td class="points <?=$acronyms[$a+1]?>-score">0</td>
							</tr>
						</table>
						<div class="player-stats">
						
							<div class="card team1-topplayer">
								<h3><?=$acronyms[$a]?> Top Player</h3>
								<img src="http://placehold.it/50x50" class="avatar img-<?=$acronyms[$a]?>-topplayer" /><br />
								<span class="username user-<?=$acronyms[$a]?>-topplayer">@britinva</span>
							</div>
							
							<div class="card team1-tweets">
								<table class="tweets">
									<tr>
										<th colspan="2"><?=$acronyms[$a]?> Tweets</th>
									</tr>								
									<tr>
										<td class="avatar"><img src="http://placehold.it/50x50"/></td>
										<td class="tweet">
											@username<br />
											Slow Glass by @adactio sums up my thoughts on Google Glass and new technology too: adactio.com/journal/6123/
										</td>
									</tr>
									<tr>
										<td class="avatar"><img src="http://placehold.it/50x50"/></td>
										<td class="tweet">
											@username<br />
											Slow Glass by @adactio sums up my thoughts on Google Glass and new technology too: adactio.com/journal/6123/
										</td>
									</tr>
								</table>
							</div>

							<div class="card team2-topplayer">
								<h3><?=$acronyms[$a+1]?> Top Player</h3>
								<img src="http://placehold.it/50x50" class="avatar img-<?=$acronyms[$a+1]?>-topplayer" /><br />
								<span class="username user-<?=$acronyms[$a+1]?>-topplayer">@britinva</span>
							</div>

							<div class="card team2-tweets">
								<table class="tweets">
									<tr>
										<th colspan="2"><?=$acronyms[$a+1]?> Tweets</th>
									</tr>								
									<tr>
										<td class="avatar"><img src="http://placehold.it/50x50"/></td>
										<td class="tweet">
											@username<br />
											Slow Glass by @adactio sums up my thoughts on Google Glass and new technology too: adactio.com/journal/6123/
										</td>
									</tr>
									<tr>
										<td class="avatar"><img src="http://placehold.it/50x50"/></td>
										<td class="tweet">
											@username<br />
											Slow Glass by @adactio sums up my thoughts on Google Glass and new technology too: adactio.com/journal/6123/
										</td>
									</tr>
								</table>
							</div>
						</div>
					</div>
				</div>
				<?php endfor; ?>
			</div>
		</div>
	</section>
	<footer>
		<div class="marquee">
			<p class="queued-up">britinva: Slow Glass by @adactio sums up my thoughts on Google Glass and new technology too: adactio.com/journal/6123/</p>
			<p class="offscreen">rustbolt: 2013 AIGA FRESH Award Submission now open at aigafresh.com. Are You FRESH Enough? FREE for members!</p>
		</div>
	</footer>
</div>
</body>
</html>