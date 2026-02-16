<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Postagem;
use App\Models\Seguidor;
use App\Models\Like;
use App\Models\User;


use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $postagens = Postagem::where('usuario_id', $user->id)->get();
        $seguidores = Seguidor::where('seguido_id', $user->id)->get();
        return view('auth.perfil', compact('user', 'postagens', 'seguidores'));
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
    public function visualizar($id)
    {
        $user = User::findOrFail($id);
        $postagens = Postagem::where('usuario_id', $user->id)->where('status', 'aprovado')->get();
        $seguidoresCount = Seguidor::where('seguido_id', $id)->count();
        $totalLikes = Like::whereIn('postagem_id', $postagens->pluck('id'))->count();
        return view('visualizarPerfil', compact('user', 'postagens', 'seguidoresCount', 'totalLikes'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit() {}

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
