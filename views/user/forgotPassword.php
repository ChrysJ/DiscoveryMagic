<main class="form-main">
    <div class="title-form">
        <h1>Mot de passe oublié</h1>
        <p>Saisissez l'adresse e-mail associé à votre espace DiscoveryMagic</p>
    </div>
    <div class="form-box">
        <form action="/" method="POST">
            
            <!-- ------------------------------ -->
            <!-- Mail -->
            <!-- ------------------------------ -->
            <div>
                <label for="mail" class="form-label">Adresse mail *</label>
                <input value="<?= $mail ?? '' ?>" name="mail" type="email" id="mail" class="form-input" autocomplete="email" required placeholder="doe.john@gmail.com">
                <p class="input-error-text" id="mailTextError"><?= $error['mail'] ?? '' ?></p>
            </div>

            <!-- ------------------------------ -->
            <!-- Submit -->
            <!-- ------------------------------ -->
            <div class="submit">
                <button id="submit" type="submit">Continuer</button>
            </div>
        </form>
    </div>
</main>