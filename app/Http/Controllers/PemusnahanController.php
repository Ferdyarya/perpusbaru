<?php

namespace App\Http\Controllers;

use App\Models\pemusnahan;
use App\Models\Rusak;
use Illuminate\Http\Request;

class PemusnahanController extends Controller
{
    public function index(Request $request)
    {
        if($request->has('search')){
            $pemusnahan = Pemusnahan::where('judul', 'LIKE', '%' .$request->search.'%')->paginate(10);
        }else{
            $pemusnahan = Pemusnahan::paginate(10);
        }
        return view('pemusnahan.index',[
            'pemusnahan' => $pemusnahan
        ]);
    }


    public function create()
    {
        $masterbukurusak = Rusak::all();

        return view('pemusnahan.create', [
            'masterbukurusak' => $masterbukurusak,
        ]);
        return view('pemusnahan.create')->with('success', 'Data Telah ditambahkan');
    }


    public function store(Request $request)
    {
        $data = $request->all();

        Pemusnahan::create($data);

        return redirect()->route('pemusnahan.index')->with('success', 'Data Telah ditambahkan');
    }


    public function show($id)
    {

    }

    public function edit($id)
{
    $item = Pemusnahan::findOrFail($id);
    $masterbukurusak = Rusak::all(); // Ambil semua kategori atau sesuai kebutuhan
    return view('pemusnahan.edit', compact('item', 'masterbukurusak'));
}


    public function update(Request $request, $id)
{
    $pemusnahan = Pemusnahan::findOrFail($id);

    $data = $request->all();

    $pemusnahan->update($data);

    return redirect()->route('pemusnahan.index')->with('success', 'Data Telah diupdate');
}


    public function destroy(Pemusnahan $pemusnahan)
    {
        $pemusnahan->delete();
        return redirect()->route('pemusnahan.index')->with('success', 'Data Telah dihapus');
    }
}
