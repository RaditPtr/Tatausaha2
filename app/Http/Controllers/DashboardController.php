<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class DashboardController extends Controller
{
    //
    public function index(Guru $guru){
        $data = [
            'guru' => $guru->all()
        ];
        return view('dashboard.index', $data);
    }

    public function create()
    {
        //
    }

    public function store(Request $request, Guru $guru)
    {
        //
    }

    public function edit(string $id, Guru $guru) {
        //
    }

    public function update(Request $request, Guru $guru)
    {
        //
    }

    public function destroy(Guru $guru, Request $request) {
        //
    }
};
