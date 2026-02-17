<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Postagem;
use App\Models\Seguidor;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::user()->permissao != 3) redirect()->route('home')->with('error', 'Sem permissão!');
        $user = Auth::user();
        $avaliar = User::where('permissao', 0)->get();
        $postagens = Postagem::where('usuario_id', $user->id)->get();
        $seguidores = Seguidor::where('seguido_id', $user->id)->get();
        return view('admin.dashboard', compact('user', 'postagens', 'seguidores', 'avaliar'));
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
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin)
    {
        //
    }
}
