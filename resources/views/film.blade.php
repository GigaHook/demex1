@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                
                <div class="card-header">
                    {{ $film->title }}
                </div>
                <div class="card-body row">

                    <div class="col-6">
                        <img src="{{ Storage::url($film->image) }}" class="img-thumbnail w-100">
                    </div>

                    <div class="col-6">
                        Рейтинг:
                        @switch($film->censorship)
                            @case('0+')
                                <span class="badge badge-success">{{ $film->censorship }}</span>
                                @break
                            @case('6+')
                                <span class="badge badge-primary">{{ $film->censorship }}</span>
                                @break
                            @case('12+')
                                <span class="badge badge-info">{{ $film->censorship }}</span>
                                @break
                            @case('16+')
                                <span class="badge badge-warning">{{ $film->censorship }}</span>
                                @break
                            @case('18+')
                                <span class="badge badge-danger">{{ $film->censorship }}</span>
                                @break
                            @default
                                <span class="badge badge-secondary">Без возростного рейтинга</span>
                        @endswitch <br>

                        Жанр:
                        @switch($film->genre)
                            @case('action')
                                <b>Боевик</b>
                                @break
                            @case('comedy')
                                <b>Комедия</b>
                                @break
                            @case('horror')
                                <b>Ужасы</b>
                                @break
                            @case('fantasy')
                                <b>Фэнтези</b>
                                @break
                            @case('detective')
                                <b>Детектив</b>
                                @break
                            @default
                                <b>Для общего развития</b>
                        @endswitch <br>

                        Начало сеанса: <b>{{ $film->premiereDate}}</b><br>
                        Цена: ${{ $film->price }}<br><br>

                        @auth
                            @if(Auth::user()->is_admin == 1)

                                <form action="{{ route('cartAddOrIncrease') }}" method="post" style="display:inline-block"><!--TODO edit/delete film-->
                                    @csrf
                                    <input type="text" name="id" value="{{ $film->id }}" hidden>
                                    <button type="submit" class="btn btn-danger mb-1">Удалить</button>
                                </form>

                            @else

                                <form action="{{ route('cartAddOrIncrease') }}" method="post" style="display:inline-block">
                                    @csrf
                                    <input type="text" name="id" value="{{ $film->id }}" hidden>
                                    @if($film->inCart())
                                        <div class="d-inline alert alert-secondary p-2 mr-2" role="alert">
                                            В корзине
                                        </div>
                                        <button type="submit" class="btn btn-danger mb-1">Добавить ещё</button>
                                    @else
                                        <button type="submit" class="btn btn-danger mb-1">Купить билет</button>
                                    @endif
                                </form>
                            @endif

                            
                        @else
                            <button type="submit" class="btn btn-danger mb-1" disabled>Купить билет</button>
                        @endauth

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
