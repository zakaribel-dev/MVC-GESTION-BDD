<?php

class Countries extends Controller
{
    protected Country $Country;

    public function index($page = null): void
    {
        if (isset($page)) {
            $this->loadModel("Country");
            $rows_per_page = $this->Country->getRowsPerPage();
            $this->Pagination($page, $rows_per_page);
        }
        $this->loadModel("Country");
        $allCountries = $this->Country->allCountries();
        $nbrCountries = $allCountries[0]['nbr_countries'];
        $allContinents = $this->Country->allContinents();
        $rows_per_page = $this->Country->getRowsPerPage();
        $pages = ceil($nbrCountries / $rows_per_page);
        $btnId = "btnCountries";
        $this->render('index', compact(
            'allCountries',
            'btnId',
            'allContinents',
            'page',
            'pages'
        ));
    }


    public function Pagination($page, $rows_per_page)
    {
        $this->loadModel("Country");
        $this->Country->setStart(intval($page) * $rows_per_page);
        $allContinents = $this->Country->allContinents();
        $allCountries = $this->Country->allCountries();
        $rows_per_page = $this->Country->getRowsPerPage();
        $this->Country->setStart($page);
        $nbrCountries = $allCountries[0]['nbr_countries'];
        $pages = ceil($nbrCountries / $rows_per_page);  
        $btnId = "btnCountries";
        $this->render('index', compact(
            'allCountries',
            'btnId',
            'allContinents',
            'pages',
            'page'
        ));
    }

    public function edit(int $currentCountryId)
    {
        $btnId = "btnCountries";
        $this->loadModel("Country");
        $this->Country->table = "pays";
        $this->Country->id = ['ID_PAYS' => $currentCountryId];
        $currentCountry = $this->Country->getOne();
        $allContinents = $this->Country->allContinents();
        $this->render('edit', compact('currentCountryId', 'allContinents', 'btnId','currentCountry'));
    }

    public function newCountry(): void
    {
        $newCountry = array();
        if (!empty($_POST['country'])) {
            $this->loadModel("Country");
            $newCountry['nom'] = htmlentities($_POST['country']);
            $newCountry['id'] = htmlentities($_POST['continent']);
            $this->Country->insert($newCountry);
            $this->redirectWithMessage("Pays : " . $_POST['country'] . " bien ajouté", "success", '&#x1F44D;', true, 'countries');
        } else {
            header("Location: " . PATH . "/countries");
        }
    }

    public function updateCountry(): void
    {
        $updatedCountry = array();
        if (!empty($_POST['updatedCountry'])) {

            $updatedCountry['idContinent'] = $_POST['updatedContinent'];
            $updatedCountry['updatedCountry'] = $_POST['updatedCountry'];
            $updatedCountry['idCountry'] = $_POST['id'];

            $this->loadModel("Country");
            $this->Country->update($updatedCountry);
            $this->redirectWithMessage('Pays bien modifié', 'info', '&#129299;', true, 'countries');
        } else {
            header("Location: " . PATH . "/countries");
        }
    }

    public function deleteCountry(int $id): void
    {
        $this->loadModel("Country");
        $this->Country->delete(htmlentities($id));
        $this->redirectWithMessage(
        'Pays supprimé',
         'warning',
          'Aurevoir petit pays... &#128577;',
           true,
            'countries');
    }

    private function redirectWithMessage($message, $type_message = null, $info = null, $envoi = false, $view = null): void
    {
        $this->loadModel("Country");
        $allCountries = $this->Country->allCountries();
        $allContinents = $this->Country->allContinents();
        $btnId = "btnCountries";
        $this->render('index', compact(
            'allCountries',
            'message',
            'allContinents',
            'type_message',
            'btnId',
            'info',
            'envoi',
            'view'
        ));
    }
}
