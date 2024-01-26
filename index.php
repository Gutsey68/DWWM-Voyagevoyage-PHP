<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/images/logo.png">
    <title>Fan club de kerim</title>
    <link rel="stylesheet" href="assets/style/custom.css">
    <link rel="stylesheet" href="assets/style/bootstrap.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer">
</head>

<body>
<!-- include du nav.php -->
    <?php include("views/_partial/nav.php") ?><script src="assets/script/bootstrap.bundle.js"></script>
<!-- voyage -->
    <section id="voyage">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-12">
                    <h1 class="pb-2">Et si vous nous racontiez <span class="fst-italic">votre voyage</span>  ?</h1>
                    <p>Partagez vos aventures uniques et découvrez comment votre périple inspire et émerveille notre communauté.</p>
                    <button class="green-btn"><i class="fa-solid fa-feather"></i>Je raconte mon voyage</button>
                </div>
                <div class="col-md-6 col-12">
                    <img src="assets/images/italie.jpg" alt="jolie ruelle italienne">
                    <img src="assets/images/zanzibar.jpg" alt="magnifique plage à zanzibar">
                </div>
            </div>
        </div>
    </section>
<!-- histoire -->
    <section id="histoire">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h2 class="pb-2">Chaque voyage <span class="fst-italic">a son histoire</span>...</h2>
                    <p>Plongez dans un monde de récits captivants où chaque destination dévoile ses mystères et ses merveilles.</p>
                    <div class="button-center">
                        <button class="orange-btn"><i class="fa-solid fa-suitcase-rolling"></i> J'explore les histoires</button>
                    </div>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-md-3">
                    <img src="assets/images/italie.jpg" alt="">
                    <p class="margin0">Le voyage de kerim68</p>
                    <p>à <span class="fst-italic">Rio de Janeiro</span></p>
                </div>
                <div class="col-md-3">
                    <img src="assets/images/italie.jpg" alt="">
                    <p class="margin0">Le voyage de kerim68</p>
                    <p>à <span class="fst-italic">Rio de Janeiro</span></p>
                </div>
                <div class="col-md-3">
                    <img src="assets/images/italie.jpg" alt="">
                    <p class="margin0">Le voyage de kerim68</p>
                    <p>à <span class="fst-italic">Rio de Janeiro</span></p>
                </div>
                <div class="col-md-3">
                    <img src="assets/images/italie.jpg" alt="">
                    <p class="margin0">Le voyage de kerim68</p>
                    <p>à <span class="fst-italic">Rio de Janeiro</span></p>
                </div>
            </div>
        </div>
    </section>
<!-- Echangez -->
    <section id="echange">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-12">
                    <h2 class="pb-2"><span class="fst-italic">Échangez</span> <br> avec les autres voyageurs</h2>
                    <p>Rejoignez notre forum et connectez-vous avec une communauté passionnée pour partager conseils et expériences de voyage.</p>
                    <button class="green-btn"><i class="fa-solid fa-comments"></i> Je découvre le forum</button>
                </div>
                <div class="col-md-6 col-12">
                    <div class="card mb-3">
                        <div class="card-header">
                            <p>MichelZora</p>
                        </div>
                        <div class="card-body">
                            <h3 class="card-title">Recherche d'Endroits Inspirés par Zelda pour Mon Voyage au Japon</h3>
                            <p class="card-text">Étant un grand fan de Zelda, je cherche des lieux au Japon qui me rappelleraient les paysages du jeu. Des suggestions pour des lieux magiques et mystérieux ?</p>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            Kerim68
                        </div>
                        <div class="card-body">
                            <h3 class="card-title">Conseils pour Rencontrer des Gens Lors de Voyages Solo</h3>
                            <p class="card-text">Je voyage seul en Europe et je cherche des conseils sur les meilleures façons de rencontrer de nouvelles personnes et peut-être même de faire de nouvelles rencontres amicales. Des idées ?</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<!-- Footer -->
<footer>
    <div class="container text-center pt-5 pb-2">
        <div class="row">
        <div class="col-md-6 col-12">
            <h3 class="pb-3"></i>Où nous trouver</h3>
            <p><i class="fa-solid fa-envelope"></i> voyagevoyage@email.fr</p>
            <p><i class="fa-solid fa-phone"></i> 07 88 48 64 97</p>
            <p><i class="fa-solid fa-house"></i> 30 rue kerim le fou</p>
        </div>
        <div class="col-md-6 col-12">
            <h3 class="pb-3">Nos résaux sociaux</h3>
            <ul>
                <li><a href=""><i class="fa-brands fa-facebook-f"></i></a></li>
                <li><a href=""><i class="fa-brands fa-instagram"></i></a></li>
                <li><a href=""><i class="fa-brands fa-x-twitter"></i></a></li>
                <li><a href=""><i class="fa-brands fa-pinterest-p"></i></a></li>
                <li><a href=""><i class="fa-brands fa-youtube"></i></a></li>
            </ul>
        </div>
        </div>
        <hr>
        <div class="col-12">
            <p>© 2023 VoyageVoyage Inc. Tous droits réservés</p>
        </div>
    </div>
</footer>
</body>
</html>