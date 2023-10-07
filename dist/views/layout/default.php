<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Mes belles bières</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?= PATH ?>/views/layout/style.css">

    <!-- Youpii pas d'autres dépendences on respire un peu plus.. -->
</head>
<body>
    <?php echo @$msg; ?>

        <header>
            <div class="d-flex justify-content-center">
                <a href="<?= PATH ?>/home"><br>
                    <button id="btnHome" class="btn">Accueil</button>
                </a>

                <a class="" href="<?= PATH ?>/articles"><br>
                    <button id="btnArticles" class="btn ">Articles</button>
                </a>

                <a class="" href="<?= PATH ?>/countries"><br>
                    <button id="btnCountries" class="btn ">Pays</button>
                </a>

                <a class="" href="<?= PATH ?>/couleurs"><br>
                    <button id="btnCouleurs" class="btn">Couleurs</button>
                </a>
            </div>
        </header>
        <?php
        if (isset($message)) {
            if (!isset($type_message)) {
                $type_message = "info";
            }
            echo "<br><div class='alert alert-$type_message alert-dismissible'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    $message
                </div>";
        }
        ?>
        <div class="content ">
            <?= $content ?>
        </div>

        <footer class="bg-secondary text-center text-white mt-5">
            <div class="container-fluid p-4">
                <section class="mb-4">
                    <a class="btn btn-outline-light btn-floating m-1" href="https://github.com/zakaribel-dev" target="blank" role="button"><i class="fab fa-github"> Github</i></a>
                    <a class="btn btn-outline-light btn-floating m-1" href="https://discord.com/users/Zak#8199" target="blank" role="button"><i class="fab fa-discord"> Discord</i></a>
                </section>
                <section class="mb-4">
                    <p>
                        L'abus d'alcool est dangereux pour la santé mais... Si vous aimez le vin... <a href="https://zakaribel.com/cave/html/VINS.html" target="blank" style="color: yellow;">cliquez ici..</a>
                    </p>
                </section>
            </div>
            <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
                © 2023 Copyright :
                <a class="text-white" href="https://zakaribel.com" target="blank">zakaribel.com</a>
            </div>
        </footer>


    <!-- MA DEPENDENCE AVEC WEBPACK (J'AI  G-A-L-É-R-É...) -->
    <script src="<?= PATH ?>/views/js/bundle.js"></script>

    <!-- le joli pti menu! -->
    <?php
    $scriptJS = "<script>  
     $(document).ready(function() {
            $('.btn').each(function() {
                $(this).removeClass('btn-info');
                $(this).removeClass('btn-secondary');
                if ($(this).attr('id') == '$btnId') {
                    $(this).addClass('btn-secondary ');
                } else {
                    $(this).addClass('btn-info');
                }
            });
        })
   </script>";

    echo $scriptJS;
    ?>


    <!-- mon pti formulaire qui apparait comme par magie..  -->
    <script>
        function afficherFormulaire() {
            let formulaire = document.getElementById("displayForm");
            formulaire.classList.toggle("visible");
        }
    </script>


    <!-- le déploiement de mes alertes sympatoches.. -->
    <?php
    function SendAlert($msg, $alert, $info = null, $view)
    {

        $path = PATH . "/" . $view;

        $scriptJS = "
    Swal.fire({
        icon: '$alert', 
        title: '$info', 
        text: '$msg',
        toast: true,
        position: 'center',
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
        didClose: () => {
            window.location.href = '$path'; // Utilisez la constante PATH ici
        }
    });
    ";

        echo "<script>" . $scriptJS . "</script>";
    }

    // trigger de ma fonction ou non..
    if (@$envoi) {
        SendAlert($message, $type_message, $info, $view);
    } else {
        echo "";
    }
    ?>
</body>

</html>