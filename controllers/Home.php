<?php

class Home extends Controller{

    public function index(){
        $scriptJS = "$(document).ready(function() {
            $('.btn').each(function() {
                $(this).removeClass('btn-info');
                $(this).removeClass('btn-secondary');
                if ($(this).attr('id') == 'btnHome') {
                    $(this).addClass('btn-secondary');
                } else {
                    $(this).addClass('btn-info');
                }
            });
        })";

        $montitre2 = "";
        $btnId = "btnHome";
        $this->render('index', compact('scriptJS', 'montitre2','btnId'));
    }

}