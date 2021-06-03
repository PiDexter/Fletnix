<?php
/* @var $data array */
?>

<section id="searchFilter">
    <div class="container">

        <form action="/results" method="post">
            <div class="row">
                <div class="column">
                    <div class="input-block fullwidth">
                        <input type="text" name="title" class="" placeholder="Zoek in titel">
                        <label for="title" class="input-label">Titel bevat</label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="column">
                    <div class="input-block fullwidth">
                        <select name="genre" class="input-select" aria-label="Genre selecteren">
                            <option value="" selected>Alle genres</option>
                            <?php foreach($data as $genre) : ?>
                                <option aria-label="<?php echo $genre['genre_name']; ?>" value="<?php echo $genre['genre_name']; ?>"><?php echo $genre['genre_name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <label for="genre" class="input-label">Genre</label>
                    </div>
                </div>
            </div>



            <div class="row">
                <div class="column">
                    <div class="input-block fullwidth">
                        <input type="number" class="input-textField" name="publicationYear" maxlength="4" placeholder="Publicatiejaar">
                        <label for="publicationYear" class="input-label">Publicatiejaar</label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="column">
                    <div class="input-block fullwidth">
                        <input type="text" name="director" class="" placeholder="Voornaam">
                        <label for="director" class="input-label">Regisseur</label>
                    </div>
                </div>
                <div class="column">
                    <div class="input-block fullwidth">
                        <input type="text" name="lastName" class="" placeholder="Achternaam">
                        <label for="lastName" class="input-label">Achternaam</label>
                    </div>
                </div>
            </div>

<!--            <select name="genre" class="">-->
<!--                <option value="genre">Opties</option>-->
<!--            </select>-->
<!--            <label for="genre">Genre</label>-->

            <div class="row">
                <div class="column">
                    <button type="submit" class="btn btn-primary fullwidth">Zoeken</button>
                </div>
            </div>
        </form>

    </div>
</section>
