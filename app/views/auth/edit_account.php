<?php
?>

<section class="form-container" id="edit-account">
    <div class="container">
        <h1>Accountgegevens</h1>
        <form method="post">
            <div class="row">
                <div class="column">
                    <div class="input-block fullwidth">
                        <input type="text" name="name" id="firstname-input" placeholder="Voornaam" value="{{first_name}}" required>
                        <label for="firstname-input" class="input-label">Voornaam</label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="column">
                    <div class="input-block fullwidth">
                        <input type="text" name="lastName" id="lastname-input" placeholder="Achternaam" value="{{last_name}}" required>
                        <label for="lastname-input" class="input-label">Achternaam</label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="column input-block fullwidth">
                    <select name="country" class="input-select" id="country-input" aria-label="Land selecteren">
                        <option value="Nederland">Nederland</option>
                        <option value="België">België</option>
                    </select>
                    <label for="country-input" class="input-label">Land</label>
                </div>
            </div>

            <div class="row">
                <div class="column">
                    <div class="input-block fullwidth">
                        <input type="date" name="date_of_birth" id="dateofbirth-input" value="{{date_of_birth}}" required>
                        <label for="dateofbirth-input" class="input-label">Geboortedatum</label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="column">
                    <div class="input-block fullwidth">
                        <input type="email" name="email" id="email-input" placeholder="E-mail" value="{{email}}" required>
                        <label for="email-input" class="input-label">E-mail</label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="column">
                    <div class="input-block fullwidth">
                        <input type="number" name="bank_number" id="banknumber-input" placeholder="Rekeningnummer" value="{{bank_number}}" required>
                        <label for="banknumber-input" class="input-label">Rekeningnummer</label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="column">
                    <button type="submit" class="btn btn-primary fullwidth">Wijzigingen opslaan</button>
                </div>
            </div>
        </form>
    </div>
</section>