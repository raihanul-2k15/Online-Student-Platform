<?php
$current_page = 5;
$rootDir = "";
session_start();
include('_pages.php');
include('includes/header.php');
include('includes/nav.php');
?>

<div class="wrapper row2">
  <div id="container" class="main-content clear" style="min-height: 1000px">
    <!-- ####################################################################################################### -->
    <!-- ####################################################################################################### -->
    <!-- ####################################################################################################### -->
    <!-- ####################################################################################################### -->
    <div id="about-us" class="clear">
      <!-- ####################################################################################################### -->
      <section id="statements" class="clear">
        <div class="panorama"><img src="img/about/cover.jpg" alt=""></div>
        <div class="one_half first">
          <h2>About Me</h2>
          <img class="imgl" src="img/about/refat.jpg" alt="">
          <blockquote>
            <p>Hello, I'm Raihanul Islam Refat and I'm the developer and designer of this website.</p>
            <p>As a CSE undergraduate in KUET, I have tried my best to develop this website for CSE family. But the whole community can use this website.</p>
          </blockquote>
          <p class="right">&quot;Do or die? - I don't think so!&quot;</p>
          <p>no matter how badly you're stuck, there's always a way out. You just need to try. And in the end you'll succeed.</p>
        </div>
        <div class="one_half">
          <h2>My Skills</h2>
          <p>Throughout my entire student life, I've developed some interpersonal skills. Most of them are a part of computer and IT field.</p>
          <ul>
            <li>Programming</li>
            <li>Software development</li>
            <li>Game development</li>
            <li>Mobile app development</li>
            <li>Different types of problem solving</li>
          </ul>
          <p>Besides all these, I also cna play games. I like Minecraft as it's a very simple but massively creative game.</p>
        </div>
      </section>
      <!-- ####################################################################################################### -->
      <section id="team">
        <ul class="clear">
          <li class="one_quarter first">
            <figure><img src="img/about/team_refat.jpg" alt="">
              <figcaption>
                <p class="team_name">Raihanul Islam Refat</p>
                <p class="team_title">CSE Undergrad</p>
                <p class="team_description">I'm an enthusiast. I like to do creative stuffs. I play minecraft.</p>
              </figcaption>
            </figure>
            <ul>
              <li><a href="https://www.facebook.com/raihanul.islam.refat"><img src="img/about/social-icon.png" alt=""></a></li>
              <li><a href="https://www.facebook.com/raihanul.islam.refat"><img src="img/about/social-icon.png" alt=""></a></li>
              <li><a href="https://www.facebook.com/raihanul.islam.refat"><img src="img/about/social-icon.png" alt=""></a></li>
              <li><a href="https://www.facebook.com/raihanul.islam.refat"><img src="img/about/social-icon.png" alt=""></a></li>
              <li><a href="https://www.facebook.com/raihanul.islam.refat"><img src="img/about/social-icon.png" alt=""></a></li>
            </ul>
          </li>
          <li class="one_quarter">
            <figure><img src="img/about/team_nahid.jpg" alt="">
              <figcaption>
                <p class="team_name">Md Nahid Hasan</p>
                <p class="team_title">CSE Undergrad</p>
                <p class="team_description">I like to have as much fun as I can and don't take everything seriously. I like to adventure</p>
              </figcaption>
            </figure>
            <ul>
              <li><a href="https://www.facebook.com/nahid.pappu.9"><img src="img/about/social-icon.png" alt=""></a></li>
              <li><a href="https://www.facebook.com/nahid.pappu.9"><img src="img/about/social-icon.png" alt=""></a></li>
              <li><a href="https://www.facebook.com/nahid.pappu.9"><img src="img/about/social-icon.png" alt=""></a></li>
              <li><a href="https://www.facebook.com/nahid.pappu.9"><img src="img/about/social-icon.png" alt=""></a></li>
              <li><a href="https://www.facebook.com/nahid.pappu.9"><img src="img/about/social-icon.png" alt=""></a></li>
            </ul>
          </li>
        </ul>
      </section>
      <!-- ####################################################################################################### -->
    </div>
    <!-- ####################################################################################################### -->
    <!-- ####################################################################################################### -->
    <!-- ####################################################################################################### -->
    <!-- ####################################################################################################### -->
  </div>
</div>

<?php
include($rootDir."includes/footer.php");
?>