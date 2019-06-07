@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
             
            <div class="card mb-4">
                <div class="card-header">Коментарии</div>

                <div class="card-body">
                    @foreach ($coments as $coment)
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between"><div class='author'>{{$coment->commentauthor->name}}</div><button class='btn btn-info blockuser' data-user="{{$coment->commentauthor->id}}">заблокировать</button></div>

                        <div class="card-body">
                            {{$coment->text}}
                        </div>
                    </div>
                    @endforeach
                    
                </div>
            </div>
            
            <div class="card">
                <div class="card-header">Заблокированные пользователи</div>

                <div class="card-body">
                    <ul>
                        @foreach ($blockedusers as $blockeduser)
                            <li><a href="{{route('otherprofile', ['id' => $blockeduser->id])}}">{{$blockeduser->name}}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @if (Route::currentRouteName()!='userprofile')
            <div class="card">
                <div class="card-header">Оставить коментарий</div>
                <div class="card-body">
                    @if (in_array(Auth::user()->id,$blockedusers->pluck('id')->all()))
                    <b>Вы не можете оставлять коментарии</b>
                    @else
                    
                        <input type="text" class="w-100 mb-2" id="senddata">
                        <div class="text-center"><button id="sendcomment">Оставить коментарий</button></div>
                    @endif
                    
                </div>
            </div>
            @endif
        </div>
    </div>
    
</div>

@endsection

@section('page-js-script')
<script type="text/javascript">
    $(function() {

        $.ajaxSetup({

            headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

        });

        $('.blockuser').click(function() {
            $.ajax({
               type:'POST',
               url:"{{route('blockuser')}}",
               data:{blockeduser_id:$(this).attr('data-user'),user_id:{{Auth::user()->id}}},
               success:function(data){
                  alert(data);
               }
            });
        });
        $('#sendcomment').click(function() {
            $.ajax({
               type:'POST',
               url:"{{route('storecomment')}}",
               data:{user_id:{{Route::current()->parameters()['id']}},commentauthor_id:{{Auth::user()->id}},text:$('#senddata').val()},
               success:function(data){
                  alert(data);
               }
            });
        });        
    });
</script>
@stop