@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ __('Class_trans.title_page') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{ __('main_trans.Grades') }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-xl-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                    {{ __('Class_trans.add_class') }}
                </button>
                <button type="button" class="button btn-info x-small" id="button_delete_all" onclick="delete_all_function()" >
                    {{ __('Class_trans.delete_checkbox') }}
                </button>
                <br><br>
                    <form action="{{route('classroom.filter_grade')}}" method="POST">
                        @csrf
                        <select name="filter" id="" onchange="this.form.submit()">
                            @foreach ($grades as $grade)
                            <option value=" {{$grade->id}}">{{$grade->name}} </option>
                            @endforeach
                        </select>
                    </form>
                <div class="table-responsive">
                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                        style="text-align: center">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="select_all" onclick="checked_all('index1' ,this)"></th>
                                <th>#</th>
                                <th>{{ __('class_trans.Name') }}</th>
                                <th>{{ __('class_trans.Name_Grade') }}</th>
                                <th>{{ __('class_trans.Processes') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; ?>
                            @foreach ($classes as $class)
                                <tr>
                                    <?php $i++; ?>
                                    <td><input type="checkbox" class="index1" name="index1" value="{{$class->id}}"></td>
                                    <td>{{ $i }}</td>
                                    <td>{{ $class->name }}</td>
                                    <td>{{ $class->grades->name }}</td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                            data-target="#edit{{ $class->id }}"
                                            title="{{ __('Class_trans.Edit') }}"><i class="fa fa-edit"></i></button>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                            data-target="#delete{{ $class->id }}"
                                            title="{{ __('Class_trans.Delete') }}"><i
                                                class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                                <!-- edit_modal_Grade -->
                                <div class="modal fade" id="edit{{ $class->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                    id="exampleModalLabel">
                                                    {{ __('Class_trans.edit_class') }}
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- update  form -->
                                                <form action="{{ route('classroom.update', 'test') }}" method="post">
                                                    {{ method_field('patch') }}
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col">
                                                            <label for="name"
                                                                class="mr-sm-2">{{ __('Class_trans.stage_name_ar') }}
                                                                :</label>
                                                            <input id="name" type="text" name="Name"
                                                                class="form-control"
                                                                value="{{ $class->getTranslation('name', 'ar') }}">
                                                            <input id="id" type="hidden" name="id"
                                                                class="form-control" value="{{ $class->id }}">
                                                        </div>
                                                        <div class="col">
                                                            <label for="name_en"
                                                                class="mr-sm-2">{{ __('Class_trans.stage_name_en') }}
                                                                :</label>
                                                            <input type="text" class="form-control"
                                                                value="{{ $class->getTranslation('name', 'en') }}"
                                                                name="Name_en">
                                                        </div>
                                                    <div class="col-12 mt-2">
                                                        <label for="Grade_id"
                                                        class="mr-sm-2">{{ __('Class_trans.Name_Grade') }}
                                                        </label>
                                                        <select class="form-control" name="Grade_id">
                                                            {{-- <option value="{{$class->grades->id}}" >{{$class->grades->name}} </option> --}}
                                                            @foreach ($grades as $Grade)
                                                                <option value="{{ $Grade->id }}"  {{ $Grade->id == $class->grades->id ? 'selected' : '' }}>
                                                                    {{$Grade->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                    <br><br>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">{{ __('Class_trans.Close') }}</button>
                                                        <button type="submit"
                                                            class="btn btn-success">{{ __('Class_trans.submit') }}</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- delete_modal_Grade -->
                                <div class="modal fade" id="delete{{ $class->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                    id="exampleModalLabel">
                                                    {{ __('Class_trans.delete_class') }}
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('classroom.destroy', 'test') }}" method="post">
                                                    {{ method_field('Delete') }}
                                                    @csrf
                                                    {{ __('Class_trans.Warning_Grade') }}
                                                    <input id="id" type="hidden" name="id"
                                                        class="form-control" value="{{ $class->id }}">
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">{{ __('Class_trans.Close') }}</button>
                                                        <button type="submit"
                                                            class="btn btn-danger">{{ __('Class_trans.Delete') }}</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
       {{--  --}}
        <!-- add_modal_class -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"  aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                            {{ __('class_trans.add_class') }}
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class=" row mb-30" action="{{ route('classroom.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="repeater">
                                    <div data-repeater-list="List_Classes">
                                        <div data-repeater-item>
                                            <div class="row">
                                                <div class="col">
                                                    <label for="Name"
                                                        class="mr-sm-2">{{ __('class_trans.Name_class') }}
                                                        :</label>
                                                    <input class="form-control" type="text" name="Name" />
                                                </div>
                                                <div class="col">
                                                    <label for="Name"
                                                        class="mr-sm-2">{{ __('class_trans.Name_class_en') }}
                                                        :</label>
                                                    <input class="form-control" type="text"
                                                        name="Name_class_en" />
                                                </div>
                                                <div class="col">
                                                    <label for="Name_en"
                                                        class="mr-sm-2">{{ __('class_trans.Name_Grade') }}
                                                        :</label>
                                                    <div class="box">
                                                        <select class="fancyselect" name="Grade_id">
                                                            @foreach ($grades as $Grade)
                                                                <option value="{{ $Grade->id }}">
                                                                    {{ $Grade->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <label for="Name_en"
                                                        class="mr-sm-2">{{ __('class_trans.Processes') }}
                                                        :</label>
                                                    <input class="btn btn-danger btn-block" data-repeater-delete
                                                        type="button"
                                                        value="{{ __('class_trans.delete_row') }}" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-20">
                                        <div class="col-12">
                                            <input class="button" data-repeater-create type="button"
                                                value="{{ __('class_trans.add_row') }}" />
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">{{ __('Class_trans.Close') }}</button>
                                        <button type="submit"
                                            class="btn btn-success">{{ __('Class_trans.submit') }}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{--  --}}
        <div class="modal fade" id="delete_all" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    {{ __('Class_trans.delete_class') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('classroom.delete_all') }}" method="POST">
                {{ csrf_field() }}
                <div class="modal-body">
                    {{ __('Class_trans.Warning_Grade') }}
                    <input class="text" type="hidden" id="delete_all_id" name="delete_all_id" value=''>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{ __('Class_trans.Close') }}</button>
                    <button type="submit" class="btn btn-danger">{{ __('Class_trans.submit') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')
<script>
    function checked_all(index1 ,ele){
        var items= document.getElementsByClassName(index1);
        length= items.length;
        if (ele.checked){
            for(var i=0 ;i<length ;i++){
                items[i].checked=true;
            }
        }else{
            for(var i=0 ;i<length ;i++){
                items[i].checked=false;
            }
        }
    }
    function delete_all_function(){
        // alert('j');
        var selected = Array();
        $("#datatable input[type=checkbox]:checked").each(function(){
            selected.push(this.value);
        });
        if(selected.length>0){
            $('#delete_all').modal('show')
            $('input[id="delete_all_id"]').val(selected);
        }
    }

</script>
@toastr_js
@toastr_render
@endsection
