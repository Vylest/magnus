@extends('layouts.app')

@section('content')
    <div class="col-md-4 col-md-offset-1">
        {!! Form::open(['action'=>['PieceController@store', $gallery->id], 'files'=>true, 'id'=>'upload-file']) !!}
        @include('piece._form')
        {!! Form::close() !!}
    </div>
    <div class="col-md-5 uploader">
        <div class="form-group">
            <label for="">Preview</label>
            <p><img id="preview" src="#"></p>
        </div>
    </div>
@endsection