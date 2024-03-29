<?php
/* @var $data array */
?>

<section id="movielist">
    <div class="container">
        <div class="row vertical-center">
            <div class="column content-left">
                <h1 class="page-title">{{page_title}}</h1>
            </div>
            <div class="column content-right">
                <a href="/search" class="btn btn-bordered">
                    <img src="/images/search-icon.svg" width="16" height="16" alt="search icon" class="icon">
                    Search
                </a>
            </div>
        </div>
        <div class="card-grid">
            <?php foreach($data as $item) : ?>
                <?php if (is_array($item)) : ?>
                    <?php foreach($item as $id => $movie) : ?>
                        <a href="/movie/<?php echo $movie['movie_id']; ?>" class="card">
                        <img src="/images/movie<?php echo random_int(1, 6); ?>.jpg" alt="">
                        <div class="card-body">
                            <span><?php echo $movie['title']; ?></span>
                        </div>
                    </a>
                    <?php endforeach; ?>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
        @pagination
    </div>
</section>
