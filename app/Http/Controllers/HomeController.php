<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Postagem;
use App\Models\Like;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorias = Categoria::all();
        $postagens = Postagem::where('status', 'aprovado')->get();
        return view('home', compact('categorias', 'postagens'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $categorias = Categoria::all();
        $postagens = Postagem::where('categoria_id', $id)->get();
        return view('home', compact('categorias', 'postagens'));
    }

    public function visualizar($id)
    {
        $postagem = Postagem::where('id', $id)->get()->firstOrFail();
        $likes = Like::where('postagem_id', $postagem->id)->get();
        return view('visualizar', compact('postagem', 'likes'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
