@extends('layouts.auth')


@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css">
@endsection


@section('content')
<div class="page-header">
    <h3 class="page-title"> Events </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Events</a></li>
        </ol>
    </nav>
</div>
<div class="row">

    <div class="container">
        @if(session('success_msg'))
        <div class="alert alert-success" role="alert">
            <strong>Good Job!</strong> {{session()->get('success_msg')}}
        </div>
        @endif
        @if(session('error_msg'))
        <div class="alert alert-danger" role="alert">
            <strong>Good Job!</strong> {{session()->get('error_msg')}}
        </div>
        @endif
    </div>
    <a href="{{route('events.create')}}" class="btn btn-info mb-3 mt-0">New Event</a>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    @if(count ($events) > 0)

                    <table class="table" id="event-table">
                        <thead>
                            <tr>
                                <th> # </th>
                                <th> Name </th>
                                <th> Description </th>
                                <th> Category </th>
                                <th> Location </th>
                                <th> Type </th>
                                <th> Price </th>
                                <th> Max Attendence </th>
                                <th> Actions </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($events as $event)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$event->name}}</td>
                                <td>{{Str::limit($event->description, 15)}}</td>
                                <td>{{$event->category->name}}</td>
                                <td>{{$event->location}}</td>
                                <td>
                                    @if($event->type == 'FREE')
                                    <span class="badge badge-primary">{{$event->type}}</span>
                                    @else($event->type == 'PAID')
                                    <span class="badge badge-success">{{$event->type}}</span>
                                    @endif
                                </td>
                                <td>{{number_format($event->price, 2)}}</td>
                                <td>{{$event->max_attendence}}</td>
                                <td class="d-flex">
                                    <a href="" class="btn btn-success">Show</a> &nbsp;
                                    <a href="" class="btn btn-info">Edit</a>&nbsp;
                                    <form action="">
                                        <button class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <p class="text-danger text-bold">No events created yet.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#event-table').DataTable();
    });
</script>
@endsection