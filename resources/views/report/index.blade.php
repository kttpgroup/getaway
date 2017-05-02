@extends('layouts.app')
@section('css')
    {!! Html::style('css/parsley.css') !!}
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
@endsection
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10">
			<h2>Report</h2>
		</div>

	</div>

	<div class="row">
		<div class="col-md-6">
			<div class="jumbotron">
				<h3 style="text-align: center;">เงินคลัง</h3>
				<hr>
				<table>
					<tr>
						<td width="70%;"><h4>Invoice</h4></td>
						<td style=""> {{ $rentsN->count()+$rentsC->count() }} รายการ</td>
					</tr>
					<tr>
						<td><h4>Money</h4></td>
						<td>{{ $totalG+$totalA }} ฿</td>
					</tr>
				</table>



			</div> <!-- ./End jumbotron -->
		</div> <!-- ./End col 6 -->
		<div class="col-md-6">
			<div class="jumbotron">
				<h3 style="text-align: center;">การบัญชี</h3>
				<hr>
				<table>
					<tr>
						<td width="70%;"><h4>GetAway</h4></td>
						<td style="">{{ $totalG }} ฿</td>
					</tr>
					<tr>
						<td><h4>ABIG</h4></td>
						<td>{{ $totalA }} ฿</td>
					</tr>
				</table>

			</div> <!-- ./End jumbotron -->
		</div> <!-- ./End col 6 -->
	</div>
	<div class="row">
		<div class="col-md-6">
			<div class="jumbotron">
				<h3 style="text-align: center;">ตรวจยอดตามวัน</h3>
				<hr>
				{!! Form::open(array('route' => 'reports.show', 'data-parsley-validate' => '', 'method' => 'get')) !!}
				{{ Form::label('from', 'เริ่มต้น:')}}
				{!! Form::text('from', '', array('id' => 'datepicker1', 'class' => 'form-control')) !!}
				{{ Form::label('end', 'สิ้นสุด:')}}
				{!! Form::text('end', '', array('id' => 'datepicker2', 'class' => 'form-control')) !!}
				
					
						{{ Form::submit('ตรวจสอบ', array('class' => 'btn btn-success btn-lg', 'style' => 'margin-top: 20px')) }}
					
				
				{!! Form::close() !!}
			</div>
		</div>
		<div class="col-md-6">
			<div class="jumbotron">
				<h3 style="text-align: center;">ตรวจยอดเงินโอนเข้าบริษัท</h3>
				<hr>
				{!! Form::open(array('route' => 'reports.collect', 'data-parsley-validate' => '', 'method' => 'get')) !!}
				{{ Form::label('from', 'เริ่มต้น:')}}
				{!! Form::text('from', '', array('id' => 'datepicker3', 'class' => 'form-control')) !!}
				{{ Form::label('end', 'สิ้นสุด:')}}
				{!! Form::text('end', '', array('id' => 'datepicker4', 'class' => 'form-control')) !!}
				
					
						{{ Form::submit('ตรวจสอบ', array('class' => 'btn btn-success btn-lg', 'style' => 'margin-top: 20px')) }}
					
				
				{!! Form::close() !!}
			</div>
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
j( "#datepicker1" ).datepicker();
j( "#datepicker2" ).datepicker();
j( "#datepicker3" ).datepicker();
j( "#datepicker4" ).datepicker();
});
    </script>
@endsection