<section id="registerForm" class="form-container">
    <div class="container">
        <h1 class="form-title">Registreren</h1>

        <form method="post">

            <div class="input-block fullwidth">
                <input type="text" name="first_name" id="firstname-input" placeholder="Voornaam" value="{{first_name}}" required>
                <label for="firstname-input" class="input-label">Voornaam</label>
            </div>

            <div class="input-block fullwidth">
                <input type="text" name="last_name" id="lastname-input" placeholder="Achternaam" value="{{last_name}}" required>
                <label for="lastname-input" class="input-label">Achternaam</label>
            </div>

            <div class="input-block fullwidth">
                <select name="country" class="input-select" id="country-input" aria-label="Land selecteren">
                    <option value="Nederland">Nederland</option>
                    <option value="België">België</option>
                </select>
                <label for="country-input" class="input-label">Land</label>
            </div>

            <div class="input-block fullwidth">
                <input type="date" name="date_of_birth" id="dateofbirth-input" value="{{date_of_birth}}" required>
                <label for="dateofbirth-input" class="input-label">Geboortedatum</label>
            </div>

            <div class="input-block fullwidth">
                <input type="email" name="email" id="email-input" placeholder="E-mail" value="{{email}}" required>
                <label for="email-input" class="input-label">E-mail</label>
            </div>

            <div class="input-block fullwidth">
                <input type="number" name="bank_number" id="banknumber-input" placeholder="Rekeningnummer" value="{{bank_number}}" required>
                <label for="banknumber-input" class="input-label">Rekeningnummer</label>
            </div>

            <div class="input-block fullwidth">
                <input type="password" name="password" id="password-input" placeholder="Password" required>
                <label for="password-input" class="input-label">Password</label>
            </div>

            <div class="input-block fullwidth">
                <input type="password" name="confirm_password" id="confirmpassword-input" placeholder="Confirm Password" required>
                <label for="confirmpassword-input" class="input-label">Confirm Password</label>
            </div>

            <div class="input-block fullwidth">
                <button type="submit" class="btn btn-primary">Registreren</button>
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
