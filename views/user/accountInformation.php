<main class="form-main">
    <div class="title-form">
        <h1>Informations de votre espace discoverymagic</h1>
        <p>Certaines de ces informations peuvent êtres vues par les autres utilisateurs</p>
    </div>


    <form class="account" method="POST">

        <!-- ------------------------------ -->
        <!-- Avatar -->
        <!-- ------------------------------ -->
        <div>
            <label class="form-label">Avatar</label>
            <div class="user-avatar-choice">
                <ul class="avatar-list">
                    <?php
                    foreach ($avatars as $key => $avatar) {
                    ?>
                        <li class="avatar-choice" data-value="<?= $key + 1 ?>"><img src="<?= $avatar->getFileInfo() ?>"></li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
            <p class="input-error-text"><?= $error['ref_avatar'] ?? '' ?></p>
            <input value="<?= $ref_avatar ?? '' ?>" type="hidden" name="ref_avatar" id="ref_avatar">
        </div>

        <div class="form-row">
            <!-- ------------------------------ -->
            <!-- Username -->
            <!-- ------------------------------ -->
            <div>
                <label for="username" class="form-label">Nom d'utilisateur *</label>
                <input value="<?= $username ?? '' ?>" name="username" type="text" id="username" class="form-input" autocomplete="name">
                <p class="input-error-text" id="usernameTextError"><?= $error['username'] ?? '' ?></p>
            </div>

            <!-- ------------------------------ -->
            <!-- Mail -->
            <!-- ------------------------------ -->
            <div>
                <label for="mail" class="form-label">Adresse mail *</label>
                <input value="<?= $mail ?? '' ?>" name="mail" type="email" id="mail" class="form-input" autocomplete="email">
                <p class="input-error-text" id="mailTextError"><?= $error['mail'] ?? '' ?></p>
            </div>
        </div>

        <div class="form-row">
            <!-- ------------------------------ -->
            <!-- Password -->
            <!-- ------------------------------ -->
            <div>
                <label for="password" class="form-label">Mot de passe *</label>
                <div class="password-box">
                    <input value="<?= $password ?? '' ?>" name="password" type="password" id="password" class="form-input" required>
                    <span class='viewpassword'><i class="fa-solid fa-eye"></i></span>
                </div>
                <p class="input-error-text" id="passwordTextError"><?= $error['password'] ?? '' ?></p>
            </div>

            <!-- ------------------------------ -->
            <!-- Confirm Password -->
            <!-- ------------------------------ -->
            <div>
                <label for="confirmPassword" class="form-label">Comfirmer mot de passe *</label>
                <input value="<?= $confirmPassword ?? '' ?>" name="confirmPassword" type="password" id="confirmPassword" class="form-input" disabled required>
                <p class="input-error-text" id="confirmPasswordTextError"><?= $error['confirmPassword'] ?? '' ?></p>
            </div>
        </div>

        <!-- ------------------------------ -->
        <!-- Submit -->
        <!-- ------------------------------ -->
        <div class="submit">
            <button id="submit" type="submit">Modifier mon compte</button>
        </div>
    </form>

</main>