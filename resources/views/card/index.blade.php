@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <h2>Card</h2>
        </div>
        <div class="col-md-2">
          <a href="{{ route('cards.create') }}" class="btn btn-lg btn-block btn-primary btn-h1-spacing" style="margin-top:20px;">Create New</a>
        </div>
        <div class="col-md-12">
          <hr>
        </div>
        <div class="col-md-12">
           
                <table class="table table-hover">
                    <thead>
                        <th>ID</th>
                        <th>ชื่อ</th>
                        <th>ชนิด</th>
                        <th>สถานะ</th>
                        <th></th>
                    </thead>
                    <tbody>

                         @foreach( $cards as $card )
                            <tr>
                                <td>{{ $card->idNumber }}</td>
                                <td>{{ $card->name }}</td>
                                <td>
                                   {{ $card->type->name}}-{{ $card->type->price}}
                                </td>
                                <td>{{ ($card->suspend) ? 'ถูกระงับ':'ปกติ' }}</td>
                                <td><a href="{{ route('cards.show', $card->id) }}" class="btn btn-default btn-sm">View</a><a href="{{ route('cards.edit', $card->id) }}" class="btn btn-default btn-sm">Edit</a></td>
                            </tr>
                         @endforeach
                    </tbody>
                </table>
                <div class="text-center">{{ $cards->links() }}</div>
        </div>
    </div>

</div>
@endsection