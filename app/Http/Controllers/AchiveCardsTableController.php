<?php

namespace App\Http\Controllers;

use App\Models\AchiveCard;
use App\Models\Task;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use stdClass;

class AchiveCardsTableController extends Controller
{
    public function index()
    {
        $cards = AchiveCard::all();

        $cards = $cards->mapWithKeys(function ($item) {
            $card = new stdClass();
            $card->name = $item->name;
            $card->image = $item->image;
            $card->count = Task::query()->where('achive_card_id', $item->id)->count();
            return [$card];
        });
        return view('welcome', ['cards' => $cards]);
    }

    public function addItem(Request $request)
    {
        $name = $request->input('name');
        $image = $request->file('image');
        $uniqueFileName = Str::uuid() . $image->getClientOriginalName() . $image->getExtension();
        $image->storeAs('/public', $uniqueFileName);
        AchiveCard::query()->create([
            'name' => $name,
            'image' => $uniqueFileName,
        ]);
//        dd(storage_path($image->getClientOriginalName()));
        return redirect()->route('home');
    }
}
