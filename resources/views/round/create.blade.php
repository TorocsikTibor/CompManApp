@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8 p-3">

            <h1>Make Round</h1>

            <form method="post" action="{{ URL('round/create/'. $id) }}">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input class="form-control" type="text" name="name">
                </div>
                @if(isset($competitors))
                    <div class="form-group">
                        <label><strong>Select Category :</strong></label><br/>
                        <select class="form-select" name="competitors[]" multiple="">
                            <div class="form-group">
                                @foreach($competitors as $competitor)
                                    <option value="{{ $competitor->id }}">{{ $competitor->name }}</option>
                                @endforeach
                            </div>
                        </select>
                    </div>
                @endif
                <input class="btn btn-primary" type="submit">
            </form>
            <a class="btn btn-primary" href="{{ route('home') }}">Back</a>
        </div>
    </div>
    {{-- todo: jquery adatok kiszedése a form ból
         todo: selectorok írása
    --}}

@endsection
