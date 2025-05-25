<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Multa;

class MultaController extends Controller
{
    public function index()
    {
        return response()->json(Multa::all());
    }
}
