@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
   <div class="col-md-10">
    <h2>ตารางคิดเงิน</h2>
  </div>

  <div class="col-md-12">
    <hr>
  </div>
  <div class="col-md-12">
    <table class="table table-hover">
      <thead>
        <th>ชื่อ</th>
        <th>เลขที่บัตร</th>
        <th>เวลาเริ่มใช้งาน</th>
        <th>จำนวนนาที</th>
        <th>ราคา</th>
        <th>คิดเงิน</th>
      </thead>
      <tbody>

      @if(isset($rents))
        @foreach($rents as $rent)
          
          <tr>
            <td>{{ $rent->member->name }} </td>
            <td>{{ $rent->card->name }}</td>
            <td>{{ $rent->checkIn->toTimeString() }}</td>
            <td><span class="tick"> {{ $rent->checkIn->diffInSeconds($now) }} </span></td>
            <td> <span class="price"> {{ $rent->card->type->price }} </span> </td>
            <td><a href="{{ route('members.show', $rent->member->id) }}" class="btn btn-default btn-sm btn-danger">Check Out</a></td>
            <input class="type_id" type="hidden" value="{{ $rent->card->type_id }}">
          </tr>

           
        @endforeach
      @endif
      </tbody>
    </table>
    <div class="text-center">{{ $rents->links() }}</div>
  </div>
</div>
<!-- Modal form to show a post -->
    <div id="showModal" class="modal fade" role="dialog" style="padding-top: 7%;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h3 class="modal-title">วิธีชำระเงิน</h3>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form">
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="id">วันเวลาที่ออก:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="show_date_time" disabled style="font-size: 36px; background-color: white;color: black;"><small>(date @ time)</small> 
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="title">เวลาที่ใช้:</label>
                            <div class="col-sm-9">
                                <input type="name" class="form-control" id="total_time" disabled style="font-size: 36px; background-color: white;color: black;"><small>(hrs : mins)</small> 
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-3" for="content">ยอดชำระ:</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" id="total_price" cols="40" rows="1" disabled  style="font-size: 60px;text-align: right; background-color: white;color: red;" ></textarea><small>(baht)</small>
                            </div>
                        </div>
                    </form>
                    <div class="modal-footer">
                    {!! Form::open(array('route' => 'rent.checkOut', 'data-parsley-validate' => '')) !!}
                        <button type="submit" class=" btn btn-primary btn-lg disabled">
                            <span class=''></span> ใช้แต้มสะสม
                        </button>
                        <button type="submit" class=" btn btn-success btn-lg">
                            <span class=''></span> เงินสด
                        </button>
                        @if(isset($rent))
                          <input type="hidden" name="member_id" id="member_id" value="{{$rent->member->id}}">
                       @endif
                        <input type="hidden" name="idNumber_hideden" id="idNumber_hideden">
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
@if(isset($rent))
<script>

  var temp = 0;
  var price = 0;
  var y = jQuery.noConflict();
  var numClass = y('.tick').length;
  var priceClass = y('.price').length;
  var typeClass = y('.type_id').length;
  var arr = new Array(numClass);
  var prices = new Array(priceClass);
  var types = new Array(typeClass);
  y(document).ready(setInterval(timeUpdate, 1000));
  function timeUpdate(){
    var days = 24*60*60,
    hours = 60*60,
    minutes = 60;
    var j = jQuery.noConflict();
    j('.tick').each(function(index){
      if(typeof arr[index] == 'undefined'){
        temp = j(this).html();
      }else{
        temp = arr[index];
      }
      


      var hour = Math.floor(temp/hours);
      var min = Math.floor(temp/minutes)%60;
      var second = temp%60;


      if(hour < 10) {
        hour = "0"+hour;
      }
      if(min < 10) {
        min = "0"+min;
      }
      if(second < 10) {
        second = "0"+second;
      }
      j(this).html(hour+":"+min+":"+second);
      temp++;
      arr[index]=temp;
    });

    j('.type_id').each(function (index){
      types[index] = j(this).val();
    });

    j('.price').each(function (index){
      if(typeof prices[index] == 'undefined'){
        price = j(this).html();
        prices[index] = j(this).html();
      }else{
        price = prices[index];
      }
      temp = arr[index];
      var min = Math.floor(temp/60);
      
      var price = prices[index];
     
      var roundUp = 0;
      var total = 0;
      var section = Math.floor(min/15);
      if(min%15>0 && min%15>=5) {
        roundUp = 1;
      }
      //promotion price for 5 hours check
      if(min>300 && types[index]==1){
        total = 200;
      }else{
        total = ((section*price)+(roundUp*price))/4;
      }

      if(min < 5){
        total = 0;
      }
      j(this).html(total);
    });
  }
</script>
@endif
{{--   Start edit by bee --}}


<!-- jQuery -->
    
<script type="text/javascript">
window.onload = function() {
  document.getElementById('idNumber').focus();
}

// Show a modal
$(document).on('click', '.show-modal', function() {
    $.ajax({
        type: 'POST',
        url: '{{route('rent.calculatePrice')}}',
        data: {
            '_token': $('input[name=_token]').val(),
            'idNumber': $('#idNumber_hideden').val(),
            'member_id': $('#member_id').val(),
        },
        success: function(data) {
            $('#show_date_time').val(getDateAndTime());
            $('#total_time').val(minutesToHrsMin(data['useTime']));
            $('#total_price').val(convertToCurrency(data['totalPrice']));
            $('#showModal').modal('show');
        }
    });
});
function getDateAndTime(){
  var today = new Date();
  var dd = today.getDate();
  var mm = today.getMonth()+1; //January is 0!
  var yyyy = today.getFullYear();
  if(dd<10) {
      dd='0'+dd
  } 
  if(mm<10) {
      mm='0'+mm
  } 
  today = yyyy+'-'+mm+'-'+dd;
  var currentdate = new Date(); 
  var datetime = " @ "  
    + currentdate.getHours() + ":"  
    + currentdate.getMinutes() + ":" 
    + currentdate.getSeconds();
  return today+" "+datetime;
}
function minutesToHrsMin (MINUTES){
  m = MINUTES % 60;
  h = (MINUTES-m)/60;
  if(h<1)
    return "0 : "+(m<10?"0":"") + m.toString();
  return h.toString() + " : " + (m<10?"0":"") + m.toString();
}
function convertToCurrency (num){
  return num.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")+".-";
}

</script>


{{--   End edit by bee --}}
@endsection