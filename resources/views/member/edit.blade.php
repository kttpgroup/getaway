@extends('layouts.app')

@section('css')
{!! Html::style('css/parsley.css') !!}
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
@endsection

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10">
      <h2>Member</h2>
    </div>
    <div class="col-md-2">
      {!! Form::open(['route' => ['members.destroy', $member->id], 'method' => 'DELETE']) !!}
      {!! Form::submit('Delete', ['class'=> 'btn btn-danger btn-h1-spacing', 'style' => 'float:right']) !!}
      {!! Form::close() !!}
    </div>
    <div class="col-md-12">
      <hr>
    </div>


    <div>
      {!! Form::model($member, ['route' => ['members.update', $member->id], 'method' => 'PUT']) !!}
      <div class="content col-md-8">
        {{ Form::label('id', 'ID') }}
        {{ Form::text('id', null, ["class" => 'form-control', "disabled" =>'disabled']) }}
        {{ Form::label('name', 'ชื่อ') }}
        {{ Form::text('name', null, ["class" => 'form-control' ]) }}
        {{ Form::label('idCard', 'เลขบัตรประชาชน') }}
        {{ Form::text('idCard', null, ["class" => 'form-control' ]) }}
        {{ Form::label('tel', 'เบอร์โทรศัพท์') }}
        {{ Form::text('tel', null, ["class" => 'form-control' ]) }}
        {{ Form::label('birth', 'วันเกิด') }}
        {{ Form::text('birth', null, ["class" => 'form-control' ]) }}
        @if($user->role==2)
        {{ Form::label('point', 'แต้ม:') }}
        {{ Form::text('point', null, ["class" => 'form-control']) }}
        @else
        {{ Form::label('point', 'แต้ม:') }}
        {{ Form::text('point', null, ["class" => 'form-control', "disabled" =>'disabled' ]) }}

        @endif
        <input type="hidden" name="pointHidden" value="{{ $member->point }}">
      </div>

      <div class="col-md-4">
        <div class="well">
          <dl class="dl-horizontal">
            <dt>ระดับ</dt>
            <dd>{{ Form::select('level', array('0' => 'Normal Card', '1' => 'Star Card', '2' => 'Gold Card'), $member->level) }}</dd>
          </dl>
          <dl class="dl-horizontal">
            <dt>ระงับการให้บริการ:</dt>
            <dd>{{ Form::select('suspend', array('0' => 'ไม่ระงับ', '1' => 'ระงับ'), $member->suspend) }}</dd>
          </dl>
          <dl class="dl-horizontal">
            <dt>สมัครเมื่อ:</dt>
            <dd>{{ date('M j, Y h:ia', strtotime($member->created_at)) }}</dd>
          </dl>

          <dl class="dl-horizontal">
            <dt>แก้ไขเมื่อ:</dt>
            <dd>{{ date('M j, Y h:ia', strtotime($member->updated_at)) }}</dd>
          </dl>
          <hr>
          <div class="row">
            <div class="col-sm-6">
              {{ Form::submit('Save changes', array('class' => 'btn btn-success btn-block'))}}
            </div>
            <div class="col-sm-6">
              {!! Html::linkRoute('members.show', 'Cancle', array($member->id), array('class' => 'btn btn-danger btn-block')) !!}
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