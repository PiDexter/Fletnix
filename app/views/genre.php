<?php
/* @var $data array */
?>
<section id="genres">
    <div class="container">
        <h1>Genres</h1>
        <div class="card-grid">
            <?php foreach($data as $genre) : ?>
                <a href="/genre/<?php echo $genre['genre_name']; ?>" class="card">
                    <?php echo $genre['genre_name']; ?>
                </a>
            <?php endforeach; ?>
        </div>
    </div>

</section>