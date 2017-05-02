@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <h2>Collect</h2>
        </div>
        <div class="col-md-2">
            {!! Form::open(array('route' => 'reports.export')) !!}
              <input type="hidden" name="from" id="from" value="{{ $from }}">
              <input type="hidden" name="end" id="end" value="{{ $end }}">
              <input type="submit" value="Export" class="btn btn-success btn-sm btn-block">
            {!! Form::close() !!}
        </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <table class="table">
          <thead>
            <th>No.</th>
            <th>เลข Invoice</th>
            <th>ยอดโอน</th>
            <th>พนักงานที่โอน</th>
            <th>วันที่โอน</th>
          </thead>
          @foreach($collects as $indexKey=>$collect)
          <tr>
          	<td>{{ ++$indexKey }}</td>
          	<td>{{ $collect->invoiceNumber }}</td>
          	<td>{{ $collect->amount }}</td>
          	<td> {{ $collect->user->name }} </td>
            <td> {{ $collect->created_at->toDateString() }} </td>
          </tr>
          @endforeach
        </table>
      </div>
     
      
    </div>
</div>
@endsection