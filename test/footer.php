<?php # -*- coding: utf-8 -*-
declare(strict_types=1);
?>

<footer class="wrapper">
    <?php
    require_once '../vendor/autoload.php';

    use Bueltge\Marksimple\Marksimple;

    // Parse the Markdown fromFile from a string.
    $footercontent = new Marksimple();
    print $footercontent->parse('Made with ♥ · [bueltge.de](https://bueltge.de)');
    ?>
</footer>

<script src="js/highlight.pack.js"></script>
<script src="js/main.js"></script>

</body>
</html>
