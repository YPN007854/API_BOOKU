<?php

namespace App\Http\Controllers;

use App\Models\KategoriBukuRelasi;
use App\Http\Requests\StoreKategoriBukuRelasiRequest;
use App\Http\Requests\UpdateKategoriBukuRelasiRequest;
use Exception;

class KategoriBukuRelasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $buku = KategoriBukuRelasi::with(["bukus", 'kategoribukus'])->get();
            $res = [
                'data' => $buku
            ];
            return response()->json($res, 200); 
         }catch(Exception $e){
            return response()->json([
                'message' => "Internal server error",
                'error' => $e
            ], 500);
         }
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
    public function store(StoreKategoriBukuRelasiRequest $request)
    {
        $data = $request->validate([
            "bukuid" => "required",
            "kategoriid" => "required"
        ]);
        $newuser = KategoriBukuRelasi::create($data);
        $res = [
            'message' => 'succes create data',
            'data' => $newuser
        ];
        return response()->json($res);    }

    /**
     * Display the specified resource.
     */
    public function show(KategoriBukuRelasi $kategoriBukuRelasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(KategoriBukuRelasi $kategoriBukuRelasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKategoriBukuRelasiRequest $request, KategoriBukuRelasi $kategoriBukuRelasi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(KategoriBukuRelasi $kategoriBukuRelasi)
    {
        //
    }
}
