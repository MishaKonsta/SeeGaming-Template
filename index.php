<?php 

error_reporting(0);

include "config.php";
$stats = ''; $comments = '';
if($config['enable_graph'] == 'on') $stats = '-stats';
if($config['enable_reviews'] == 'on') $comments = '-comments';
$url = 'https://seegaming.com/web/jsonapi'.$stats.''.$comments.'-'.$config['seegaming_id'].'.js';
$contents = file_get_contents($url); 
$contents = utf8_encode($contents); 
$results = json_decode($contents); 
?>
<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="en"> <!--<![endif]-->

<head>
	<meta charset="utf-8">
	<title><?php echo $config['server_logo']; ?> - <?php echo $results->{'gamename'}; ?> server</title>
	<meta name="keywords" content="gaming, server, play, online, <?php echo $results->{'game'}; ?>">
	<meta name="description" content="<?php echo $config['short_description']; ?>">	
	<link rel="shortcut icon" href="https://seegaming.com/images/favicons/<?php echo $results->{'game'}; ?>.ico" type="image/x-icon">	
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">		
	<link href="css/bootstrap.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
	<link href="css/fa-icons/css/font-awesome.min.css" rel="stylesheet">
	
	<?php if($config['style_theme'] == 'dark' OR $config['style_theme'] == 'white' OR $config['style_theme'] == 'blue') { echo '<link href="css/colors/'.$config['style_theme'].'.css" rel="stylesheet"> '; }
	else echo '<link href="css/colors/white.css" rel="stylesheet"> ';?>


	<!-- Google Fonts -->
	<link href='https://fonts.googleapis.com/css?family=Raleway:400,700,800&amp;subsetting=all' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400italic,400,800,700,300' rel='stylesheet' type='text/css'>
	
</head>

