<section id="home-spotlight" class="spotlight-grid">
    <img src="/images/hero-image.jpg" width="1600" height="900" alt="Mind explained banner" title="" class="spotlight-image">
    <div class="spotlight-text-frame">
        <div class="spotlight-row">
            <?php if(!isset($_SESSION['user'])) : ?>
            <h1 class="spotlight-title">Smarter everyday</h1>
            <p>Watch science and educational movies and series, or follow self-development video courses.</p>
            <div class="column content-left">
                <a href="/register" class="btn btn-primary">Register to watch!</a>
            </div>
                <?php else : ?>
            <h1 class="spotlight-title">MarsX explained</h1>
            <p>Have you ever wondered what's going on in MarsX? From dreams to reality, discover how MarsX works in this enlightening movie.</p>
            <div class="column content-left">
                <a href="/movie/968" class="btn btn-primary">Watch</a>
            </div>
            <?php endif; ?>
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