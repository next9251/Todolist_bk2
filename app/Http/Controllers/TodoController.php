<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;    


class TodoController extends Controller
{

    public function index()
    {
        $items = Todo::all();
        return response()->json([
            'data' => $items
        ], 200);
    }

    public function store(Request $request)
    {
        $item = new Todo;
        $item->todo = $request->todo;
        $item->save();
        return response()->json([
            'data' => $item
        ], 200);
    }

    public function show(Todo $todo)
    {
        $item = Todo::where('id', $todo->id)->first();
        if ($item) {
            return response()->json([
                'data' => $item
            ], 200);
        }
    }


    public function update(Request $request, Todo $todo)
    {
        $item = Todo::where('id', $todo->id)->first();
        $item->todo  = $request->todo;
        $item->save();
        if ($item) {
            return response()->json([
                'message' => 'Updated successfully',
            ], 200);
        } else {
            return response()->json([
                'message' => 'Not found',
            ], 404);
        }
    }


    public function destroy(Todo $todo)
    {
        $item = Todo::where('id', $todo->id)->delete();
        if ($item) {
            return response()->json([
                'message' => 'Deleted successfully',
            ], 200);
        } else {
            return response()->json([
                'message' => 'Not found',
            ], 404);
        }
    }
}
