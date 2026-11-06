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
            print htmlspecialchars($e->getMessage(), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
        }
        ?>
    </article>
</div> <!-- .main -->

<?php require_once 'footer.php'; ?>
