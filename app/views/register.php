<?php ?>
<section id="registerForm">
    <div class="container">
        <h1 class="page-title">Registreren</h1>
        <form action="" method="post">
            <div class="row">
                <div class="column">
                    <div class="input-block fullwidth">
                        <input type="text" class="input-textField" name="name" placeholder="Voornaam" required>
                        <label for="name" class="input-label">Voornaam</label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="column">
                    <div class="input-block fullwidth">
                        <input type="text" class="input-textField" name="lastName" placeholder="Achternaam" required>
                        <label for="lastName" class="input-label">Achternaam</label>
                    </div>
                </div>
            </div>

            <select name="country" class="">
                <option value="volvo">Nederland</option>
                <option value="volvo">België</option>
            </select>
            <label for="cars">Land</label>


            <div class="row">
                <div class="column">
                    <div class="input-block fullwidth">
                        <input type="date" class="input-textField" name="dateOfBirth" placeholder="Geboortedatum" required>
                        <label for="dateOfBirth" class="input-label">Geboortedatum</label>
                    </div>
                </div>
            </div>

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
                        <input type="number" class="input-textField" name="bankAccount" placeholder="Rekeningnummer" required>
                        <label for="bankAccount" class="input-label">Rekeningnummer</label>
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
                        <input type="password" class="input-textField" name="confirmPassword" placeholder="Confirm Password" required>
                        <label for="confirmPassword" class="input-label">Confirm Password</label>
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
                    <a href="#">Inloggen</a>
                </p>
            </div>
        </div>

    </div>
</section>
