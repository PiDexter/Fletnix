<section id="registerForm" class="form-container">
    <div class="container">
        <h1 class="form-title">Register</h1>

        <form method="post">

            <div class="input-block fullwidth">
                <input type="text" name="first_name" id="firstname-input" placeholder="First name" value="{{first_name}}" minlength="1" maxlength="40" required>
                <label for="firstname-input" class="input-label">First name</label>
            </div>

            <div class="input-block fullwidth">
                <input type="text" name="last_name" id="lastname-input" placeholder="Last name" value="{{last_name}}" minlength="1" maxlength="40" required>
                <label for="lastname-input" class="input-label">Last name</label>
            </div>

            <div class="input-block fullwidth">
                <select name="country" class="input-select" id="country-input" aria-label="Select country">
                    <option value="Netherlands">Netherlands</option>
                    <option value="Belgium">Belgium</option>
                </select>
                <label for="country-input" class="input-label">Country</label>
            </div>

            <div class="input-block fullwidth">
                <input type="date" name="date_of_birth" id="dateofbirth-input" value="{{date_of_birth}}" required>
                <label for="dateofbirth-input" class="input-label">Date of birth</label>
            </div>

            <div class="input-block fullwidth">
                <input type="email" name="email" id="email-input" placeholder="E-mail" value="{{email}}" required>
                <label for="email-input" class="input-label">E-mail</label>
            </div>

            <div class="input-block fullwidth">
                <input type="number" name="bank_number" id="banknumber-input" placeholder="Bank account number" value="{{bank_number}}" required>
                <label for="banknumber-input" class="input-label">Bank account number</label>
            </div>

            <div class="input-block fullwidth">
                <input type="password" name="password" id="password-input" placeholder="Password" minlength="8" required>
                <label for="password-input" class="input-label">Password</label>
            </div>

            <div class="input-block fullwidth">
                <input type="password" name="confirm_password" id="confirmpassword-input" placeholder="Confirm Password" required>
                <label for="confirmpassword-input" class="input-label">Confirm Password</label>
            </div>

            <div class="input-block fullwidth">
                <button type="submit" class="btn btn-primary">Create account</button>
            </div>

        </form>

        <div class="row" id="loginSignup">
            <div class="column content-left">
                <p>Already registered?
                    <a href="/login"><u>Login</u></a>
                </p>
            </div>
        </div>

    </div>
</section>
