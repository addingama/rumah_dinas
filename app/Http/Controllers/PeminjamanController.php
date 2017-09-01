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
    public function index() {
        $list_peminjaman = Peminjaman::notReturned()->with('pegawai', 'rumah.tipe')->get();

        $data = compact('list_peminjaman');
        return view('peminjaman.index')->with($data);
    }

    public function create()
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
        return view('peminjaman.create')->with($data);
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
                    'jabatan_id' => $jabatan->id,
                    'terbilang' => $rumah->tipe->terbilang
                ]);

                if ($pegawai == null) {
                    $pegawai = Pegawai::create($request->all());
                } else {
                    $pegawai->update($request->all());
                }

                // simpan data peminjaman
                $request->merge([
                    'pegawai_id' => $pegawai->id,
                    'start' => Carbon::createFromFormat('m/d/Y', $request->get('start'))->format('Y-m-d'),
                    'end' => Carbon::createFromFormat('m/d/Y', $request->get('end'))->format('Y-m-d'),
                    'harga_sewa' => $rumah->tipe->harga_sewa
                ]);
                $peminjaman = Peminjaman::create($request->all());

                $rumah->update(['is_available' => 0]);

            }
        } catch (Exception $e) {
            DB::rollback();
            return back()->with('error', 'Peminjaman gagal ditambahkan');
        }
        DB::commit();
        return redirect('peminjaman/'.$peminjaman->id)->with('success', 'Peminjaman berhasil ditambahkan');
    }

    public function edit($id)
    {
        try {
            $peminjaman = Peminjaman::with('pegawai.jabatan', 'pegawai.skpd', 'rumah.tipe')->findOrFail($id);
            $list_pegawai = Pegawai::with('pangkat')->with('jabatan')->with('skpd')->get();
            $list_pangkat = Pangkat::select(DB::raw('CONCAT(golongan, " / ", nama) as nama'), 'id')->get()->pluck('nama', 'id')->all();
            $list_jabatan = Jabatan::select('nama')->orderBy('nama', 'asc')->get()->pluck('nama')->all();
            $list_skpd = SKPD::orderBy('nama', 'ASC')
                ->get()->pluck('nama', 'id')->all();
            $list_rumah = Rumah::where('is_available', '=', 1)
                ->orWhere(function($query) use ($peminjaman) {
                    $query->where('is_available', '=', 0)->where('id', '=', $peminjaman->rumah_id);
                })
                ->orderBy('alamat', 'ASC')
                ->get()->pluck('alamat', 'id')->all();

            JavaScript::put([
                'list_jabatan' => $list_jabatan,
                'list_skpd' => $list_skpd,
                'list_nip' => $list_pegawai->pluck('nip')->all(),
                'list_nama' => $list_pegawai->pluck('nama')->all(),
                'list_pegawai' => $list_pegawai
            ]);

            $pegawai = $peminjaman->pegawai;
            $peminjaman->nama = $pegawai->nama;
            $peminjaman->nip = $pegawai->nip;
            $peminjaman->telepon = $pegawai->telepon;
            $peminjaman->jenis_kelamin = $pegawai->jenis_kelamin;
            $peminjaman->pangkat_id = $pegawai->pangkat_id;
            $peminjaman->jabatan = $pegawai->jabatan->nama;
            $peminjaman->skpd = $pegawai->skpd->nama;
            $peminjaman->start = Carbon::createFromFormat('Y-m-d', $peminjaman->start)->format('m/d/Y');
            $peminjaman->end = Carbon::createFromFormat('Y-m-d', $peminjaman->end)->format('m/d/Y');

            $data = compact('list_pangkat', 'list_rumah', 'peminjaman');
        } catch (Exception $e) {
            return back()->with('error', 'Peminjaman yang anda pilih tidak dapat ditemukan');
        }

        return view('peminjaman.edit')->with($data);
    }

    public function update(Request $request, $id)
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
                $peminjaman = Peminjaman::find($id);
                if ($peminjaman == null) {
                    return back()->with('error', 'Peminjaman tidak ditemukan');
                }
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

                $_rumah = Rumah::findOrFail($peminjaman->rumah_id);
                $_rumah->update([
                    'is_available' => 1
                ]);

                // simpan data peminjaman
                $request->merge([
                    'pegawai_id' => $pegawai->id,
                    'start' => Carbon::createFromFormat('m/d/Y', $request->get('start'))->format('Y-m-d'),
                    'end' => Carbon::createFromFormat('m/d/Y', $request->get('end'))->format('Y-m-d'),
                    'harga_sewa' => $rumah->tipe->harga_sewa,
                    'terbilang' => $rumah->tipe->terbilang
                ]);

                $peminjaman->update($request->all());

                $rumah->update(['is_available' => 0]);

            }
        } catch (Exception $e) {
            DB::rollback();
            return back()->with('error', 'Peminjaman gagal diubah');
        }
        DB::commit();
        return redirect('peminjaman/'.$id)->with('success', 'Peminjaman berhasil diubah');
    }

    public function destroy($id) {
        DB::beginTransaction();
        try {
            $peminjaman = Peminjaman::findOrFail($id);
            $tanggal_sekarang = Carbon::now();
            $tanggal_akhir_peminjaman = Carbon::createFromFormat('Y-m-d', $peminjaman->end);

            // reset is_available jika di hapus sebelum akhir peminjaman
            if ($tanggal_sekarang >= $tanggal_akhir_peminjaman) {
                $rumah = $peminjaman->rumah;
                $rumah->update(['is_available' => 1]);
            }

            $peminjaman->delete();


        } catch (Exception $e) {
            DB::rollback();
            return back()->with('error', 'Data peminjaman gagal di hapus');
        }
        DB::commit();
        return back()->with('success', 'Data peminjaman berhasil di hapus');
    }

    public function show($id) {
        try {
            $peminjaman = Peminjaman::with('pegawai.jabatan', 'pegawai.skpd', 'rumah.tipe')->findOrFail($id);
            $start_date = Carbon::createFromFormat('Y-m-d', $peminjaman->start);
            $end_date = Carbon::createFromFormat('Y-m-d', $peminjaman->end);
            $diff_in_days = $end_date->diffInDays($start_date);
            $diff_in_month = $end_date->diffInMonths($start_date);

            $sisa_hari = $diff_in_days % 30;
            if ($sisa_hari > 0) {
                $diff_in_month = $diff_in_month + 1;
            }

            $perkiraan_total_sewa = $peminjaman->harga_sewa * $diff_in_month;

            $data = compact('peminjaman', 'start_date', 'end_date', 'diff_in_month', 'diff_in_days', 'perkiraan_total_sewa');
        } catch(Exception $e) {
            return back()->with('error', 'Data peminjaman yang anda pilih tidak dapat ditemukan');
        }
        return view('peminjaman.show')->with($data);
    }

    public function sip($id) {
        try {
            $peminjaman = Peminjaman::with('pegawai.jabatan', 'pegawai.skpd', 'rumah.tipe')->findOrFail($id);

            $data = compact('peminjaman');
        } catch(Exception $e) {
            return back()->with('error', 'Data peminjaman yang anda pilih tidak dapat ditemukan');
        }
        return view('prints.sip')->with($data);
    }

    public function returning($id) {
        DB::beginTransaction();
        try {
            $peminjaman = Peminjaman::where('id', '=', $id)->first();
            $peminjaman->update(['is_returned' => 1]);
            $rumah = $peminjaman->rumah;
            $rumah->update(['is_available' => 1]);


        } catch(Exception $e) {
            DB::rollback();
            return back()->with('error', 'Data peminjaman yang anda pilih tidak dapat ditemukan');
        }
        DB::commit();
        return back()->with('success', 'Data peminjaman berhasil di hapus');
    }
}
