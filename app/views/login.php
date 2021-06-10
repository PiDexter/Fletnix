<section id="loginForm" class="form-container">
    <div class="container">
        <h1 class="form-title">Inloggen</h1>
        <form method="post">
            <div class="input-block fullwidth">
                <input type="email" id="email-input" name="email" placeholder="E-mail" value="{{email}}" required>
                <label for="email-input" class="input-label">E-mail</label>
            </div>
            <div class="input-block fullwidth">
                <input type="password" id="password-input" name="password" placeholder="Password" autocomplete="on" required>
                <label for="password-input" class="input-label">Password</label>
            </div>
            <div class="input-block fullwidth">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
        </form>

        <div class="row" id="loginSignup">
            <div class="column content-left">
                <p>Nog geen lid?
                    <a href="/register">Registreer je nu</a>
                </p>
            </div>
        </div>

    </div>
</section>
