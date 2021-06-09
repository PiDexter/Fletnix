<?php
/* @var $data array */
?>

<div id="pagination" class="row vertical-center">
    <div class="column content-left">
        <?php if ($data['page'] > 1) : ?>
            <a href='
                    <?php if (isset($data['search_params'])) : ?>
                        <?php echo "?" . $data['search_params'] . "&page=" . $data['page'] - 1 ?>
                    <?php else: ?>
                        <?php echo "?page=" . $data['page'] - 1; ?>
                    <?php endif; ?>
                    '  class='btn btn-bordered'>Vorige</a>
        <?php endif; ?>
    </div>

    <div class="column">
        <span><?php echo $data['page'] . "/" . $data['total_pages']; ?></span>
    </div>

    <div class="column content-right">
        <?php if ($data['page'] < $data['total_pages']) : ?>
            <a href='
                    <?php if (isset($data['search_params'])) : ?>
                        <?php echo "?" . $data['search_params'] . "&page=" . $data['page'] + 1 ?>
                    <?php else: ?>
                        <?php echo "?page=" . $data['page'] + 1; ?>
                    <?php endif; ?>
                    ' class='btn btn-primary'>Volgende</a>
        <?php endif; ?>
    </div>
</div>
