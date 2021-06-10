<?php
/** @var $data array*/
?>

<section class="form-container" id="profile-list">
    <div class="container">
        <h1>Profile</h1>
        <span class="">Hey <?php echo $_SESSION['name'] ?>, welcome back!</span>
        <div class="card-grid">
            <a href="" class="card">Subscription</a>
            <a href="/profile/edit" class="card">Account details</a>
            <a href="/profile/change-password" class="card">Change password</a>
            <a href="/logout" class="card">Logout</a>
        </div>
    </div>
</section>
