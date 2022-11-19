<main class="form-main form-dashboard">
    <div class="title-form">
        <?php
        if ($_GET['action'] == 'validate') {
            echo '<h1>Validation parc</h1>';
        }
        if ($_GET['action'] == 'update') {
            echo '<h1>Modification parc</h1>';
        }
        ?>
    </div>
    <?php
    if (isset($error['add'])) {
        echo '<p class="message">' . $error['add'] .  '</p>';
    }
    ?>
    <!-- Formulaire ajout de park -->
    <form class="add-park" novalidate enctype="multipart/form-data" method="POST">
        <?= $error['add']  ?? '' ?>
        <div class="informations-park">
            <div class="title-section-add-park">
                <h2>Informations sur le parc<span>*</span></h2>
            </div>

            <!-- Nom du parc -->
            <div>
                <label for="name" class="form-label">Nom du parc *</label>
                <input value="<?= $readPark->name ?? '' ?>" name="name" type="text" id="name" class="form-input" required placeholder="DisneylandParis">
                <p class="input-error-text" id="nameTextError"><?= $error['name'] ?? '' ?></p>
            </div>

            <!-- Url  -->
            <div>
                <label for="url" class="form-label">Url site internet du parc *</label>
                <input value="<?= $readPark->url ?? '' ?>" name="url" type="url" id="url" class="form-input" placeholder="https://exemple-mon-parc.com" required>
                <p class="input-error-text" id="urlTextError"><?= $error['url'] ?? '' ?></p>
            </div>

            <!-- Région du parc -->
            <div>
                <label for="region" class="form-label">Région du parc *</label>
                <select name="region" id="region" class="form-input" required>
                    <?php
                    foreach ($getRegions as $getRegion) {
                        $isSelected = ($getRegion->id == $readPark->idRegion) ? 'selected' : '';
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
                    <?php
                    foreach ($getThemes as $getTheme) {
                        $isSelected = ($getTheme->id == $readPark->idTheme) ? 'selected' : '';
                        echo "<option $isSelected value=\"$getTheme->id\" >$getTheme->theme</option>";
                    }
                    ?>
                </select>
                <p class="input-error-text" id="ThemeTextError"><?= $error['theme'] ?? '' ?></p>
            </div>

            <!-- description  -->
            <div>
                <label for="description" class="form-label">Description du parc *</label>
                <textarea class="form-input" name="description" id="description" required><?= $readPark->description ?? '' ?></textarea>
                <p class="input-error-text"><?= $error['description'] ?? '' ?></p>
            </div>
        </div>

        <div class="other-info-park">

            <!-- Coordonnées gps -->
            <div class="title-section-add-park">
                <h2>Coordonnées gps</h2>
                <a target="_blank" href="https://www.torop.net/coordonnees-gps.php">Obtenir les coordonnées</a>
            </div>
            <div class="coordinates-park">
                <div>
                    <label for="latitude" class="form-label">Latitude</label>
                    <input value="<?= $readPark->latitude ?? '' ?>" name="latitude" type="text" id="latitude" class="form-input" placeholder="49.135870">
                    <p class="input-error-text" id="latitudeTextError"><?= $error['latitude'] ?? '' ?></p>
                </div>
                <div>
                    <label for="longitude" class="form-label">longitude</label>
                    <input value="<?= $readPark->longitude ?? '' ?>" name="longitude" type="text" id="longitude" class="form-input" placeholder="2.566240">
                    <p class="input-error-text" id="longitudeTextError"><?= $error['longitude'] ?? '' ?></p>
                </div>
                <div class="map"></div>
            </div>

            <!-- Images -->
            <div class="title-section-add-park">
                <h2>Vos photos du parc<span>*</span></h2>
                <p>( jpg / png - 3mo max )</p>
            </div>
            <div class="ctn-picture-park">
                <div>
                    <p>Photo mise en avant *</p>
                    <div class="picture-park">
                        <label for="pictureMainView" class="form-label">
                            <!-- <input name="pictureMainView" type="file" accept=".png, .jpg, .jpeg" id="pictureMainView" class="form-input" required> -->
                            <img src="/<?= $imgsPark[0]->getPathName() ?? '' ?>" class="imgPreview" id="previewMainView">
                        </label>
                    </div>
                </div>
                <?php if (isset($imgsPark[1])) {
                ?>
                    <div>
                        <p>Photo n°1</p>
                        <div class="picture-park">
                            <label for="picture1" class="form-label">
                                <input name="picture1" type="file" accept=".png, .jpg, .jpeg" id="picture1" class="form-input">
                                <img src="/<?= $imgsPark[1] ?? '' ?>" class="imgPreview" id="previewPicture1">
                            </label>
                        </div>
                    </div>
                <?php  }
                if (isset($imgsPark[2])) { ?>
                    <div>
                        <p>Photo n°2</p>
                        <div class="picture-park">
                            <label for="picture2" class="form-label">
                                <input name="picture2" type="file" accept=".png, .jpg, .jpeg" id="picture2" class="form-input">
                                <img src="/<?= $imgsPark[2] ?? '' ?>" class="imgPreview" id="previewPicture2">
                            </label>
                        </div>
                    </div>
                <?php  } ?>
            </div>
        </div>
        <!-- Modification du bouton -->
        <!-- Submit -->
        <div class="submit">
            <button id="submit" type="submit"><?= ($_GET['action'] == 'validate') ? 'Valider' : 'modifier' ?></button>
            <a class="btn-delete" href="/dashboard/suppresion_parc/<?= $readPark->id ?>" id="submit" type="submit">Supprimer</a>
        </div>
    </form>

</main>