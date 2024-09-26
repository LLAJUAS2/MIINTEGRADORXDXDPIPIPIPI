<?php

namespace App\Http\Controllers;

use App\Models\TareaUser;
use Illuminate\Http\Request;

/**
 * Class TareaUserController
 * @package App\Http\Controllers
 */
class TareaUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tareaUsers = TareaUser::paginate(10);

        return view('tarea-user.index', compact('tareaUsers'))
            ->with('i', (request()->input('page', 1) - 1) * $tareaUsers->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tareaUsers = new TareaUser();
        return view('tarea-user.create', compact('tareaUser'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(TareaUser::$rules);

        $tareaUsers = TareaUser::create($request->all());

        return redirect()->route('tarea-users.index')
            ->with('success', 'TareaUser created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tareaUser = TareaUser::find($id);

        return view('tarea-user.show', compact('tareaUser'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tareaUser = TareaUser::find($id);

        return view('tarea-user.edit', compact('tareaUser'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  TareaUser $tareaUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TareaUser $tareaUser)
    {
        request()->validate(TareaUser::$rules);

        $tareaUser->update($request->all());

        return redirect()->route('tarea-users.index')
            ->with('success', 'TareaUser updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $tareaUser = TareaUser::find($id)->delete();

        return redirect()->route('tarea-users.index')
            ->with('success', 'TareaUser deleted successfully');
    }
}
