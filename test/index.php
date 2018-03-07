<?php # -*- coding: utf-8 -*-
declare(strict_types=1);

require_once '../vendor/autoload.php';

use Bueltge\Marksimple\Exception\InvalideFileException;
use Bueltge\Marksimple\Marksimple;

require_once 'head.php';
?>

<div class="main">
    <article>
        <?php
        // Parse the Markdown syntax from a file.
        try {
            $ms = new Marksimple();
            print $ms->parseFile('../README.md');
        } catch ( InvalideFileException $e ) {
            print filter_var($e->getMessage(), FILTER_SANITIZE_STRING);
        }
        ?>
    </article>
</div> <!-- .main -->

<?php require_once 'footer.php'; ?>
