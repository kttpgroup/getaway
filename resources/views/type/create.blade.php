@extends('layouts.app')

@section('css')
    {!! Html::style('css/parsley.css') !!}
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
@endsection

@section('content')
<div class="container">
<div class="row">
<h2>เพิ่มบัตรสมาชิก</h2>
  <hr>
  
  <div class="row col-md-6 col-md-offset-3 well">
  {!! Form::open(array('route' => 'types.store', 'data-parsley-validate' => '')) !!}
    {{ Form::label('name', 'ชื่อชนิด:')}}
    {{ Form::text('name', null, array('class' => 'form-control', 'required' => '')) }}
    {{ Form::label('price', 'ราคา:')}}
    {{ Form::text('price', null, array('class' => 'form-control', 'required' => '')) }}


    <div class="row">
      <div class="col-sm-6">
        {{ Form::submit('Submit', array('class' => 'btn btn-success btn-lg btn-block', 'style' => 'margin-top: 20px')) }}
      </div>
      <div class="col-sm-6">
        <a href="/types" class="btn btn-danger btn-lg btn-block" style="margin-top:20px">Cancle</a>
      </div>
    </div>
  {!! Form::close() !!}
  </div>
  </div>
</div>
    
@endsection

@section('script')
    {!! Html::script('js/parsley.js') !!}
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
    <script>
    $(function() {
    $( "#datepicker" ).datepicker();
    
    });
    </script>
@endsection