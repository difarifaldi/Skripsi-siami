<?php

namespace Modules\KUI\Http\Controllers;

use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Modules\KUI\Entities\Instrument;
use Modules\KUI\DataTables\InstrumentDataTables;

class InstrumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(InstrumentDataTables $dataTable)
    {

        abort_if(Gate::denies('access_KUI'), 403);

        return $dataTable->render('kui::instruments.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(Gate::denies('create_KUI'), 403);
        return view('kui::instruments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        abort_if(Gate::denies('access_KUI'), 403);
        $validatedData = $request->validate([
            'no_ps' => 'required',
            'pernyataan_standar' => 'required'
        ]);
        $validatedData['penanggung_jawab'] = auth()->user()->id;
        Instrument::create($validatedData);

        toast("Instument Berhasil dibuat", 'success');

        return redirect()->route('kui.create');
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        $instrument = Instrument::with([
            'penanggungJawab',
            'auditeeUser',
            'auditorUser',
        ])
            ->find($id);

        abort_if(Gate::denies('access_KUI'), 403);

        $is_auditee = Auth::user()->roles[0]->id == 5;
        $is_auditor = Auth::user()->roles[0]->id == 4;

        return view('kui::instruments.show', compact('instrument', 'is_auditee', 'is_auditor'));
    }

    /**
     * 
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $instrument = Instrument::with([
            'penanggungJawab',
            'auditeeUser',
            'auditorUser',
        ])
            ->find($id);

        abort_if(Gate::denies('access_KUI'), 403);

        $is_auditee = Auth::user()->roles[0]->id == 5;
        $is_auditor = Auth::user()->roles[0]->id == 4;

        return view('kui::instruments.edit', compact('instrument', 'is_auditee', 'is_auditor'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {

        try {
            abort_if(Gate::denies('access_KUI'), 403);

            if (Auth::user()->roles[0]->id == 5) {
                $validatedData = $request->validate([
                    'no' => 'required|string',
                    'indikator' => 'required|string',
                    'deskripsi' => 'required|string',
                    'akar_penyebab' => 'required|string',
                    'akibat' => 'required|string'
                ]);

                $validatedData['auditee'] = auth()->user()->id;
            } else {
                $validatedData = $request->validate([
                    'rekomendasi' => 'required|string',
                    'tanggapan' => 'required|string',
                    'rencana' => 'required|string',
                    'jadwal' => 'required|date',
                    'sebutan' => 'required|string|in:positif,negatif',
                    'link' => 'required|string',
                    'status' => 'required|string',
                ]);
                $validatedData['auditor'] = auth()->user()->id;
            }

            $instrument = Instrument::findOrFail($id);
            $instrument->update($validatedData);

            toast('Instrument berhasil diperbarui!', 'success');

            return redirect()->route('kui.index');
        } catch (Exception $e) {
            dd([
                'Message' => $e->getMessage(),
                'File' => $e->getFile(),
                'Line' => $e->getLine(),
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
