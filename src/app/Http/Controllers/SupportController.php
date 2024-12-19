<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateSupport;
use App\Models\Support;
use Illuminate\Http\Request;
use Ramsey\Uuid\Type\Integer;

class SupportController extends Controller
{
    public function index(Support $support) {

        $supports = $support->all();

        return view('admin/supports/index', compact('supports'));
    }

    public function show(string|int $id) {

        if(!$support = Support::find($id)) {
             return back();
        }

        return view('admin/supports/show', compact('support'));

    }

    public function create() {
        return view('admin/supports/create');
    }

    public function store(StoreUpdateSupport $request) {

        $data = $request->only('subject', 'body');
        $data['status'] = 'a';

        Support::create($data);

        return response()->json(['message' => 'Registrado com sucesso!']);

        // return redirect('/supports');

    }


    public function edit(Support $support, string|int $id) {

        if(!$support = $support->where('id', $id)->first()) {
             return back();
        }

        return view('admin/supports.edit', compact('support'));

    }


    public function update(Request $request, Support $support, $id) {

        if(!$support = $support->find($id)) {
            return back();
        }

        $support->update($request->only([
            'subject',
            'body'
        ]));

        return redirect('/supports');

    }


    public function destroy(string|int $id) {

        if(!$support = Support::find($id)) {
            return back();
        }

        $support->delete();

        return redirect('/supports');

    }


}
