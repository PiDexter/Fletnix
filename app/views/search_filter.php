<?php

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

            <select name="genre" class="" >
                <option value="Action" selected>Opties</option>
            </select>
            <label for="genre">Genre</label>

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
                        <input type="text" name="firstName" class="" placeholder="Voornaam">
                        <label for="firstName" class="input-label">Voornaam</label>
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
