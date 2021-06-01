<?php
/* @var $data array */

?>

<?php for ($page = 1; $page <= ceil(1000 / 15); $page++):?>
    <a href='<?php echo "?page=$page"; ?>' class="pagination">
        <?php  echo $page; ?>
    </a>
<?php endfor; ?>