<?php
/** @var $data array*/
?>

<section class="form-container" id="profile-list">
    <div class="container">
        <h1>Profiel</h1>
        <span class="">Welkom terug, <?php echo $_SESSION['name'] ?>!</span>
        <div class="card-grid">
            <a href="" class="card">Abonnement</a>
            <a href="/profile/edit" class="card">Accountgegevens</a>
            <a href="/profile/change-password" class="card">Wachtwoord wijzigen</a>
            <a href="/logout" class="card">Uitloggen</a>
        </div>
    </div>
</section>
