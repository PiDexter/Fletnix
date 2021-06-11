<section class="form-container" id="edit-account">
    <div class="container">

        <h1 class="form-title">Account details</h1>

        <form method="post">

            <div class="input-block fullwidth">
                <input type="text" name="name" id="firstname-input" placeholder="First name" value="{{first_name}}" required>
                <label for="firstname-input" class="input-label">First name</label>
            </div>

            <div class="input-block fullwidth">
                <input type="text" name="lastName" id="lastname-input" placeholder="Last name" value="{{last_name}}" required>
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
                <button type="submit" class="btn btn-primary fullwidth">Save changes</button>
            </div>

        </form>

    </div>
</section>