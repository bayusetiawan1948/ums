<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use App\Models\ItemPenjualan;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PenjualanController extends Controller
{
    public function getPenjualan($id = null):JsonResponse {
        try {
            $result = [];
            if($id){
                $data = ItemPenjualan::select(DB::raw('penjualan.id_nota, 
                        DATE_FORMAT(penjualan.tgl, "%d-%M-%Y") as tgl, penjualan.subtotal, 
                        pelanggan.nama as nama_pelanggan, pelanggan.id_pelanggan, 
                        barang.kode as id_barang, barang.nama as nama_barang, barang.harga as normal_harga, (barang.harga * item_penjualan.qty) as multiple_harga, item_penjualan.qty'))
                        ->where('item_penjualan.id_nota', $id)
                        ->join('penjualan', 'penjualan.id_nota', '=', 'item_penjualan.id_nota')
                        ->join('barang', 'barang.kode', '=', 'item_penjualan.kode_barang')
                        ->join('pelanggan', 'pelanggan.id_pelanggan', '=', 'penjualan.kode_pelanggan')
                        ->orderBy('tgl', 'desc')
                        ->get();
                foreach ($data as $value) {
                    $currentIdNota = $value->id_nota;
                    if(count($result) > 0){
                        $index = -1;
                        foreach ($result as $kunci => $isi) {
                            if($isi['id_nota'] === $currentIdNota){
                                $index = $kunci;
                            }else{
                                $index = -1;
                            }
                        }
                        if($index !== -1){
                            $detail = [
                                'id_barang' => $value->id_barang,
                                'nama_barang' => $value->nama_barang,
                                'normal_harga' => $value->normal_harga,
                                'multiple_harga' => $value->multiple_harga,
                                'qty' => $value->qty,
                            ];
                            $result[$kunci]['detail'][] = $detail;
                        }else{
                            $detail = [
                                'id_barang' => $value->id_barang,
                                'nama_barang' => $value->nama_barang,
                                'normal_harga' => $value->normal_harga,
                                'multiple_harga' => $value->multiple_harga,
                                'qty' => $value->qty,
                            ];
                            $header = [
                                'id_nota' => $value->id_nota,
                                'id_pelanggan' => $value->id_pelanggan,
                                'nama_pelanggan' => $value->nama_pelanggan,
                                'tanggal' => $value->tgl,
                                'subtotal' => $value->subtotal,
                                'detail' => [$detail]
                            ];
                            array_push($result, $header);
                        }
                    }else{
                        $detail = [
                            'id_barang' => $value->id_barang,
                            'nama_barang' => $value->nama_barang,
                            'normal_harga' => $value->normal_harga,
                            'multiple_harga' => $value->multiple_harga,
                            'qty' => $value->qty,
                        ];
                        $header = [
                            'id_nota' => $value->id_nota,
                            'id_pelanggan' => $value->id_pelanggan,
                            'nama_pelanggan' => $value->nama_pelanggan,
                            'tanggal' => $value->tgl,
                            'subtotal' => $value->subtotal,
                            'detail' => [$detail]
                        ];
                        array_push($result, $header);
                    }
                }
            }else{
                $data = ItemPenjualan::select(DB::raw('penjualan.id_nota, 
                        DATE_FORMAT(penjualan.tgl, "%d-%M-%Y") as tgl, penjualan.subtotal, 
                        pelanggan.nama as nama_pelanggan, pelanggan.id_pelanggan, 
                        barang.kode as id_barang, barang.nama as nama_barang, barang.harga as normal_harga, (barang.harga * item_penjualan.qty) as multiple_harga, item_penjualan.qty'))
                        ->join('penjualan', 'penjualan.id_nota', '=', 'item_penjualan.id_nota')
                        ->join('barang', 'barang.kode', '=', 'item_penjualan.kode_barang')
                        ->join('pelanggan', 'pelanggan.id_pelanggan', '=', 'penjualan.kode_pelanggan')
                        ->orderBy('tgl', 'desc')
                        ->get();
                        $tmp = [];
                foreach ($data as $value) {
                    $currentIdNota = $value->id_nota;
                    if(count($result) > 0){
                        $index = -1;
                        foreach ($result as $kunci => $isi) {
                            if($isi['id_nota'] === $currentIdNota){
                                $index = $kunci;
                                break;
                            }
                        }
                        if($index !== -1){
                            $detail = [
                                'id_barang' => $value->id_barang,
                                'nama_barang' => $value->nama_barang,
                                'normal_harga' => $value->normal_harga,
                                'multiple_harga' => $value->multiple_harga,
                                'qty' => $value->qty,
                            ];
                            $result[$kunci]['detail'][] = $detail;
                        }else{
                            $detail = [
                                'id_barang' => $value->id_barang,
                                'nama_barang' => $value->nama_barang,
                                'normal_harga' => $value->normal_harga,
                                'multiple_harga' => $value->multiple_harga,
                                'qty' => $value->qty,
                            ];
                            $header = [
                                'id_nota' => $value->id_nota,
                                'id_pelanggan' => $value->id_pelanggan,
                                'nama_pelanggan' => $value->nama_pelanggan,
                                'tanggal' => $value->tgl,
                                'subtotal' => $value->subtotal,
                                'detail' => [$detail]
                            ];
                            array_push($result, $header);
                        }
                    }else{
                        $detail = [
                            'id_barang' => $value->id_barang,
                            'nama_barang' => $value->nama_barang,
                            'normal_harga' => $value->normal_harga,
                            'multiple_harga' => $value->multiple_harga,
                            'qty' => $value->qty,
                        ];
                        $header = [
                            'id_nota' => $value->id_nota,
                            'id_pelanggan' => $value->id_pelanggan,
                            'nama_pelanggan' => $value->nama_pelanggan,
                            'tanggal' => $value->tgl,
                            'subtotal' => $value->subtotal,
                            'detail' => [$detail]
                        ];
                        array_push($result, $header);
                    }
                }
                // dd($tmp);
            }
            return $this->sendResponse($result);
        } catch (\Throwable $th) {
            return $this->sendError('Internal error in controller : ' . $th);
        }
    }

    public function createPenjualan(Request $request) : JsonResponse {
        try {
            $validatedHeader = Validator::make($request->all(), [
                'pelanggan' => 'required',
                'detail' => 'required',
            ], [
                'pelanggan.required' => 'Tolong isikan pelanggan',
                'detail.required' => 'Tolong isikan kode detail',
            ]);
            if($validatedHeader->fails()){
                return $this->sendError($validatedHeader->errors(), 400);
            }
            $detailPejualan = $request->input('detail');
            if(empty($detailPejualan) || !is_array($detailPejualan)){
                return $this->sendError('Isikan field detail dengan barang barang', 400);
            }

            if(count($detailPejualan) <= 0){
                return $this->sendError('Isikan field detail dengan barang barang', 400);
            }

            foreach ($detailPejualan as $key => $value) {
                $validatedDetail = Validator::make($value, [
                    'barang' => 'required',
                    'qty' => 'required',
                ], [
                    'barang.required' => 'Tolong isikan barang',
                    'qty.required' => 'Tolong isikan kode qty',
                ]);
                if($validatedDetail->fails()){
                    return $this->sendError($validatedDetail->errors(), 400);
                }
            }
            $subtotal = 0;
            $groupDetail = [];
            $notaId = "";
            $getLastId = Penjualan::select('id_nota')->orderBy('id_nota', 'desc')->first();
            if(empty($getLastId)){
                $notaId = 'NOTA_1';
            }else{
                $separateData = explode("_", $getLastId->id_nota);
                $stringConcat = 'NOTA_';
                $notaId = $stringConcat . ((int) $separateData[1] + 1);
            }
            foreach ($detailPejualan as $key => $value) {
                if($value['qty'] <= 0){
                    return $this->sendError('kuantiti harus lebih dari 0');
                }
                $checkBarang = Barang::select('kode', 'harga')
                                        ->where('kode', $value['barang'])
                                        ->first();
                if(empty($checkBarang)){
                    return $this->sendError('Barang tidak diketahui', 400);
                }
                $subtotal = $subtotal + ($checkBarang->harga * $value['qty']);
                $tmpGroup = [
                    'id_nota' => $notaId,
                    'kode_barang' => $value['barang'],
                    'qty' => $value['qty']
                ];
                array_push($groupDetail, $tmpGroup);
            }

            $head = [
                'id_nota' => $notaId,
                'tgl' => date("Y-m-d"),
                'kode_pelanggan' => $request->input('pelanggan'),
                'subtotal' => $subtotal
            ];

            Penjualan::create($head);
            ItemPenjualan::insert($groupDetail);
            return $this->sendResponse('Berhasil menambahkan penjualan');
        } catch (\Throwable $th) {
            return $this->sendError('Internal error in controller : ' . $th);
        }
    }
    
    public function updatePenjualan(Request $request, $id) : JsonResponse {
        try {
            if(!$id){
                return $this->sendError('Masukan nota', 400);
            }
            $getPenjualan = Penjualan::where('id_nota', $id)->first();
            if(empty($getPenjualan)){
                return $this->sendError('Nota tidak ditemukan', 400);
            }
    
            $detailPejualan = $request->input('detail');
            if(empty($detailPejualan) || !is_array($detailPejualan)){
                return $this->sendError('Isikan field detail dengan barang barang', 400);
            }
            if(count($detailPejualan) <= 0){
                return $this->sendError('Isikan field detail dengan barang barang', 400);
            }
            $subtotal = 0;
            $groupDetail = [];
            foreach ($detailPejualan as $key => $value) {
                if($value['qty'] <= 0){
                    return $this->sendError('kuantiti harus lebih dari 0');
                }
                $checkBarang = Barang::select('kode', 'harga')
                                        ->where('kode', $value['barang'])
                                        ->first();
                if(empty($checkBarang)){
                    return $this->sendError('Barang tidak diketahui', 400);
                }
                $subtotal = $subtotal + ($checkBarang->harga * $value['qty']);
                $tmpGroup = [
                    'id_nota' => $id,
                    'kode_barang' => $value['barang'],
                    'qty' => $value['qty']
                ];
                array_push($groupDetail, $tmpGroup);
            }
            $head = [
                'id_nota' => $id,
                'tgl' => $getPenjualan->tgl,
                'kode_pelanggan' => $request->input('pelanggan'),
                'subtotal' => $subtotal
            ];
            Penjualan::where('id_nota', $id)->update($head);
            ItemPenjualan::where('id_nota', $id)->delete();
            ItemPenjualan::insert($groupDetail);

            return $this->sendResponse('Berhasil mengupdate penjualan');
        } catch (\Throwable $th) {
            return $this->sendError('Internal error in controller : ' . $th);
        }
    }
    
    public function deletePenjualan($id) : JsonResponse {
        try {
            if(!$id){
                return $this->sendError('Masukan nota', 400);
            }

            $getPenjualan = Penjualan::where('id_nota', $id)->first();
            if(empty($getPenjualan)){
                return $this->sendError('Nota tidak ditemukan', 400);
            }

            ItemPenjualan::where('id_nota', $id)->delete();
            Penjualan::where('id_nota', $id)->delete();
            return $this->sendResponse('Berhasil menghapus penjualan');
        } catch (\Throwable $th) {
            return $this->sendError('Internal error in controller : ' . $th);
        }
    }
}
