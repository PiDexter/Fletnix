<?php
?>

<section id="edit-account">
    <div class="container">
        <h1>Accountgegevens</h1>
        <form action="" method="post">
            <div class="row">
                <div class="column">
                    <div class="input-block fullwidth">
                        <input type="text" class="input-textField" name="name" placeholder="Voornaam" value="{{first_name}}" required>
                        <label for="name" class="input-label">Voornaam</label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="column">
                    <div class="input-block fullwidth">
                        <input type="text" class="input-textField" name="lastName" placeholder="Achternaam" value="{{last_name}}" required>
                        <label for="lastName" class="input-label">Achternaam</label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="column">
                    <div class="input-block fullwidth">
                        <select name="country" class="">
                            <option value="Nederland">Nederland</option>
                            <option value="België">België</option>
                        </select>
                        <label for="country" class="input-label">Land</label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="column">
                    <div class="input-block fullwidth">
                        <input type="date" class="input-textField" name="dateOfBirth" placeholder="Geboortedatum" value="{{date_of_birth}}" required>
                        <label for="dateOfBirth" class="input-label">Geboortedatum</label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="column">
                    <div class="input-block fullwidth">
                        <input type="email" class="input-textField" name="email" placeholder="E-mail" value="{{email}}" required>
                        <label for="email" class="input-label">E-mail</label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="column">
                    <div class="input-block fullwidth">
                        <input type="number" class="input-textField" name="bankAccount" placeholder="Rekeningnummer" value="{{bank_number}}" required>
                        <label for="bankAccount" class="input-label">Rekeningnummer</label>
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