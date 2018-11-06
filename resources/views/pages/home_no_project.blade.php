@extends('layouts.layout')
@section('content')
<div class="container con-min-height">
    <style>
        .inline{
            display: inline;    
        }
        .self-card{
            display:none;
            max-width: 26rem;
            opacity:0.9;
        }
    </style>
    <div style="margin-top:5%">
        <div class="row">
            <div class="col-6">
                <h1>Hi, Welcome!</h1>
                <h5>Get started by joining or create a new project.</h5>
                <div class="inline">
                    <button class="btn btn-success" onclick="toggleInvitation();">Join Invitation</button>
                    <button class="btn btn-primary" onclick="toggleCreateProject();">Create New Project</button>
                </div>
                <div class="top-spacing-s">
                    <div class="card text-white bg-primary mb-3 create-project self-card">
                      <div class="card-body">
                        <input type="text" class="form-group" placeholder="My Project" style="width:80%;margin-bottom:0">
                        <button class="btn btn-sm" style="float:right;">Create</button>
                      </div>
                    </div>
                    @foreach($invitations as $inv)
                    <div class="card text-white bg-success mb-3 invitation self-card">
                      <div class="card-body">
                        <p class="card-text"><b>{{$inv->fromUser->name}}</b> invite you to join <b>{{$inv->project->name}}</b><button class="btn btn-sm" style="float:right;"><i class="fas fa-plus"></i></button></p>
                      </div>
                    </div>
                    @endforeach
                </div>
                <div>
                </div>
            </div>
            <div class="col-6">
                <h2>What's New!</h2>
                {{-- latest updates --}}
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                {{-- carousell --}}
            </div>
        </div>
    </div>
</div>
<script>
    function toggleInvitation(){
        $('.invitation').toggle('show');
    }

    function toggleCreateProject(){
        $('.create-project').toggle('show');
    }
</script>
@endsection