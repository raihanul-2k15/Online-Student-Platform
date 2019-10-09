		<footer class="page-footer">
			<small>&copy; 
				<?php
					if (!preg_match('/login.php/i', $_SERVER['REQUEST_URI']) && !preg_match('/register.php/i', $_SERVER['REQUEST_URI']))
						$_SESSION['last_page_visited'] = $_SERVER['REQUEST_URI'];
					echo date('Y');
				?>, Raihanul Islam Refat</small>
		</footer>
	</body>
</html>