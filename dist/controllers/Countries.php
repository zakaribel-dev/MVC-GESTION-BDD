<?php

class Countries extends Controller
{
    protected Country $Country;

    public function index(): void
    {
        $this->loadModel("Country");
        $allCountries = $this->Country->allCountries();
        $allContinents = $this->Country->allContinents();
        $btnId = "btnCountries";
        $this->render('index', compact('allCountries', 'btnId', 'allContinents'));
    }

    public function edit(int $currentCountryId)
    {
        $btnId = "btnCountries";
        $this->loadModel("Country");
        $allContinents = $this->Country->allContinents();
        $this->render('edit', compact('currentCountryId','allContinents', 'btnId'));
    }

    public function newCountry(): void
    {
        $newCountry = array();
        if (!empty($_POST['country'])) {
            $this->loadModel("Country");
            $newCountry['nom'] = $_POST['country'];
            $newCountry['id'] = $_POST['continent'];
            $this->Country->insert($newCountry);
            $this->redirectWithMessage("Pays " . $_POST['country'] . " bien ajouté", "success",'&#x1F44D;',true);
        } else {
            header("Location: " . PATH . "/counties");
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
            $this->redirectWithMessage('Pays bien modifié', 'info','&#129299;',true);
        }else{
            header("Location: " . PATH . "/countries");
        }
    }

    public function deleteCountry(int $id): void
    {
        $this->loadModel("Country");
        $this->Country->delete($id);
        $this->redirectWithMessage('Pays numéro ' . $id . ' bien supprimé', 'danger','Aurevoir petit pays... &#128577;',true);
    }

    private function redirectWithMessage($message, $type_message = null,$info=null,$envoi=false): void
    {
        $this->loadModel("Country");
        $allCountries = $this->Country->allCountries();
        $allContinents = $this->Country->allContinents();
        $btnId = "btnCountries";
        $this->render('index', compact('allCountries', 'message', 'allContinents', 'type_message', 'btnId','info','envoi'));
    }
}
