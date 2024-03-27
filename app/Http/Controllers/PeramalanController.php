<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Kandang;
use App\Models\Peramalan;
use App\Models\Produksi;
use App\Models\Result;
use App\Models\TahunProduksi;
use DB;
use Illuminate\Support\Facades\DB as FacadesDB;

class PeramalanController extends Controller
{
    public function index()
    {
        $kandangs = Kandang::all();
        $kandang = FacadesDB::table('kandang')->count();
        $dataAktual = FacadesDB::table('produksi_telur')->get();
        $tahun = TahunProduksi::all();
        $peramalan = Peramalan::all();
        $penghitunganTelur = $this->hitung($dataAktual);
        return view('peramalan.index', compact('kandangs', 'kandang', 'tahun', 'dataAktual', 'penghitunganTelur', 'peramalan'));
    }

    public function hitung($dataAktual)
    {
        $jumlahSemuaTelur = 0;

        foreach ($dataAktual as $key => $produksi) {
            $jumlahSemuaTelur += $produksi->jumlah;
        }

        return $jumlahSemuaTelur;
    }

    public function forecast(Request $request)
    {

        if (Peramalan::count() > 0) {
            return redirect('/peramalanAdmin')->with('toast_error', 'Silahkan clear records terlebih dahulu untuk melakukan proses peramalan berikutnya');
        }

        $kandang = $request->input('namakandang_id');

        $bulanUrutan = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];

        // Dapatkan data produksi dengan filtering berdasarkan kandang_id
        $produksi = Produksi::where('namakandang_id', $kandang)
            ->get()
            ->sortBy(function ($item) use ($bulanUrutan) {
                // Pisahkan nilai bulan dan tahun
                $parts = explode(' ', $item->bulan);
                $bulanIndex = 0; // Default nilai bulanIndex

                // Periksa apakah array memiliki panjang yang cukup
                if (count($parts) == 2) {
                    $bulanIndex = array_search($parts[0], $bulanUrutan);
                }

                // Konversi nama bulan menjadi angka
                $tahun = isset($parts[1]) ? intval($parts[1]) : 0;

                // Gabungkan tahun dan indeks bulan untuk menghasilkan nilai yang bisa diurutkan
                return $tahun * 100 + $bulanIndex;
            });

        // Lakukan eager loading untuk relasi kandang dan tahunProduksi
        $produksi->load(['kandang', 'tahunProduksi']);

        if ($produksi->count() <= 0) {
            return redirect('/peramalanAdmin')->with('toast_error', 'Data kandang ayam tidak ditemukan');
        }

        $jumlah = $produksi->pluck('jumlah');

        // Tentukan nilai alpha
        $alpha = $request->input('alpha'); // Nilai alpha, bisa disesuaikan

        // Inisialisasi nilai awal
        $s1t = $jumlah[0]; // Nilai awal s1t adalah data aktual pada indeks 0
        $s2t = $s1t; // Nilai awal s2t adalah nilai dari s1t pada indeks 0
        $at = 0; // Nilai awal at diindeks 0 adalah 0
        $bt = 0; // Nilai awal bt diindeks 0 adalah 0

        // Inisialisasi nilai peramalan sebelumnya
        $previousForecast = 0;

        foreach ($jumlah as $index => $actual) {
            // Hitung nilai peramalan
            if ($index === 0) {
                $forecast = 0; // Periode pertama, peramalan sama dengan data aktual
            } else {
                // Hitung nilai s1t, s2t, at, bt, dan ft
                $s1t = $alpha * $actual + (1 - $alpha) * $s1t;
                $s2t = $alpha * $s1t + (1 - $alpha) * $s2t;
                $at = 2 * $s1t - $s2t;
                $bt = $alpha / (1 - $alpha) * ($s1t - $s2t); // Perbaikan perhitungan BT

                // Hitung peramalan untuk periode saat ini
                if ($at == 0 && $bt == 0) {
                    $forecast = 0; // Jika at dan bt sebelumnya 0, maka forecast juga 0
                } else {
                    $forecast = $at + $bt * 1;
                }
            }

            // Simpan peramalan ke dalam array
            $peramalan = new Peramalan();
            $peramalan->periode = $index + 1; // Anda bisa menyesuaikan periode sesuai dengan kebutuhan
            $peramalan->alpha = $alpha;
            $peramalan->aktual = $actual;
            $peramalan->s1 = $s1t;
            $peramalan->s2 = $s2t;
            $peramalan->a = $at;
            $peramalan->b = $bt;
            $peramalan->f = $previousForecast; // Menggunakan nilai peramalan sebelumnya
            // Jika Anda memiliki kolom lain yang ingin disimpan, tambahkan di sini
            $peramalan->save();

            // Simpan nilai peramalan untuk index saat ini sebagai nilai sebelumnya untuk iterasi berikutnya
            $previousForecast = $forecast;
        }

        // Tampilkan hasil peramalan
        return redirect('/peramalanAdmin')->withInput();
    }

    public function resultData()
    {
        $data = Result::all();

        return view('result.index', compact('data'));
    }


    public function generateForecast(Request $request)
    {
        $dataAt = Peramalan::orderBy('periode', 'desc')->pluck('a')->first();
        $valueAt = doubleval($dataAt);

        $dataBt = Peramalan::orderBy('periode', 'desc')->pluck('b')->first();
        $valueBt = doubleval($dataBt);

        $dataPeriod = Peramalan::orderBy('periode', 'desc')->pluck('periode')->first();
        $valuePeriod = intval($dataPeriod);

        $bulan = $request->input('bulan');

        // Lakukan perulangan untuk menyimpan data
        for ($i = 0; $i < $bulan; $i++) {
            // Buat instance baru dari model Result
            $result = new Result();

            // Tetapkan nilai atribut sesuai dengan logika Anda
            $result->periode = $valuePeriod + $i + 1; // Periode bertambah 1 setiap perulangan
            $result->a = $valueAt; // Gunakan nilai dari Peramalan::latest()->pluck('a')->first()
            $result->b = $valueBt; // Gunakan nilai dari Peramalan::latest()->pluck('b')->first()
            $result->m = $i + 1; // Misalnya, Anda belum memiliki nilai untuk 'm', Anda dapat menyesuaikan ini
            $result->ft = ($valueAt + $valueBt) * ($i + 1); // Misalnya, Anda belum memiliki nilai untuk 'ft', Anda dapat menyesuaikan ini

            // Simpan instance ke dalam database
            $result->save();
        }

        return redirect('/result-view');
    }

    public function destroy()
    {

        if (Peramalan::count() <= 0) {
            return redirect('/peramalanAdmin')->with('toast_info', 'Records sudah kosong!');;
        }

        Peramalan::truncate();

        return redirect('/peramalanAdmin');
    }

    public function destroyResult()
    {
        if (Result::count() <= 0) {
            return redirect('/result-view')->with('toast_info', 'Records sudah kosong!');
        }

        Result::truncate();

        return redirect('/result-view');
    }
}
