<?php

namespace App\Http\Controllers;

use App\Models\Competitor;
use Illuminate\Http\Request;

class CompetitorController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('competitor/create');
    }

    public function createCompetitor(Request $request): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        $competitor = new Competitor();

        $competitor->fill($request->all());
        $competitor->save();

        return redirect('home');
    }
}
