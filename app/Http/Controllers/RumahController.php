<?php

namespace App\Http\Controllers;

use App\Models\Rumah;
use App\Models\TipeRumah;
use Illuminate\Http\Request;
use Validator;
use DB;
use File;
use Illuminate\Support\Facades\App;

class RumahController extends Controller
{
    public function index() {
        $list_rumah = Rumah::select('msRumah.*', 'msTipeRumah.nama as tipe_rumah', 'msTipeRumah.harga_sewa')
            ->leftJoin('msTipeRumah', 'msRumah.tipe_rumah_id', '=', 'msTipeRumah.id')
            ->get();

        $data = compact('list_rumah');
        return view('rumah.index')->with($data);
    }

    public function create() {
        $list_tipe_rumah = TipeRumah::orderBy('harga_sewa', 'desc')
            ->get()
            ->pluck('nama', 'id')
            ->all();

        $data = compact('list_tipe_rumah');
        return view('rumah.create')->with($data);
    }

    public function store(Request $request) {
        DB::beginTransaction();
        try {
            $rules = [
                'alamat' => 'required|unique:msRumah,alamat',
                'kondisi' => 'required',
                'tipe_rumah_id' => 'required|numeric'
            ];

            $validator = Validator::make($request->all(), $rules);

            //process
            if ($validator->fails()) {
                return  back()
                    ->withErrors($validator)
                    ->withInput();
            } else {
                Rumah::create($request->all());
            }
        } catch (Exception $e) {
            DB::rollback();
            return back()->with('error', 'Rumah gagal ditambahkan');
        }
        DB::commit();
        return redirect('rumah')->with('success', 'Rumah berhasil ditambahkan');
    }

    public function edit($id) {
        try {
            $rumah = Rumah::findOrFail($id);
            $list_tipe_rumah = TipeRumah::orderBy('harga_sewa', 'desc')
                ->get()
                ->pluck('nama', 'id')
                ->all();

            $data = compact('list_tipe_rumah', 'rumah');
        } catch (Exception $e) {
            return back()->with('error', 'Rumah yang anda pilih tidak dapat ditemukan');
        }
        return view('rumah.edit')->with($data);

    }

    public function update(Request $request, $id) {
        DB::beginTransaction();
        try {
            $rules = [
                'alamat' => 'required|unique:msRumah,alamat',
                'kondisi' => 'required',
                'tipe_rumah_id' => 'required|numeric'
            ];

            $validator = Validator::make($request->all(), $rules);

            //process
            if ($validator->fails()) {
                return  back()
                    ->withErrors($validator)
                    ->withInput();
            } else {
                $rumah = Rumah::findOrFail($id);
                $rumah->update($request->all());
            }
        } catch (Exception $e) {
            DB::rollback();
            return back()->with('error', 'Rumah gagal diubah');
        }
        DB::commit();
        return redirect('rumah')->with('success', 'Rumah berhasil diubah');
    }

    public function destroy($id) {
        DB::beginTransaction();
        try {
            $rumah = Rumah::findOrFail($id);
            $rumah->delete();
        } catch (Exception $e) {
            DB::rollback();
            return back()->with('error', 'Data rumah gagal di hapus');
        }
        DB::commit();
        return back()->with('success', 'Data rumah berhasil di hapus');
    }

    public function import(Request $request) {
        ini_set('memory_limit', '1024M');
        ini_set('max_execution_time', 3600);
        DB::beginTransaction();
        try {
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $destinationPath = 'uploads/rumah';
                if (!File::exists($destinationPath)) {
                    File::makeDirectory($destinationPath, $mode = 0777, true, true);
                }
                $extension = $file->getClientOriginalExtension(); //if you need extension of the file
                $filename = 'rumah_dinas.'. $extension;
                $uploadSuccess = $request->file('file')->move($destinationPath, $filename);
                if ($uploadSuccess) {
                    $excel = App::make('excel');
                    $excel->load($destinationPath . '/' . $filename, function ($reader) {
                        $results = $reader->all();

                        foreach ($results as $key => $value) {
                            $alamat = $value['alamat'];
                            $tipe = $value['tipe_rumah'];

                            $tipe_rumah = TipeRumah::where('nama', '=', $tipe)->first();
                            if ($tipe_rumah == null) {
                                $tipe_rumah = TipeRumah::create([
                                    'nama' => $value['tipe_rumah'],
                                    'harga_sewa' => $value['harga_sewa']
                                ]);
                            }
                            if ($alamat != null) {
                                $rumah = Rumah::where('alamat', '=', $alamat)->first();
                                if ($rumah == null) {
                                    Rumah::create([
                                        'alamat' => $value['alamat'],
                                        'kondisi' => $value['kondisi'],
                                        'keterangan' => $value['keterangan'],
                                        'tipe_rumah_id' => $tipe_rumah->id
                                    ]);
                                } else {
                                    $rumah->update([
                                        'alamat' => $value['alamat'],
                                        'kondisi' => $value['kondisi'],
                                        'keterangan' => $value['keterangan'],
                                        'tipe_rumah_id' => $tipe_rumah->id
                                    ]);
                                }
                            }

                        }
                    });
                }
            }
        } catch (Exception $e) {
            DB::rollback();
            return back()->with('error', 'Import Data Rumah Dinas Gagal');
        }
        DB::commit();
        return back()->with('success', 'Import Data Rumah Dinas Berhasil');
    }
}
