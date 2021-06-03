<?php

namespace App\Controllers;

helper('xml');

class Home extends BaseController
{
	public function index(): string
    {
		return view('pages/home');
	}
}
