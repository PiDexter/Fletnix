<?php
/* @var $data array */
?>

<section id="search-filter" class="form-container">
    <div class="container">

        <h1 class="form-title">Doorzoek alle films</h1>

        <form action="/results" method="get">

            <div class="input-block fullwidth">
                <input type="text" name="title" id="title-input" placeholder="Zoek in titel">
                <label for="title-input" class="input-label">Titel bevat</label>
            </div>

            <div class="input-block fullwidth">
                <select name="genre" id="genre-input" class="input-select" aria-label="Genre selecteren">
                    <option value="" selected>Alle genres</option>
                    <?php foreach($data['genre'] as $genre) : ?>
                        <option value="<?php echo $genre['genre_name']; ?>"><?php echo $genre['genre_name']; ?></option>
                    <?php endforeach; ?>
                </select>
                <label for="genre-input" class="input-label">Genre</label>
            </div>

            <div class="input-block fullwidth">
                <select name="publicationYear" id="year-input" class="input-select" aria-label="Publicatiejaar selecteren">
                    <option value="" selected>Selecteer jaartal</option>
                    <?php foreach($data['years'] as $year) : ?>
                        <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
                    <?php endforeach; ?>
                </select>
                <label for="year-input" class="input-label">Publicatiejaar</label>
            </div>

            <div class="input-block fullwidth">
                <input type="text" name="director" id="director-input" placeholder="Regisseur">
                <label for="director-input" class="input-label">Regisseur</label>
            </div>

            <div class="input-block fullwidth">
                <button type="submit" class="btn btn-primary">Zoeken</button>
            </div>
        </form>

    </div>
</section>
