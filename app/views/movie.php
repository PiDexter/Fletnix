<section class="spotlight-grid">
    <!--            <img src="images/movie1-1.jpg" alt="" title="" class="img-spotlight">-->
    <video width="100%" height="" class="spotlight-video" autoplay muted loop>
        <source src="/video/movie_example_1.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>
    <div class="spotlight-row">
        <h2 class="spotlight-title">{{title}}</h2>
        <p>Time icon: {{duration}} min.</p>
        <div class="column content-left">
            <button class="btn btn-secondary fullwidth">Afspelen</button>
        </div>
    </div>
</section>
<section id="details">
    <div class="container">
        <div class="row">
            <p>{{description}}</p>
        </div>
    </div>
</section>

<section>
    <div class="tabs-wrapper">
        <input type="radio" name="tabs" id="tab-1" checked="checked">
        <label for="tab-1" class="tab-label">Details</label>
        <div class="tab">
            <dl id="movie-details">
                <dt>Director</dt>
                <dd>{{director}}</dd>

                <dt>Publicatiejaar</dt>
                <dd>{{publication_year}}</dd>

                <dt>Samenvatting</dt>
                <dd>{{description}}</dd>
            </dl>
        </div>

        <input type="radio" name="tabs" id="tab-2">
        <label for="tab-2" class="tab-label">Acteurs</label>
        <div class="tab" aria-label="film cast">
            <dl id="movie-cast-list">
                <?php foreach($data as $persons) : ?>
                    <?php if(is_array($persons)) : ?>
                        <?php foreach($persons as $person) : ?>
                        <dt><?php echo $person['role'] ?></dt>
                        <dd><?php echo $person['firstname'] . " " . $person['lastname']; ?></dd>
                        <?php endforeach; ?>
                    <?php endif; ?>
                <?php endforeach; ?>
            </dl>
        </div>

    </div>
</section>
