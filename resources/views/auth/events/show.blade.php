@extends('layouts.auth')

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css">
<style>
    #event-details th {
        width: 12%;
    }
</style>
@endsection

@section('content')
<div class="page-header">
    <h3 class="page-title"> Events Details</h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('events.index')}}">Events</a></li>
            <li class="breadcrumb-item"><a href="#">Show</a></li>
        </ol>
    </nav>
</div>
<div class="row">
    <a href="{{route('events.index')}}" class="btn btn-info mb-3 mt-0">Go Back</a>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    @if($event)
                    <table class="table table-bordered" id="event-details">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <td>{{$event->name}}</td>
                            </tr>
                            <tr>
                                <th>Type</th>
                                <td>{{$event->type}}</td>
                            </tr>
                            <tr>
                                <th>Location</th>
                                <td>{{$event->location}}</td>
                            </tr>
                            <tr>
                                <th>Category</th>
                                <td>{{$event->category ? $event->category->name : ''}}</td>
                            </tr>
                            @if($event->type != 'FREE')
                            <tr>
                                <th>Price</th>
                                <td>{{$event->price}}</td>
                            </tr>
                            @endif
                            <tr>
                                <th>Start Date</th>
                                <td>{{date('D d/m/Y', strtotime($event->start_date))}}</td>
                            </tr>
                            <tr>
                                <th>End Date</th>
                                <td>{{date('D d/m/Y', strtotime($event->end_date))}}</td>
                            </tr>
                            <tr>
                                <th>Max Attendence</th>
                                <td>{{$event->max_attendence}}</td>
                            </tr>
                            <tr>
                                <th>Created At</th>
                                <td>{{$event->created_at->diffForHumans()}}</td>
                            </tr>
                        </thead>
                    </table>
                    <br>
                    <p style="color: #6c7293;" class="p-0"><b>Description</b></p>
                    <p style="color: #6c7293;" class="p-0">{{$event->description}}</p>
                    @else
                    <p class="text-danger text-bold text-center mt-3"><b>Unable to find event details</b></p>
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
        $('#event-details').DataTable();
    });
</script>
@endsection