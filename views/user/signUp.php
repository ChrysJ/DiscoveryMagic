<main class="form-main">
    <div class="title-form">
        <h1>Créer un compte !</h1>
        <p>Pour partager votre magie et mettre vos parcs en favoris.</p>
    </div>

    <?php
    if (isset($error['add'])) {
        echo '<p class="message">' . $error['add'] .  '</p>';
    }
    ?>

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
            <input value="<?= $ref_avatar ?? '1' ?>" type="hidden" name="ref_avatar" id="ref_avatar">
        </div>

        <div class="form-row">
            <!-- ------------------------------ -->
            <!-- Username -->
            <!-- ------------------------------ -->
            <div>
                <label for="username" class="form-label">Nom d'utilisateur *</label>
                <input value="<?= $username ?? '' ?>" name="username" type="text" id="username" class="form-input" autocomplete="name" required placeholder="Doe" pattern="<?= REGEX_NO_NUMBER ?>">
                <p class="input-error-text" id="usernameTextError"><?= $error['username'] ?? '' ?></p>
            </div>

            <!-- ------------------------------ -->
            <!-- Mail -->
            <!-- ------------------------------ -->
            <div>
                <label for="mail" class="form-label">Adresse mail *</label>
                <input value="<?= $mail ?? '' ?>" name="mail" type="email" id="mail" class="form-input" autocomplete="email" required placeholder="doe.john@gmail.com">
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

        <p class="conditions-text">En créant un compte, vous acceptez nos <a href="">Conditions d'utilisation</a> et reconnaissez que vous avez lu les Règles de respect de la vie privée, <a href="">les Modalités relatives aux cookies</a></p>

        <!-- ------------------------------ -->
        <!-- Submit -->
        <!-- ------------------------------ -->
        <div class="submit">
            <button id="submit" type="submit">Créer un compte</button>
        </div>
        <!-- ------------------------------ -->
        <!-- Bottom form -->
        <!-- ------------------------------ -->
        <div class="box-bottom-form">
            <p>Vous avez déjà un compte ?</p>
            <a href="/connexion">Vous connecté</a>
        </div>
    </form>


</main>