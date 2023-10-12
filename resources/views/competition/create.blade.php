@extends('layouts.app')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8 p-3">
            <h1>New competition</h1>
            <form method="post" action="{{ route('createCompetition') }}">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input class="form-control" type="text" name="name">
                </div>
                <div class="form-group">
                    <label for="date">Date</label>
                    <input class="form-control" type="date" name="date">
                </div>
                <input class="btn btn-primary" type="submit">
            </form>
            <a class="btn btn-primary" href="{{ route('home') }}">Back</a>
        </div>
    </div>

@endsection
