<?php
/* @var $data array */
?>
<section id="searchResult">
    <div class="container">

        @pagination

        <div class="card-grid">
            <?php foreach($data as $movie) : ?>
                <a href="/movie/<?php echo $movie['movie_id']; ?>" class="card">
                    <?php echo $movie['title']; ?>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>

