<?php
?>

<section id="genres">
    <div class="container">
        <div class="card-grid">
            <?php foreach($data as $movie) : ?>
                <a href="/movie/<?php echo $movie['movie_id']; ?>" class="card">
                    <?php echo $movie['title']; ?>
                </a>
            <?php endforeach; ?>
        </div>
    </div>

</section>
