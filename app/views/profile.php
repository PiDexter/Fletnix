<?php
/** @var $data array*/
?>

<section>
<!--    <div class="container">-->
<!--        <h1 class="page-title">Profiel</h1>-->
<!--    </div>-->
    <div class="tabs-wrapper">
        <input type="radio" name="tabs" id="tab-1" checked="checked">
        <label for="tab-1" class="tab-label">Gegevens</label>
        <div class="tab">

            <form action="" method="post">
                <div class="row">
                    <div class="column">
                        <div class="input-block fullwidth">
                            <input type="text" class="input-textField" name="name" placeholder="Voornaam" value="<?php echo $data['first_name'] ?? false ?>" required>
                            <label for="name" class="input-label">Voornaam</label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="column">
                        <div class="input-block fullwidth">
                            <input type="text" class="input-textField" name="lastName" placeholder="Achternaam" value="<?php echo $data['last_name'] ?? false ?>" required>
                            <label for="lastName" class="input-label">Achternaam</label>
                        </div>
                    </div>
                </div>

                <select name="country" class="">
                    <option value="Nederland">Nederland</option>
                    <option value="België">België</option>
                </select>
                <label for="country">Land</label>


                <div class="row">
                    <div class="column">
                        <div class="input-block fullwidth">
                            <input type="date" class="input-textField" name="dateOfBirth" placeholder="Geboortedatum" value="<?php echo $data['date_of_birth'] ?? false ?>" required>
                            <label for="dateOfBirth" class="input-label">Geboortedatum</label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="column">
                        <div class="input-block fullwidth">
                            <input type="email" class="input-textField" name="email" placeholder="E-mail" value="<?php echo $data['email'] ?? false ?>" required>
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
                        <button type="submit" class="btn btn-primary fullwidth">Wijzigingen opslaan</button>
                    </div>
                </div>
            </form>


        </div>

        <input type="radio" name="tabs" id="tab-2">
        <label for="tab-2" class="tab-label">Wachtwoord wijzigen</label>
        <div class="tab">
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

    </div>
</section>


<!--<section id="registerForm">-->
<!--    <div class="container">-->
<!--        <h1 class="page-title">Profiel</h1>-->
<!--        <form action="" method="post">-->
<!--            <div class="row">-->
<!--                <div class="column">-->
<!--                    <div class="input-block fullwidth">-->
<!--                        <input type="text" class="input-textField" name="name" placeholder="Voornaam" value="--><?php //echo $data['first_name'] ?><!--" required>-->
<!--                        <label for="name" class="input-label">Voornaam</label>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!---->
<!--            <div class="row">-->
<!--                <div class="column">-->
<!--                    <div class="input-block fullwidth">-->
<!--                        <input type="text" class="input-textField" name="lastName" placeholder="Achternaam" value="--><?php //echo $data['last_name'] ?><!--" required>-->
<!--                        <label for="lastName" class="input-label">Achternaam</label>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!---->
<!--            <select name="country" class="">-->
<!--                <option value="Nederland">Nederland</option>-->
<!--                <option value="België">België</option>-->
<!--            </select>-->
<!--            <label for="country">Land</label>-->
<!---->
<!---->
<!--            <div class="row">-->
<!--                <div class="column">-->
<!--                    <div class="input-block fullwidth">-->
<!--                        <input type="date" class="input-textField" name="dateOfBirth" placeholder="Geboortedatum" value="--><?php //echo $data['date_of_birth'] ?><!--" required>-->
<!--                        <label for="dateOfBirth" class="input-label">Geboortedatum</label>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!---->
<!--            <div class="row">-->
<!--                <div class="column">-->
<!--                    <div class="input-block fullwidth">-->
<!--                        <input type="email" class="input-textField" name="email" placeholder="E-mail" value="--><?php //echo $data['email'] ?><!--" required>-->
<!--                        <label for="email" class="input-label">E-mail</label>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!---->
<!--            <div class="row">-->
<!--                <div class="column">-->
<!--                    <div class="input-block fullwidth">-->
<!--                        <input type="number" class="input-textField" name="bankAccount" placeholder="Rekeningnummer" required>-->
<!--                        <label for="bankAccount" class="input-label">Rekeningnummer</label>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!---->
<!--            <div class="row">-->
<!--                <div class="column">-->
<!--                    <div class="input-block fullwidth">-->
<!--                        <input type="password" class="input-textField" name="password" placeholder="Password" required>-->
<!--                        <label for="password" class="input-label">Password</label>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!---->
<!--            <div class="row">-->
<!--                <div class="column">-->
<!--                    <div class="input-block fullwidth">-->
<!--                        <input type="password" class="input-textField" name="confirmPassword" placeholder="Confirm Password" required>-->
<!--                        <label for="confirmPassword" class="input-label">Confirm Password</label>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!---->
<!--            <div class="row">-->
<!--                <div class="column">-->
<!--                    <button type="submit" class="btn btn-primary fullwidth">Wijzigingen opslaan</button>-->
<!--                </div>-->
<!--            </div>-->
<!--        </form>-->
<!---->
<!--    </div>-->
<!--</section>-->

