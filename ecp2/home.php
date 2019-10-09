<?php
$current_page = 0;
$rootDir = "";
session_start();
include('_pages.php');
include('includes/header.php');
include('includes/nav.php');
?>


<div class="main-content">
	<h2 id="caption">Welcome</h2><br>
	<div class="w3-content w3-display-container" max-height="px">
	  <img class="mySlides w3-animate-right" src="img/home_slideshow/01.jpg" style="width:100%">
	  <img class="mySlides w3-animate-right" src="img/home_slideshow/02.jpg" style="width:100%">
	  <img class="mySlides w3-animate-right" src="img/home_slideshow/03.jpg" style="width:100%">
	  <img class="mySlides w3-animate-right" src="img/home_slideshow/04.jpg" style="width:100%">
	  <img class="mySlides w3-animate-right" src="img/home_slideshow/05.jpg" style="width:100%">
	  <img class="mySlides w3-animate-right" src="img/home_slideshow/06.jpg" style="width:100%">
	  <img class="mySlides w3-animate-right" src="img/home_slideshow/07.jpg" style="width:100%">
	  
	  <button class="w3-button w3-black w3-display-left" onclick="changeSlide(-1)">&#10094;</button>
	  <button class="w3-button w3-black w3-display-right" onclick="changeSlide(1)">&#10095;</button>
	</div> <!-- carousel -->
	<br>
	<script src="scripts/home.js"></script>
	
	<div class="text-container">
		<p>
			Welcome to E-Class of KUET. This is a web platform that enables you to help each other in your class or other classes with home tasks or basically any educational topic related to the academy. <br>
			If you're a student of KUET and want to avoid getting yourself into those 'never-ending' gossips when you visit a friend for some group study, then you've coem to the right place. <br>
			Go ahead the read below to know how it works.
		</p>
	</div> <!-- text-container -->
	
	<div class="row">
		<div  class="column">
			<h2 class="section-title">Features at a glance</h2>
			<hr>
			<h3>Main features: </h3>
			<ul caption="Main Features: ">
				<li>Discussion boards for separate classes categorized as subjects</li>
				<li>Categorized collection of book references.</li>
				<li>Links to external references in case of bigger contents, etc</li>
			</ul>
			
			<h3>Extra features: </h3>
			<ul>
				<li>Bored of study, play some mini-games right in your browser.</li>
				<li>View your class routines</li>
			</ul>
		</div> <!-- column -->
	
		<div class="column">
			<h2 class="section-title">How it works?</h2>
			<hr>
			<p>
				<p>
					At first you register on this site. The process is simple. Just follow the steps on the registration page and you should be able to use this right away!<br>
					The whole webpage has been designed to be user-friendly and most of the features should be self-explanatory. <br>
					But if you don't want to figure it out yourself, here you go:<br>
					<ol>
						<li>Click on &quotes;register&quotes; on the top right corner.</li>
						<li>Follow the steps on the registration page.</li>
						<li>Log in using the email and password.</li>
					</ol>
				</p>
			</p>
		</div> <!-- column -->
	</div> <!-- row -->
</div> <!-- main-content -->

<?php
include("includes/footer.php");
?>