@extends('layouts.layout')
@section('content')
<style>
.left-card-border{
    border-left:1px solid #e0e0e0 !important;
}
.a-black-bold{
    font-size: 1.1rem;
    color:black;
}

.a-black-bold:hover{
    text-decoration:none;
}
</style>
<div class="container con-min-height top-spacing-l">
    @foreach($messages as $key => $message)
        <div class="row">
            <div class="col-12">
                <div class="card" style="width:100%">
                    <div class="card-header">
                        <b>{{ $key }}{{ ' ' }}<i class="far fa-comment-alt"></i></b>
                        <span style="float:right" class="badge pointer" onclick="showMessage(this)">Expand</span>
                    </div>
                    <ul class="list-group list-group-flush">
                        @foreach($message as $key2 => $msg)
                            <li class="list-group-item message left-card-border" data-id="{{ $key2 }}" {!! $key2 > 0? 'style="display: none"':''!!}>
                                {!! $msg->message !!}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endforeach
    <div class="row top-spacing-l">
        @foreach($tasks as $key => $task)
            <div class="col-4">
                <div class="card" style="width:100%">
                    <div class="card-header">
                        <i class="fas fa-tasks"></i>{{ ' ' }}<b>{{ $key }}</b>   
                    </div>
                    <ul class="list-group list-group-flush">
                        @foreach($task as $t)
                            <li class="list-group-item left-card-border">
                                <h3><i class="fa fa-poll" style="float:right;color:
                                {{ $t->priority == priority('low')?($t->priority == priority('medium')?'#32CD32':'#F0E68C'):'#FF0000' }}"></i></h3>
                                <a class="a-black-bold" href="/tasks/{{ $t->id }}">#{{ $t->id }}: {{ $t->title }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endforeach
    </div>
</div>
<script>

    function showMessage(obj){
        $('.message').show('slide');
        $(obj).attr('onclick','hideMessage(this)').text('Hide');
    }

    function hideMessage(obj){
        $('.message').each(function(){
            if($(this).data('id') > 0) $(this).hide('slide');
        });
        $(obj).attr('onclick','showMessage(this)').text('Expand');   
    }
</script>
@endsection