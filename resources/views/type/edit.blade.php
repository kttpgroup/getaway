@extends('layouts.app')

@section('css')
{!! Html::style('css/parsley.css') !!}
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
@endsection

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10">
      <h2>type</h2>
    </div>
    <div class="col-md-2">
      {!! Form::open(['route' => ['types.destroy', $type->id], 'method' => 'DELETE']) !!}
      {!! Form::submit('Delete', ['class'=> 'btn btn-danger btn-h1-spacing', 'style' => 'float:right']) !!}
      {!! Form::close() !!}
    </div>
    <div class="col-md-12">
      <hr>
    </div>


    <div>
      {!! Form::model($type, ['route' => ['types.update', $type->id], 'method' => 'PUT']) !!}
      <div class="content col-md-8">
        {{ Form::label('id', 'ID') }}
        {{ Form::text('id', null, ["class" => 'form-control', "disabled" =>'disabled']) }}
        {{ Form::label('name', 'ชื่อชนิด') }}
        {{ Form::text('name', null, ["class" => 'form-control' ]) }}
        {{ Form::label('price', 'ราคา') }}
        {{ Form::text('price', null, ["class" => 'form-control' ]) }}
      </div>

      <div class="col-md-4">
        <div class="well">
          
         
          <div class="row">
            <div class="col-sm-6">
              {{ Form::submit('Save changes', array('class' => 'btn btn-success btn-block'))}}
            </div>
            <div class="col-sm-6">
              {!! Html::linkRoute('types.index', 'Cancle', array($type->id), array('class' => 'btn btn-danger btn-block')) !!}
            </div>

          </div>
        </div> <!-- End well -->
      </div><!-- End sidebar -->
      {!! Form::close() !!}
    </div>
  </div>
</div>

@endsection

