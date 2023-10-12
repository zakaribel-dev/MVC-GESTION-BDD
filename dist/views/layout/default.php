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

    <div class="content ">
        <?= $content ?>
    </div>
    <div class="space"></div>
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
            © 2023 :
            <a class="text-white" href="https://zakaribel.com" target="blank">zakaribel.com</a>
        </div>
    </footer>


    <!-- MA DEPENDENCE AVEC WEBPACK.. -->
    <script src="<?= PATH ?>/views/js/bundle.js"></script>

    <!-- le joli pti menu! -->
    <?php
    $scriptJS = "<script>  
     $(document).ready(function() {
            $('.btn').each(function() {
                $(this).removeClass('btn-info');
                $(this).removeClass('btn-secondary');
                if ($(this).attr('id') == '".@$btnId."') {
                    $(this).addClass('btn-secondary ');
                } else {
                    $(this).addClass('btn-warning');
                }
            });
        })
   </script>";

    echo $scriptJS;
    ?>

    <!-- mon pti formulaire & mes petits titres qui apparaissent comme par magie..  -->
    <script>
        
        function afficherFormulaire(idFormulaire) {
            let formulaire = document.getElementById(idFormulaire);
            if (formulaire) {
                formulaire.classList.toggle("visible");
            }
        }

        document.addEventListener("DOMContentLoaded", function() {
            let paragraph = document.querySelector('.paragraph');
            paragraph.classList.add('appear');
        });

        document.addEventListener("DOMContentLoaded", function() {
            let mbb = document.querySelector('.mbb');
            mbb.classList.add('appear');
        });
        document.addEventListener("DOMContentLoaded", function() {
            let beer = document.querySelector('.beer');
            beer.classList.add('appear');
        });
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
        html: '$msg',
        confirmButtonColor: '#3085d6',
        confirmButtonText: 'OK',
        didClose: () => {
            window.location.href = '$path';
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

    <script>
        function confirmDelete(item, action, controller, id) {
            Swal.fire({
                title: 'Êtes-vous sûr de vouloir supprimer : <b>' + item + '</b> ?',
                icon: 'warning',
                showCancelButton: true,
                cancelButtonText: 'Annuler',
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Oui, supprimer!',
            }).then((result) => {
                if (result.value) {
                    window.location.href = "<?= PATH ?>/" + controller + "/" + action + "/" + id;
                }
            });

            return false;
        }

        $(document).ready(function() {
            $('.pour')
                .delay(300)
                .animate({
                    height: '360px'
                }, 500)
                .delay(1600)
                .slideUp(300);

            $('#liquid')
                .delay(300)
                .animate({
                    height: '170px'
                }, 2500);

            $('.beer-foam')
                .delay(300)
                .animate({
                    bottom: '200px'
                }, 2500);
        });
    </script>
</body>

</html>