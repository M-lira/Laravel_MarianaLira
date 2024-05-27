<?php

namespace App\Http\Controllers;

use App\Models\Band;
use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AlbumController extends Controller
{
    private function getAlbums() //vai buscar os albums à BD
    {
        $albums = DB::table('albums')
            ->join('bands', 'bands_id', '=', 'bands.id')
            ->select('albums.*', 'bands.name as band_name')
            ->distinct()
            ->get();

        return $albums;
    }
    public function allAlbums() { //apresenta todos os albums

        $albums = $this->getAlbums();
        return view('albums.all_albums', compact('albums'));
    }

    public function addAlbum() {
        $bands = DB::table('bands')
            ->select('bands.id as bands_id', 'bands.name as band_name')
            ->distinct()
            ->get();

        return view('albums.add_album', compact('bands'));
    }

    public function createAlbum(Request $request) { //Adiciona um album

        $bands = Band::all();

        $request->validate([
            'albumName' => 'required|string|max:50',
            'dateRelease' => 'required|integer|digits:4',
            'bands_id' => 'required|exists:bands,id',
        ]);

        $cover = null;
        if ($request->has('cover')) {
            $cover = Storage::putFile('uploadedImages', $request->cover);

        Album::insert([
            'albumName' => $request->albumName,
            'cover' => $cover,
            'dateRelease' => $request->dateRelease,
            'bands_id' => $request->bands_id,
        ]);

        foreach ($bands as $myBand) {
            $myBand->num_albums = Album::where('bands_id', $myBand->id)->count();
            $myBand->save();
        }

        return redirect()->route('album.all')->with('message', 'New album successfully created!');
    }

    public function viewAlbum($id) {
        $bands = DB::table('bands')->get();
        $album = DB::table('albums')
            ->where('albums.id', $id)
            ->join('bands', 'bands_id', '=', 'bands.id')
            ->select('albums.*', 'bands.name as band_name', )
            ->distinct()
            ->first();
        return view('albums.view_album', compact('album', 'bands'));
    }

    public function updateAlbum(Request $request) { //Atualiza um album

        $request->validate([
            'albumName' => 'required|string|max:50',
            'dateRelease' => 'required|integer|digits:4',
            'bands_id' => 'required|exists:bands,id',
        ]);

        $album = Album::findOrFail($request->id);

        // $cover = null;
        if ($request->hasFile('cover')) {
            $cover = Storage::putFile('uploadedImages', $request->file('cover'));
        } else {
            $cover = $album->cover;
        }

        Album::where('id', $request->id)
            ->update([
                'albumName' => $request->albumName,
                'cover' => $cover,
                'dateRelease' => $request->dateRelease,
                'bands_id' => $request->bands_id,
            ]);

        return redirect()->route('album.all')->with('message', 'Update completed successfully!');
    }

    public function deleteAlbum($id)  //Elima o album pelo id
    {
        DB::table('albums')
            ->where('id', ($id))
            ->delete();
        return back()->with('message', 'Album deleted successfully!');
    }

    public function showAlbum($id)
    {
        $album = Album::find($id);
        $bands = DB::table('bands')
            ->select('id', 'name')
            ->distinct()
            ->get();

        return view('albums.show_album', compact('album', 'bands'));
    }


}
