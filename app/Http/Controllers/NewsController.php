<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateNewsRequest;
use Illuminate\Support\Facades\Auth;
use App\News;
use App\Image;
use Image as Imagick;

class NewsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth'])->except(['index', 'show', 'search']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($tag = null)
    {
        $allNews = $this->getNews($tag);

        return view('news.index', compact('allNews'));
    }

    public function myNews()
    {
        $allNews = Auth::user()->news()->orderBy('updated_at', 'desc')->paginate(6);

        return view('news.my-news', compact('allNews'));
    }

    public function search(Request $request)
    {
        $allNews = News::where('title', 'like', "%$request->word%")
                        ->orderBy('updated_at', 'desc')
                        ->paginate(6);

        return view('news.index', compact('allNews'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('news.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateNewsRequest $request)
    {
        $path = str_replace('public', '/storage', $request->file('image')->store('public/images'));
        $tags = explode(",", $request->tags);

        $image = Image::create([
            'path' => $path
        ]);

        $post = new News();
        $post->fill([
            'user_id' => Auth::id(),
            'image_id' => $image->id,
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content,
        ]);
        $post->save();
        $post->tag($tags);

        return redirect()->route('news.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        return view('news.show', compact('news'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        $tags = '';
        foreach ($news->tags as $tag) {
            $tags .= $tag->name . ',';
        }
        return view('news.edit', compact('news', 'tags'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateNewsRequest $request, News $news)
    {
        $path = str_replace('public', '/storage', $request->file('image')->store('public/images'));
        $tags = explode(",", $request->tags);

        $news->image->path = $path;
        $news->image->save();

        $post->fill([
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content,
        ]);
        $post->save();
        $post->retag($tags);

        return redirect()->route('my-news');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function getNews($tag)
    {
        if ($tag) {
            return News::withAnyTag([$tag])->orderBy('updated_at', 'desc')->paginate(3);
        }
        return News::orderBy('updated_at', 'desc')->paginate(3);
    }
}
