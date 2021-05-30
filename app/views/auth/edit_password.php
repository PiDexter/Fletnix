<?php
?>

<section id="edit-password">

    <div class="container">

            @displayFlashMessage

        <h1>Wachtwoord wijzigen</h1>
        <form action="" method="post">
            <div class="row">
                <div class="column">
                    <div class="input-block fullwidth">
                        <input type="password" class="input-textField" name="currentPassword" placeholder="Huidig wachtwoord" required>
                        <label for="currentPassword" class="input-label">Huidig wachtwoord</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="column">
                    <div class="input-block fullwidth">
                        <input type="password" class="input-textField" name="newPassword" placeholder="Nieuw wachtwoord" required>
                        <label for="newPassword" class="input-label">Nieuw wachtwoord</label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="column">
                    <div class="input-block fullwidth">
                        <input type="password" class="input-textField" name="confirmPassword" placeholder="Confirm Password" required>
                        <label for="confirmPassword" class="input-label">Confirm Password</label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="column">
                    <button type="submit" class="btn btn-primary fullwidth">Wijziging opslaan</button>
                </div>
            </div>
        </form>
    </div>
</section>