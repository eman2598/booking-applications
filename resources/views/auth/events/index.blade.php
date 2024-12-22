@extends('layouts.auth')


@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                                <th> Location </th>
                                <th> Price </th>
                                <th> Max Attendence </th>
                                <th> Type </th>
                                <th> Actions </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($events as $event)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$event->name}}</td>
                                <td>{{$event->location}}</td>
                                <td>{{number_format($event->price, 2)}}</td>
                                <td>{{$event->max_attendence}}</td>
                                <td>
                                    @if($event->type == 'FREE')
                                    <span class="badge badge-primary">{{$event->type}}</span>
                                    @else($event->type == 'PAID')
                                    <span class="badge badge-success">{{$event->type}}</span>
                                    @endif
                                </td>
                                <td class="d-flex">
                                    <a href="{{route('events.show', $event->id)}}" class="btn btn-success">Show</a> &nbsp;
                                    <a href="{{route('events.edit', $event->id)}}" class="btn btn-info">Edit</a>&nbsp;
                                    <form action="{{route('events.destroy', $event->id)}}" method="post" class="event-delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger delete-btn">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <p class="text-danger text-bold text-center">No events created yet.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.dataTables.bootstrap4.js"></script>
<script>
    $(document).ready(function() {
        $('#event-table').DataTable();
    });

    $(document).ready(function() {
        $('.delete-btn').click(function(e) {
            e.preventDefault();
            //  if (confirm('Are you sure? You want to delete it')) {
            //    $('.event-delete-form').submit();
            // }

            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $('.event-delete-form').submit();
                    Swal.fire({
                        title: "Deleted!",
                        text: "Your file has been deleted.",
                        icon: "success"
                    });
                }
            })
        });
    });
</script>
@endsection