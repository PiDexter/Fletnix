<?php
/** @var $error \Exception */
?>

<section class="form-container" id="error">
    <div class="container">

        <h1>Whoops!</h1>
        <p><?php echo $error->getMessage(); ?></p>

        <?php if(!isset($_SESSION['user']) && $error->getCode() === 403) : ?>
        <div class="hero-buttons">
            <div class="row">
                <div class="column">
                    <a href="/register" class="btn btn-primary fullwidth">Lid worden!</a>
                </div>
                <div class="column">
                    <a href="/login" class="btn btn-secondary fullwidth">Inloggen</a>
                </div>
            </div>
        </div>
        <?php endif; ?>

    </div>

</section>
