<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class BarangController extends Controller
{
    public function getBarang($id = null):JsonResponse {
        try {
            if($id){
                $data = Barang::where('kode', $id)->first();
                return $this->sendResponse($data);
            }

            $data = Barang::all();
            return $this->sendResponse($data);
        } catch (\Throwable $th) {
            return $this->sendError('Internal error in controller : ' . $th);
        }
    }

    public function createBarang(Request $request):JsonResponse {
        try {
            $validated = Validator::make($request->all(), [
                'nama' => 'required',
                'kategori' => 'required',
                'harga' => 'required',
            ], [
                'nama.required' => 'Tolong isikan nama',
                'kategori.required' => 'Tolong isikan kode kategori',
                'harga.required' => 'Tolong isikan harga',
            ]);
            if($validated->fails()){
                return $this->sendError($validated->errors(), 400);
            }

            $kodeId = '';
            $getLastId = Barang::select('kode')->orderBy('kode', 'desc')->first();
            if(empty($getLastId)){
                $kodeId = 'BRG_1';
            }else{
                $separateData = explode("_", $getLastId);
                $stringConcat = 'BRG_';
                $kodeId = $stringConcat . ((int) $separateData[1] + 1);
            }

            $data = [
                'kode' => $kodeId,
                'nama' => ucwords($request->input('nama')),
                'kategori' => ucwords($request->input('kategori')),
                'harga' => $request->input('harga'),
            ];

            Barang::create($data);

            return $this->sendResponse($data);
        } catch (\Throwable $th) {
            return $this->sendError('Internal error in controller : ' . $th);
        }
    }

    public function updateBarang(Request $request, $id = null):JsonResponse {
        try {
            if(!$id){
                return $this->sendError('Masukan kode barang', 400);
            }

            $getBarang = Barang::where('kode', $id)->first();
            if(empty($getBarang)){
                return $this->sendError('Kode barang tidak ditemukan', 400);
            }

            $data = [
                'kode' => $getBarang->kode,
                'nama' => $request->input('nama') ? ucwords($request->input('nama')) : $getBarang->nama,
                'kategori' => $request->input('kategori') ? ucwords($request->input('kategori')) : $getBarang->kategori,
                'harga' => $request->input('harga') ? $request->input('harga') : $getBarang->harga,
            ];

            Barang::where('kode', $id)->update($data);
            return $this->sendResponse($data);
        } catch (\Throwable $th) {
            return $this->sendError('Internal error in controller : ' . $th);
        }
    }

    public function deleteBarang($id = null):JsonResponse {
        try {
            if(!$id){
                return $this->sendError('Masukan kode barang', 400);
            }

            $getBarang = Barang::where('kode', $id)->first();
            if(empty($getBarang)){
                return $this->sendError('Kode barang tidak ditemukan', 400);
            }

            Barang::where('kode', $id)->delete();
            return $this->sendResponse('Berhasil megnghapus barang');
        } catch (\Throwable $th) {
            return $this->sendError('Internal error in controller : ' . $th);
        }
    }
}
