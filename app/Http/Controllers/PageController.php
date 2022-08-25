<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Entity;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function document()
    {
        return view('pages.document');
    }

    public function entity()
    {
        return view('pages.entity');
    }

    public function user()
    {
        return view('pages.user');
    }

    public function position($id)
    {
        $entity = Entity::find($id);
        return view('pages.position', compact('entity'));
    }

    public function assignment($id)
    {
        $user = User::find($id);
        return view('pages.assignment', compact('user'));
    }

    public function correspondence()
    {
        return view('pages.correspondence');
    }

    public function diagram()
    {
        return view('pages.diagram');
    }

    public function roadmap()
    {
        return view('pages.roadmap');
    }
}
