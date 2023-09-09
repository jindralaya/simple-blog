<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogRequest;
use App\Models\Blog;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use ProtoneMedia\Splade\Facades\Toast;
use Illuminate\Support\Str;
use ProtoneMedia\Splade\Facades\SEO;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        SEO::title('Blog diveloper.id')
            ->description('Blog diveloper.id')
            ->keywords(['laravel', 'nextjs', 'vue', 'adonisjs', 'website', 'blog']);
        try {
            // cek jika ada pencarian
            $search = $request->get('search');
            if ($search) {
                // cek auth
                if (Auth::check() && Auth::user()->is_admin) {
                    //mengambil data
                    $blog = Blog::where('title', 'LIKE', "%$search%")
                        ->orWhere('content', 'LIKE', "%$search%")
                        ->paginate(10);
                } else {
                    //mengambil data
                    $blog = Blog::where('active', 1)
                        ->orwhere('title', 'LIKE', "%$search%")
                        ->orWhere('content', 'LIKE', "%$search%")
                        ->paginate(10);
                }
                // kirim data ke view
                return view('blog', compact(
                    'blog'
                ));
            } else {
                // cek auth
                if (Auth::check() && Auth::user()->is_admin) {
                    // mengambil data
                    $blog = Blog::paginate(10);
                } else {
                    // mengambil data
                    $blog = Blog::where('active', 1)->paginate(10);
                }
                // kirim data ke view
                return view('blog', compact(
                    'blog'
                ));
            }
        } catch (\Exception $e) {
            // mengambil error message
            Toast::title('Gagal memuat data!')
                ->message($e->getMessage())
                ->danger()
                ->autoDismiss(15)
                ->backdrop();
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tags = Tag::all();
        return view('admin.blog.insert', compact(
            'tags'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BlogRequest $request)
    {
        try {
            $user = User::find(Auth::id());
            $blog = new Blog([
                'title' => $request->title,
                'content' => $request->content,
                'slug' => Str::slug($request->title),
                'active' => $request->active
            ]);
            $user->blogs()->save($blog);
            // Hubungkan blog dengan tag yang dipilih (jika ada tag yang dipilih)
            if (isset($request->tag)) {
                $blog->tags()->attach($request->tag);
            }
            Toast::title('Data berhasil ditambah.')
                ->success()
                ->autoDismiss(15)
                ->backdrop();
            // kembali ke view
            return to_route('blog');
        } catch (\Exception $e) {
            // mengambil error message
            Toast::title('Gagal memuat data!')
                ->message($e->getMessage())
                ->danger()
                ->autoDismiss(15)
                ->backdrop();
            // kembali ke view
            return to_route('blog');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        try {
            // mengambil data
            $blog = Blog::where('slug', $slug)
                ->where('active', 1)
                ->first();
            // cek data apakah berisi
            if (isset($blog)) {
                SEO::title($blog->title)
                    ->description(Str::of(strip_tags($blog->content))->words(20))
                    ->keywords($blog->tags->pluck('tag'));
            } else {
                $tag = [
                    'laravel',
                    'mariadb',
                    'nextjs',
                    'vuejs',
                    'about me'
                ];
                SEO::title('Tentang aijra.id')
                    ->description('ini adalah tentang aijra.id')
                    ->keywords($tag);
            }
            // kembali ke view
            return view('blog-detail', compact(
                'blog'
            ));
        } catch (\Exception $e) {
            // mengambil error message
            Toast::title('Gagal memuat data!')
                ->message($e->getMessage())
                ->danger()
                ->autoDismiss(15)
                ->backdrop();
            // kembali ke view
            return to_route('blog');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        $tags = Tag::all();
        return view('admin.blog.edit', compact(
            'blog',
            'tags'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BlogRequest $request, Blog $blog)
    {
        try {
            // mengambil data
            $blog->update([
                'title' => $request->title,
                'content' => $request->content,
                'slug' => Str::slug($request->title),
                'active' => $request->active
            ]);
            // cek data apakah berisi
            if (isset($request->tag)) {
                // Update hubungan pivot untuk tags
                $blog->tags()->sync($request->tag);
            }
            Toast::title('Data berhasil diubah.')
                ->success()
                ->autoDismiss(15)
                ->backdrop();
            // kembali ke view
            return to_route('blog');
        } catch (\Exception $e) {
            // mengambil error message
            Toast::title('Gagal memuat data!')
                ->message($e->getMessage())
                ->danger()
                ->autoDismiss(15)
                ->backdrop();
            // kembali ke view
            return to_route('blog');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        try {
            // hapus data
            $blog->delete();
            Toast::title('Data berhasil dihapus.')
                ->success()
                ->autoDismiss(15)
                ->backdrop();
            // kembali ke view
            return to_route('blog');
        } catch (\Exception $e) {
            // mengambil error message
            Toast::title('Gagal memuat data!')
                ->message($e->getMessage())
                ->danger()
                ->autoDismiss(15)
                ->backdrop();
            // kembali ke view
            return to_route('blog');
        }
    }
}
