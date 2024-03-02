<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class PelangganController extends Controller
{
    public function getPelanggan($id):JsonResponse {
        try {
            if($id){
                $data = Pelanggan::where('id_pelanggan', $id)->get();
                return $this->sendResponse($data);
            }

            $data = Pelanggan::all();
            return $this->sendResponse($data);
        } catch (\Throwable $th) {
            return $this->sendError('Internal error in controller : ' . $th);
        }
    }

    public function createPelanggan(Request $request):JsonResponse {
        try {
            $validated = Validator::make($request->all(), [
                'nama' => 'required',
                'domisili' => 'required',
                'jenis_kelamin' => 'required',
            ], [
                'nama.required' => 'Tolong isikan nama',
                'domisili.required' => 'Tolong isikan kode domisili',
                'jenis_kelamin.required' => 'Tolong isikan jenis_kelamin',
            ]);
            if($validated->fails()){
                return $this->sendError($validated->errors(), 400);
            }

            $getLastId = Pelanggan::count();
            $stringConcat = 'PELANGGAN_';
            $idPelanggan = $stringConcat . ($getLastId + 1);

            $data = [
                'id_pelanggan' => $idPelanggan,
                'nama' => ucwords($request->input('nama')),
                'domisili' => strtoupper($request->input('domisili')),
                'jenis_kelamin' => strtoupper($request->input('jenis_kelamin')),
            ];

            Pelanggan::create($data);

            return $this->sendResponse($data);
        } catch (\Throwable $th) {
            return $this->sendError('Internal error in controller : ' . $th);
        }
    }

    public function updatePelanggan(Request $request, $id):JsonResponse {
        try {
            if(!$id){
                return $this->sendError('Masukan kode barang', 400);
            }

            $getPelanggan = Pelanggan::where('id_pelanggan', $id)->first();
            if(empty($getPelanggan)){
                return $this->sendError('Kode barang tidak ditemukan', 400);
            }

            $data = [
                'kode' => $getPelanggan->id_pelanggan,
                'nama' => $request->input('nama') ? ucwords($request->input('nama')) : $getPelanggan->nama,
                'domisili' => $request->input('domisili') ? strtoupper($request->input('domisili')) : $getPelanggan->domisili,
                'jenis_kelamin' => $request->input('jenis_kelamin') ? strtoupper($request->input('jenis_kelamin')) : $getPelanggan->jenis_kelamin,
            ];

            Pelanggan::where('id_pelanggan', $id)->update($data);
            return $this->sendResponse($data);
        } catch (\Throwable $th) {
            return $this->sendError('Internal error in controller : ' . $th);
        }
    }

    public function deletePelanggan($id):JsonResponse {
        try {
            if(!$id){
                return $this->sendError('Masukan kode barang', 400);
            }

            $getPelanggan = Pelanggan::where('id_pelanggan', $id)->first();
            if(empty($getPelanggan)){
                return $this->sendError('Kode barang tidak ditemukan', 400);
            }

            Barang::where('id_pelanggan', $id)->delete();
            return $this->sendResponse('Berhasil megnghapus pelanggan');
        } catch (\Throwable $th) {
            return $this->sendError('Internal error in controller : ' . $th);
        }
    }
}
