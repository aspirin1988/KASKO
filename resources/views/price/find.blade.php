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
                <table class="table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Марка</th>
                        <th>Модкль</th>
                        <th>Год</th>
                        <th>Цена</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>{{$data->car_name->ID}}</td>
                        <td>{{$data->car_name->mark}}</td>
                        <td>{{$data->car_name->model}}</td>
                        <td>{{$data->car_name->year}}</td>
                        <td>{{$data->price}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
