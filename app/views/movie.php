<section id="movie-details" class="spotlight-grid">
    <img src="/images/hero-image.jpg" alt="" title="" class="spotlight-image">
    <div class="spotlight-text-frame">
        <div class="spotlight-row">
            <h1 class="spotlight-title">{{title}}</h1>
<!--            <img src="/images/clock-icon.svg" width="16" height="16" alt="" class="icon">-->
<!--            -->
            <p>{{description}}</p>


                <div class="column content-left">
                    <a href="#popup2" class="btn btn-primary fullwidth">
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


<div id="popup1" class="overlay">
    <a class="cancel" href="#!"></a>
    <div class="popup">
        <a href="#projects" class="popup-close">
            <svg class="svg-icon" viewBox="0 0 20 20">
                <path fill="none" d="M12.71,7.291c-0.15-0.15-0.393-0.15-0.542,0L10,9.458L7.833,7.291c-0.15-0.15-0.392-0.15-0.542,0c-0.149,0.149-0.149,0.392,0,0.541L9.458,10l-2.168,2.167c-0.149,0.15-0.149,0.393,0,0.542c0.15,0.149,0.392,0.149,0.542,0L10,10.542l2.168,2.167c0.149,0.149,0.392,0.149,0.542,0c0.148-0.149,0.148-0.392,0-0.542L10.542,10l2.168-2.168C12.858,7.683,12.858,7.44,12.71,7.291z M10,1.188c-4.867,0-8.812,3.946-8.812,8.812c0,4.867,3.945,8.812,8.812,8.812s8.812-3.945,8.812-8.812C18.812,5.133,14.867,1.188,10,1.188z M10,18.046c-4.444,0-8.046-3.603-8.046-8.046c0-4.444,3.603-8.046,8.046-8.046c4.443,0,8.046,3.602,8.046,8.046C18.046,14.443,14.443,18.046,10,18.046z"></path>
            </svg>
            close
        </a>
        <img src="images/freshlymind-4.jpg" alt="">
        <div class="popup-title">
            <span class="pre-text">Ecommerce</span>
            <h2>FreshlyMind.com</h2>
            <p>2016-2019</p>
        </div>
        <div class="popup-description">
            <p>Meditation & Yoga store build with WordPress and WooCommerce.</p>
        </div>
        <a href="#" class="popup-button">
            Read the full description

            <span class="right-arrow">
                                    <svg class="svg-icon" viewBox="0 0 20 20">
                                        <path fill="none" d="M11.611,10.049l-4.76-4.873c-0.303-0.31-0.297-0.804,0.012-1.105c0.309-0.304,0.803-0.293,1.105,0.012l5.306,5.433c0.304,0.31,0.296,0.805-0.012,1.105L7.83,15.928c-0.152,0.148-0.35,0.223-0.547,0.223c-0.203,0-0.406-0.08-0.559-0.236c-0.303-0.309-0.295-0.803,0.012-1.104L11.611,10.049z"></path>
                                    </svg>
                                </span>

        </a>
    </div>
</div>