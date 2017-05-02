@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <h2>type</h2>
        </div>
        <div class="col-md-2">
          <a href="{{ route('types.create') }}" class="btn btn-lg btn-block btn-primary btn-h1-spacing" style="margin-top:20px;">Create New</a>
        </div>
        <div class="col-md-12">
          <hr>
        </div>
        <div class="col-md-12">
           
                <table class="table table-hover">
                    <thead>
                        <th>ID</th>
                        <th>ชื่อ</th>
                        <th>ราคา</th>
                        <th></th>
                    </thead>
                    <tbody>

                         @foreach( $types as $type )
                            <tr>
                                <td>{{ $type->id }}</td>
                                <td>{{ $type->name }}</td>
                                <td>{{ $type->price }}</td>
                                <td><a href="{{ route('types.show', $type->id) }}" class="btn btn-default btn-sm">View</a><a href="{{ route('types.edit', $type->id) }}" class="btn btn-default btn-sm">Edit</a></td>
                            </tr>
                         @endforeach
                    </tbody>
                </table>
                <div class="text-center">{{ $types->links() }}</div>
        </div>
    </div>

</div>
@endsection