@extends('layouts.app')

@section('css')
    {!! Html::style('css/parsley.css') !!}
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
@endsection

@section('content')
<div class="container">
<div class="row">
<h2>เพิ่มสมาชิก</h2>
  <hr>
  
  <div class="row col-md-6 col-md-offset-3 well">
  {!! Form::open(array('route' => 'members.store', 'data-parsley-validate' => '')) !!}
    {{ Form::label('name', 'ชื่อ:')}}
    {{ Form::text('name', null, array('class' => 'form-control', 'required' => '')) }}
    {{ Form::label('tel', 'เบอร์โทรศัพท์:')}}
    {{ Form::text('tel', null, array('class' => 'form-control', 'required' => '')) }}

    {{ Form::label('idCard', 'บัตรประชาชน:')}}
    {{ Form::text('idCard', null, array('class' => 'form-control', 'required' => '')) }}
    
    {{ Form::label('birth', 'วันเกิด:') }}
    {!! Form::text('birth', '', array('id' => 'datepicker', 'class' => 'form-control')) !!}
    <div class="row">
      <div class="col-sm-6">
        {{ Form::submit('Submit', array('class' => 'btn btn-success btn-lg btn-block', 'style' => 'margin-top: 20px')) }}
      </div>
      <div class="col-sm-6">
        <a href="/members" class="btn btn-danger btn-lg btn-block" style="margin-top:20px">Cancle</a>
      </div>
    </div>
  {!! Form::close() !!}
  </div>
  </div>
</div>
    
@endsection

@section('script')
    {!! Html::script('js/parsley.js') !!}
    
    <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
    <script>
    var j = jQuery.noConflict();
    j(function() {
    j( "#datepicker" ).datepicker();
    
    });
    </script>
@endsection