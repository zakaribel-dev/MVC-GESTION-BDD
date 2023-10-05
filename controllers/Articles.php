<?php

class Articles extends Controller
{
    
    // je met en protected mes attr pour pouvoir les utiliser qu'à l'intérieur dla classe
    // ces attributs contiendront l'objet de la classe Article ou Couleur une fois que j'aurai load mon model

    protected Article $Article;
    protected Couleur $Couleur;


    public function index(): void
    {
        $this->loadModel("Article");
        $allArticles = $this->Article->allArticles();
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
        ));
    }

    public function edit(int $currentArticleId): void
    {
        $this->loadModel("Article");
        $allArticles = $this->Article->allArticles();
        $allTypes = $this->Article->allTypes();
        $allMarques = $this->Article->AllMarques();
        $this->loadModel('Couleur');
        $allColors = $this->Couleur->getAll();

        $btnId = "btnArticles";
        $this->render('edit', compact('currentArticleId',
         'btnId',
          'allArticles',
           'allTypes',
            'allMarques',
             'allColors'
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
            $this->redirectWithMessage("Article ".$_POST['nom']." bien ajouté", "success","&#x1F44D;", true);
        } else {
            header("Location: " . PATH . "/articles");
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
            $this->redirectWithMessage("Article bien modifié", "success", "&#129299;",true);
        } else {
            header("Location: " . PATH . "/edit");
        }
    }

    public function deleteArticle(int $id): void
    {
        $this->loadModel("Article");
        $this->Article->delete($id);
        $this->redirectWithMessage(
       'Article numéro ' . $id . ' a bien été supprimé',
         'danger',
          'Aurevoir petit article... &#128577;',
            true
        );
    }


    private function redirectWithMessage($message, $type_message = null, $info = null, $envoi=false): void
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
                'envoi'
            )
        );
    }
}
