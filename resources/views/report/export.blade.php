<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

</head>
<body>
	

<table>
	<tr>
		<td>No.</td>
		<td>เลข Invoice</td>
		<td>ยอดโอน</td>
		<td>พนักงานที่โอน</td>
		<td>วันที่โอน</td>
	</tr>
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
</body>
</html>