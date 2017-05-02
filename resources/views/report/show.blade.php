@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <h2>Report</h2>
        </div>
        <div class="col-md-2">
        {!! Form::open( ['route' => ['report.reportCollect', $from, $end]]) !!}
            {{ Form::submit('Collect', array('class' => 'btn btn-success btn-block'))}}       
       {!! Form::close() !!}
        </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <h3>รายงาน</h3>
        <table class="table">
          <thead>
            <th>No.</th>
            <th>ID Passport</th>
            <th>Phone</th>
            <th>Min(s).</th>
            <th>Type</th>
            <th>Price</th>
            <th>Date</th>
            <th>Status</th>
          </thead>
          <?php $total=0; $totalCollect = 0;?>
          @foreach($rents as $indexKey=>$rental)
          <tr>
          	<td>{{ ++$indexKey }}</td>
          	<td>{{ $rental->member->idCard }}</td>
          	<td>{{ $rental->member->tel }}</td>
          	<td>

          	{{ $rental->totalMin}}

          	</td>
            <td>{{ $rental->card->type->name }}</td>
            <td>{{ $rental->total }} ฿</td>
            <td>{{ $rental->checkIn->toDateString() }}</td>
            <td>
            	@if($rental->collect_id != null)
            		โอนเงินแล้ว
            		<?php $totalCollect = $totalCollect+$rental->total ?>
            	@else
            		ยังไม่ได้โอน
            		<?php $total = $total+$rental->total ?>
            	@endif
            </td>
          </tr>
          @endforeach
        </table>
      </div>
      <div class="text-center">{{ $rents->appends(request()->input())->links() }}</div>
      
    </div>
</div>
@endsection