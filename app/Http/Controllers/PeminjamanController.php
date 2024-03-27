<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Http\Requests\StorePeminjamanRequest;
use App\Http\Requests\UpdatePeminjamanRequest;
use App\Models\Buku;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $buku = Peminjaman::with(["bukus", 'users'])->get();
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
    public function store(Request $request)
{
    try {
        $data = $request->validate([
            "userid" => "required",
            "bukuid" => "required",
            "tanggal_peminjaman" => "required",
            "tanggal_pengembalian" => "required",
        ]);

        // Memastikan buku tersedia untuk dipinjam
        $buku = Buku::findOrFail($data['bukuid']);
        if ($buku->status === 'dipinjam') {
            throw new \Exception('Buku tidak tersedia untuk dipinjam.');
        }

        // Update status buku
        $buku->status = 'dipinjam';
        $buku->save();

        // Menyimpan data peminjaman
        $newPeminjaman = Peminjaman::create([
            'userid' => $data['userid'],
            'bukuid' => $data['bukuid'],
            'tanggal_peminjaman' => $data['tanggal_peminjaman'],
            'tanggal_pengembalian' => $data['tanggal_pengembalian']
        ]);

        $res = [
            'message' => 'Berhasil meminjam buku.',
            'data' => $newPeminjaman,
        ];
        return response()->json($res, 200);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}



    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $user = Peminjaman::all()->find($id);
            $res = [
                'data' => $user
            ];

            return response()->json($res, 201);
        } catch (Exception $e) {
            return response()->json($e, 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Peminjaman $peminjaman)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
       //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        Peminjaman::where('peminjamanid', $id)->delete();
        return response()->json([
            'message' => "Delete peminjaman successfully",
        ]);
    }
}
