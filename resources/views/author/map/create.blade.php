@extends('layouts.frontend.app')

@section('title', 'Map')

    @push('css')
        <link href="{{ asset('assets/frontend/css/profile/styles.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/frontend/css/profile/responsive.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
            integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    @endpush

@section('content')
    <form action="{{ route('author.map.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="container mt-5">
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-8 col-sm-12 col-12 m-auto">
                    <div class="card shadow">
                        <div class="card-header bg-primary">
                            <h5 class="card-title text-white"> Google Autocomplete Address</h5>
                        </div>

                        <div class="card-body">
                            <div class="form-line">
                                <textarea type="text" id="title"
                                    class="form-control" name="title"
                                    placeholder="Map Title" aria-required="true"
                                    aria-invalid="false"></textarea>

                            </div>
                            <br>
                            <div class="form-group">
                                <label for="autocomplete"> Location/City/Address </label>
                                <input type="text" name="address_address" id="address_address" class="form-control"
                                    placeholder="Select Location">
                            </div>

                            <div class="form-group" id="lat_area">
                                <label for="latitude"> Latitude </label>
                                <input type="text" name="latitude" id="latitude" class="form-control">
                            </div>

                            <div class="form-group" id="long_area">
                                <label for="latitude"> Longitude </label>
                                <input type="text" name="longitude" id="longitude" class="form-control">
                            </div>
                        </div>

                        <div class="card-footer">
                            <a href="{{ route('author.dashboard') }}" class="btn btn-danger waves-effect" id="form">BACK</a>
                            <button type="submit" class="btn btn-success"> Submit </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('js')
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    {{-- javascript code --}}
    <script
        src="https://maps.google.com/maps/api/js?key=AIzaSyDw9PYl-xqySFpYTTUkalB2GBL_9W53gJ0&libraries=places&callback=initAutocomplete"
        type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            $("#lat_area").addClass("d-none");
            $("#long_area").addClass("d-none");
        });

    </script>


    <script>
        google.maps.event.addDomListener(window, 'load', initialize);

        function initialize() {
            var options = {
                componentRestrictions: {
                    country: "TH"
                }
            };

            var input = document.getElementById('address_address');
            var autocomplete = new google.maps.places.Autocomplete(input, options);
            autocomplete.addListener('place_changed', function() {
                var place = autocomplete.getPlace();
                $('#latitude').val(place.geometry['location'].lat());
                $('#longitude').val(place.geometry['location'].lng());

                // --------- show lat and long ---------------
                $("#lat_area").removeClass("d-none");
                $("#long_area").removeClass("d-none");
            });
        }

    </script>

@endpush
