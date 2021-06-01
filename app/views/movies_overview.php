<?php
/* @var $data array */
?>
<section id="allMovies">
    <div class="container">
        <div class="row">
            <div class="column">
                <span class="page-count">Pagina <?php echo $_GET['page'] ?? 1; ?></span>
            </div>
            <div class="column">
                <a href="/search" class="btn btn-secondary">Uitgebreid zoeken</a>
            </div>
        </div>
        <div class="card-grid">
            <?php foreach($data as $movie) : ?>
                <a href="/movie/<?php echo $movie['movie_id']; ?>" class="card">
                    <?php echo $movie['title']; ?>
                </a>
            <?php endforeach; ?>
        </div>
        @pagination
    </div>
</section>

