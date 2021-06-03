<?php

namespace App\Http\Controllers;

use App\Models\AchiveCard;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WeekDealsController extends Controller
{
    public function index()
    {

        $monday = Carbon::now()->startOfWeek();
        $sunday = Carbon::now()->endOfWeek();
        $daterange = new \DatePeriod(
            new \DateTime($monday),
            new \DateInterval('P1D'),
            new \DateTime($sunday)
        );

        $daterange = collect($daterange);

        $daterange = $daterange->mapWithKeys(function ($item) {
            $date = $item->format('Y-m-d');
            return [
                $date => Task::query()->where('date', '=', $date)->get()
            ];
        });

        $cards = AchiveCard::all();
        return view('week',  ['cards' => $cards, 'daterange' => $daterange]);
    }

    public function addTaskDay(Request $request)
    {
        $fields = collect($request->all());
        Task::query()->create($fields->except('_token')->toArray());
        return back();
    }

    public function addCardToTaskFromWeek(Request $request)
    {
        Task::query()
            ->find($request->input('id'))
            ->fill(['achive_card_id' => $request->input('achive_card_id')])
            ->save();

        return back();
    }
}
