<?php
/* @var $data array */
?>

<section id="search-filter" class="form-container">
    <div class="container">
        <h1>Doorzoek alle films</h1>
        <form action="/results" method="get">
            <div class="row">
                <div class="column">
                    <div class="input-block fullwidth">
                        <input type="text" name="title" id="title-input" placeholder="Zoek in titel">
                        <label for="title-input" class="input-label">Titel bevat</label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="column">
                    <div class="input-block fullwidth">
                        <select name="genre" id="genre-input" class="input-select" aria-label="Genre selecteren">
                            <option value="" selected>Alle genres</option>
                            <?php foreach($data as $genre) : ?>
                                <option value="<?php echo $genre['genre_name']; ?>"><?php echo $genre['genre_name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <label for="genre-input" class="input-label">Genre</label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="column">
                    <div class="input-block fullwidth">
                        <input type="number" name="publicationYear" id="publication-year" placeholder="Publicatiejaar">
                        <label for="publication-year" class="input-label">Publicatiejaar</label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="column">
                    <div class="input-block fullwidth">
                        <input type="text" name="director" id="director-input" placeholder="Regisseur">
                        <label for="director-input" class="input-label">Regisseur</label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="column">
                    <button type="submit" class="btn btn-primary fullwidth">Zoeken</button>
                </div>
            </div>
        </form>

    </div>
</section>
