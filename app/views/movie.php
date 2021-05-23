<?php ?>

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
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est, exercitationem, mollitia!
                Ab ad commodi dolorem eius esse.
            </p>
        </div>
    </div>
</section>

<section>
    <div class="tabs-wrapper">
        <input type="radio" name="tabs" id="tab-1" checked="checked">
        <label for="tab-1" class="tab-label">Details</label>
        <div class="tab">
            <p>
                {{description}}
            </p>
        </div>

        <input type="radio" name="tabs" id="tab-2">
        <label for="tab-2" class="tab-label">Meer zoals dit</label>
        <div class="tab">
            <p>
                Content 23
            </p>
        </div>

    </div>
</section>
