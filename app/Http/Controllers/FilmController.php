<?php

namespace App\Http\Controllers;

use App\Models\Film;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

/**
 * Summary of FilmController
 */
class FilmController extends Controller
{
    /**
     * Summary of index
     * @return View
     */
    public static function index(): View {
        return view('admin.filmManager');
    }

    /**
     * Summary of viewFilm
     * @param mixed $id
     * @return View
     */
    public static function viewFilm(int $id): View {
        return view('film', ['film' =>  Film::find($id)]);
    }

    /**
     * Summary of create
     * @param Request $request
     * @param string $imagePath
     * @return void
     */
    public static function create(Request $request, string $imagePath): void{
        $film = new Film;
        $film->title = $request->title;
        $film->image = $imagePath;
        $film->price = $request->price;
        $film->censorship = $request->censorship;
        $film->premiereDate = $request->premiereDate;
        $film->genre = $request->genre;
        $film->save();
    }

    /**
     * Summary of edit
     * @param string $id
     * @return View
     */
    public static function edit(string $id): View {
        return view('admin.filmEdit', ['film' => Film::find($id)]);
    }

    /**
     * Summary of update
     * @param Request $request
     * @return RedirectResponse
     */
    public static function update(Request $request): RedirectResponse { //TODO сделать метод update в FileController
        $film = Film::find($request->id);
        $film->title = $request->title;
        //$film->image = $imagePath;
        $film->price = $request->price;
        $film->censorship = $request->censorship;
        $film->premiereDate = $request->premiereDate;
        $film->genre = $request->genre;
        if ($request->image) $film->image = $request->image->storeAs('public/upload', $request->title."image".$request->image->getClientOriginalExtension());
        $film->save();
        return redirect()->route('home');
    }


    /**
     * Summary of delete
     * @param int $id
     * @return RedirectResponse
     */
    public static function delete(int $id): RedirectResponse {
        Film::find($id)->delete();
        return redirect()->route('home');
    }

    

}
