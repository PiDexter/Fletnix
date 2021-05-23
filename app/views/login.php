<?php ?>
<section id="loginForm">
    <div class="container">
        <h1 class="page-title">Inloggen</h1>
        <form action="login" method="post">
            <div class="row">
                <div class="column">
                    <div class="input-block fullwidth">
                        <input type="email" class="input-textField" name="email" placeholder="E-mail" required>
                        <label for="email" class="input-label">E-mail</label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="column">
                    <div class="input-block fullwidth">
                        <input type="password" class="input-textField" name="password" placeholder="Password" autocomplete="on" required>
                        <label for="password" class="input-label">Password</label>
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
                    <a href="#">Registreer je nu</a>
                </p>
            </div>
        </div>

    </div>
</section>
