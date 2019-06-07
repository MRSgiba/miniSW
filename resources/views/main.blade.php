@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
             
            <div class="card mb-4">
                <div class="card-header">Список всех пользователей</div>

                <div class="card-body">

                            <ul>
                                @foreach ($users as $user)
                                <li><a href="{{route('otherprofile', ['id' => $user->id])}}">{{$user->name}}</a></li>
                                @endforeach
                            </ul>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
