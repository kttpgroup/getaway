@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <h2>Member</h2>
        </div>
        <div class="col-md-2">
          <a href="{{ route('members.create') }}" class="btn btn-lg btn-block btn-primary btn-h1-spacing" style="margin-top:20px;">Create New</a>
        </div>
        <div class="col-md-12">
          <hr>
        </div>
        <div class="col-md-12">
           
                <table class="table table-hover">
                    <thead>
                        <th>ชื่อ</th>
                        <th>รหัสบัตรประชาชน</th>
                        <th>เบอร์โทรศัพท์</th>
                        <th></th>
                    </thead>
                    <tbody>

                         @foreach( $members as $member )
                            <tr>
                                <td>{{ $member->name }}</td>
                                <td>{{ $member->idCard }}</td>
                                <td>{{ $member->tel }}</td>
                                <td><a href="{{ route('members.show', $member->id) }}" class="btn btn-default btn-sm">View</a><a href="{{ route('members.edit', $member->id) }}" class="btn btn-default btn-sm">Edit</a></td>
                            </tr>
                         @endforeach

                    </tbody>
                </table>
                <div class="text-center">{{ $members->links() }}</div>
        </div>

    </div>

</div>
@endsection