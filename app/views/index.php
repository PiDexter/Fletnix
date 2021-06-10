<section id="home-spotlight" class="spotlight-grid">
    <img src="/images/hero-image.jpg" width="1600" height="900" alt="Mind explained banner" title="" class="spotlight-image">
    <div class="spotlight-text-frame">
        <div class="spotlight-row">
            <h1 class="spotlight-title">Mind explained</h1>
            <p>Heb je je ooit afgevraagd wat er in je hoofd gebeurt? Van dromen tot angststoornissen, ontdek in deze verhelderende serie hoe je hersenen werken.</p>
            <div class="column content-left">
                <?php if(!isset($_SESSION['user'])) : ?>
                    <a href="/register" class="btn btn-primary">Kijken? Word lid!</a>
                <?php else : ?>
                    <a href="/movie/968" class="btn btn-primary">Bekijken</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<section id="overview">
    <div class="slider-row" id="trending">
        <h2 class="row-title">Trending</h2>
        <div class="card-deck">
            <?php foreach($data['trending'] as $movie) : ?>
                <a href="/movie/<?php echo $movie['movie_id']; ?>" class="card">
                    <img src="images/movie4.jpg" width="300" height="180" alt="<?php echo $movie['title']; ?>">
                    <div class="card-body">
                        <span class="pre-text"><?php echo $movie['genre_name']; ?></span>
                        <h2><?php echo $movie['title']; ?></h2>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="slider-row" id="Science">
        <h2 class="row-title">Science</h2>
        <div class="card-deck">

            <?php foreach($data['documentary'] as $movie) : ?>
                <a href="/movie/<?php echo $movie['movie_id']; ?>" class="card">
                    <img src="images/movie2.jpg" width="300" height="180" alt="<?php echo $movie['title']; ?>">
                    <div class="card-body">
                        <span class="pre-text"><?php echo $movie['genre_name']; ?></span>
                        <h2><?php echo $movie['title']; ?></h2>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>