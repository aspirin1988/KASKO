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
                <h2 id="_result_error" style="display: none">К сожалению, по Вашему запросу ничего не найдено.</h2>
                <table class="table" id="_result_success" style="display: none">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Марка</th>
                        <th>Модель</th>
                        <th>Год</th>
                        <th>Цена</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
