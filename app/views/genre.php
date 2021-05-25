<?php
?>

<section id="genres">
    <div class="container">
        <div class="card-grid">
            <?php foreach($data as $genre) : ?>
                <a href="/genre/<?php echo $genre['genre_name']; ?>" class="card">
                    <?php echo $genre['genre_name']; ?>
                </a>
            <?php endforeach; ?>
        </div>
    </div>

</section>