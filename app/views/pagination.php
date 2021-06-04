<?php
/* @var $data array */
$page = $_GET['page'] ?? 1;
?>

<div class="row">
    <div class="column content-left">
        <?php if (!empty($data) && $page > 1) : ?>
            <a href='<?php echo "?page=" . $page - 1; ?>' class='btn btn-bordered'>VORIGE</a>
        <?php endif; ?>
    </div>

    <div class="column content-right">
        <?php if (!empty($data) && $page < 32) : ?>
            <a href='<?php echo "?page=" . $page + 1; ?>' class='btn btn-primary'>VOLGENDE</a>
        <?php endif; ?>
    </div>
</div>
