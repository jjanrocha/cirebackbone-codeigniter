<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Link;

class LinkController extends BaseController
{

    public function __construct()
    {
        $this->link = new Link();
    }

    public function index()
    {
        $links = $this->link->orderBy('titulo', 'asc')->findAll();
        return view('app/links', [
            'title' => 'Links',
            'links' => $links
        ]);
    }
}
