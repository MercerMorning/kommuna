@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="w-75 row">
                @foreach($daterange as $day => $tasks)
                    <div class="bg-light p-3" style="width: 210px">
                        <form method="post" action="{{ route('weekDeals.addTaskDay') }}">
                            @csrf
                            {{ $day }}
                            <br>
                            <input type="hidden" name="date" value="{{ $day }}">
                            <input type="text" name="name">
                            <br>

                        </form>
                        <ul>
                            @foreach($tasks as $task)
                                <li>
                                    <form method="post" action="{{ route('weekDeals.addCardToTask') }}">
                                        @csrf
                                        <input name="id" type="hidden" value="{{ $task->id }}">
                                        <span> {{ $task->name }}</span>
                                        <img class="w-100" src="storage/{{ $task->archiveCard() }}">
                                        <br>
                                        <select name="achive_card_id">
                                            @foreach($cards as $card)
                                                <option value="{{ $card->id }}">{{ $card->name }}</option>
                                            @endforeach
                                        </select>
                                        <br>
                                        <input type="submit">
                                    </form>

                                </li>
                            @endforeach
                        </ul>
                    </div>
{{--                    @foreach($day->tasks as $task)--}}
{{--                        123--}}
{{--                    @endforeach--}}

                @endforeach
            </div>
            <div class="w-25">

                    @if(isset($cards) and !empty($cards))
                    <ul>
                        @foreach($cards as $card)
                            <li class="p-5">
                                <img class="w-100" src="storage/{{$card->image}}">

                            </li>
                        @endforeach

                    </ul>
                    @endif
            </div>
        </div>

    </div>
@endsection