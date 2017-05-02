@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10">
            <h2>Card</h2>
        </div>
        <div class="col-md-2">
          <a href="{{ route('cards.edit', $card->id) }}" class="btn btn-lg btn-block btn-primary btn-h1-spacing" style="margin-top:20px;">แก้ไข</a>
        </div>
        <div class="col-md-12">
          <hr>
        </div>
        <div class="col-md-12">
           
                <table style="width:100%;">
                    <tr>
                        <td><label for="idCard">รหัสบัตร:</label> <span>&nbsp;{{ $card->idNumber }}</span></td>
                        <td><label for="suspend" class="tab">สถานะ:</label> <span>&nbsp;{{ ($card->suspend) ? 'ถูกระงับ':'ปกติ' }}</td>
                    </tr>
                    <tr>
                        <td><label for="name">ชื่อบัตร:</label> <span>&nbsp;{{ $card->name }}</span></td>
                        <td><label for="type" class="tab">ชนิดบัตร:</label> <span>&nbsp;
                        {{ $card->type->name}}-{{ $card->type->price }}
                        </span></td> 
                    </tr>
                </table>
            
        </div>
    </div>

</div>
@endsection