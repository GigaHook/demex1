@extends('layouts.app')
@section('content')
<div class="container">
    <h3>Управление сеансами</h3>
    <div class="row justify-content-center">
        <div class="col-6">
            <div class="card">
                <div class="card-header">Редактировать сеанс</div>
                <div class="card-body">
                    <form action="{{ route('updateFilm') }}" enctype="multipart/form-data" method="POST">

                        @csrf
                        
                        <input type="text" name="id" value="{{ $film->id }}" hidden>

                        <label for="title">Название</label>
                        <input id="title" name="title" type="text" class="form-control mb-4" value="{{ $film->title }}">
                        
                        <label for="image">Изображение</label>
                        <input id="image" name="image" type="file" class="form-control mb-4">
                        
                        <label for="price">Цена</label>
                        <input id="price" name="price" type="number" class="form-control mb-4" value="{{ $film->price }}">

                        <label for="censorship">Возрастное ограничение</label>
                        <select name="censorship" id="censorship" class="form-select mb-4" value="{{ $film->censorship }}">
                            <option value="0+">0+</option>
                            <option value="6+">6+</option>
                            <option value="12+">12+</option>
                            <option value="16+">16+</option>
                            <option value="18+">18+</option>
                        </select>

                        <label for="genre">Жанр</label>
                        <select name="genre" id="genre" class="form-select mb-4" value="{{ $film->genre }}">
                            <option value="action">Боевик</option>
                            <option value="comedy">Комедия</option>
                            <option value="horror">Ужасы</option>
                            <option value="fantasy">Фэнтези</option>
                            <option value="detective">Детектив</option>
                        </select>

                        <label for="premiereDate">Дата показа</label>
                        <input id="premiereDate" name="premiereDate" type="datetime-local" class="form-control mb-4" required value="{{ $film->premiereDate }}">

                        <button type="submit" class="btn btn-danger">Изменить</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection