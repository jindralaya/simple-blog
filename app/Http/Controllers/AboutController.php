<?php

namespace App\Http\Controllers;

use App\Http\Requests\AboutRequest;
use App\Models\About;
use App\Models\Tag;
use ProtoneMedia\Splade\Facades\SEO;
use ProtoneMedia\Splade\Facades\Toast;
use Illuminate\Support\Str;

class AboutController extends Controller
{
    public function index()
    {
        try {
            // mengambil data
            $about = About::first();
            $tag = Tag::pluck('tag');
            // cek data apakah berisi
            if (isset($about) && isset($tag)) {
                SEO::title('Tentang diveloper.id')
                    ->description(Str::of(strip_tags($about->content))->words(20))
                    ->keywords($tag);
            } else {
                $tag = [
                    'laravel',
                    'mariadb',
                    'nextjs',
                    'vuejs',
                    'about me'
                ];
                SEO::title('Tentang diveloper.id')
                    ->description('ini adalah tentang diveloper.id')
                    ->keywords($tag);
            }
            // kirim data ke view
            return view('about', compact('about'));
        } catch (\Exception $e) {
            // mengambil error message
            Toast::title('Gagal memuat data!')
                ->message($e->getMessage())
                ->danger()
                ->autoDismiss(15)
                ->backdrop();
        }
    }

    public function insertView()
    {
        // mengambil data
        $about = About::first();
        //cek data apakah berisi
        if (isset($about)) {
            // kembali ke view
            return to_route('about.edit');
        }
        // kembali ke view
        return view('admin.about.insert');
    }
    public function editView()
    {
        $about = About::first();
        return view('admin.about.edit', compact('about'));
    }
    public function insert(AboutRequest $request)
    {
        // cek data
        $cek = About::first();
        if ($cek) {
            Toast::title('Data sudah ada,silahkan edit!')
                ->danger()
                ->autoDismiss(15)
                ->backdrop();
            // kembali ke view
            return to_route('about');
        } else {
            try {
                $data = [
                    'uuid' => Str::uuid(),
                    'content' => $request->content
                ];
                $save = About::insert($data);
                Toast::title('Data berhasil ditambah.')
                    ->success()
                    ->autoDismiss(15)
                    ->backdrop();
                // kembali ke view
                return to_route('about');
            } catch (\Exception $e) {
                // mengambil error message
                Toast::title('Gagal memuat data!')
                    ->message($e->getMessage())
                    ->danger()
                    ->autoDismiss(15)
                    ->backdrop();
            }
        }
    }
    public function update(About $about, AboutRequest $request)
    {
        try {
            // ubah data
            $about->update([
                'uuid' => Str::uuid(),
                'content' => $request->content
            ]);
            Toast::title('Data berhasil diubah.')
                ->success()
                ->autoDismiss(15)
                ->backdrop();
            // kembali ke view
            return to_route('about');
        } catch (\Exception $e) {
            // mengambil error message
            Toast::title('Gagal memuat data!')
                ->message($e->getMessage())
                ->danger()
                ->autoDismiss(15)
                ->backdrop();
        }
    }
    public function delete(About $about)
    {
        try {
            // hapus data
            $about->delete();
            Toast::title('Data berhasil dihapus.')
                ->success()
                ->autoDismiss(15)
                ->backdrop();
            // kembali ke view
            return to_route('about');
        } catch (\Exception $e) {
            // mengambil error message
            Toast::title('Gagal memuat data!')
                ->message($e->getMessage())
                ->danger()
                ->autoDismiss(15)
                ->backdrop();
        }
    }
}
