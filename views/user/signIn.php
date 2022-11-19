<main class="form-main">
    <div class="title-form">
        <h1>Connectez-vous</h1>
        <p>Accéder à votre espace DiscoveryMagic.</p>
    </div>
    <div class="form-box">

        <?php
        if (isset($error['connexion'])) {
            echo '<p class="message">' . $error['connexion'] .  '</p>';
        }
        ?>

        <form method="POST">

            <!-- ------------------------------ -->
            <!-- Mail -->
            <!-- ------------------------------ -->
            <div>
                <label for="mail" class="form-label">Adresse mail *</label>
                <input value="<?= $mail ?? '' ?>" name="mail" type="email" id="mail" class="form-input" autocomplete="email" required placeholder="doe.john@gmail.com">
                <p class="input-error-text" id="mailTextError"><?= $error['mail'] ?? '' ?></p>
            </div>

            <!-- ------------------------------ -->
            <!-- Password -->
            <!-- ------------------------------ -->
            <div>
                <label for="password" class="form-label">Mot de passe *</label>
                <input value="<?= $password ?? '' ?>" name="password" type="password" id="password" class="form-input" required>
                <p class="input-error-text" id="passwordTextError"><?= $error['password'] ?? '' ?></p>
            </div>

            <!-- ------------------------------ -->
            <!-- Submit -->
            <!-- ------------------------------ -->
            <div class="submit">
                <button id="submit" type="submit">Connectez-vous</button>
            </div>

            <div class="box-bottom-form">
                <p>Besoin d'aide pour vous connecter ?</p>
                <a href="/mot_de_passe_oublie">Mot de passe oublié</a>
            </div>

            <div class="box-bottom-form">
                <p>Vous n'avez pas encore de compte ?</p>
                <a href="/creation_compte">Créer un compte</a>
            </div>
        </form>
    </div>
</main>