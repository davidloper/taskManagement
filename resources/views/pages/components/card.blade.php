@extends('layouts.layout')
@section('content')
<div class="container con-min-height top-spacing-l">
    <div class="card">
        <div class="card-header">
            <form method="get">
                <div class="row">
                    <div class="col-4">
                        <h2>{{ $title }}</h2>
                    </div>
                    <div class="col-8 text-right">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control datepicker" name="start_date" placeholder="From Date (Optional)">
                            <input type="text" class="form-control datepicker" name="end_date" placeholder="To Date (Optional)">
                            <input type="text" class="form-control" name="keyword" placeholder="Keyword">
                            <div class="input-group-append">
                                <button class="btn btn-primary">Search</button>
                          </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body">
            {{ $slot }}
        </div>
    </div>
</div>
<script>
    $('.datepicker').datepicker();
</script>
@endsection

