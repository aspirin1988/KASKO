@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <div class="panel panel-default">
                    <div class="panel-heading">Фотрма для проверки</div>
                    <div class="panel-body">
                        @include('price.form')
                    </div>
                </div>
                <h2>К сожалению, по Вашему запросу ничего не найдено.</h2>
            </div>
        </div>
    </div>
@endsection
