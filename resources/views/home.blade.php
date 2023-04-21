@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        @foreach ($films as $film)
            <div class="col-3 mb-4">
                <div class="card">
                    <div class="card-header">
                        {{ $film->title }} 
                    </div>
                    <div class="card-body">

                        <img src="{{ Storage::url('upload/'.$film->image) }}" class="img-thumbnail" style="height: 156px;min-width: 100%;"><br>

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
                        @endswitch
                        <br>
                        Цена: ${{ $film->price }}

                    </div>

                    <div class="card-footer px-2">

                        @auth
                            @if(Auth::user()->is_admin == 1)
                                <a href="{{ url('filmedit/'.$film->id) }}" class="btn btn-danger mb-1">Редактировать</a>
                                <a href="{{ url('filmdelete/'.$film->id)}}" class="btn btn-danger mb-1">Удалить</a>
                                <!--<form id="confirm" action="{{ url('filmdelete/'.$film->id) }}" method="get" style="display:inline-block">
                                    @csrf
                                    <button class="btn btn-danger mb-1" type="submit">Удалить</button>
                                </form>-->
                                <script>
                                    //function confirm(event) { 
                                    //    event.preventDefault()
                                    //    if (confirm('Удалить сеанс?')) {
                                    //        document.getElementById('confirm').submit()
                                    //    }
                                    //}
                                    //не робит хз почему
                                </script>
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
                                <a href="{{ url('film/'.$film->id) }}" class="btn btn-danger mb-1">...</a>
                            @endif

                                

                        @else
                            <button type="submit" class="btn btn-danger mb-1" disabled>Купить билет</button>
                        @endauth

                    </div>
                </div>
            </div>
        @endforeach
    </div>

    @guest
        <div class="alert alert-danger mb-4" role="alert">
            Войдите в аккаунт чтобы купить билет
        </div>
    @endguest

</div>
@endsection
