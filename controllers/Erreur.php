<?php

class Erreur extends Controller{
    protected $exception;

    public function __construct(Exception $e) {
        $this->exception = $e;
    }

    public function index(){
        // On envoie les données à la vue index
        $scriptJS = "$(document).ready(function() {
            $('.btn').each(function() {
                $(this).removeClass('btn-info');
                $(this).removeClass('btn-secondary');

                $(this).addClass('btn-info');

            });
        })";
        $message = $this->exception->getMessage();
        $type_message = "danger";
        $this->render('index', compact('message', 'type_message','scriptJS'));
    }

}