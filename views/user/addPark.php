<main class="form-main">
    <div class="title-form">
        <h1>Vous souhaitez partager votre magie</h1>
        <p>Faites une demande d’ajout de votre parc !</p>
    </div>
    <?php
    if (isset($error['add'])) {
        echo '<p class="message">' . $error['add'] .  '</p>';
    }
    ?>
    <form class="add-park" novalidate enctype="multipart/form-data" method="POST">
        <div class="informations-park">
            <div class="title-section-add-park">
                <h2>Informations sur le parc<span>*</span></h2>
            </div>

            <!-- Nom du parc -->
            <div>
                <label for="name" class="form-label">Nom du parc *</label>
                <input value="<?= $name ?? 'Puy du fou' ?>" name="name" type="text" id="name" class="form-input" required placeholder="DisneylandParis">
                <p class="input-error-text" id="nameTextError"><?= $error['name'] ?? '' ?></p>
            </div>

            <!-- Url  -->
            <div>
                <label for="url" class="form-label">Url site internet du parc *</label>
                <input value="<?= $url ?? 'https://www.puydufou.com/france/fr' ?>" name="url" type="url" id="url" class="form-input" placeholder="https://exemple-mon-parc.com" required>
                <p class="input-error-text" id="urlTextError"><?= $error['url'] ?? '' ?></p>
            </div>

            <!-- Région du parc -->
            <div>
                <label for="region" class="form-label">Région du parc *</label>
                <select name="region" id="region" class="form-input" required>
                    <option>Sélectionnez la région du parc</option>
                    <?php
                    foreach ($getRegions as $getRegion) {
                        $isSelected = ($getRegion->id == $region) ? 'selected' : '';
                        echo "<option $isSelected value=\"$getRegion->id\" >$getRegion->region</option>";
                    }
                    ?>
                </select>
                <p class="input-error-text" id="RegionTextError"><?= $error['region'] ?? '' ?></p>
            </div>

            <!-- Theme du parc -->
            <div>
                <label for="theme" class="form-label">Thème du parc *</label>
                <select name="theme" id="theme" class="form-input" required>
                    <option>Sélectionnez le thème du parc</option>
                    <?php
                    foreach ($getThemes as $getTheme) {
                        $isSelected = ($getTheme->id == $theme) ? 'selected' : '';
                        echo "<option $isSelected value=\"$getTheme->id\" >$getTheme->theme</option>";
                    }
                    ?>
                </select>
                <p class="input-error-text" id="ThemeTextError"><?= $error['theme'] ?? '' ?></p>
            </div>

            <!-- description  -->
            <div>
                <label for="description" class="form-label">Description du parc *</label>
                <textarea class="form-input" name="description" id="description" required><?= $description ?? "Le Puy du Fou est un parc à thème historique qui a survécu au centre de l'Europe, aux siècles de guerre et au passage du temps. Un lieu où les gens s'amusent, vivent leurs rêves et découvrent les secrets de l'histoire. Le Puy du Fou est un lieu dédié à votre famille ! Faites une promenade dans le temps et découvrez les secrets de cette expérience inoubliable." ?></textarea>
                <p class="input-error-text"><?= $error['description'] ?? '' ?></p>
            </div>
        </div>

        <div class="other-info-park">
            <!-- Coordonnées gps -->
            <div class="title-section-add-park">
                <h2>Coordonnées gps du parc<span>*</span></h2>
                <a target="_blank" href="https://www.torop.net/coordonnees-gps.php">Obtenir les coordonnées</a>
            </div>
            <div class="coordinates-park">
                <div>
                    <label for="latitude" class="form-label">Latitude *</label>
                    <input value="<?= $latitude ?? '46.89340000000004' ?>" name="latitude" type="text" id="latitude" class="form-input" placeholder="49.135870">
                    <p class="input-error-text" id="latitudeTextError"><?= $error['latitude'] ?? '' ?></p>
                </div>
                <div>
                    <label for="longitude" class="form-label">longitude *</label>
                    <input value="<?= $longitude ?? '-0.9320799999999281' ?>" name="longitude" type="text" id="longitude" class="form-input" placeholder="2.566240">
                    <p class="input-error-text" id="longitudeTextError"><?= $error['longitude'] ?? '' ?></p>
                </div>
            </div>
            <!-- Picture -->
            <div class="title-section-add-park">
                <h2>Vos photos du parc<span>*</span></h2>
                <p>( jpg / png - 3mo max )</p>
            </div>
            <div class="ctn-picture-park">
                <div>
                    <p>Photo mise en avant *</p>
                    <div class="picture-park">
                        <label for="pictureMainView" class="form-label">
                            <input value="<?= $pictureMainView ?? '' ?>" name="pictureMainView" type="file" accept=".png, .jpg, .jpeg" id="pictureMainView" class="form-input" required>
                            <img class="imgPreview" id="previewMainView">
                        </label>
                    </div>
                    <p class="input-error-text" id="pictureTextError"><?= $error['pictureMainView'] ?? '' ?></p>
                </div>
                <div>
                    <p>Photo n°1</p>
                    <div class="picture-park">
                        <label for="picture1" class="form-label">
                            <input value="<?= $picture1 ?? '' ?>" name="picture1" type="file" accept=".png, .jpg, .jpeg" id="picture1" class="form-input">
                            <img class="imgPreview" id="previewPicture1">
                        </label>
                    </div>
                    <p class="input-error-text" id="picture1TextError"><?= $error['picture1'] ?? '' ?></p>
                </div>
                <div>
                    <p>Photo n°2</p>
                    <div class="picture-park">
                        <label for="picture2" class="form-label">
                            <input value="<?= $picture2 ?? '' ?>" name="picture2" type="file" accept=".png, .jpg, .jpeg" id="picture2" class="form-input">
                            <img class="imgPreview" id="previewPicture2">
                        </label>
                    </div>
                    <p class="input-error-text" id="picture2TextError"><?= $error['picture2'] ?? '' ?></p>
                </div>
            </div>
        </div>
        <!-- Submit -->
        <div class="submit">
            <button id="submit" type="submit">Ajouter un parc</button>
        </div>
    </form>

</main>