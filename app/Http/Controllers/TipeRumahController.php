<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\TipeRumah;
use Validator;
use DB;
use File;
use Illuminate\Support\Facades\App;



class TipeRumahController extends Controller
{
    public function index() {
        $list_tipe_rumah = TipeRumah::all();

        $data = compact('list_tipe_rumah');
        return view('tipe_rumah.index')->with($data);
    }

    public function create() {
        return view('tipe_rumah.create');
    }

    public function store(Request $request) {
        DB::beginTransaction();
        try {
            $rules = [
                'nama' => 'required|unique:msTipeRumah,nama',
                'harga_sewa' => 'required|numeric'
            ];

            $validator = Validator::make($request->all(), $rules);

            //process
            if ($validator->fails()) {
                return  back()
                    ->withErrors($validator)
                    ->withInput();
            } else {
                TipeRumah::create($request->all());
            }
        } catch (Exception $e) {
            DB::rollback();
            return back()->with('error', 'Tipe rumah gagal ditambahkan');
        }
        DB::commit();
        return redirect('tipe_rumah')->with('success', 'Tipe rumah berhasil ditambahkan');
    }

    public function edit($id) {
        try {
            $tipe_rumah = TipeRumah::findOrFail($id);
        } catch (Exception $e) {
            return back()->with('error', 'Tipe rumah yang anda pilih tidak dapat ditemukan');
        }
        return view('tipe_rumah.edit')->with('tipe_rumah', $tipe_rumah);
    }

    public function update(Request $request, $id) {
        DB::beginTransaction();
        try {
            $rules = [
                'nama' => 'required|unique:msTipeRumah,nama,'.$id,
                'harga_sewa' => 'required|numeric'
            ];

            $validator = Validator::make($request->all(), $rules);

            //process
            if ($validator->fails()) {
                return  back()
                    ->withErrors($validator)
                    ->withInput();
            } else {
                $tipe_rumah = TipeRumah::findOrFail($id);
                $tipe_rumah->update($request->all());
            }
        } catch (Exception $e) {
            DB::rollback();
            return back()->with('error', 'Tipe rumah gagal diubah');
        }
        DB::commit();
        return redirect('tipe_rumah')->with('success', 'Tipe rumah berhasil diubah');
    }

    public function destroy($id) {
        DB::beginTransaction();
        try {
            $tipe_rumah = TipeRumah::findOrFail($id);
            $tipe_rumah->delete();
        } catch (Exception $e) {
            DB::rollback();
            return back()->with('error', 'Data tipe rumah gagal di hapus');
        }
        DB::commit();
        return back()->with('success', 'Data tipe rumah berhasil di hapus');
    }

    public function import(Request $request) {
        ini_set('memory_limit', '1024M');
        ini_set('max_execution_time', 3600);
        DB::beginTransaction();
        try {
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $destinationPath = 'uploads/tipe_rumah';
                if (!File::exists($destinationPath)) {
                    File::makeDirectory($destinationPath, $mode = 0777, true, true);
                }
                $extension = $file->getClientOriginalExtension(); //if you need extension of the file
                $filename = 'tipe_rumah_dinas.'. $extension;
                $uploadSuccess = $request->file('file')->move($destinationPath, $filename);
                if ($uploadSuccess) {
                    $excel = App::make('excel');
                    $excel->load($destinationPath . '/' . $filename, function ($reader) {
                        $results = $reader->all();

                        foreach ($results as $key => $value) {
                            $nama = $value['tipe'];
                            if ($nama != null) {
                                $tipe_rumah = TipeRumah::where('nama', '=', $nama)->first();
                                if ($tipe_rumah == null) {
                                    TipeRumah::create([
                                        'nama' => $value['tipe'],
                                        'harga_sewa' => $value['harga_sewa'],
                                        'terbilang' => $value['terbilang']
                                    ]);
                                } else {
                                    $tipe_rumah->update([
                                        'nama' => $value['tipe'],
                                        'harga_sewa' => $value['harga_sewa'],
                                        'terbilang' => $value['terbilang']
                                    ]);
                                }
                            }

                        }
                    });
                }
            }
        } catch (Exception $e) {
            DB::rollback();
            return back()->with('error', 'Import Data Tipe Rumah Dinas Gagal');
        }
        DB::commit();
        return back()->with('success', 'Import Data Tipe Rumah Dinas Berhasil');
    }
}
