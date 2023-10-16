@extends('layouts.app')

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8 p-3">


            <div id="saveform_errlist">
            </div>

            <div id="success_message">
            </div>

            <h1>Make competitor</h1>

            <div class="form-group">
                <label for="name">Name</label>
                <input class="form-control name" type="text" name="name">
            </div>
            <div class="form-group">
                <label for="date">Birthday</label>
                <input class="form-control birthday" type="date" name="birthday">
            </div>
            <div class="form-group">
                <label for="date">Nationality</label>
                <input class="form-control nationality" type="text" name="nationality">
            </div>
            <input class="btn btn-primary add_competitor" type="submit">

            <a class="btn btn-primary" href="{{ route('home') }}">Back</a>
        </div>
    </div>



    <script>
        $(document).ready(function () {
            $(document).on('click', '.add_competitor', function (e) {
                e.preventDefault();

                let data = {
                    'name': $('.name').val(),
                    'birthday': $('.birthday').val(),
                    'nationality': $('.nationality').val(),
                }

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "POST",
                    url: "competitor/create",
                    data: data,
                    dataType: "json",
                    success: function (response) {
                        if (response.status == 201) {
                            $('#success_message').html("");
                            $('#success_message').addClass('alert alert-success');
                            $('#success_message').text('Competitor created successfully');
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

