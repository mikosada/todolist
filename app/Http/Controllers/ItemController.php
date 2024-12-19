<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Support\Carbon;

class ItemController extends Controller
{
    public function index()
    {
        return Item::orderBy('created_at', 'DESC')->get();
    }

    public function store(Request $request)
    {
        $data = new Item;
        $data->title = $request->title;
        $data->description = $request->description;
        $data->save();

        return $data;
    }

    public function update(Request $request, $id)
    {
        $request->validate(['completed' => 'required|boolean']);

        $item = Item::find($id);
        
        if ($item) {
            $item->completed = $request->completed;
            $item->completed_at = $request->completed ? Carbon::now() : null;
            $item->save();

            return response()->json($item, 200);
        }

        return "Item not found";
    }

    public function updateTask(Request $request, $id)
    {
        $item = Item::find($id);
        
        if ($item) {
            $item->title = $request->title;
            $item->description = $request->description;
            $item->save();
            
            return response()->json($item, 200);
        }

        return "Item not found";
    }

    public function destroy($id)
    {
        $item = Item::find($id);

        if($item) {
            $item->delete();
            return 'Item deleted';
        }

        return 'Item not found';
    } 
}
