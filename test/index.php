<?php # -*- coding: utf-8 -*-
declare(strict_types=1);

require_once '../vendor/autoload.php';
use Bueltge\Marksimple\Marksimple;

require_once 'head.php';
?>

<div class="main">
    <article>
        <?php
        // Parse the Markdown syntax from a file.
        $ms = new Marksimple();
        print $ms->parseFile('../README.md');
        ?>
    </article>
</div> <!-- .main -->

<?php require_once 'footer.php'; ?>
