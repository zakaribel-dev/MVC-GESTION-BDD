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

        $this->render('edit', compact('currentColorId','btnId'));
    }

    public function newColor(): void
    {
        $newColor = array();
        if (!empty($_POST['couleur'])) {
            $this->loadModel("Couleur");
            $newColor['nom'] = $_POST['couleur'];
            $this->Couleur->insert($newColor);
            $this->redirectWithMessage("Couleur ".$_POST['couleur']. " bien ajoutée", "success","&#x1F44D;",true);
        } else {
            header("Location: " . PATH . "/couleurs");
        }
    }

    public function updateColor(): void
    {   
        $updatedColor = array();
        if (!empty($_POST['updatedColor'])) {
            $updatedColor['nom'] = $_POST['updatedColor'];
            $updatedColor['id'] =  $_POST['id'];
            $this->loadModel("Couleur");
            $this->Couleur->update($updatedColor);
            $this->redirectWithMessage('Couleur bien modifiée', 'info','&#129299;',true);
        }
    }

    public function deleteColor(int $id): void
    {
        $this->loadModel("Couleur");
        $this->Couleur->delete($id);
        $this->redirectWithMessage('Couleur bien supprimée','danger','Aurevoir petite couleur... &#128577;',true);
    }


    private function redirectWithMessage($message, $type_message = null,$info = null, $envoi=false): void
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
              'envoi'
            ));
    }
}
