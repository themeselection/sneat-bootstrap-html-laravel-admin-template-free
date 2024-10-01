<?php

namespace App\Http\Controllers\tables;

use App\Http\Controllers\Controller;
use App\Models\Chopper;
use Illuminate\Http\Request;

class ChopperTable extends Controller
{
  public function index(Request $request)
  {
    $plantGroup = $request->query('plantGroup');

    $choppers = Chopper::query()
      ->when($plantGroup, function ($query, $plantGroup) {
        return $query->where('PlantGroup', $plantGroup);
      })
      ->get();

    $plantGroups = Chopper::query()
      ->select('PlantGroup')
      ->distinct()
      ->get();

    return view(
      'content.tables.table-chopper',
      compact('choppers', 'plantGroups')
    );
  }

  public function show(Chopper $chopper)
  {

    // jika user tidak mengirim kan chopper pada url
    if (!$chopper) {
      return redirect()->route('tables-chopper');
    }

    // cari chopper berdasarkan id, jika tidak ada maka 404
    Chopper::query()
      ->findOrFail($chopper->id);

    return view('content.tables.table-chopper-show', compact('chopper'));
  }


  public function update(Request $request, Chopper $chopper)
  {
    // jika user tidak mengirim kan chopper pada url
    if (!$chopper) {
      return redirect()->route('tables-chopper');
    }


    // validasi user input
    $validated = $request->validate([
      'PlantGroup' => 'required',
      'TanggalPengamatan' => 'required',
      'Lokasi' => 'required',
      'LuasAktif' => 'required',
      'Sat' => 'required',
      'ExsTanaman' => 'required',
      '%_Tanaman_Hancur' => 'required',
      '%_Bonggol_Tercacah' => 'required',
      '%_Aplikasi_Rapat' => 'required',
      'Total_(%)' => 'required',
    ]);

    // update chopper
    $chopper->update([
      'PlantGroup' => $validated['PlantGroup'],
      'TanggalPengamatan' => $validated['TanggalPengamatan'],
      'Lokasi' => $validated['Lokasi'],
      'LuasAktif' => $validated['LuasAktif'],
      'Sat' => $validated['Sat'],
      'ExsTanaman' => $validated['ExsTanaman'],
      '% Tanaman Hancur' => $validated['%_Tanaman_Hancur'],
      '% Bonggol Tercacah' => $validated['%_Bonggol_Tercacah'],
      '% Aplikasi Rapat' => $validated['%_Aplikasi_Rapat'],
      'Total (%)' => $validated['Total_(%)'],
    ]);

    // cek apakah chopper berhasil di update
    if ($chopper) {
      // kembali ke halaman table chopper
      return redirect()->route('tables-chopper')->with('success', 'Chopper berhasil di update');
    }

    // jika gagal update, maka kembali ke halaman edit chopper
    return redirect()->back()->withInput()->with('error', 'Chopper gagal di update');
  }

  public function destroy(Chopper $chopper)
  {
    // jika user tidak mengirim kan chopper pada url
    if (!$chopper) {
      return redirect()->route('tables-chopper');
    }

    // cari chopper berdasarkan id, jika tidak ada maka 404
    Chopper::query()
      ->findOrFail($chopper->id);

    // hapus chopper
    $chopper->delete();

    // kembali ke halaman table chopper
    return redirect()->route('tables-chopper')->with('success', 'Chopper berhasil di hapus');
  }
}
