
@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{trans('main_trans.add_student')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{trans('main_trans.add_parents')}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
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
                <form method="post"  action="{{ route('parents.store') }}" autocomplete="off" enctype="multipart/form-data">
                    @csrf
                    <div class="container " style="text-align:center ;background-color:gray ;padding:10px 5px;">
                        <h2>
                            Father Form
                        </h2>
                    </div>
                        <div class="col-md-12">
                            <br>
                            <div class="form-row">
                                <div class="col">
                                    <label for="title">{{trans('Parent_trans.Email')}}</label>
                                    <input type="email" name="Email"  class="form-control">
                                    @error('Email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="title">{{trans('Parent_trans.Password')}}</label>
                                    <input type="password" name="Password" class="form-control" >
                                    @error('Password')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
            
                            <div class="form-row">
                                <div class="col">
                                    <label for="title">{{trans('Parent_trans.Name_Father')}}</label>
                                    <input type="text" name="Name_Father" class="form-control" >
                                    @error('Name_Father')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="title">{{trans('Parent_trans.Name_Father_en')}}</label>
                                    <input type="text" name="Name_Father_en" class="form-control" >
                                    @error('Name_Father_en')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
            
                            <div class="form-row">
                                <div class="col-md-3">
                                    <label for="title">{{trans('Parent_trans.Job_Father')}}</label>
                                    <input type="text" name="Job_Father" class="form-control">
                                    @error('Job_Father')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label for="title">{{trans('Parent_trans.Job_Father_en')}}</label>
                                    <input type="text" name="Job_Father_en" class="form-control">
                                    @error('Job_Father_en')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
            
                                <div class="col">
                                    <label for="title">{{trans('Parent_trans.National_ID_Father')}}</label>
                                    <input type="text" name="National_ID_Father" class="form-control">
                                    @error('National_ID_Father')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="title">{{trans('Parent_trans.Passport_ID_Father')}}</label>
                                    <input type="text" name="Passport_ID_Father" class="form-control">
                                    @error('Passport_ID_Father')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
            
                                <div class="col">
                                    <label for="title">{{trans('Parent_trans.Phone_Father')}}</label>
                                    <input type="text" name="Phone_Father" class="form-control">
                                    @error('Phone_Father')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
            
                            </div>
            
            
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputCity">{{trans('Parent_trans.Nationality_Father_id')}}</label>
                                    <select class="custom-select my-1 mr-sm-2" name="Nationality_Father_id">
                                        <option selected>{{trans('Parent_trans.Choose')}}...</option>
                                        @foreach($Nationalities as $National)
                                            <option value="{{$National->id}}">{{$National->Name}}</option>
                                        @endforeach
                                    </select>
                                    @error('Nationality_Father_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col">
                                    <label for="inputState">{{trans('Parent_trans.Blood_Type_Father_id')}}</label>
                                    <select class="custom-select my-1 mr-sm-2" name="Blood_Type_Father_id">
                                        <option selected>{{trans('Parent_trans.Choose')}}...</option>
                                        @foreach($Type_Bloods as $Type_Blood)
                                            <option value="{{$Type_Blood->id}}">{{$Type_Blood->Name}}</option>
                                        @endforeach
                                    </select>
                                    @error('Blood_Type_Father_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
            
            
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">{{trans('Parent_trans.Address_Father')}}</label>
                                <textarea class="form-control" name="Address_Father" id="exampleFormControlTextarea1" rows="4"></textarea>
                                @error('Address_Father')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                       
                        </div>
                    <div class="container " style="text-align:center ;background-color:gray ;padding:10px 5px;">
                        <h2>
                            Mother Form
                        </h2>
                    </div>
                    <div class="col-xs-12">
                        <div class="col-md-12">
                            <br>
                            <div class="form-row">
                                <div class="col">
                                    <label for="title">{{trans('Parent_trans.Email')}}</label>
                                    <input type="email" name="Email"  class="form-control">
                                    @error('Email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="title">{{trans('Parent_trans.Password')}}</label>
                                    <input type="password" name="Password" class="form-control" >
                                    @error('Password')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
            
                            <div class="form-row">
                                <div class="col">
                                    <label for="title">{{trans('Parent_trans.Name_Father')}}</label>
                                    <input type="text" name="Name_Father" class="form-control" >
                                    @error('Name_Father')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="title">{{trans('Parent_trans.Name_Father_en')}}</label>
                                    <input type="text" name="Name_Father_en" class="form-control" >
                                    @error('Name_Father_en')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
            
                            <div class="form-row">
                                <div class="col-md-3">
                                    <label for="title">{{trans('Parent_trans.Job_Father')}}</label>
                                    <input type="text" name="Job_Father" class="form-control">
                                    @error('Job_Father')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label for="title">{{trans('Parent_trans.Job_Father_en')}}</label>
                                    <input type="text" name="Job_Father_en" class="form-control">
                                    @error('Job_Father_en')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
            
                                <div class="col">
                                    <label for="title">{{trans('Parent_trans.National_ID_Father')}}</label>
                                    <input type="text" name="National_ID_Father" class="form-control">
                                    @error('National_ID_Father')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="title">{{trans('Parent_trans.Passport_ID_Father')}}</label>
                                    <input type="text" name="Passport_ID_Father" class="form-control">
                                    @error('Passport_ID_Father')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
            
                                <div class="col">
                                    <label for="title">{{trans('Parent_trans.Phone_Father')}}</label>
                                    <input type="text" name="Phone_Father" class="form-control">
                                    @error('Phone_Father')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
            
                            </div>
            
            
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputCity">{{trans('Parent_trans.Nationality_Father_id')}}</label>
                                    <select class="custom-select my-1 mr-sm-2" name="Nationality_Father_id">
                                        <option selected>{{trans('Parent_trans.Choose')}}...</option>
                                        @foreach($Nationalities as $National)
                                            <option value="{{$National->id}}">{{$National->Name}}</option>
                                        @endforeach
                                    </select>
                                    @error('Nationality_Father_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group col">
                                    <label for="inputState">{{trans('Parent_trans.Blood_Type_Father_id')}}</label>
                                    <select class="custom-select my-1 mr-sm-2" name="Blood_Type_Father_id">
                                        <option selected>{{trans('Parent_trans.Choose')}}...</option>
                                        @foreach($Type_Bloods as $Type_Blood)
                                            <option value="{{$Type_Blood->id}}">{{$Type_Blood->Name}}</option>
                                        @endforeach
                                    </select>
                                    @error('Blood_Type_Father_id')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                            </div>
            
            
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">{{trans('Parent_trans.Address_Father')}}</label>
                                <textarea class="form-control" name="Address_Father" id="exampleFormControlTextarea1" rows="4"></textarea>
                                @error('Address_Father')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
             
                        </div>
                    </div>
                    <div class="container " style="text-align:center ;background-color:gray ;padding:10px 5px;">
                        <h2>
                            Attachements Form
                        </h2>
                    </div>
                    <div class="col-md-12 mt-4">
                        <div class="form-group">
                            <label for="red">attachements</label>
                            <input type="file" wire:model="photos" accept="image/*" multiple >
                        </div>
                    </div>
                    <div class="container " style="text-align:center;">
                            <button class="btn btn-success   " style="width: 100%" type="submit">{{trans('Students_trans.submit')}}</button>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')
    @toastr_js
    @toastr_render
    <script>
        $(document).ready(function () {
            $('select[name="Grade_id"]').on('change', function () {
                var Grade_id = $(this).val();
                console.log(Grade_id);
                
                if (Grade_id) {
                    $.ajax({
                        url: "{{ URL::to('Get_classrooms') }}/" + Grade_id,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            console.log(data);
                            
                            $('select[name="Classroom_id"]').empty();
                            $('select[name="Classroom_id"]').append('<option selected disabled >{{trans('Parent_trans.Choose')}}...</option>');
                            $.each(data, function (key, value) {
                                $('select[name="Classroom_id"]').append('<option value="' + key + '">' + value + '</option>');
                            });

                        },
                        error :function(){
                            console.log('error ocurrce');
                            
                        }
                    });
                }

                else {
                    console.log('AJAX load did not work');
                }
            });
        });
    </script>
    

    <script>
        $(document).ready(function () {
            $('select[name="Classroom_id"]').on('change', function () {
                var Classroom_id = $(this).val();
                if (Classroom_id) {
                    $.ajax({
                        url: "{{ URL::to('Get_Sections') }}/" + Classroom_id,
                        type: "GET",
                        dataType: "json",
                        success: function (data) {
                            $('select[name="section_id"]').empty();
                            $.each(data, function (key, value) {
                                $('select[name="section_id"]').append('<option value="' + key + '">' + value + '</option>');
                            });

                        },
                    });
                }

                else {
                    console.log('AJAX load did not work');
                }
            });
        });
    </script>
@endsection
