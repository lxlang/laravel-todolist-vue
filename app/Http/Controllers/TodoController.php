<?php

namespace App\Http\Controllers;

use App\Todo;
use Auth;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class TodoController extends Controller
{
    /**
     * Display Frontend for Todos
     * @return View
     */
    public function list()
    {
        return view('user.dashboard')
        ->with('todos', Auth::user()->todos);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return response()->json(Auth::user()->todos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  Request  $request
     * @return Response
     */
    public function create()
    {
        //TODO:
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     * @throws ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $todo = Auth::user()->todos()->create([
            'name' => $request->get('name'),
        ]);

        return response()->json($todo->fresh());
    }

    /**
     * Display the specified resource.
     *
     * @param  Todo  $todo
     * @return Response
     */
    public function show(Todo $todo)
    {
        return response()->json(Auth::user()->todos()->find($todo->id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Todo  $todo
     * @return Response
     */
    public function edit(Todo $todo)
    {
        //TODO:
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Todo  $todo
     * @return Response
     * @throws ValidationException
     */
    public function update(Request $request, Todo $todo)
    {
        $this->validate($request, [
            'name' => 'required',
            'done' => 'required|boolean',
        ]);

        $todo->update($request->only(['name', 'done']));

        return response()->json($todo);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Todo  $todo
     * @return Response
     * @throws Exception
     */
    public function destroy(Todo $todo)
    {
        $todo->delete();
        return response()->json($todo);
    }
}
