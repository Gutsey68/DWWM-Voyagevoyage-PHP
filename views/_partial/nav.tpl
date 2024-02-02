<nav class="navbar navbar-expand-lg">
    <div class="container-fluid ">
        <a href="index.php">
            <!-- mettre le logo ici -->
            <img src="" alt="">
            <p>Voyage<span class="fst-italic">Voyage</span></p>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 nav-fill">
                <li class="nav-item">
                    <a class="nav-link flex-fill {if ($strPage == "explore")} active{/if}"
                        href="index.php?action=explore&ctrl=utrip"><i class="fa-solid fa-compass"></i> Explorez</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link flex-fill {if ($strPage == "raconte")} active{/if}"
                        href="index.php?action=raconte&ctrl=utrip">Racontez</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link flex-fill {if ($strPage == "forum")} active{/if}"
                        href="index.php?action=home&ctrl=forum">Forum</a>
                </li>
                <li class="nav-item">
                    <form class="my-lg-0">
                        <div class="inputgroup col-10">
                            <input type="text" id="navinput" placeholder="Rechercher un voyage"
                                aria-label="Rechercher un voyage">
                            <button id="navbutton">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </div>
                    </form>
                </li>
                <li class="nav-item ">
                    <div class="button-center">
                        <a class="green-btn" href="index.php?action=login&ctrl=user"><i
                                class="fa-solid fa-user"></i>S'enregistrer / Se connecter</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>