<body data-spy="scroll" data-target=".navigation">
	
    <div id="banner" class="bg-blur" style="<?php 
			if($config['header_background'] == '') echo "background-image:url(https://seegaming.com/images/backgrounds/".$results->{'game'}.".jpg)"; 
			else echo "background-image:url(".$config['header_background'].")";
			?>">
		<!-- Start Header -->
		<div id="header">
			<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
				<div class="container">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand text-logo" href="#"><i class="icon-rocket blue"></i><?php echo $config['server_logo']; ?></a>
					</div>
					<div class="navigation navbar-collapse collapse">
						<ul class="nav navbar-nav menu-right">
							<li class="active"><a href="#banner">Home</a></li>
							<li><a href="#about">About</a></li>
							<li><a href="#monitoring">Monitoring</a></li>
							<?php	if($config['enable_graph'] == 'on') { ?><li><a href="#statistic">Statistic</a></li><?php } ?>
							<?php	if($config['enable_graph'] != '') { ?><li><a href="#news">News</a></li><?php } ?>
							<li><a href="<?php echo $config['link_url']; ?>"><?php echo $config['link_name']; ?></a></li>
						</ul>
					</div>
				</div>
			</nav>
		</div>
		<div class="banner-content">
			<div class="container">
				<div class="row">
					<div class="col-md-7 col-sm-7">
						<h1><strong><?php echo $results->{'gamename'}; ?></strong> Server</h1>
						<p><?php echo $config['short_description']; ?></p>
					</div>
					<div class="col-lg-4 col-md-4 col-md-offset-1 col-sm-5">
						<div class="banner-form">
							<div class="form-title">
								<h2>Server online</h2>
							</div>
							<div class="form-body">
								<table class="table" style="color:#fff"> 
								<tbody> <tr> <td><h5>Now playing</h5></td> <td class="type-info"><?php echo $results->{'players'}; ?> / <?php echo $results->{'maxplayers'}; ?> players</td> </tr>
								
								<?php if($results->{'version'} != '') echo '<tr> <td><h5>Version</h5></td> <td class="type-info"> '.$results->{'version'}.' </td> </tr> '; ?>
								<tr> <td><h5>Mapname</h5></td> <td class="type-info"><?php echo $results->{'mapname'}; ?></td> </tr></tbody> </table>
									<a href="#monitoring" class="btn btn-default btn-submit">Full server info</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
	<section id="about" class="section">
		<div class="container">
			<div class="row">
				<div class="col-md-12 headline">
					<h2>About  <span class="blue"><?php echo $config['server_logo']; ?></span>  <?php echo $results->{'gamename'}; ?> server</h2>
					<p><?php echo $config['full_description']; ?></p>
				</div>
			</div>
			<?php if($config['enable_reviews'] == 'on') { ?> 
			
				<?php if($results->{'comment1'} != '') { ?> 
	
				<center><div class="carousel slide carousel-mod" data-ride="carousel" id="testimonial">
						<div class="carousel-inner">
							<div class="item active">
								<div class="testimonial-inner">
									
									<p><?php echo $results->{'comment1'}; ?></p>
									<small>by <?php echo $results->{'author1'}; ?></small>
								</div>
							</div>
							<?php if($results->{'comment2'} != '') { ?> 
							<div class="item">
								<div class="testimonial-inner">
								
									<p><?php echo $results->{'comment2'}; ?></p>
									<small>by <?php echo $results->{'author2'}; ?></small>
								</div>
							</div>		
						<?php } ?>	
						<?php if($results->{'comment3'} != '') { ?> 							
							<div class="item">
								<div class="testimonial-inner">
							
									<p><?php echo $results->{'comment3'}; ?></p>
									<small>by <?php echo $results->{'author3'}; ?></small>
								</div>
							</div>	
						<?php } ?>							
						</div>
						<ol class="carousel-indicators">
							<li data-target="#testimonial" data-slide-to="0" class="active"></li>
							<?php if($results->{'comment2'} != '') { ?> <li data-target="#testimonial" data-slide-to="1"></li><?php } ?>	
							<?php if($results->{'comment3'} != '') { ?> <li data-target="#testimonial" data-slide-to="2"></li><?php } ?>	
						</ol>
					</div></center>
					<?php 
					} 
					else
					{
					?>
					<center>No reviews for server but you can <br /><a class="btn btn-sm btn-success" href="https://seegaming.com/server-<?php echo $config['seegaming_id']; ?>#addcomment">Write a review</a></center>
					<?php } ?>
			<?php } ?>
		</div>
	</section>
    <section id="monitoring" class="section bg-grey arrow-bottom">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
				<?php
					$percent = $results->{'players'} / $results->{'maxplayers'} * 100;
				?>
					<div class="headline">
						<h2>Server info</h2>
						<h3><?php echo $results->{'hostname'}; ?></h3>
						<div class="skillbar clearfix " data-percent="<?php echo $percent; ?>%">
						<div class="skillbar-title" style="background: #2980b9;"><span>Loaded on</span></div>
						<div class="skillbar-bar" style="background: #3498db;"></div>
						<div class="skill-bar-percent Count"><?php echo $percent; ?></div>
					</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12">
					<center><h3 style="font-family: Arial;text-transform: uppercase; font-size:45px; font-weight: 700;">NOW PLAYING <?php echo $results->{'players'}; ?> / <?php echo $results->{'maxplayers'}; ?> PLAYERS</h3>
					<table class="table" style="font-size:20px; font-weight: 700;"> 
						<tr> 
							<td style="text-align:right;"><span class="colored_monitoring">MAPNAME:</span> <?php echo $results->{'mapname'}; ?></td>
							<td style="text-align:center;"><span class="colored_monitoring">VERSION:</span> <?php echo $results->{'version'}; ?></td> 
							<td style="text-align:left;"><span class="colored_monitoring">IP:</span> <?php echo $results->{'ip'}.':'.$results->{'port'}; ?></td> 
						</tr> 
					</table>
					<p><a class="btn btn-lg btn-outline btn-info" href="https://seegaming.com/go.php?serverip=<?php echo $results->{'ip'}.':'.$results->{'port'}; ?>&game=<?php echo $results->{'game'}; ?>"><img src="https://seegaming.com/images/icons/<?php echo $results->{'game'}; ?>.png" width="30px">	Connect to server</a></p>
					</center>
				</div>
				
			</div>
			
		</div>
	</section>

