<section id="movie-banner" class="spotlight-grid">
    <img src="/images/hero-image.jpg" alt="" title="" class="spotlight-image">
    <div class="spotlight-text-frame">
        <div class="spotlight-row">
            <h1 class="spotlight-title">{{title}}</h1>
            <p>{{description}}</p>
                <div class="column content-left">
                    <a href="#popup" class="btn btn-primary fullwidth">
                        <img src="/images/play-button-white-icon.svg" width="24" height="24" alt="" class="icon">
                        Afspelen
                    </a>
                </div>
        </div>
    </div>
</section>


<section id="details">
    <div class="tabs-wrapper">
        <input type="radio" name="tabs" id="tab-1" checked="checked">
        <label for="tab-1" class="tab-label">Details</label>
        <div class="tab" id="movie-details">


            <div class="row">
                <div class="column content-left vertical-center">
                    <img src="/images/director-icon.svg" width="24" height="24" alt="" class="icon">
                    <span class="column-title">Regisseur</span>
                </div>
                <div class="column">
                    <span>{{director}}</span>
                </div>
            </div>
            <div class="row">
                <div class="column content-left vertical-center">
                    <img src="/images/calendar-icon.svg" width="24" height="24" alt="" class="icon">
                    <span class="column-title">Publicatiejaar</span>
                </div>
                <div class="column">
                    <span>{{publication_year}}</span>
                </div>
            </div>

            <div class="row">
                <div class="column content-left vertical-center">
                    <img src="/images/clock-icon.svg" width="24" height="24" alt="" class="icon">
                    <span class="column-title">Tijdsduur</span>
                </div>
                <div class="column">
                    <span>{{duration}} minuten</span>
                </div>
            </div>
            <div id="movie-description" class="row">
                <div class="column content-left vertical-center">
                    <img src="/images/director-icon.svg" width="24" height="24" alt="" class="icon">
                    <span class="column-title">Samenvatting</span>
                </div>
                <div class="column">
                    <span>{{description}}</span>
                </div>
            </div>

        </div>

        <input type="radio" name="tabs" id="tab-2">
        <label for="tab-2" class="tab-label">Acteurs</label>
        <div class="tab">
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
    <div id="popup" class="overlay">
        <a class="cancel" href="#!"></a>
        <div class="video">
            <a href="#!" class="popup-close">
                <img src="/images/close-icon.svg" width="24" height="24" alt="" class="icon">
                close
            </a>
            <video class="spotlight-video" controls>
                <source src="/video/movie_example_1.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>
        </div>
    </div>
</section>


