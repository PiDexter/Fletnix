<?php
use app\src\session\FlashMessage;
?>

<?php if (FlashMessage::hasFlashMessage()) : ?>
<div class="row">
    <div class="column alert {{messageType}}">
        <span>{{errorMessage}}</span>
    </div>
</div>
<?php endif; ?>