<?php	if($config['enable_graph'] == 'on') { ?>
    <section id="statistic" class="section">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="headline">
						<h2>Players History</h2>
						<p>Last 24 hours online statistic</p>
					</div>
				</div>
			</div>
	
			<div class="row">
				<div class="col-md-12 col-sm-12 features">
					<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.6/Chart.min.js"></script>
					<center> <canvas id="onlineChart" width="200" height="50"></canvas> </center>
					<script>

						var ctx = document.getElementById("onlineChart");
						var times = [<?php echo $results->{'timesgraph'}; ?>];
						var players = [<?php echo $results->{'playersgraph'}; ?>];
						var onlineChart = new Chart(ctx, {
							type: 'line',
							data: {
								labels: times,
								datasets: [{
									label: ['Players online'],
									data: players,
									fill: true,
									fill: true,
									borderColor: '#d8d8d8',
								
									pointBackgroundColor: '#00964A',
									pointBorderColor: "#fff",
									pointHoverBackgroundColor: "#fff",
									pointRadius: 1,
									pointHitRadius: 1,
								}]
							},
							
							options: {
								scales: {
									yAxes: [{
										ticks: {
											beginAtZero:true
										}
									}]
								}
							}
						});
					</script>
				</div>
				
		</div>
	</section>
<?php } ?>
	
		<?php	if($config['enable_graph'] != '') { ?>
	<!-- NEWS -->
	<section id="news" class="section bg-grey  arrow-bottom">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-sm-12">
					<a class="twitter-timeline" href="https://twitter.com/<?php echo $config['twitter_page']; ?>">Latest news by <?php echo $config['twitter_page']; ?></a> <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
				</div>
			</div>
		</div>
	</section>	
		<?php } ?>
	<section class="footer footer-top">
		<div class="container">
			<div class="row">
				<!-- Footer Intro  -->
				<div class="col-md-7">
					<iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2F<?php echo $config['facebook_page']; ?>&tabs&width=500&height=100&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" width="500" height="150" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
				</div>
				<div class="col-sm-3">
					<h3>Stay in Touch!</h3>
					<p>Follow us on our social networks!</p>
					<ul class="social">
						<li class="facebook"> <a href="https://facebook.com/<?php echo $config['facebook_page']; ?>"> <i class="fa fa-facebook"></i> </a> </li>
						<li class="twitter"> <a href="https://twitter.com/<?php echo $config['twitter_page']; ?>"> <i class="fa fa-twitter"></i> </a> </li>
						<li class="google-plus"> <a href="https://seegaming.com/server-<?php echo $config['seegaming_id']; ?>"> <i class="fa fa-gamepad"></i> </a> </li>
					</ul>
				</div>
				<div class="col-md-2">
					<center><h3>Vote for server</h3>
					<a style="color:white" class="btn-sm btn-success" href="https://seegaming.com/server-<?php echo $config['seegaming_id']; ?>"><?php echo $results->{'rating'}; ?> <i class="fa fa-thumbs-o-up" ></i> </a></center>
				</div>	

				
			</div>
		</div>
	</section>	
	<footer class="footer footer-sub">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-sm-6">
					<p>&copy; <?php echo $config['server_logo']; ?> - <?php echo $results->{'gamename'}; ?> server. All Right Reserved</p>
				</div>
			</div>
		</div>
	</footer>
	<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.0.min.js"></script>
	<script type="text/javascript">window.jQuery || document.write('<script src="js/jquery-2.1.0.min.js"><\/script>')</script>
	<script src="js/bootstrap.min.js" type="text/javascript"></script>
	<script src="js/modernizr.min.js" type="text/javascript"></script>
	<script src="js/custom.js" type="text/javascript"></script>

</body>
</html>