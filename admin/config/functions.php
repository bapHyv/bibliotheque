<?php

function alert($message, $color) { ?>
    <div class="alert alert-<?= $color ?>">
        <?= $message ?>
    </div>

<?php }