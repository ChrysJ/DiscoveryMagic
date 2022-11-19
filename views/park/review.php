<main class="main-description-park">
    <!-- ------------------------------ -->
    <!-- Section park -->
    <!-- ------------------------------ -->
    <section class="section-park">
        <div class="description-park">

            <!-- Title -->
            <div class="park-title">
                <h1><?= $park->name ?></h1>
                <i class="fa-regular fa-heart heart"></i>
            </div>
            <div class="container-rated">
                <i class="fa-solid fa-star stars"></i>
                <i class="fa-solid fa-star stars"></i>
                <i class="fa-solid fa-star stars"></i>
                <i class="fa-solid fa-star stars"></i>
                <i class="fa-solid fa-star empty-stars"></i>
                <span class="rated">4.1</span>
                <span class="separate-rate"></span>
                <span class="number-vote">2 notes</span>
            </div>
            <span class="theme-park-title"><?= $park->theme ?></span>

            <!-- Informations -->
            <div class="informations-park">
                <hr>
                <h2>Informations pratique</h2>
                <ul>
                    <?php
                    if (isset($adress)) {
                    ?>
                        <li><i class="fa-solid fa-location-dot"></i><span id="adress"><?= $adress ?></span></li>
                    <?php
                    }
                    ?>
                    <li id="itinerary"><a target="_blank" href="https://www.google.com/maps/dir//<?= $park->name ?>"><i class="fa-solid fa-location-arrow"></i><span>Itinéraire</span></a></li>
                    <li><a target="_blank" href="<?= $park->url ?>"><i class="fa-solid fa-link"></i><span><?= $park->url ?></span></a></li>
                </ul>
                <hr>
            </div>
            <!-- Description -->
            <div class="short-info-text-park">
                <h2>Description</h2>
                <p class="truncate text-descriptionpark"><?= $park->description ?></p>
                <!-- Bouton voir plus -->
                <span class="seemore"></span>
            </div>
        </div>

        <!-- ------------------------------ -->
        <!-- Swiper IMG -->
        <!-- ------------------------------ -->
        <div class="swiper swiper-description-park">
            <div class="swiper-wrapper">
                <?php
                foreach ($imgsPark as $imgPark) {
                ?>
                    <div class="swiper-slide">
                        <img src=".<?= $imgPark->getPathName() ?>" alt="photo du parc <?= $park->name ?>">
                    </div>
                <?php
                }
                ?>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </section>

    <!-- ------------------------------ -->
    <!-- MAP -->
    <!-- ------------------------------ -->
    <div id="mapid"></div>
    <!-- Appel de ma fonction pour afficher la carte -->
    <script>
        displayMap()
    </script>
    <!-- ---------------------------------------------------------------------------------- -->

    <!-- ------------------------------ -->
    <!-- Section avis -->
    <!-- ------------------------------ -->
    <section class="share-opinion">
        <!-- Title -->
        <h3>Vous donnez votre avis</h3>

        <!-- nombre d'avis -->
        <div class="box-share-opinion">
            <div class="box-note-park">
                <h4>Note utilisateur</h4>
                <div class="container-rated">
                    <i class="fa-solid fa-star stars"></i>
                    <i class="fa-solid fa-star stars"></i>
                    <i class="fa-solid fa-star stars"></i>
                    <i class="fa-solid fa-star stars"></i>
                    <i class="fa-solid fa-star empty-stars"></i>
                    <span class="rated">4.1</span>
                    <span class="separate-rate"></span>
                    <span class="number-vote">2 notes</span>
                </div>
                <hr>
                <div class="container-rated">
                    <i class="fa-solid fa-star stars"></i>
                    <i class="fa-solid fa-star stars"></i>
                    <i class="fa-solid fa-star stars"></i>
                    <i class="fa-solid fa-star stars"></i>
                    <i class="fa-solid fa-star stars"></i>
                    <span class="separate-rate"></span>
                    <span class="number-vote">5 notes</span>
                </div>
                <div class="container-rated">
                    <i class="fa-solid fa-star stars"></i>
                    <i class="fa-solid fa-star stars"></i>
                    <i class="fa-solid fa-star stars"></i>
                    <i class="fa-solid fa-star stars"></i>
                    <i class="fa-solid fa-star empty-stars"></i>
                    <span class="separate-rate"></span>
                    <span class="number-vote">3 notes</span>
                </div>
                <div class="container-rated">
                    <i class="fa-solid fa-star stars"></i>
                    <i class="fa-solid fa-star stars"></i>
                    <i class="fa-solid fa-star stars"></i>
                    <i class="fa-solid fa-star empty-stars"></i>
                    <i class="fa-solid fa-star empty-stars"></i>
                    <span class="separate-rate"></span>
                    <span class="number-vote">2 notes</span>
                </div>
                <div class="container-rated">
                    <i class="fa-solid fa-star stars"></i>
                    <i class="fa-solid fa-star stars"></i>
                    <i class="fa-solid fa-star empty-stars"></i>
                    <i class="fa-solid fa-star empty-stars"></i>
                    <i class="fa-solid fa-star empty-stars"></i>
                    <span class="separate-rate"></span>
                    <span class="number-vote">2 notes</span>
                </div>
                <div class="container-rated">
                    <i class="fa-solid fa-star stars"></i>
                    <i class="fa-solid fa-star empty-stars"></i>
                    <i class="fa-solid fa-star empty-stars"></i>
                    <i class="fa-solid fa-star empty-stars"></i>
                    <i class="fa-solid fa-star empty-stars"></i>
                    <span class="separate-rate"></span>
                    <span class="number-vote">2 notes</span>
                </div>
            </div>

            <!-- ------------------------------------ ---->
            <!-- formulaire avis disconnected -->
            <!-- -------------------------------------- -->
            <div class="box-opinions">
                <!-- Decconecté -->
                <!-- <div class="form-user form-user-disconnected">
                    <img src="../../public/assets/img/icons/connected.png" alt="icon de connection">
                    <p class="text-form-user-disconnected">Vous devez être connecté pour donner votre avis sur le parc.</p>
                    <a class="btn" href="../../controllers/connexionController.php">Connectez-vous</a>
                </div> -->

                <!-- ------------------------------- --->
                <!--Formulaire avis connecté-->
                <!-- -------------------------------- -->
                <div class="form-user form-user-connected ">
                    <form class="form-box" method="POST">

                        <!-- Note  -->
                        <p>Votre note (obligatoire )</p>
                        <div>
                            <div class=" container-rated">
                                <i class="lar star-rated fa-solid fa-star" data-value="1"></i>
                                <i class="lar star-rated fa-solid fa-star" data-value="2"></i>
                                <i class="lar star-rated fa-solid fa-star" data-value="3"></i>
                                <i class="lar star-rated fa-solid fa-star" data-value="4"></i>
                                <i class="lar star-rated fa-solid fa-star" data-value="5"></i>
                                <div class="selected-stars">
                                    <span class="separate-rate"></span>
                                    <span class="user-selected-rate"></span>
                                </div>
                            </div>
                            <p class="input-error-text"><?= $error['rate'] ?? '' ?></p>
                            <input value="<?= $rate ?? '' ?>" type="hidden" name="rate" id="rate">

                            <!-- Titre de l'avis -->
                            <div>
                                <label for="titleOpinion" class="form-label">Titre de votre avis <span class="format">( 50 caractères max )</span></label>
                                <input value="<?= $titleOpinion ?? '' ?>" name="titleOpinion" type="text" id="titleOpinion" class="form-input" placeholder="exemple : Un séjour inoubliable">
                                <p class="input-error-text" id="titleOpinionTextError"><?= $error['titleOpinion'] ?? '' ?></p>
                            </div>

                            <!-- Avis utilisateur -->
                            <div>
                                <label for="opinion" class="form-label">Votre avis</label>
                                <textarea class="form-input" name="opinion" id="opinion"><?= $opinion ?? '' ?></textarea>
                                <p class="input-error-text"><?= $error['opinion'] ?? '' ?></p>
                            </div>

                            <!-- Submit -->
                            <div class="submit">
                                <button id="submit" type="submit">Donnez votre avis</button>
                            </div>
                    </form>
                    <?php $validateTitleOpinion ?>
                </div>
            </div>

            <!-- ------------------------------ -->
            <!--Avis utilisateurs -->
            <!-- ------------------------------ -->
            <div class="user-opinion">

                <!-- Profil  -->
                <div class="user-profile">
                    <img src="/public/assets/img/other/avatar.jpg" alt="user avatar">
                    <h4>John Doe</h4>
                </div>

                <!-- Note -->
                <div class="container-rated">
                    <i class="fa-solid fa-star stars"></i>
                    <i class="fa-solid fa-star stars"></i>
                    <i class="fa-solid fa-star stars"></i>
                    <i class="fa-solid fa-star stars"></i>
                    <i class="fa-solid fa-star empty-stars"></i>
                    <span class="separate-rate"></span>
                    <h5>Un séjour inoubliable</h5>
                </div>

                <!-- Date avis  -->
                <span class="date-opinion">Avis écrit le : 07 / 10 / 2022</span>
                <p class="opinion">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aspernatur sunt sit quis quisquam sequi ducimus ipsa ullam magni blanditiis odio corrupti ut debitis consequatur, nihil laborum nobis est nisi sapiente.</p>
            </div>
        </div>
        </div>
    </section>
    <h3>D'autres parcs de la région île de france</h3>