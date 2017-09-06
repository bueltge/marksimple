<?php # -*- coding: utf-8 -*-
declare( strict_types = 1 );
?>

		<footer class="wrapper">
		<?php
		require_once '../MarkSimple.php';
		use Bueltge\MarkSimple\MarkSimple as MS;
			// Parse the Markdown content from a string.
			print ( new MS( 'Made with ♥ · [bueltge.de](https://bueltge.de).' ) );
		?>
		</footer>

		<script src="js/highlight.pack.js"></script>
		<script src="js/main.js"></script>

	</body>
</html>
