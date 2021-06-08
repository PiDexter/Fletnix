<section id="home-spotlight" class="spotlight-grid">
    <img src="/images/hero-image.jpg" alt="" title="" class="spotlight-image">
    <div class="spotlight-text-frame">
        <div class="spotlight-row">
            <h1 class="spotlight-title">Mind explained</h1>
            <p>Heb je je ooit afgevraagd wat er in je hoofd gebeurt? Van dromen tot angststoornissen, ontdek in deze verhelderende serie hoe je hersenen werken.</p>
            <div class="column content-left">
                <?php if(!isset($_SESSION['user'])) : ?>
                    <a href="/register" class="btn btn-primary">Kijken? Word lid!</a>
                <?php else : ?>
                    <a href="" class="btn btn-primary">Afspelen</a>
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
                    <img src="images/movie2.jpg" alt="">
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
            <!-- Card 1 -->
            <a href="#popup1" class="card" id="popuptest4">
                <img src="images/movie4.jpg" alt="">
            </a>

            <!-- Card 2 -->
            <a href="#popup1" class="card" id="popuptest5">
                <img src="images/movie5.jpg" alt="">
            </a>

            <!-- Card 3 -->
            <a href="#popup1" class="card" id="popuptest6">
                <img src="images/movie6.jpg" alt="">
            </a>
        </div>
    </div>
</section>