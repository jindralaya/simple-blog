<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Tag;
use ProtoneMedia\Splade\Facades\SEO;
use ProtoneMedia\Splade\Facades\Toast;

class BerandaController extends Controller
{
    public function index()
    {
        try {
            // mengambil data
            $blog = Blog::where('active', 1)->paginate(10);
            // dd($blog);
            $tag = Tag::pluck('tag');
            // cek data apakah berisi
            if (count($blog) > 0 && isset($tag)) {
                SEO::title('Selamat data diveloper.id')
                    ->description('Ini adalah halaman awal website diveloper.id')
                    ->keywords($tag);
            } else {
                $tag = [
                    'laravel',
                    'mariadb',
                    'nextjs',
                    'vuejs',
                    'about me'
                ];
                SEO::title('diveloper.id')
                    ->description('diveloper.id')
                    ->keywords($tag);
            }
            // kirim data ke view
            return view('home', compact('blog'));
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