<?php
/* @var $data array */
?>

<div id="pagination" class="row vertical-center">
    <div class="column content-left">
        <?php if ($data['page'] > 1) : ?>
            <?php if (isset($data['search_params'])) : ?>
                <a href="<?php echo '?' . $data['search_params'] . '&amp;page=' . $data['page'] - 1 ?>" class='btn btn-bordered'>Previous</a>
            <?php else: ?>
            <a href="<?php echo '?'. 'page=' . $data['page'] - 1; ?>" class='btn btn-bordered'>Previous</a>
            <?php endif; ?>
        <?php endif; ?>
    </div>

    <div class="column">
        <span><?php echo $data['page'] . "/" . $data['total_pages']; ?></span>
    </div>

    <div class="column content-right">
        <?php if ($data['page'] < $data['total_pages']) : ?>
            <?php if (isset($data['search_params'])) : ?>
                <a href="<?php echo '?' . $data['search_params'] . '&amp;page=' . $data['page'] + 1 ?>" class='btn btn-primary'>Next</a>
            <?php else: ?>
                <a href="<?php echo '?'. 'page=' . $data['page'] + 1; ?>" class='btn btn-primary'>Next</a>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</div>
