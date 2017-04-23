<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\Pangkat;
use App\Models\Pegawai;
use App\Models\SKPD;
use Illuminate\Http\Request;
use JavaScript;
use DB;
use Validator;
use Debugbar;

class PegawaiController extends Controller
{
    public function index()
    {
        $list_pegawai = Pegawai::orderBy('nip', 'asc')
            ->with('pangkat')
            ->with('jabatan')
            ->with('skpd')
            ->get();

        $data = compact('list_pegawai');
        return view('pegawai.index')->with($data);
    }

    public function create()
    {
        $list_pangkat = Pangkat::all()->pluck('nama', 'id')->all();
        $list_jabatan = Jabatan::select('nama')->orderBy('nama', 'asc')->get()->pluck('nama')->all();
        $list_skpd = SKPD::orderBy('nama', 'ASC')
            ->get()->pluck('nama', 'id')->all();

        JavaScript::put([
            'list_jabatan' => $list_jabatan,
            'list_skpd' => $list_skpd
        ]);

        $data = compact('list_pangkat');
        return view('pegawai.create')->with($data);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $rules = [
                'nip' => 'required|unique:msPegawai,nip',
                'nama' => 'required',
                'pangkat_id' => 'required',
                'jenis_kelamin' => 'required',
                'jabatan' => 'required',
                'skpd' => 'required'
            ];

            $validator = Validator::make($request->all(), $rules);

            //process
            if ($validator->fails()) {
                return back()
                    ->withErrors($validator)
                    ->withInput();
            } else {
                // cari id jabatan jika tidak ketemu, maka buat data jabatan baru (skpd juga begitu)
                $jabatan = Jabatan::where('nama', '=', $request->get('jabatan'))->first();
                $skpd = SKPD::where('nama', '=', $request->get('skpd'))->first();

                if ($jabatan == null) {
                    $jabatan = Jabatan::create(['nama' => $request->get('jabatan')]);
                }

                if ($skpd == null) {
                    $skpd = SKPD::create(['nama' => $request->get('skpd')]);
                }

                // masukkan data jabatan dan skpd id ke dalam array request
                $request->merge([
                    'skpd_id' => $skpd->id,
                    'jabatan_id' => $jabatan->id
                ]);

                Pegawai::create($request->all());
            }
        } catch (Exception $e) {
            DB::rollback();
            return back()->with('error', 'Pegawai gagal ditambahkan');
        }
        DB::commit();
        return redirect('pegawai')->with('success', 'Pegawai berhasil ditambahkan');
    }

    public function edit($id)
    {
        try {
            $pegawai = Pegawai::findOrFail($id);
            $pegawai->jabatan = $pegawai->jabatan->nama;
            $pegawai->skpd = $pegawai->skpd->nama;
            $list_pangkat = Pangkat::all()->pluck('nama', 'id')->all();
            $list_jabatan = Jabatan::select('nama')->orderBy('nama', 'asc')->get()->pluck('nama')->all();
            $list_skpd = SKPD::orderBy('nama', 'ASC')
                ->get()->pluck('nama', 'id')->all();

            JavaScript::put([
                'list_jabatan' => $list_jabatan,
                'list_skpd' => $list_skpd
            ]);

            $data = compact('list_pangkat', 'pegawai');
            Debugbar::info($pegawai);
        } catch (Exception $e) {
            return back()->with('error', 'Pegawai yang anda pilih tidak dapat ditemukan');
        }
        return view('pegawai.edit')->with($data);

    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $rules = [
                'nip' => 'required|unique:msPegawai,nip,'. $id,
                'nama' => 'required',
                'pangkat_id' => 'required',
                'jenis_kelamin' => 'required',
                'jabatan' => 'required',
                'skpd' => 'required'
            ];

            $validator = Validator::make($request->all(), $rules);

            //process
            if ($validator->fails()) {
                return back()
                    ->withErrors($validator)
                    ->withInput();
            } else {
                $pegawai = Pegawai::findOrFail($id);
                // cari id jabatan jika tidak ketemu, maka buat data jabatan baru (skpd juga begitu)
                $jabatan = Jabatan::where('nama', '=', $request->get('jabatan'))->first();
                $skpd = SKPD::where('nama', '=', $request->get('skpd'))->first();

                if ($jabatan == null) {
                    $jabatan = Jabatan::create(['nama' => $request->get('jabatan')]);
                }

                if ($skpd == null) {
                    $skpd = SKPD::create(['nama' => $request->get('skpd')]);
                }

                // masukkan data jabatan dan skpd id ke dalam array request
                $request->merge([
                    'skpd_id' => $skpd->id,
                    'jabatan_id' => $jabatan->id
                ]);


                $pegawai->update($request->all());
            }
        } catch (Exception $e) {
            DB::rollback();
            return back()->with('error', 'Pegawai gagal diubah');
        }
        DB::commit();
        return redirect('pegawai')->with('success', 'Pegawai berhasil diubah');
    }

    public function destroy($id) {
        DB::beginTransaction();
        try {
            $pegawai = Pegawai::findOrFail($id);
            $pegawai->delete();
        } catch (Exception $e) {
            DB::rollback();
            return back()->with('error', 'Data pegawai gagal di hapus');
        }
        DB::commit();
        return back()->with('success', 'Data pegawai berhasil di hapus');
    }
}
