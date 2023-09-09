<?php

namespace App\Http\Controllers;

use App\Models\Alquran;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use ProtoneMedia\Splade\Facades\SEO;
use ProtoneMedia\Splade\Facades\Toast;
use Illuminate\Http\Request;

class PlayboxController extends Controller
{
    public function index()
    {
        SEO::title('Playbox diveloper.id')
            ->description('Berisi tentang project atau fitur web dari diveloper')
            ->keywords(['laravel', 'nextjs', 'vue', 'adonisjs', 'website', 'blog']);
        return view('playbox.index');
    }
    public function Alquran(Request $request)
    {
        SEO::title('Alquran online diveloper.id')
            ->description('Alquran online diveloper.id')
            ->keywords(['alquran', 'alquran online', 'surat alquran', 'surah alquran', '30 juz', 'ayat alquran']);
        try {
            // cek jika ada pencarian
            $search = $request->get('search');
            $query = Alquran::query();
            if ($search) {
                //mengambil data
                $alquran = Alquran::where('title', 'LIKE', "%$search%")
                    ->paginate(20);
            } else {
                $alquran = $query->paginate(20);
            }
            return view('playbox.alquran', compact(
                'alquran'
            ));
        } catch (\Exception $e) {
            // mengambil error message
            Toast::title('Gagal memuat data!')
                ->message($e->getMessage())
                ->danger()
                ->autoDismiss(15)
                ->backdrop();
        }
    }
    public function Alqurandetail($slug)
    {
        $alquran = Alquran::where('slug', $slug)->first();

        SEO::title($alquran->title)
            ->description('surat alquran yang ' . $alquran->id . ' adalah ' . $alquran->title)
            ->keywords(['surat alquran yang ' . $alquran->id, $alquran->title]);

        return view('playbox.alquran-detail', compact(
            'alquran'
        ));
    }

    public function Sinkron()
    {
        $response = Http::get('https://api.npoint.io/99c279bb173a6e28359c/data')->json();
        try {
            $no = 0;
            foreach ($response as $data) {

                // Jika data tidak ada, tambahkan data baru
                AlQuran::updateOrInsert([
                    'id' => $data['nomor'],
                ], [
                    'id' => $data['nomor'],
                    'number' => $no++,
                    'title' => $data['nama'],
                    'slug' => Str::slug($data['nama']),
                    'audio' => $data['audio'],
                    // Masukkan kolom-kolom lain sesuai dengan struktur tabel Anda
                ]);
            }
            // mengambil error message
            Toast::title('Berhasil sinkron.')
                ->success()
                ->autoDismiss(15)
                ->backdrop();
            return to_route('alquran');
        } catch (\Exception $e) {
            // mengambil error message
            Toast::title('Gagal memuat data!')
                ->message($e->getMessage())
                ->danger()
                ->autoDismiss(15)
                ->backdrop();
            return to_route('alquran');
        }
    }
}
