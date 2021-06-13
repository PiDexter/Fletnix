<section class="form-container" id="edit-password">

    <div class="container">
        <h1 class="form-title">Change password</h1>

        <form method="POST">

            <div class="input-block fullwidth">
                <input type="password" name="currentPassword" id="currentpassword-input" placeholder="Current password" required>
                <label for="currentpassword-input" class="input-label">Current password</label>
            </div>

            <div class="input-block fullwidth">
                <input type="password" name="newPassword" id="newpassword-input" placeholder="New password" required>
                <label for="newpassword-input" class="input-label">New password</label>
            </div>

            <div class="input-block fullwidth">
                <input type="password" name="confirmPassword" id="confirmpassword-input" placeholder="Confirm password" required>
                <label for="confirmpassword-input" class="input-label">Confirm password</label>
            </div>

            <div class="input-block fullwidth">
                <button type="submit" class="btn btn-primary">Save password</button>
            </div>

        </form>

    </div>
</section>