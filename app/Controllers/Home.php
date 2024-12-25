<?php

namespace App\Controllers;

class Home extends BaseController
{
    public $validation;
    public function index(): string
    {
        return view('welcome_message');
    }
    public function error(){
        return view('admin/error/error');
    }
    public function about(): string
    {
        return view('main/about');
    }
    public function booking(): string
    {
        return view('main/booking');
    }
    public function contact(): string
    {
        return view('main/contact');
    }
    public function menu(): string
    {
        return view('main/menu');
    }
    public function service(): string
    {
        return view('main/service');
    }
    public function team(): string
    {
        return view('main/team');
    }
    public function testmonial(): string
    {
        return view('main/testmonial');
    }
}
