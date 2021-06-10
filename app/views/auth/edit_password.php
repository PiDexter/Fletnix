<?php
?>

<section class="form-container" id="edit-password">

    <div class="container">

            @displayFlashMessage

        <h1 class="form-title">Wachtwoord wijzigen</h1>

        <form method="post">

            <div class="input-block fullwidth">
                <input type="password" name="currentPassword" id="currentpassword-input" placeholder="Huidig wachtwoord" required>
                <label for="currentpassword-input" class="input-label">Huidig wachtwoord</label>
            </div>

            <div class="input-block fullwidth">
                <input type="password" name="newPassword" id="newpassword-input" placeholder="Nieuw wachtwoord" required>
                <label for="newpassword-input" class="input-label">Nieuw wachtwoord</label>
            </div>

            <div class="input-block fullwidth">
                <input type="password" name="confirmPassword" id="confirmpassword-input" placeholder="Confirm Password" required>
                <label for="confirmpassword-input" class="input-label">Confirm Password</label>
            </div>

            <div class="input-block fullwidth">
                <button type="submit" class="btn btn-primary">Wijziging opslaan</button>
            </div>

        </form>

    </div>
</section>