<!-- Main file where all the user actions take place -->
<?php
include 'authentication.php';
require 'php/login/fbconfig.php';
session_start();
//Facebook Login Check. Instructions given at: https://developers.facebook.com/docs/facebook-login/manually-build-a-login-flow/v2.0
//if access is denied, go back to the landing page
if ($_GET["error"] == "access_denied")
header("Location: /");
else {
//Save the code received from facebook
$code = $_GET["code"];
//Get access_token from Facebook
//$access_token = readfile("https://graph.facebook.com/oauth/access_token?client_id=834481703238074&redirect_uri=http://lifewin.co/app.php&client_secret=347633e603fd132fd38abaca14034e01&code=$code");
//$access_token= substr((string)$access_token,13,-1);
//echo $access_token;
}
?>
<?php //print_r($_SESSION); ?>
<!doctype html>
<HTML>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<HEAD>
<!-- Change the favicon path in app.php -->
<link rel="shortcut icon" href="img/favicon.ico" />
<title>LifeWin - Habits to Success</title>
<link rel="stylesheet" href="css/jquery-ui.css">
<script src="js/jquery-2.0.3.min.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/jquery.ui.touch-punch.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<link href="css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/shield.css">
<link rel="stylesheet" type="text/css" href="custom.css">
<script src="js/goal.js"></script>
<script src="js/stopwatch.js"></script>
<script src="js/moment.min.js"></script>
<!--<script src="angularJS/angular.min.js"></script>-->
<script src="js/shield.js" type = "text/javascript"></script>
<script>
if (localStorage.getItem("list") === null) {
localStorage.setItem("background", bg1);
}
if (localStorage.getItem("background") == bg1) {
document.getElementById("maincontentofwebsite").style.background = "url(img/bg1.jpg)";
}
if (localStorage.getItem("background") == bg2) {
document.getElementById("maincontentofwebsite").style.background = "url(img/bg2.jpg)";
}
if (localStorage.getItem("background") == bg3) {
document.getElementById("maincontentofwebsite").style.background = "url(img/bg3.jpg)";
}
if (localStorage.getItem("background") == bg4) {
document.getElementById("maincontentofwebsite").style.background = "url(img/bg4.jpg)";
}
if (localStorage.getItem("background") == bg5) {
document.getElementById("maincontentofwebsite").style.background = "url(img/bg5.jpg)";
}
if (localStorage.getItem("background") == bg6) {
document.getElementById("maincontentofwebsite").style.background = "url(img/bg6.jpg)";
}
</script>
<!--  All the timer related js code has now been moved to stopwatch.js -->
</HEAD>
<BODY>
<div class="selection-error" style="display: none;"></div>
<div class="selection-success" style="display: none;"></div>
<!-- Popover when a list item is clicked -->
<!-- SideBar From: http://bootply.com/88026 -->
<div class="page-container">
<header>
<div id="headerNav">
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
<div class="container">
<div class="row">
<!-- Brand and toggle get grouped for better mobile display -->
<div class="navbar-header col-xs-2">
<h1 id="logo"><a href="http://lifewin.co/index.php"><img src="img/logo.PNG" height="50" width="200" alt="logo" ></a></h1>
</div>
<!-- Collect the nav links, forms, and other content for toggling -->
<div class="col-xs-10">
<ul class="nav navbar-nav navbar-right desktop">
<!-- For the timer
<li><a href="#" class="did-it tick_img"><?php echo "<img class=\"user_img\"src='img/circle.png' />"; ?></a></li> -->
<li >
<a href="#" class="dropdown-toggle icon-plus" data-toggle="dropdown">
<span data-placement="bottom" title="Show Timer" class="colorchange">Timer </span></a>
<ul class="dropdown-menu timer-wrapper keep_open" style="
padding: 5px;
" >
<div class="btn-group">
<button title="" type="button" class="btn btn-default b_fix icon-stopwatch" onclick="start(0);" data-original-title="Stopwatch"></button>
<button title="" type="button" class="btn btn-default b_fix icon-clock" onclick="start(1);" data-original-title="Timer"></button>
</div>
<div class = "time_div form-control">
<span id="time" class="form-control">00:00:00</span>
<span id="timeelapsed" class="form-control">00:00:00</span>
<div class = "progress_div">
<span>Work Time</span>
<div id = "progress">
</div>
</div>
<div class = "progress_div1">
<span>Rest Time</span>
<div id = "progress1">
</div>
</div>
<div class = "progress_div2">
<div id = "progress2">
</div>
</div>
<button class = "rest_btn" onclick = "start(2)" style = "display:none"></button>
</div>
<button type="button" class="glyphicon glyphicon-pause pause_btn" onclick="stop();" onmouseout="this.blur();"data-original-title="Pause" title=""></button>
<button type="button" class="glyphicon glyphicon-refresh pause_btn" onclick="reset(1);" onmouseout="this.blur();"data-original-title="Reset" title=""></button>
<div class = "clearfix"></div>
</ul>
</li>
<li><a href="#"><span data-placement="bottom" title="Daily Points" id="daily"></span></a></li>
<li><a href="#"><span data-placement="bottom" title="Weekly Points" id="weekly"></span></a></li>
<li><a href="#" class="dropdown-toggle icon-plus" data-toggle="dropdown">
<span data-placement="bottom" title="Total Points"> Add Points </span>
</a>
<ul class="dropdown-menu">
<li data-toggle="modal" data-target="#quickadd"><a href="#">Enter Value</a></li>
<li class="divider"></li>
<li><a onclick="addPoints(2);" href="#">2 points</a></li>
<li><a onclick="addPoints(5);" href="#">5 points</a></li>
<li><a onclick="addPoints(10);" href="#">10 points</a></li>
</ul>
</li>
<li class="dropdown">
<a href="#" class="dropdown-toggle" data-toggle="dropdown">
<?php
if(fblogin)
{
echo "<img class=\"user_img\" src='https://graph.facebook.com/$fbid/picture' />";
}
else
{
echo "<img class=\"user_img\" src='img/user_img.png' />";
}?>
</a>
<ul class="dropdown-menu">
<li><a href="#"><span class="glyphicon glyphicon-cog"></span>Settings</a></li>
<!-- The sync icon should be rotated on click rather than on page load-->
<li><a href="#" class="sync-btn"><span class="glyphicon glyphicon-refresh"></span>Sync</a></li>
<li><a href="logout.php"><span class="glyphicon glyphicon-off"></span>Logout</span></a></li>
</ul>
</li>
<li class="hiddenclass">
<div class="navbar-header input-group">
<span class="input-group-btn hiddenclass">
<button type="button" class="navbar-toggle btn btn-default" data-toggle="offcanvas" data-target=".sidebar-nav">
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</button>
</span>
<h2 class="navbar-brand hide" id="listname"></h2>
</div>
</li>
</ul>
<!-- <ul class="nav navbar-nav navbar-right pull-right mobile_device">
<li> <a href="#" class="dropdown-toggle" data-toggle="dropdown"> +show </a>
</li>
<li class="dropdown">
<a href="#" class="dropdown-toggle" data-toggle="dropdown">
<a href="#" class="dropdown-toggle" data-toggle="dropdown">
<?php echo "<img class=\"user_img\" src='https://graph.facebook.com/$fbid/picture' />"; ?>
<span id="username"><?php echo $fbuname ?></span>
</a>
</a>
<ul class="dropdown-menu">
<li><a href="#"><span class="glyphicon glyphicon-cog"></span>Settings</a></li>
<li><a href="#"><span class="glyphicon glyphicon-refresh"></span>Sync</a></li>
<li><a href="logout.php"><span class="glyphicon glyphicon-off"></span>Logout</span></a></li>
</ul>
</li>
</li>
<li class="hiddenclass">
<div class="navbar-header input-group">
<span class="input-group-btn hiddenclass">
<button type="button" class="navbar-toggle btn btn-default" data-toggle="offcanvas" data-target=".sidebar-nav">
<span class="icon-bar"></span>
<span class="icon-bar"></span>
<span class="icon-bar"></span>
</button>
</span>
<h2 class="navbar-brand hide" id="listname"></h2>
</div>
</li>
</ul> -->
</div>
</div>
</div><!-- /.container -->
</nav>
</div><!--headernav-->
</header>
<style>
.input-group .suggestion { display:none; }
.input-group input[type=text]:focus + .suggestion { display:block; }
.suggestion { position: absolute; width:150px; color:#fff; background:#000; top:35px; padding:5px; }
.content-wrap { max-height:60%; overflow:hidden; position:relative;top:75px}
</style>
<!-- top navbar. Fixed on top of the screen even when scrolling down-->
<div class="container content-wrap">
<div class="row row-offcanvas row-offcanvas-left">
<!-- sidebar -->
<div class="col-xs-12 col-sm-3 col-md-2 sidebar-offcanvas sidebar-position" style="margin-top:10px;">
<div id="sidebar">
<ul class="nav nav-pills nav-stacked">
<!-- class="active" and "sidebar-brand" to be used properly -->
<li class="active"><a onclick="list('Tasks');" href="#"><span data-placement="right" title="Show/Add Tasks">Tasks</span></a></li>
<li><a onclick="list('Goals');" href="#">Goals</a></li>
<li><a onclick="list('Dailies');" href="#">Daily</a></li>
<li><a onclick="list('Scoreboard');" href="#">Scoreboard</a></li>
</ul>
</div>
</div>
<div class="cols-xs-9 col-sm-9 col-md-9 list-view" style="margin-top:-65px;padding-left:15px;">
<div class="navbar navbar-default hide" role="navigation">
<div class="container-head">
<!--Navbar modified with use of inputgroup buttons From: http://getbootstrap.com/components/#input-groups-->
</div>
</div>
<!-- Main Content of the whole website -->
<div class="inner-content-wrapper">
<form id="input" onSubmit="save(); return false;" >
<!-- Input styling From: http://getbootstrap.com/components/#input-groups -->
<div class="input-group">
<input type="text" class="form-control" name="newEntry" id="newEntry" placeholder="New Goal">
<span class="suggestion"> Add your new Task </span>
<span class="input-group-btn">
<button class="btn btn-default" type="button" onClick="save();
return false;">ADD</button></span>
</div>
</form>
<!--1. Doesn't gets included in goalsNames 2. No list item can be dragged above -->
<ul class="sortable list-group">
<li class="tags list-group-item" id="tag0">
<!--Collapse/Show List Icons removed - they were confusing the users - users think that clicking on them will reveal what they are to do for the day
<span id="tagIcon0"></span>-->
<!--Sperate span for the text because otherwise the "badge" class span would get deleted!-->
<span id="firstTag"></span>
<span id="tagCount0" class="badge"></span>
</li>
</ul>
<!--"list-group" class is a requirement for bootstrap-->
<ul id="list" class="sortable list-group"></ul>
<!-- This part opens up list options separately. By default it is hidden. -->
<div class="inner-content-wrapper rightform" style="display:none; position: absolute; top:0; left:70%; width:30%;">
<div class="input-group" style="margin-bottom:10px;">
<input type="text"  name="newEntry" id="newEntry" class="datepicker form-control" placeholder="Set Date">
<span class="input-group-btn">
<span class="  btn btn-default" ><span class="glyphicon glyphicon-calendar"></span></span></span>
</div>
<div class="input-group" style="margin-bottom:10px;">
<input type="text" class="datepicker form-control" name="newEntry" id="newEntry" placeholder="Set Date">
<span class="input-group-btn">
<button class="btn btn-default" type="button"><span class="glyphicon glyphicon-time"></span></button></span>
</div>
<div class="input-group" style="margin-bottom:10px;">
<input type="text" class="form-control" name="newEntry" id="newEntry" placeholder="Task Details">
<span class="input-group-btn">
<button class="edit btn btn-default" type="button" onClick="save();
return false;"><span class="glyphicon glyphicon-pencil"></span></button></span>
</div>
<div class="input-group" style="margin-bottom:10px;">
<span class="input-group-btn">
<button class="btn btn-default" type="button" style="width:100%"><span class="glyphicon glyphicon-trash"></span></button></span>
<span class="input-group-btn lock">
<button class="btn btn-default" type="button" style="width:100%"><span class="glyphicon glyphicon-lock"></span></button></span>
</div>
</div>
</div>
</div>
<!-- Added a third column shrinking whatever column that existed previously. -->
<div class="col-xs-5 col-sm-5 col-md-5 details-view" style="margin-top:10px">
	<div class = "details row">
		<div class = "col-sm-8 col-md-8 lpad head-details">
		<h3 class = "edit-title"></h3>
		</div>
		<div class = "col-sm-8 col-md-8 lpad input-group">
			<input type="text" class="form-control datepicker duedatepicker" placeholder="Set Due Date" name = "duedate" style="display:block"/><span class = "input-group-addon cal-due cal-trigs"><i class="glyphicon glyphicon-calendar"></i></span>
		</div>
		<div class = "col-sm-8 col-md-8 lpad input-group">
			<input type="text" class="form-control datepicker reminder" placeholder="Set Reminder" name = "reminder"/><span class = "input-group-addon cal-rem cal-trigs"><i class="glyphicon glyphicon-calendar"></i></span>
		</div>
		<div class = "col-sm-8 col-md-8 lpad input-group">
			<button class = "btn btn-primary edit-div" style = "margin-right:1em;" title="Edit Task Title"><span class="glyphicon glyphicon-pencil"></span></button>
			<button class = "btn btn-primary delete-div" style = "margin-right:1em;" title="Delete Task"><span class="glyphicon glyphicon-trash"></span></button>
			<button class = "btn btn-primary hide-details-div" title="Hide Side Pane"><span class="glyphicon glyphicon-share-alt"></span></button>
			<div class = "edit-points"></div>
		</div>
	</div>
</div>
<script>
$('body').on('click','.extender',function(){
	$('.list-view').attr('class', 'col-xs-5 col-sm-5 col-md-5 list-view');
	$('.details-view').show();
	$('.extender').not(this).removeClass('activeext');
	$(this).addClass('activeext');
	$('.head-details h3').html($(this).find('span').first().text());
});
$('body').on('click','.edit-div', function(){
	$('.edit-title').attr('contenteditable','true').focus();
});
$('.edit-title').on('focus',function(){
	$('.edit-title').on('keydown',function(e){
		if(e.keyCode == 13){
			$(this).blur();
		}
	});
});
$('.edit-title').on('blur',function(){
	var newValue = $(this).text();
	if($.trim(newValue).length > 0){
	 if($.inArray(newValue,JSON.parse(localStorage.getItem("TasksNames")) ) < 0){
		var oldValue = $('.activeext').find('span').first().text();
		$('.activeext').find('span').first().text(newValue);
		var pos = $('.activeext').attr('id').split('g');
		pos = pos[1];
		if((oldValue!=newValue)&&(newValue!=""))
			edit(oldValue, newValue);
		$(this).attr('contenteditable', 'false');
	 }
	} else {
		var oldValue = $('.activeext').find('span').first().text();
		$('.edit-title').text(oldValue);
	}
});
$('body').on('click','.delete-div',function(){
	var pos = $('.activeext').attr('id').split('g');
	pos = pos[1];
	del(pos);
	$('.list-view').attr('class', 'col-xs-9 col-sm-9 col-md-9 list-view');
	$('.details-view').hide();
});
$('body').on('click','.hide-details-div',function(){
	$('.list-view').attr('class', 'col-xs-9 col-sm-9 col-md-9 list-view');
	$('.details-view').hide();
});
$('body').on('click','.edit-points', function(){
	$('.edit-points').attr('contenteditable','true').focus();
});
$('.edit-points').on('focus',function(){
	$(this).css({'color':'#2a1333'});
	var point = $(this).text().split(" ");
	$(this).empty();
	if($.isNumeric($.trim(point[0]))){
		$(this).text(point[0]);
	}
	
	$('.edit-points').on('keydown',function(e){
		if(e.keyCode == 13){
			$(this).blur();
		}
	});
});
$('.edit-points').on('blur',function(e){
	var nValue = $(this).text();
	if($.trim(nValue).length > 0 ){
		$(this).attr('contenteditable', 'false');
		if($.isNumeric($.trim(nValue))){
			//Need help with accessing the appropriate storage element via json parsing
			//alert('storage function');
			$(this).html("<strong>"+ nValue + "</strong> points for this task");
		} else {
			//alert('Enter A Valid Number');
		}
		$(this).css({'color':'#2a1333'});
	} else {
		$(this).empty();
		$(this).html('Set Points for this task');
		$(this).css({'color':'#c5c5c5'});
		$(this).attr('contenteditable', 'false');
	}
	e.stopPropagation();
	e.stopImmediatePropagation();
});
</script>
</div>
</div>
<!-- Footer to have the QuickAdd, Timer, Stopwatch, Meassage Text and Stop buttons -->
<div class="footer hide">
<div class="container">
<!--From: http://getbootstrap.com/components/#input-groups -->
<div class="input-group">
<span class="input-group-btn">
<button type="button" class="btn btn-default b_fix icon-stopwatch" onclick="start(0);">
<!-- Halfling used earlier
<span class="glyphicon glyphicon-time"></span>-->
</button>
</span>
<span class="input-group-btn">
<button type="button" class="btn btn-default b_fix icon-clock" onclick="start(1);">
<!-- Halfling used earlier
<span class="glyphicon glyphicon-bell"></span>-->
</button>
</span>
<span id="time" class="form-control"></span>
<span class="input-group-btn">
<button type="button" class="btn btn-default b_fix stop_fix" onclick="stop();" onmouseout="this.blur();">STOP</button>
</span>
</div>
</div>
</div>
</div>
<!-- QuickAdd Implemented using Modal from: http://getbootstrap.com/javascript/#modals -->
<div class="modal fade" id="quickadd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<h4 class="modal-title" id="myModalLabel">Quick Add</h4>
</div>
<div class="modal-body">
<form id="quickAdd" >
<input type="number" min="0" class="form-control" name="quickadd" id="points" placeholder="Points to Add">
</form>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
<button type="button" class="btn btn-primary" onclick="addPoints('quickAdd');" data-dismiss="modal">Save</button> <!--Send Message to addPoints() function to check the quickAdd's form's value -->
</div>
</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</BODY>
</HTML>
