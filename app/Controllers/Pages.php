<?php

namespace App\Controllers;

class Pages extends BaseController
{
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
