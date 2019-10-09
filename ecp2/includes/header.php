<!DOCTYPE html>
<html>
	<head>
		<title><?php echo $pages[$current_page]["title"]." | e-class";?></title>
		<link rel="stylesheet" href="<?php echo $pages[$current_page]['style2'];?>">
		<link rel="stylesheet" href="<?php echo $pages[$current_page]['templateStyle'];?>">
		<link rel="stylesheet" href="<?php echo $pages[$current_page]['style'];?>">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script type="text/javascript" src="<?php echo $pages[$current_page]['script'];?>"></script>
		<meta name="viewport" content="width=device-width initial-scale=1.0">
		<style>
			.main-content {
				background-image: url("<?php echo $rootDir."img/background/bg-".str_pad(rand(1, 11), 2, '0', STR_PAD_LEFT).".png";?>");
				background-attachment: fixed;
			}
		</style>
	</head>
	
	<body>
	<header class="page-header">
		<a class="homepage-link" href="<?php echo $rootDir;?>home.php"><img src="<?php echo $rootDir;?>img/home-logo.png"></img></a>
		<h1>E-Class platform</h1>
		<?php
		if (isset($_COOKIE['user-login'])) {
			require($rootDir.'_mysqli_connect.php');
			$hash = $_COOKIE['user-login'];
			$query = "select * from user where login_cookie_hash='$hash';";
			$response = $dbc->query($query);
			if ($response && $response->num_rows == 1) {
				$row = $response->fetch_array();
				$username = $row['username'];
				$dept = $row['dept_name'];
				$_SESSION['login']=true;
				$_SESSION['username']=$username;
				$_SESSION['department'] = $dept;
			} else {
				echo "<span style=\"color:white\">Attempt to unauthorized access detected!</span>";
				setcookie($username, "", time() - 60*60, "/");
			}
		}

		if (isset($_SESSION['login'])) {
			echo "<a class=\"red-btn\" href=\"".$pages[$current_page]['logoutLink']."\">Logout</a>"."<p class=\"header-username\">".$_SESSION['username']."</p>";
		} else {
			echo "<a class=\"blue-btn\" href=\"".$pages[$current_page]['loginLink']."\">Login</a><a class=\"green-btn\" href=\"".$pages[$current_page]['registerLink']."\">Register</a>";
		}
		?>

		<div class="search-area">
			<input onkeypress="detectEnter(event, this.value)" onkeyup="showSuggestion(this.value)" type="text" id="search-box" placeholder="search" />
			<div class="suggestion-box">
				<!-- <a href="#"><div class="suggestion-item">Hello</div></a><br> -->
			</div>
		</div>
		<style>
			.search-area {
				position: absolute;
				top: calc(100% - 33px);
				right: 0px;
				width: 200px;
			}

			.search-area input {
				width: 100%;
				margin: 0;
			}

			.search-area .suggestion-box {
				width: 100%;
				max-height: 140px;
				margin: 0;
				z-index: 99;
				background-color: #454442;
				overflow: hidden;
			}

			.search-area .suggestion-box a {
				text-decoration: none;
				color: #e5e4d7;
			}

			.search-area .suggestion-box a .suggestion-item {
				width: 100%;
				margin: 0;
				padding: 0 5px;
				font-size: 14px;
				line-height: 20px;
				height: 20px;
				overflow: hidden;
			}

			.search-area .suggestion-box a .suggestion-item:hover {
				background-color: #161513;
			}
		</style>
		<script type="text/javascript">
			rootDir = "<?php echo $rootDir;?>";
			function detectEnter(e, q) {
				if (e.keyCode == 13) {
				window.location.replace(rootDir+"search.php?q="+urlencode(q));
				}
			}

			function urlencode(str) {
				return encodeURIComponent(str)
			    .replace(/!/g, '%21')
			    .replace(/'/g, '%27')
			    .replace(/\(/g, '%28')
			    .replace(/\)/g, '%29')
			    .replace(/\*/g, '%2A')
			    .replace(/%20/g, '+');
			}

			function showSuggestion(q) {
				q = urlencode(q);
				sgBox = document.getElementsByClassName("suggestion-box")[0];
					if (q.length==0) {
					sgBox.innerHTML="";
					sgBox.style.display = "none";
					return;
				}
				if (window.XMLHttpRequest) {
					xmlhttp=new XMLHttpRequest();
				} else {
					xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
				}
				xmlhttp.onreadystatechange=function() {
					if (this.readyState==4 && this.status==200) {
						sgBox.innerHTML=this.responseText;
						sgBox.style.display = "block";
					}
				}
				xmlhttp.open("GET",rootDir+"_search_suggestion.php?q="+q+"&rootDir=<?php echo rawurlencode($rootDir);?>",true);
				xmlhttp.send();
			}
		</script>
	</header>