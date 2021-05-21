<?php

namespace App\Http\Controllers;

use App\Models\Servidores;
use Illuminate\Http\Request;

class ServidoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $servidores = Servidores::latest()->paginate(8);
        return view('servidores.index',compact('servidores')); // ENVIA A VARIAVEL SERVIDORES PARA A VIEW
            
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('servidores.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        {
            $request->validate([
                'nome' => 'required',
                'link-servidor' => 'required',
                'tags' => 'required'
            ]);
        
            Servidores::create($request->all());
         
            return redirect()->route('servidores.index')
                            ->with('success','Servidor registrado com sucesso.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Servidores  $servidores
     * @return \Illuminate\Http\Response
     */
    public function show(Servidores $servidores)
    {
        return view('servidores.servidores',compact('servidores'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Servidores  $servidores
     * @return \Illuminate\Http\Response
     */
    public function edit(Servidores $servidores)
    {
        return view('servidores.edit',compact('servidores'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Servidores  $servidores
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Servidores $servidores)
    {
        $request->validate([
            'nome' => 'required',
            'link-servidor' => 'required',
            'tags' => 'required'
        ]);
    
        $servidores->update($request->all());
    
        return redirect()->route('servidores.index')
                        ->with('success','Servidor atualizado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Servidores  $servidores
     * @return \Illuminate\Http\Response
     */
    public function destroy(Servidores $servidores)
    {
        $servidores->delete();
    
        return redirect()->route('servidores.index')
                        ->with('success','Servidor deletado  com sucesso');
    }
}