<?php

class Articles extends Controller
{

    // je met en protected mes attr pour pouvoir les utiliser qu'à l'intérieur dla classe
    // ces attributs contiendront l'objet de la classe Article ou Couleur une fois que j'aurai load mon model

    protected Article $Article;
    protected Couleur $Couleur;


    public function index($page = null): void
    {
        if (isset($page)) {
            $this->loadModel("Article");
            $rows_per_page = $this->Article->getRowsPerPage();
            $this->Pagination($page, $rows_per_page);
        }
        $this->loadModel("Article");
        $allArticles = $this->Article->allArticles();
        $nbrArticles = $allArticles[0]['nbr_articles'];
        $rows_per_page = $this->Article->getRowsPerPage();
        $pages = ceil($nbrArticles / $rows_per_page);
        $allTypes = $this->Article->allTypes();
        $allMarques = $this->Article->AllMarques();
        $this->loadModel('Couleur');
        $allColors = $this->Couleur->getAll();
        $btnId = "btnArticles";
        $this->render('index', compact(
            'allArticles',
            'btnId',
            'allColors',
            'allTypes',
            'allMarques',
            'pages',
            'page'
        ));
    }

    public function Pagination($page, $rows_per_page)
    {
        $this->loadModel("Article");
        $this->Article->setStart(intval($page) * $rows_per_page);

        $allArticles = $this->Article->allArticles();
        $rows_per_page = $this->Article->getRowsPerPage();
        $start = $this->Article->getStart();
        $this->Article->setStart($page);

        $nbrArticles = $allArticles[0]['nbr_articles'];
        $pages = ceil($nbrArticles / $rows_per_page);
        $allTypes = $this->Article->allTypes();
        $allMarques = $this->Article->AllMarques();
        $this->loadModel('Couleur');
        $allColors = $this->Couleur->getAll();
        $btnId = "btnArticles";
        $this->render('index', compact(
            'allArticles',
            'btnId',
            'allColors',
            'allTypes',
            'allMarques',
            'pages',
            'page'
        ));
    }

    public function edit(int $currentArticleId): void
    {
        $this->loadModel("Article");
        $this->Article->table = "article";
        $this->Article->id = ['ID_ARTICLE' => $currentArticleId];
        $currentArticle = $this->Article->getOne();

        $allArticles = $this->Article->allArticles();
        $allTypes = $this->Article->allTypes();
        $allMarques = $this->Article->AllMarques();
        $this->loadModel('Couleur');
        $allColors = $this->Couleur->getAll();

        $btnId = "btnArticles";
        $this->render('edit', compact(
            'currentArticleId',
            'btnId',
            'allArticles',
            'allTypes',
            'allMarques',
            'allColors',
            'currentArticle'
        ));
    }

    public function newArticle(): void
    {
        $article = array();

        if (
            !empty($_POST['nom']) &&
            !empty($_POST['prix']) &&
            !empty($_POST['volume']) &&
            !empty($_POST['titrage']) &&
            !empty($_POST['marque']) &&
            !empty($_POST['type']) &&
            !empty($_POST['couleur'])
        ) {

            $article['nom'] = $_POST['nom'];
            $article['prix'] = intval($_POST['prix']);
            $article['volume'] = intval($_POST['volume']);
            $article['titrage'] = intval($_POST['titrage']);
            $article['id_marque'] = intval($_POST['marque']);
            $article['id_type'] = intval($_POST['type']);
            $article['id_couleur'] = intval($_POST['couleur']);

            $this->loadModel("Article");
            $this->Article->insert($article);
            $this->redirectWithMessage("Article : " . $_POST['nom'] . " bien ajouté", "success", "&#x1F44D;", true, '/articles');
        } else {
            $this->redirectWithMessage('Merci de bien remplire tout le formulaire..', 'warning', '&#128545;', true, 'articles');
        }
    }

    public function updateArticle(): void
    {
        $updatedArticle = array();

        if (
            !empty($_POST['nom']) &&
            !empty($_POST['prix']) &&
            !empty($_POST['volume']) &&
            !empty($_POST['titrage']) &&
            !empty($_POST['marque']) &&
            !empty($_POST['type']) &&
            !empty($_POST['couleur'])
        ) {

            $updatedArticle['nom'] = $_POST['nom'];
            $updatedArticle['prix'] = intval($_POST['prix']);
            $updatedArticle['volume'] = intval($_POST['volume']);
            $updatedArticle['titrage'] = intval($_POST['titrage']);
            $updatedArticle['id_marque'] = intval($_POST['marque']);
            $updatedArticle['id_type'] = intval($_POST['type']);
            $updatedArticle['id_couleur'] = intval($_POST['couleur']);
            $updatedArticle['id'] = intval($_POST['id']);

            $this->loadModel("Article");
            $this->Article->update($updatedArticle);
            $this->redirectWithMessage("Article bien modifié", "success", "&#129299;", true, "articles");
        } else {
            header("Location: " . PATH . "/edit");
        }
    }

    public function deleteArticle(int $id): void
    {
        $this->loadModel("Article");
        $this->Article->delete($id);
        $this->redirectWithMessage(
            'Article supprimé',
            'warning',
            'Aurevoir petit article... &#128577;',
            true,
            'articles'
        );
    }


    private function redirectWithMessage($message, $type_message = null, $info = null, $envoi = false, $view = null): void
    {

        $this->loadModel("Article");
        $allArticles = $this->Article->allArticles();
        $allTypes = $this->Article->allTypes();
        $allMarques = $this->Article->AllMarques();
        $this->loadModel('Couleur');
        $allColors = $this->Couleur->getAll();

        $btnId = "btnArticles";
        $this->render(
            'index',
            compact(
                'allColors',
                'message',
                'allArticles',
                'allColors',
                'type_message',
                'btnId',
                'allTypes',
                'allMarques',
                'info',
                'envoi',
                'view'
            )
        );
    }
}
