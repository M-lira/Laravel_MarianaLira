<?php

namespace App\Http\Controllers;

use App\Models\Band;
use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BandController extends Controller
{
    private function getBands() { //vai buscar as banda à BD

        $band = DB::table('bands')->get();
        return $band;
    }

    public function allBands() {
        $band = $this->getBands();

        foreach ($band as $myBand) {
            $myBand->num_albums = Album::where('bands_id', $myBand->id)->count();
        }

        return view('bands.all_bands', compact('band'));
    }

    public function addBand() {
        $band = DB::table('bands')->get();
        return view('bands.add_band', compact('band'));
    }

    public function createBand(Request $request) { //Adiciona uma banda

        $request->validate([
            'name' => 'required|string|max:50',
            'origin' => 'required|string|max:50',
            'genre' => 'required|string|max:50',
            'yearFormation' => 'required|digits:4',
        ]);

        $photo = null;
        if ($request->has('photo')) {
            $photo = Storage::putFile('uploadedImages', $request->photo);
        }

        Band::insert([
            'name' => $request->name,
            'origin' => $request->origin,
            'genre' => $request->genre,
            'photo' => $photo,
            'yearFormation' => $request->yearFormation,
        ]);
        return redirect()->route('bands.all')->with('message', 'New band successfully created!');
    }

    public function viewBand($id) {

        $band = DB::table('bands')
            ->where('id', $id)
            ->first();
        return view('bands.view_band', compact('band'));
    }

    public function updateBand(Request $request) { //Atualiza a banda

        $request->validate([
            'name' => 'required|string|max:50',
            'origin' => 'required|string|max:50',
            'genre' => 'required|string|max:50',
            'yearFormation' => 'required|digits:4',
        ]);

        $band = Band::findOrFail($request->id);

        if ($request->hasFile('photo')) {
            $photo = Storage::putFile('uploadedImages', $request->file('photo'));
        } else {
            $photo = $band->photo;
        }

        Band::where('id', $request->id)
            ->update([
                'name' => $request->name,
                'origin' => $request->origin,
                'genre' => $request->genre,
                'photo' => $photo,
                'yearFormation' => $request->yearFormation,
            ]);
        return redirect()->route('bands.all')->with('message', 'Update completed successfully!');
    }

    public function deleteBand($id) { //elimina banda pelo id

        DB::table('bands')
            ->where('id', ($id))
            ->delete();
        return back()->with('message', 'Band deleted successfully!');
    }

    public function showBand($id) {
        $band = Band::findOrFail($id);
        $albums = Album::where('bands_id', $band->id)->get();

        // dd($albums);
        return view('bands.show_band', compact('band', 'albums'));
    }


}
