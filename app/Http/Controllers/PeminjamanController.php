<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Peminjaman;
use App\Models\Rumah;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Pangkat;
use App\Models\Jabatan;
use App\Models\SKPD;
use JavaScript;
use DB;
use Validator;

class PeminjamanController extends Controller
{
    public function index()
    {
        $list_pegawai = Pegawai::with('pangkat')->with('jabatan')->with('skpd')->get();
        $list_pangkat = Pangkat::select(DB::raw('CONCAT(golongan, " / ", nama) as nama'), 'id')->get()->pluck('nama', 'id')->all();
        $list_jabatan = Jabatan::select('nama')->orderBy('nama', 'asc')->get()->pluck('nama')->all();
        $list_skpd = SKPD::orderBy('nama', 'ASC')
            ->get()->pluck('nama', 'id')->all();
        $list_rumah = Rumah::where('is_available', '=', 1)->orderBy('alamat', 'ASC')
            ->get()->pluck('alamat', 'id')->all();

        JavaScript::put([
            'list_jabatan' => $list_jabatan,
            'list_skpd' => $list_skpd,
            'list_nip' => $list_pegawai->pluck('nip')->all(),
            'list_nama' => $list_pegawai->pluck('nama')->all(),
            'list_pegawai' => $list_pegawai
        ]);

        $data = compact('list_pangkat', 'list_rumah');
        return view('peminjaman.form_peminjaman')->with($data);
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $rules = [
                'nip' => 'required',
                'nama' => 'required',
                'pangkat_id' => 'required',
                'jenis_kelamin' => 'required',
                'jabatan' => 'required',
                'skpd' => 'required',
                'rumah_id' => 'required',
                'start' => 'required',
                'end' => 'required'
            ];

            $validator = Validator::make($request->all(), $rules);

            //process
            if ($validator->fails()) {
                return back()
                    ->withErrors($validator)
                    ->withInput();
            } else {
                $pegawai = Pegawai::where('nip', '=', $request->nip)->first();
                // cari id jabatan jika tidak ketemu, maka buat data jabatan baru (skpd juga begitu)
                $jabatan = Jabatan::where('nama', '=', $request->get('jabatan'))->first();
                $skpd = SKPD::where('nama', '=', $request->get('skpd'))->first();
                $rumah = Rumah::with('tipe')->find($request->get('rumah_id'));

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

                if ($pegawai == null) {
                    $pegawai = Pegawai::create($request->all());
                } else {
                    $pegawai->update($request->all());
                }

                // simpan data peminjaman
                $request->merge([
                    'pegawai_id' => $pegawai->id,
                    'start' => Carbon::createFromFormat('d/m/Y', $request->get('start'))->format('Y-m-d'),
                    'end' => Carbon::createFromFormat('d/m/Y', $request->get('end'))->format('Y-m-d'),
                    'harga_sewa' => $rumah->tipe->harga_sewa
                ]);
                Peminjaman::create($request->all());

                $rumah->update(['is_available' => 0]);

            }
        } catch (Exception $e) {
            DB::rollback();
            return back()->with('error', 'Peminjaman gagal ditambahkan');
        }
        DB::commit();
        return redirect('peminjaman')->with('success', 'Peminjaman berhasil ditambahkan');
    }
}
