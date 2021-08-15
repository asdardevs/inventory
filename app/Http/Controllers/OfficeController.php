<?php

namespace App\Http\Controllers;

use App\Models\Major;
use App\Models\Office;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Helpers\Functions;
use Illuminate\Support\Facades\Mail;

class OfficeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Home', [
            'prodi' => Major::all()
        ]);
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
        // return $request->file_sk;
            $token = Functions::token(20);

            $this->validate($request, [
                'nama' => ['required'],
                'kode_fakultas' => ['required'],
                'kode_prodi' => ['required'],
                'email' => ['required', 'string', 'email'],
                'file_sk' => ['required','mimes:pdf', 'max:1024'],
            ]);


            Mail::raw($token,  function ($message) use ($request) {
                $message->from('office365@unm.ac.id');
                $message->to($request->email)->subject('Token Office 365');
            });
    
            $foto = $request->file('file_sk');
            if ($foto) {
                $extension = $foto->getClientOriginalExtension();
                $filename =  $request->nama . '_' . time() . '.' . $extension;
                $foto->move('file-sk/', $filename);
                Office::create([
                    'nama' => $request->nama,
                    'email' => $request->email,
                    'fakultas_id' => $request->kode_fakultas,
                    'prodi_id' => $request->kode_prodi,
                    'file' => $filename,
                    'token' => $token,

                ]);
              
            }
    

            
          
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
        $data =Office::where('token', $id)->first();
        if ($data) {
            return response()->json($data);
          
        }
        return 3;
        
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
        //
    }
}
