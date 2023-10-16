@extends('layouts.app')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8 p-3">

            <div id="saveform_errlist">
            </div>
            <div id="success_message">
            </div>

            <h1>Update Round</h1>

            <div class="form-group">
                <label for="name">Name</label>
                <input class="form-control name" type="text" name="name" value="{{$round->name}}">
            </div>
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

            <input class="btn btn-primary update_round" type="submit" value="Update">

            <a class="btn btn-primary" href="{{ route('home') }}">Back</a>
        </div>
    </div>

    <script>

        $(document).ready(function () {
            $(document).on('click', '.update_round', function (e) {
                e.preventDefault();

                let data = {
                    'name': $('.name').val(),
                    'competitors': $('.competitors').val(),
                }

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "<?php echo $round->id; ?>",
                    data: data,
                    dataType: "json",
                    success: function (response) {
                        if (response.status == 200) {
                            $('#success_message').html("");
                            $('#success_message').addClass('alert alert-success');
                            $('#success_message').text('Round updated successfully');
                        } else {
                            $('#saveform_errlist').html("");
                            $('#saveform_errlist').addClass('alert alert-danger');
                            $.each(response.errors, function (key, err_values) {
                                $('#saveform_errlist').append('<li>' + err_values + '</li>');
                            });
                        }
                    }
                });
            });
        });

    </script>
@endsection

