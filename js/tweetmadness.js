function goFullscreen(id) {
	var element = document.getElementById(id);

	if (element.mozRequestFullScreen) {
		element.mozRequestFullScreen();
	} else if (element.webkitRequestFullScreen) {
		element.webkitRequestFullScreen();
	}
}


function scoreboard(score) {
	var strScore = String(score);
	var strHTML = "";
	for (var i = 0; i < strScore.length; i++) {
    	strHTML = strHTML + "<img src='images/numbers/"+strScore.charAt(i)+".jpg' alt='"+strScore.charAt(i)+"' />";
    }
	//alert(strHTML);
    return strHTML;
}


function getScores() {
	$(".team-score").removeClass("updated");
	$.getJSON("data/getScores.php", function(data) {
		var items = [];
		var i = 0;
		$.each(data, function(key, val) {
			prevScore = $("#"+val.name+" .team-score").html();
			newScore = val.score;
			$("#"+val.name+"-logo .team-score").html(scoreboard(val.score));
			if (newScore != prevScore) {
				$("#"+val.name+" .team-score").html(val.score).addClass("updated");
			}
			i++;
		});
	});
}



function getTweets() {
	$.getJSON("data/getAllICFtweets.php", function(data) {
		$.each(data, function(key, val) {
			var tweetCount = val.tweets.length;
			if (tweetCount > 5) {tweetCount = 5;}
			$("#"+val.school+"-stats .tweets").empty();					

			for ( i = 1; i < tweetCount; i++) {
				var listitem = '<li><strong class="twusername">'+val.tweets[i-1].user+'</strong> <span class="tweet">'+val.tweets[i-1].text+'</span></li>';
				$("#"+val.school+"-stats .tweets").append(listitem);
			}
		});				
	});
}


function getTopScorer() {
	$.getJSON("data/getTopAlltweeters.php", function(data) {
		$.each(data, function(key, val) {
			//alert(val.school);
			$('#'+val.school+'-top-scorer .twusername').html(val.tweets[0].user);
			$('#'+val.school+'-top-scorer .twscore').html(val.tweets[0].count);
			$('#'+val.school+'-top-scorer .twavatar').attr("src", val.tweets[0].avatar);
		});
	});
}

function getTopICF() {
	$.getJSON("data/getTopICF.php", function(data) {
		$.each(data, function(key, val) {
			$('#icfi-top-scorer .username').html(val.tweets[0].user);
			$('#icfi-top-scorer .score').html((val.tweets[0].count)*3+' pts');
			$('#icfi-top-scorer .avatar').attr("src", val.tweets[0].avatar);
		});
	});
}


function getNextGame(n) {
	if(n % 2 == 0) {
	
		$('.team1-logo .front').removeAttr('id');
		$('.team2-logo .front').removeAttr('id');
		$('.stats .front').removeAttr('id');
		$('.top-scorer .front').removeAttr('id');

		$('.team1-logo .front').attr('id', data.games[n].team1.name+'-logo');
		$('.team2-logo .front').attr('id', data.games[n].team2.name+'-logo');
		$('.team1-stats .front').attr('id', data.games[n].team1.name+'-stats');
		$('.team2-stats .front').attr('id', data.games[n].team2.name+'-stats');
		$('.team1-top-scorer .front').attr('id', data.games[n].team1.name+'-top-scorer');
		$('.team2-top-scorer .front').attr('id', data.games[n].team2.name+'-top-scorer');

		$(".team1-stats .front .hashtag").html('#'+data.games[n].team1.hashtag);
		$(".team2-stats .front .hashtag").html('#'+data.games[n].team2.hashtag);
		
		$('.team1-logo .front .logo').attr('src', 'http://a.espncdn.com/combiner/i?img=/i/teamlogos/ncaa/500/'+data.games[n].team1.espn_id+'.png?w=200&h=200&transparent=true');
		$('.team2-logo .front .logo').attr('src', 'http://a.espncdn.com/combiner/i?img=/i/teamlogos/ncaa/500/'+data.games[n].team2.espn_id+'.png?w=200&h=200&transparent=true');
		
	} else {

		$('.team1-logo .back').removeAttr('id');
		$('.team2-logo .back').removeAttr('id');			
		$('.stats .back').removeAttr('id');
		$('.top-scorer .back').removeAttr('id');
		
		$('.team1-logo .back').attr('id', data.games[n].team1.name+'-logo');
		$('.team2-logo .back').attr('id', data.games[n].team2.name+'-logo');			
		$('.team1-stats .back').attr('id', data.games[n].team1.name+'-stats');
		$('.team2-stats .back').attr('id', data.games[n].team2.name+'-stats');
		$('.team1-top-scorer .back').attr('id', data.games[n].team1.name+'-top-scorer');
		$('.team2-top-scorer .back').attr('id', data.games[n].team2.name+'-top-scorer');

		$(".team1-stats .back .hashtag").html('#'+data.games[n].team1.hashtag);
		$(".team2-stats .back .hashtag").html('#'+data.games[n].team2.hashtag);

		$('.team1-logo .back .logo').attr('src', 'http://a.espncdn.com/combiner/i?img=/i/teamlogos/ncaa/500/'+data.games[n].team1.espn_id+'.png?w=200&h=200&transparent=true');
		$('.team2-logo .back .logo').attr('src', 'http://a.espncdn.com/combiner/i?img=/i/teamlogos/ncaa/500/'+data.games[n].team2.espn_id+'.png?w=200&h=200&transparent=true');
		
	}
	getTweets();		
	getTopScorer();
}


function getStats(n) {
	$('.stats').removeAttr('id');
	$('.team1-stats').attr('id', data.games[n].team1.name+'-stats');
	$('.team2-stats').attr('id', data.games[n].team2.name+'-stats');
}





/* Animation Functions */

function flipScores() {
	$('.game').each(function(index) {
		setTimeout(
			function(){
				$('.game:nth-child('+index+')').toggleClass('tails');
			},
		index*300);
	});
}


function flipFeatured() {
	$('.logo-placeholder').toggleClass('tails');
}


function flipStats() {
	$('.stat-placeholder').toggleClass('tails');
}


function flipScorer() {
	$('.top-scorer-placeholder').toggleClass('tails');
}


function scrollTweets(x) {
	currPos = x*-120;
	$('.tweets li').css('top', currPos+'px');
	//alert(currPos[0]);
}

/* Main Loop */
var featuredGame = 0;
var tick = 30*1000;

$(function() {
/*
	getTweets();
	getTopScorer();
*/
	getScores();
	getTopICF();
	getStats(featuredGame);
	featuredGame++;
	getNextGame(featuredGame);
	var scrollPos = 0;
	
	var scoreFlip = setInterval(function(){
		flipScores();
		scrollPos++;
		if (scrollPos > 3) scrollPos = 0;
		setTimeout(function() {scrollTweets(scrollPos);}, 500);
		
	},tick/4);
	
	var scoreFlip = setInterval(function(){
		getScores();
	},tick);
	var scoreFlip = setInterval(function(){
		getStats(featuredGame);
		featuredGame++;
		if (featuredGame > 15) featuredGame = 0;				
		flipFeatured();
		setTimeout("getNextGame(featuredGame)", 2000);
	},tick);
	var statFlip = setInterval(function(){
		setTimeout("flipStats()", 250);
		setTimeout("flipScorer()", 500);
	},tick);
	var topICF = setInterval(function(){
		getTopICF();
	},tick*4);
});
