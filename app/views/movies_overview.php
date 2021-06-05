<?php
/* @var $data array */
?>
<section id="movielist">
    <div class="container">
        <div class="row">
            <div class="column content-left">
                <span class="page-count">Pagina <?php echo $_GET['page'] ?? 1; ?></span>
            </div>
            <div class="column content-right">
                <a href="/search" class="btn btn-bordered">
                    <img src="/images/search-icon.svg" width="16" height="16" alt="search icon" class="icon">
                    Zoeken
                </a>
            </div>
        </div>
        <div class="card-grid grid-col-2">
            <?php foreach($data as $movie) : ?>
                <a href="/movie/<?php echo $movie['movie_id']; ?>" class="card">
                    <img src="/images/movie2.jpg" alt="">
                    <div class="card-body">
                        <span><?php echo $movie['title']; ?></span>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
        @pagination
    </div>
</section>

