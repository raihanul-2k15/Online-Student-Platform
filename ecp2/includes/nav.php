		<div class="page-nav">
			<ul>
				<?php 
				for ($i = 0; $i < count($pages); $i++) {
				    if ($i == $current_page) {
				        echo "<li class=\"current-page\"><span>" . $pages[$i]["title"] . "</span></li>";
				    } else {
				        echo "<li><a href=\"".$pages[$i]["link"]."\">".$pages[$i]["title"]."</a></li>";
				    }
				}
				?>
			</ul>
		</div>