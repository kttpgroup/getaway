@extends('layouts.app')

@section('css')
{!! Html::style('css/parsley.css') !!}
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
@endsection

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10">
      <h2>Card</h2>
    </div>
    <div class="col-md-2">
      {!! Form::open(['route' => ['cards.destroy', $card->id], 'method' => 'DELETE']) !!}
      {!! Form::submit('Delete', ['class'=> 'btn btn-danger btn-h1-spacing', 'style' => 'float:right']) !!}
      {!! Form::close() !!}
    </div>
    <div class="col-md-12">
      <hr>
    </div>


    <div>
      {!! Form::model($card, ['route' => ['cards.update', $card->id], 'method' => 'PUT']) !!}
      <div class="content col-md-8">
        {{ Form::label('id', 'ID') }}
        {{ Form::text('id', null, ["class" => 'form-control', "disabled" =>'disabled']) }}
        {{ Form::label('name', 'ชื่อบัตร') }}
        {{ Form::text('name', null, ["class" => 'form-control' ]) }}
        {{ Form::label('idNumber', 'รหัสบัตร') }}
        {{ Form::text('idNumber', null, ["class" => 'form-control' ]) }}
        @if($user->role==2)
        {{ Form::label('type', 'ชนิดบัตร:') }}<br>
        <select name="type" id="type">
          <option value="{{ $card->type->id }}"> 
            {{$card->type->name}}-{{$card->type->price}}
          </option>
          @foreach($types as $type)
          <option value="{{ $type->id }}"> {{$type->name}}-{{$type->price}} </option>
          @endforeach
        </select>
        @else
        {{ Form::label('type', 'ชนิดบัตร:') }}<br>
        <select name="type" id="type"><br>
          <option value="{{ $card->type->id }}"> 
            {{$card->type->name}}-{{$card->type->price}} 
          </option>
        </select>
        @endif
      </div>

      <div class="col-md-4">
        <div class="well">
          
          <dl class="dl-horizontal">
            <dt>ระงับการให้บริการ:</dt>
            <dd>{{ Form::select('suspend', array('0' => 'ไม่ระงับ', '1' => 'ระงับ'), $card->suspend) }}</dd>
          </dl>
          <dl class="dl-horizontal">
            <dt>สมัครเมื่อ:</dt>
            <dd>{{ date('M j, Y h:ia', strtotime($card->created_at)) }}</dd>
          </dl>

          <dl class="dl-horizontal">
            <dt>แก้ไขเมื่อ:</dt>
            <dd>{{ date('M j, Y h:ia', strtotime($card->updated_at)) }}</dd>
          </dl>
          <hr>
          <div class="row">
            <div class="col-sm-6">
              {{ Form::submit('Save changes', array('class' => 'btn btn-success btn-block'))}}
            </div>
            <div class="col-sm-6">
              {!! Html::linkRoute('cards.show', 'Cancle', array($card->id), array('class' => 'btn btn-danger btn-block')) !!}
            </div>

          </div>
        </div> <!-- End well -->
      </div><!-- End sidebar -->
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