<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function Accueil() { 
        echo view('/commons/NavBar');
        echo view('Accueil');
        echo view('/commons/Footer');
    } 
    public function Absences() { 
        echo view('/commons/NavBar');
        echo view('Absences');
        echo view('/commons/Footer');
    } 
    public function Rattrapages() { 
        echo view('/commons/NavBar');
        echo view('Rattrapages');
        echo view('/commons/Footer');
    }
}
