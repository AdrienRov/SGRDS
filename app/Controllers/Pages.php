<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function Connexion()
    {
        return view('commons/CommonPage', [
            'content' => view('Connexion')
        ]);
    }
    public function Accueil() { 
        return view('commons/CommonPage', [
            'content' => view('Accueil')
        ]);
    } 
    public function Absences() { 
        return view('commons/CommonPage', [
            'content' => view('Absences')
        ]);
    } 
    public function Rattrapages() { 
        return view('commons/CommonPage', [
            'content' => view('Rattrapages')
        ]);
    }
}
