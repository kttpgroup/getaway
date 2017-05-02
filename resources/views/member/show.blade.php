@extends('layouts.app')


@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10">
      <h2>Member</h2>
    </div>
    <div class="col-md-2">
      <a href="{{ route('members.edit', $member->id) }}" class="btn btn-lg btn-block btn-primary btn-h1-spacing" style="margin-top:20px;">แก้ไข</a>
    </div>
    <div class="col-md-12">
      <hr>
    </div>
    <div class="col-md-12">
      <table style="width:100%;">
        <tr>
          <td><label for="idCard">บัตรประชาชน:</label> <span>&nbsp;{{ $member->idCard }}</span></td>
          <td><label for="suspend" class="tab">สถานะ:</label> <span>&nbsp;{{ ($member->suspend) ? 'ถูกระงับ':'ปกติ' }}</td>
        </tr>
        <tr>
          <td><label for="name">ชื่อ:</label> <span>&nbsp;{{ $member->name }}</span></td>
          <td><label for="tel" class="tab">เบอร์โทรศัพท์:</label> <span>&nbsp;{{ $member->tel }}</span></td> 
        </tr>
        <tr>
          <td><label for="birth">วันเกิด:</label> <span>&nbsp;{{ $member->birth }}</span></td>
          <td><label for="point" class="tab">แต้ม:</label> <span>&nbsp;{{ $member->point }}</span></td> 
        </tr>
      </table>

    </div>
    <div class="col-md-12">
      <hr>
    </div>
   
      <div class="col-md-6">
        <h3>ประวัติการใช้งาน</h3>
        <table class="table">
          <thead>
            <th>วันที่</th>
            <th>เวลา</th>
            <th style="text-align: center;">ราคา</th>
          </thead>
          
          @foreach($rents as $rental)
          <tr>
            <td>{{ $rental->checkIn->toDateString() }}<input type="hidden" name="rentId" value="{{$rental->id}}"></td>
            <td>{{ $rental->checkIn->toTimeString() }} - {{ $rental->checkOut->toTimeString() }}</td>
            <td style="text-align: right;">{{ number_format($rental->total, 0) }}</td>
          </tr>
          @endforeach
        </table>
        <div class="text-center">{{ $rents->links() }}</div>
      </div>
      <div class="col-md-6">
        <h3>การเข้าใช้</h3>
        <div>
          {!! Form::open(array('route' => 'rent.checkIn', 'data-parsley-validate' => '')) !!}
          <button type="submit" class="btn btn-warning btn-space" style="width: 100px;" {{ ($rent) ? 'disabled="disabled"' : '' }}>Card</button>
          @if($rent!=null)
            <span style="font-size: 20px;"><code>{{ $rent->card->name }}</code></span>
          @else
            <input type="text" name="idNumber" id="idNumber" placeholder="รหัสบัตร">
          @endif
          <input type="hidden" id="member_id" name="member_id" value="{{$member->id}}">
          {!! Form::close() !!}
        </div>
        <div>
         <button type="button" class="btn btn-success btn-space disabled" style="width: 100px;">Start</button> 
         @if($rent!=null)
         <span class="text-danger" style="font-size: 24px;">{{ $rent->checkIn->toTimeString() }}</span>
         @endif
       </div>



{{--   Start edit by bee --}}
   
     
       <div>
           <button type="submit" class="show-modal btn btn-danger btn-space" {{ ($rent) ? '' : 'disabled="disabled"' }} style="width: 100px;" >Check Out</button> 
           @if($rent!=null)
           <input type="text" name="idNumber" id="idNumber" placeholder="รหัสบัตร">
           @endif
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
                       <input type="hidden" name="member_id" id="member_id" value="{{$member->id}}">
                        <input type="hidden" name="idNumber_hideden" id="idNumber_hideden">
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div> {{-- ./End row --}}

  <!-- Alert Card is not correct -->
  <!-- Modal form to show a post -->
    <div id="alertModal" class="modal fade" role="dialog" style="padding-top: 7%;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h3 class="modal-title">Warning</h3>
                </div>
                <div class="modal-body">
                <h2>รหัสบัตรไม่ตรงกัน</h2>
                </div>
            </div>
        </div>
      </div>


{{--   End edit by bee --}}


</div>

</div>
@endsection




{{--   Start edit by bee --}}


<!-- jQuery -->
    <script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
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
            'idNumber': $('#idNumber').val(),
            'member_id': $('#member_id').val(),
        },
        success: function(data) {
            validateCal (data);
        }
    });
});

$(document).keypress(function(e) {
   if(e.which == 13) {
        $.ajax({
        type: 'POST',
        url: '{{route('rent.calculatePrice')}}',
        data: {
            '_token': $('input[name=_token]').val(),
            'idNumber': $('#idNumber').val(),
            'member_id': $('#member_id').val(),
        },
        success: function(data) {
           validateCal (data);
        }
    });

    }
    
});

function validateCal (data){
  putCopoyDataField();
  $('#show_date_time').val(getDateAndTime());
  if(data['totalPrice'] || (data['validateCard'] != 0))
  {
    $('#total_time').val(minutesToHrsMin(data['useTime']));
    $('#total_price').val(convertToCurrency(data['totalPrice']));
    $('#showModal').modal('show');
  }
   else
  {
     $('#alertModal').modal('show');
  }
}

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
function putCopoyDataField(){
  var idNumberF = document.getElementById('idNumber').value;
  var idNumberH = document.getElementById('idNumber_hideden') ;
  idNumberH.value = idNumberF;
}
</script>


{{--   End edit by bee --}}
