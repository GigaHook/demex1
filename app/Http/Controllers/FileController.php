<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
/**
 * Summary of FileController
 */
class FileController extends Controller
{
    /**
     * Summary of upload
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public static function upload(Request $request) {
        $image = $request->file('image');
        //$image->storeAs('public/upload', $request->title."_image.".$image->getClientOriginalExtension())
        
        FilmController::create($request, Storage::put('/uploads', $image));
        
        return redirect()->route('home');
    }


}
