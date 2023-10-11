<?php

class Couleurs extends Controller
{
    protected Model $Couleur;

    public function index(): void
    {
        $this->loadModel("Couleur");
        $allColors = $this->Couleur->getAll();
        $btnId = "btnCouleurs";
        $this->render('index', compact('allColors','btnId'));
    }

    public function edit(int $currentColorId)
    {
        $btnId = "btnCouleurs";
        $this->loadModel("Couleur");
        $this->Couleur->table = "couleur";
        $this->Couleur->id = ['ID_COULEUR' => $currentColorId];
        $currentColor = $this->Couleur->getOne();
        $this->render('edit', compact('currentColorId','btnId','currentColor'));
    }

    public function newColor(): void
    {
        $newColor = array();
        if (!empty($_POST['couleur'])) {
            $this->loadModel("Couleur");
            htmlentities($_POST['couleur']);
            $newColor['nom'] = $_POST['couleur'];
            $this->Couleur->insert($newColor);
            $this->redirectWithMessage("Couleur : ".$_POST['couleur']. " bien ajoutée", "success","&#x1F44D;",true,"couleurs");
        } else {
            header("Location: " . PATH . "/couleurs");
        }
    }

    public function updateColor(): void
    {   
        $updatedColor = array();
        if (!empty($_POST['updatedColor'])) {
            htmlentities($_POST['updatedColor']);
            htmlentities($_POST['id']);
            $updatedColor['nom'] = $_POST['updatedColor'];
            $updatedColor['id'] =  $_POST['id'];
            $this->loadModel("Couleur");
            $this->Couleur->update($updatedColor);
            $this->redirectWithMessage('Couleur bien modifiée', 'info','&#129299;',true,"couleurs");
        }
    }

    public function deleteColor(int $id): void
    {
        $this->loadModel("Couleur");
        $this->Couleur->delete(htmlentities($id));  
        $this->redirectWithMessage('Couleur supprimée','warning','Aurevoir petite couleur... &#128577;',true,"couleurs");
    }


    private function redirectWithMessage($message, $type_message = null,$info = null, $envoi=false,$view =null): void
    {
        $this->loadModel("Couleur");
        $allColors = $this->Couleur->getAll();
        $btnId = "btnCouleurs";
        $this->render('index', compact(
      'allColors',
         'message',
          'type_message',
            'btnId',
             'info',
              'envoi',
              'view'
            ));
    }
}
