<?php
/* @var $data array */
?>

<div class="row">
    <div class="column content-left">
        <?php if ($data['page'] > 1) : ?>
            <a href='
                    <?php if (isset($data['search_params'])) : ?>
                        <?php echo "?" . $data['search_params'] . "&page=" . $data['page'] - 1 ?>
                    <?php else: ?>
                        <?php echo "?page=" . $data['page'] - 1; ?>
                    <?php endif; ?>
                    '  class='btn btn-bordered'>VORIGE</a>
        <?php endif; ?>
    </div>

    <div class="column content-right">
        <?php if ($data['page'] < $data['total_pages']) : ?>
            <a href='
                    <?php if (isset($data['search_params'])) : ?>
                        <?php echo "?" . $data['search_params'] . "&page=" . $data['page'] + 1 ?>
                    <?php else: ?>
                        <?php echo "?page=" . $data['page'] + 1; ?>
                    <?php endif; ?>
                    ' class='btn btn-primary'>VOLGENDE</a>
        <?php endif; ?>
    </div>
</div>
