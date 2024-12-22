@extends('layouts.auth')

@section('content')
<div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Events</h4>
                <p class="card-description">All Location Events</p>
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form class="forms-sample" method="post" action="{{route('events.store')}}">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputName1">Name</label>
                        <input type="text" class="form-control" id="exampleInputName1" name="name" placeholder="Name" value="{{old('name')}}">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" class="form-control" cols="10" rows="5" placeholder="Enter description here....">{{old('description')}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleSelectGender">Categories</label>
                        <select class="form-control" name="category">
                            <option value="" disabled selected>Choose Option</option>
                            @foreach($categories as $category)
                            <option value="{{$category->id}}" {{old('category') == $category->id ? 'selected' : ''}}>{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Location</label>
                        <select class="form-control" name="location">
                            <option value="" disabled selected>Choose Option</option>
                            <option value="islamabad" {{old('location') == 'islamabad' ? 'selected' : ''}}>Islamabad</option>
                            <option value="karachi" {{old('location') == 'karachi' ? 'selected' : ''}}>Karachi</option>
                            <option value="lahore" {{old('location') == 'lahore' ? 'selected' : ''}}>Lahore</option>
                            <option value="rawalpindi" {{old('location') == 'rawalpindi' ? 'selected' : ''}}>Rawalpindi</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Type</label>
                        <select class="form-control" name="type">
                            <option value="" disabled selected>Choose Option</option>
                            <option value="free" {{old('type') == 'free' ? 'selected' : ''}}>Free</option>
                            <option value="paid" {{old('type') == 'paid' ? 'selected' : ''}}>Paid</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Price</label>
                        <input type="number" name="price" class="form-control" placeholder="Enter price" value="{{old('price')}}">
                    </div>
                    <div class="form-group">
                        <label>Start Date</label>
                        <input type="date" name="start_date" class="form-control" value="{{old('start_date')}}">
                    </div>
                    <div class="form-group">
                        <label>End Date</label>
                        <input type="date" name="end_date" class="form-control" value="{{old('end_date')}}">
                    </div>
                    <div class="form-group">
                        <label>Max Attendence</label>
                        <input type="number" name="max_attendence" class="form-control" placeholder="1" value="{{old('max_attendence')}}">
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <button class="btn btn-dark">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection