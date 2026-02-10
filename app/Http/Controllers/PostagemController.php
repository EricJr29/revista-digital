<?php

namespace App\Http\Controllers;

use App\Models\Postagem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostagemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        $user = Auth::user();

        $postagem = Postagem::create([
            'status' => 'producao',
            'usuario_id' => $user->id,
            'titulo' => 'Novo Projeto',
        ]);

        return redirect()->route('postagem.edit', ['id' => $postagem->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Postagem $postagem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Postagem $postagem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Postagem $postagem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Postagem $postagem)
    {
        //
    }
}
