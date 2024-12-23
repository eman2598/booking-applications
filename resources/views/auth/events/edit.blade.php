@extends('layouts.auth')

@section('content')
<div class="row">
    <a href="{{route('events.index')}}" class="btn btn-info mb-3 mt-0">Go Back</a>
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Event</h4>
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form method="POST" action="{{ route('events.update', $event->id) }}" class="form-sample">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="exampleInputName1">Name</label>
                        <input type="text" class="form-control" id="exampleInputName1" name="name" placeholder="Name" value="{{ old('name', $event->name) }}">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" class="form-control" cols="10" rows="5" placeholder="Enter description here....">{{old('description', $event->description)}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleSelectGender">Categories</label>
                        <select class="form-control" name="category">
                            <option value="" disabled selected>Choose Option</option>
                            @foreach($categories as $category)
                            <option value="{{$category->id}}" {{old('category', $event->category_id) == $category->id ? 'selected' : ''}}>{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Location</label>
                        <select class="form-control" name="location">
                            <option value="" disabled selected>Choose Option</option>
                            <option value="islamabad" {{old('location', strtolower($event->location)) == 'islamabad' ? 'selected' : ''}}>Islamabad</option>
                            <option value="karachi" {{old('location', strtolower($event->location)) == 'karachi' ? 'selected' : ''}}>Karachi</option>
                            <option value="lahore" {{old('location', strtolower($event->location)) == 'lahore' ? 'selected' : ''}}>Lahore</option>
                            <option value="rawalpindi" {{old('location', strtolower($event->location)) == 'rawalpindi' ? 'selected' : ''}}>Rawalpindi</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Type</label>
                        <select class="form-control" name="type">
                            <option value="" disabled selected>Choose Option</option>
                            <option value="free" {{old('type', strtolower($event->type)) == 'free' ? 'selected' : ''}}>Free</option>
                            <option value="paid" {{old('type', strtolower($event->type)) == 'paid' ? 'selected' : ''}}>Paid</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Price</label>
                        <input type="number" name="price" class="form-control" placeholder="Enter price" value="{{old('price', $event->price)}}">
                    </div>
                    <div class="form-group">
                        <label>Start Date</label>
                        <input type="date" name="start_date" class="form-control" value="{{old('start_date', $event->start_date)}}">
                    </div>
                    <div class="form-group">
                        <label>End Date</label>
                        <input type="date" name="end_date" class="form-control" value="{{old('end_date', $event->end_date)}}">
                    </div>
                    <div class="form-group">
                        <label>Max Attendence</label>
                        <input type="number" name="max_attendence" class="form-control" placeholder="1" value="{{old('max_attendence', $event->max_attendence)}}">
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <button class="btn btn-dark">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection