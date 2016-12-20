{{!$form_data=\App\СarList::getFormData() }}
<form class="form-horizontal" id="_search" role="form" method="POST" action="{{url('/cars/price/get')}}">
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

<script>
    var scope={};

    var fill_select=function (data,field,object,callback) {
        object.html('');
        $.each(data, function(key,item) {
            object.append($("<option />").val(item[field]).text(item[field]));
        });
        if (callback) {
            callback(data);
        }
    };

    (function init () {
        window.onload=function () {
            $('#_mark').change(function () {
                var obj=$(this);
                scope.mark=obj.val();
                $.post( "/api/get/model",scope, function( data ) {
                    var model=$('#_model');
                    fill_select(data,'model',model,function () {
                        model.trigger('change');
                    });
                });
            });
            $('#_model').change(function () {
                var obj=$(this);
                scope.model=obj.val();
                $.post( "/api/get/year",scope, function( data ) {
                    fill_select(data,'year',$('#_year'));
                });
            });
            $('#_search').submit(function (e) {
                $.post( "/api/find/car",$( this ).serializeArray(),function (data) {
                   if (data && !data.error){
                       var success = $("#_result_success");
                       $("#_result_error").hide();
                       success.find('tbody').html('')
                               .append($("<tr/>")
                                       .append($("<td/>").text(data.car_name.mark))
                                       .append($("<td/>").text(data.car_name.model))
                                       .append($("<td/>").text(data.car_name.year))
                                       .append($("<td/>").text(data.price)));
                       success.show();
                   }
                   else {
                       $("#_result_success").hide();
                       $("#_result_error").show();
                   }
                });
                return false;
            });
        };
    })();

</script>
