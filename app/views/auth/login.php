<section id="loginForm" class="form-container">
    <div class="container">
        <h1 class="form-title">Login</h1>
        <form method="POST">

            <label class="input-block fullwidth validation-error">{{error}}</label>

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
                <p>Not registered?
                    <a href="/register"><u>Create account</u></a>
                </p>
            </div>
        </div>

    </div>
</section>
