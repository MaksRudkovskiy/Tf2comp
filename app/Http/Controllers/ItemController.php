<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Character;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function item(Request $request)
    {
        $characterId = $request->input('character');
        $selectedItemId = $request->input('selected_item');

        $items = Item::when($characterId, function($query) use ($characterId) {
            return $query->whereHas('characters', function($q) use ($characterId) {
                $q->where('characters_id', $characterId);
            });
        })->paginate(16);

        $selectedItem = $selectedItemId ? Item::find($selectedItemId) : $items->first();
        $characters = Character::all();

        return view('pages.item', compact('items', 'characters', 'selectedItem'));
    }
}
