<!DOCTYPE html>
<html>

<head>

  	<title>Print Preview</title>

<style type="text/css" >
 	@page { 
	size:80mm 140mm; 
	/*margin: 2cm;*/
}
body {
	width: 80mm;
	padding: 2%;
	font-family: 'Open Sans', sans-serif;
}
header nav, footer {
	display: none;
}
h1 {
	font-size: 16px;
	text-align: center;
}
h2 {
	font-size: 12px;
	text-align: center;
}
p {
	font-size: 12px;
	text-align: center;
}
table {
	width: 78mm;
}
.row-info {
	text-align: left;
	font-size: 16px;
	font-weight: bold;
}
.row-data {
	text-align: right;
	ffont-size: 16px;
	font-weight: bold;
}
</style>

</head>

<body style="width: 88mm;padding: 2%;">
<h1>A BIG GETAWAY Co.,Ltd.</h1>
<h2>Time Tracking Card</h2>
<p>Table Number</p>
<table align="center">
	<tr>
		<td class="row-info">Date</td>
		<td class="row-data">{{date("Y-m-d")}}</td>
	</tr>
	<tr>
		<td class="row-info">Check In</td>
		<td class="row-data">{{ $rent->checkIn->toTimeString() }}</td>
	</tr>
	<tr>
		<td class="row-info">Check Out</td>
		<td class="row-data">{{ $rent->checkOut->toTimeString() }}</td>
	</tr>
	<tr>
		<td class="row-info">Total Time</td>
		<td id="totalTime" class="row-data">{{ $rent->totalMin }}</td>
	</tr>
	<tr>
		<td class="row-info">Seats</td>
		<td class="row-data">{{ $rent->card->name }}</td>
	</tr>
	<tr>
		<td class="row-info">Price</td>
		<td class="row-data">{{ $rent->total }}</td>
	</tr>
	<tr>
		<td class="row-info">Name</td>
		<td class="row-data">{{ $rent->member->name }}</td>
	</tr>
	<tr>
		<td class="row-info">Mobile</td>
		<td class="row-data">{{ $rent->member->tel }}</td>
	</tr>
</table>
<p>*ระหว่างเข้าใช้บริการ ขอความกรุณา<br>อย่าสิ่งเสียดังรบกวนผู้ใช้บริการท่านอื่น</p>
<p>กรุณาแสดงบัตรและติดต่อเจ้าหน้าที่ทุกครั้ง<br><span style="text-align: center">ก่อนใช้บริการ</span></p>

<script>
	window.onload = function() {
  		 window.print();
  		 setTimeout(function( ) { redirectPage() },1)
	}
	function redirectPage() {
		if({{$timeTable}}==0){
		window.location = '{{route("members.show",$rent->member->id)}}';
	}else{
		window.location = '{{route("rent.timeTable")}}';
	}
	}
</script>
</body>

</html>