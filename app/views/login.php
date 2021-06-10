<section id="loginForm" class="form-container">
    <div class="container">
        <h1 class="page-title">Inloggen</h1>
        <form method="post">
            <div class="row">
                <div class="column">
                    <div class="input-block fullwidth">
                        <input type="email" id="email-input" name="email" placeholder="E-mail" value="{{email}}" required>
                        <label for="email-input" class="input-label">E-mail</label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="column">
                    <div class="input-block fullwidth">
                        <input type="password" id="password-input" name="password" placeholder="Password" autocomplete="on" required>
                        <label for="password-input" class="input-label">Password</label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="column">
                    <button type="submit" class="btn btn-primary fullwidth">Login</button>
                </div>
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
