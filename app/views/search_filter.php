<?php

?>

<section id="searchFilter">
    <div class="container">

        <form action="" method="post">
            <div class="row">
                <div class="column">
                    <div class="input-block fullwidth">
                        <input type="text" name="title" class="" placeholder="Zoek in titel">
                        <label for="title">Titel bevat</label>
                    </div>
                </div>
            </div>

            <select name="genre" class="">
                <option value="genre">Opties</option>
            </select>
            <label for="genre">Genre</label>

            <div class="row">
                <div class="column">
                    <div class="input-block fullwidth">
                        <input type="number" class="input-textField" name="startDate" maxlength="4" placeholder="Vanaf jaartal">
                        <label for="startDate" class="input-label">Vanaf jaartal</label>
                    </div>
                </div>
                <div class="column">
                    <div class="input-block fullwidth">
                        <input type="number" class="input-textField" name="endDate" maxlength="4" placeholder="Tot jaartal">
                        <label for="endDate" class="input-label">Tot jaartal</label>
                    </div>
                </div>
            </div>

            <select name="genre" class="">
                <option value="genre">Opties</option>
            </select>
            <label for="genre">Genre</label>

            <div class="row">
                <div class="column">
                    <button type="submit" class="btn btn-primary fullwidth">Search</button>
                </div>
            </div>
        </form>

    </div>
</section>
