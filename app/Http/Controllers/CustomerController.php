<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customer =Customer::orderBy('id', 'DESC')->get();

        return Inertia::render('Admin/Customer', ['customer' =>$customer]);
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
        

        $this->validate($request, [
            'nama' => ['required'],
            'telepon' => ['required','numeric'],
            'alamat' => ['required'],
            'email' => ['required','email'],
            'diskon' => ['required','numeric'],
            'tipe_diskon' => ['required'],
           
        ]);

        if ($request->kode == null) {
            $this->validate($request, [
                'foto_ktp' => ['required','image','mimes:jpeg,png,jpg', 'max:1024'],
            ]);    
        }
        
        $data = [
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'email' => $request->email,
                'telepon' => $request->telepon,
                'diskon' => $request->diskon,
                'tipe_diskon' => ($request->tipe_diskon == 'Percent') ? "0":"1",
        ];
        
        $foto = $request->file('foto_ktp');
        if ($foto) {
         
            try {
                $cek = Customer::where('id', $request->kode)->first();
                $path = 'ktp/' . $cek['foto_ktp'];
                if (is_file($path)) {
                    unlink($path);
                }
            } catch (\Throwable $th) {
                //throw $th;
            }
        
            $extension = $foto->getClientOriginalExtension();
            $filename =  $request->nama . '_' . time() . '.' . $extension;

            $foto->move('ktp/', $filename);
            $data['foto_ktp'] = $filename;
          
        }

        Customer::updateOrCreate(
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
        $cek = Customer::where('id', $id)->first();
        $path = 'ktp/' . $cek['foto_ktp'];
        if (is_file($path)) {
            unlink($path);
        }
        
        //find post by ID
        $post = Customer::findOrfail($id);

        //delete post
        $post->delete();

        return back();
    }
}
