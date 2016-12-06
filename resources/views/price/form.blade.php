{{!$form_data=\App\СarList::getFormData() }}
<form class="form-horizontal" role="form" method="POST" action="{{url('/cars/price/get')}}">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="_mark" class="col-md-4 control-label">Марка</label>
        <div class="col-md-6">
            <select name="mark" class="form-control" id="_mark">
                @foreach($form_data['mark'] as $value)
                <option <?=($find['mark']==$value->mark?'selected':'')?> value="{{$value->mark}}">{{$value->mark}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group">
        <label for="_model" class="col-md-4 control-label">Модель</label>
        <div class="col-md-6">
            <select name="model" class="form-control" id="_model">
                @foreach($form_data['model'] as $value)
                    <option <?=($find['model']==$value->model?'selected':'')?> value="{{$value->model}}">{{$value->model}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group">
        <label for="_year" class="col-md-4 control-label">Год</label>
        <div class="col-md-6">
            <select name="year" class="form-control" id="_year">
                @foreach($form_data['year'] as $value)
                    <option <?=($find['year']==$value->year?'selected':'')?> value="{{$value->year}}">{{$value->year}}</option>
                @endforeach
            </select>
        </div>
    </div>


    <div class="form-group">
        <div class="col-md-6 col-md-offset-4">
            <button type="submit" class="btn btn-primary">
                Найти
            </button>
        </div>
    </div>
</form>
