<section class="spotlight-grid">
    <!--            <img src="images/movie1-1.jpg" alt="" title="" class="img-spotlight">-->
    <video width="100%" height="" class="spotlight-video" autoplay muted loop>
        <source src="/video/movie_example_1.mp4" type="video/mp4">
        Your browser does not support the video tag.
    </video>
    <div class="spotlight-row">
        <h2 class="spotlight-title">{{title}}</h2>
        <div class="column content-left vertical-center">
            <img src="/images/clock-icon.svg" width="16" height="16" alt="" class="icon">
            <span>{{duration}} min.</span>
        </div>
    </div>
</section>
<section id="details">
    <div class="container">
        <div class="row">
            <div class="column content-left">
                <a href="#popup2" class="btn btn-secondary fullwidth">
                    <img src="/images/play-button-black-icon.svg" width="24" height="24" alt="" class="icon">
                    Afspelen
                </a>
            </div>
        </div>
    </div>
</section>

<section>
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






<div id="popup2" class="overlay">
    <a class="cancel" id="cancel" href="#!"></a>
    <div class="popup">
        <a href="#projects" class="popup-close">
            <svg class="svg-icon" viewBox="0 0 20 20">
                <path fill="none" d="M12.71,7.291c-0.15-0.15-0.393-0.15-0.542,0L10,9.458L7.833,7.291c-0.15-0.15-0.392-0.15-0.542,0c-0.149,0.149-0.149,0.392,0,0.541L9.458,10l-2.168,2.167c-0.149,0.15-0.149,0.393,0,0.542c0.15,0.149,0.392,0.149,0.542,0L10,10.542l2.168,2.167c0.149,0.149,0.392,0.149,0.542,0c0.148-0.149,0.148-0.392,0-0.542L10.542,10l2.168-2.168C12.858,7.683,12.858,7.44,12.71,7.291z M10,1.188c-4.867,0-8.812,3.946-8.812,8.812c0,4.867,3.945,8.812,8.812,8.812s8.812-3.945,8.812-8.812C18.812,5.133,14.867,1.188,10,1.188z M10,18.046c-4.444,0-8.046-3.603-8.046-8.046c0-4.444,3.603-8.046,8.046-8.046c4.443,0,8.046,3.602,8.046,8.046C18.046,14.443,14.443,18.046,10,18.046z"></path>
            </svg>
            close
        </a>

        <video width="100%" height="" class="spotlight-video" controls>
            <source src="/video/movie_example_1.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>

    </div>
</div>
