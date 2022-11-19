<main class="form-main">
    <div class="title-form">
        <h1>Contactez nous !</h1>
        <p>Pour toutes question ou demande.</p>
    </div>
    <div class="form-box">
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
            <!-- Message -->
            <!-- ------------------------------ -->
            <div>
                <label for="message" class="form-label">Message *<br><span class="format">( 250 caractères max )</span></label>
                <textarea class="form-input" name="message" id="message" required><?= $message ?? '' ?></textarea>
                <p class="input-error-text"><?= $error['message'] ?? '' ?></p>
            </div>

            <p class="conditions-text">J’ai bien pris connaissance de la <a href="#">déclaration de confidentialité</a>.</p>

            <!-- ------------------------------ -->
            <!-- Submit -->
            <!-- ------------------------------ -->
            <div class="submit-contact">
                <button id="submit" type="submit">Envoyer</button>
            </div>
        </form>
    </div>
</main>