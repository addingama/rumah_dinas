<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pangkat;
use Validator;
use DB;

class PangkatController extends Controller
{
    public function index() {
        $list_pangkat = Pangkat::all();

        $data = compact('list_pangkat');
        return view('pangkat.index')->with($data);
    }

    public function create() {
        return view('pangkat.create');
    }

    public function store(Request $request) {
        DB::beginTransaction();
        try {
            $rules = [
                'nama' => 'required|unique:msPangkatPegawai,nama',
                'golongan' => 'required|unique:msPangkatPegawai,golongan'
            ];

            $validator = Validator::make($request->all(), $rules);

            //process
            if ($validator->fails()) {
                return  back()
                    ->withErrors($validator)
                    ->withInput();
            } else {
                Pangkat::create($request->all());
            }
        } catch (Exception $e) {
            DB::rollback();
            return back()->with('error', 'Pangkat gagal ditambahkan');
        }
        DB::commit();
        return redirect('pangkat')->with('success', 'Pangkat berhasil ditambahkan');
    }

    public function edit($id) {
        try {
            $pangkat = Pangkat::findOrFail($id);
        } catch (Exception $e) {
            return back()->with('error', 'Pangkat yang anda pilih tidak dapat ditemukan');
        }
        return view('pangkat.edit')->with('pangkat', $pangkat);
    }

    public function update(Request $request, $id) {
        DB::beginTransaction();
        try {
            $rules = [
                'nama' => 'required|unique:msPangkatPegawai,nama,'. $id,
                'golongan' => 'required|unique:msPangkatPegawai,golongan,'.$id
            ];

            $validator = Validator::make($request->all(), $rules);

            //process
            if ($validator->fails()) {
                return  back()
                    ->withErrors($validator)
                    ->withInput();
            } else {
                $pangkat = Pangkat::findOrFail($id);
                $pangkat->update($request->all());
            }
        } catch (Exception $e) {
            DB::rollback();
            return back()->with('error', 'Pangkat gagal diubah');
        }
        DB::commit();
        return redirect('pangkat')->with('success', 'Pangkat berhasil diubah');
    }

    public function destroy($id) {
        DB::beginTransaction();
        try {
            $pangkat = Pangkat::findOrFail($id);
            $pangkat->delete();
        } catch (Exception $e) {
            DB::rollback();
            return back()->with('error', 'Data pangkat gagal di hapus');
        }
        DB::commit();
        return back()->with('success', 'Data pangkat berhasil di hapus');
    }
}
