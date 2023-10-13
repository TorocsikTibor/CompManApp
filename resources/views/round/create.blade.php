@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8 p-3">

            <div id="saveform_errlist">
            </div>

            <div id="success_message">
            </div>

            <h1>Make Round</h1>

                <div class="form-group">
                    <label for="name">Name</label>
                    <input class="form-control name" type="text" name="name">
                </div>
                @if(isset($competitors))
                    <div class="form-group">
                        <label>Select Category :</label><br/>
                        <select class="form-select competitors" name="competitors[]" multiple="">
                            <div class="form-group">
                                @foreach($competitors as $competitor)
                                    <option value="{{ $competitor->id }}">{{ $competitor->name }}</option>
                                @endforeach
                            </div>
                        </select>
                    </div>
                @endif
                <input class="btn btn-primary add_round" type="submit" value="Save">
            <a class="btn btn-primary" href="{{ route('home') }}">Back</a>
        </div>
    </div>
    {{-- todo: jquery adatok kiszedése a form ból
         todo: selectorok írása
    --}}

    <script>
        $(document).ready(function () {
            $(document).on('click', '.add_round', function (e) {
                e.preventDefault();

                let data = {
                    'name': $('.name').val(),
                    'competitors': $('.competitors').val(),
                }

                console.log(data);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "create/<?php echo $id; ?>",
                    data: data,
                    dataType: "json",
                    success: function (response) {

                        console.log(response);
                        if(response.status == 400) {
                            $('#saveform_errlist').html("");
                            $('#saveform_errlist').addClass('alert alert-danger');
                            $.each(response.errors, function (key, err_values) {
                                $('#saveform_errlist').append('<li>'+err_values+'</li>');
                            });
                        } else {
                            $('#success_message').html("");
                            $('#success_message').addClass('alert alert-success');
                            $('#success_message').text('Round created successfully');
                        }
                    }
                });
            });
        });

    </script>

@endsection
