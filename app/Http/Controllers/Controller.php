<?php

namespace App\Http\Controllers;

use App\Http\Controllers\MyLibs\Alert;
use App\Http\Controllers\MyLibs\Form;
use App\Http\Controllers\MasterDataController;

abstract class Controller
{
    protected $alert;
    protected $form;
    protected $title;
    protected $master;

    public function __construct()
    {
        $this->alert = new Alert;
        $this->form = new Form;
        $this->master = new MasterDataController;
        $this->title = 'Sistem Pelaporan Revitalisasi SMK Ashhabul Maimanah Sidayu 2026';
    }
}
