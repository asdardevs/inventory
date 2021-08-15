<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product =Product::orderBy('id', 'DESC')->get();

        return Inertia::render('Admin/Product', ['product' =>$product]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->kode == null) {
            $this->validate($request, [
                'foto' => ['required','image','mimes:jpeg,png,jpg', 'max:1024'],
            ]);    
        }

        $this->validate($request, [
            'nama' => ['required'],
            'stok' => ['required','numeric'],
            'harga_satuan' => ['required','numeric'],
            'satuan' => ['required'],
           
        ]);

        $data = [
                'nama' => $request->nama,
                'stok' => $request->stok,
                'harga_satuan' => $request->harga_satuan,
                'satuan' => $request->satuan,
        ];
        
        $foto = $request->file('foto');
        if ($foto) {
            $extension = $foto->getClientOriginalExtension();
            $filename =  $request->nama . '_' . time() . '.' . $extension;
            $foto->move('file/', $filename);
            $data['foto'] = $filename;
          
        }

        Product::updateOrCreate(
            ['id' => $request->kode],
            $data
        );
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //find post by ID
        $post = Product::findOrfail($id);

        //delete post
        $post->delete();

        return back();

    }
}
