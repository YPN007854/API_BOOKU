<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Http\Requests\StoreBukuRequest;
use App\Http\Requests\UpdateBukuRequest;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Exception;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $buku = Buku::all();
        $res = [
            'data' => $buku
        ];
        return response()->json($res, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function store(Request $request)
    {
        $buku = $request->validate([
            "judul_buku" => "required",
            "penulis" => "required",
            "penerbit" => "required",
            "tahun_terbit" => "required",
            "cover" => "required",

        ]);
        if ($request->hasFile('cover')) {
            if($request->file('cover')->isValid()) {
                try {
                    $file = $request->file('cover');
                    $image = base64_encode(file_get_contents($file));
                    $buku['cover'] = $image;
    
    
                } catch (Exception $e) {
                    return response()->json([
                        'error'=> $e->getMessage()
                    ]);
    
                }
            }
        }
        $newbuku = Buku::create($buku);
        $res = [
            'message' => 'succes create data',
            'data' => $newbuku
        ];
        return response()->json($res);

    }


    /**
     * Store a newly created resource in storage.
     */
    
    /**
     * Display the specified resource.
     */
    public function show(Buku $buku)
    {
        {
            $buku = Buku::with(['peminjamans'])->get()->find($buku->bukuid);
            $res = [
                'data' => $buku
            ];
            return response()->json($res);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id )
    {
        

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        try{
            $data = $request->validate([
                "judul_buku" => "string",
                "penulis" => "string",
                "penerbit" => "string",
                "tahun_terbit" => "string",
                "cover" => "string",
                
            ]);
    
            Buku::where('bukuid', $id)->update($data);
    
            return response()->json([
                "message" => "Update successfully",
                "data" => $data,
            ], 201);
        }catch(Exception $e){
            return response()->json([
                'message' => 'Internal server error',
                'error' => $e
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        Buku::where('bukuid', $id)->delete();
        return response()->json([
            'message' => "Delete buku successfully",
        ]);
    }
}
