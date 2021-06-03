@extends('layouts.app')
@section('content')
    <div class="container">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Название</th>
                <th scope="col">Изображение</th>
                <th scope="col">Количество</th>
            </tr>
            </thead>
            <tbody>
            @if(isset($cards) and !empty($cards))
                @foreach($cards as $card)
                    <tr>
                        <td>{{ $card->name }}</td>
                        <td>
                            <img class="w-25" src="storage/{{$card->image}}">
                        </td>
                        <td>{{$card->count}}</td>
                    </tr>
                @endforeach
            @endif


            </tbody>
        </table>
        <form method="post" action="{{ route('achiveCardsTable.addItem') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="text">Название</label>
                <input name="name" type="text" class="form-control" id="name" required>
            </div>
            <input name="image" type="file" id="image" required>
            <input type="submit">
        </form>
        <a href="{{ route('weekDeals.index') }}">Далее</a>
    </div>


@endsection