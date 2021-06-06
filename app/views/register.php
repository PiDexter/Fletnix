<section id="registerForm" class="form-container">
    <div class="container">
        <h1 class="page-title">Registreren</h1>
        <form action="" method="post">
            <div class="row">
                <div class="column">
                    <div class="input-block fullwidth">
                        <input type="text" class="input-textField" name="first_name" placeholder="Voornaam" value="{{first_name}}" required>
                        <label for="first_name" class="input-label">Voornaam</label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="column">
                    <div class="input-block fullwidth">
                        <input type="text" class="input-textField" name="last_name" placeholder="Achternaam" value="{{last_name}}" required>
                        <label for="last_name" class="input-label">Achternaam</label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="column input-block fullwidth">
                    <select name="country" class="input-select" aria-label="Land selecteren">
                        <option value="Nederland">Nederland</option>
                        <option value="België">België</option>
                    </select>
                    <label for="country" class="input-label">Land</label>
                </div>
            </div>

            <div class="row">
                <div class="column">
                    <div class="input-block fullwidth">
                        <input type="date" class="input-textField" name="date_of_birth" placeholder="Geboortedatum" value="{{date_of_birth}}" required>
                        <label for="date_of_birth" class="input-label">Geboortedatum</label>
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
                        <input type="number" class="input-textField" name="bank_number" placeholder="Rekeningnummer" value="{{bank_number}}" required>
                        <label for="bank_number" class="input-label">Rekeningnummer</label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="column">
                    <div class="input-block fullwidth">
                        <input type="password" class="input-textField" name="password" placeholder="Password" required>
                        <label for="password" class="input-label">Password</label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="column">
                    <div class="input-block fullwidth">
                        <input type="password" class="input-textField" name="confirm_password" placeholder="Confirm Password" required>
                        <label for="confirm_password" class="input-label">Confirm Password</label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="column">
                    <button type="submit" class="btn btn-primary fullwidth">Registreren</button>
                </div>
            </div>
        </form>

        <div class="row" id="loginSignup">
            <div class="column content-left">
                <p>Ben je al lid?
                    <a href="/login">Inloggen</a>
                </p>
            </div>
        </div>

    </div>
</section>
