@extends('layouts.frontend.app')

@section('title', 'Map')

@push('css')
<link href="{{ asset('assets/frontend/css/profile/styles.css') }}" rel="stylesheet">
<link href="{{ asset('assets/frontend/css/profile/responsive.css') }}" rel="stylesheet">
<style type="text/css">
    #map {
        height: 100%;
    }

    /* Optional: Makes the sample page fill the window. */

    html,
    body {
        height: 100%;
        margin: 0;
        padding: 0;
    }
</style>
@endpush

@section('content')

<body>
    <div class="container-fluid">
        <br /><br />
        
        <!-- Vertical Layout | With Floating Label -->
        <a href="{{ route('author.dashboard') }}" class="btn btn-danger waves-effect" id="form">BACK</a>

        <br /><br />
        <div class="row center-block">
            <div class="col-xs-10 col-sm-10 col-md-10 ">
                <table>
                    <tr>
                        <td><strong>ชื่อแมว :</strong></td>
                        <td>{{ $cats[0]['name'] }}</td>
                    </tr>
                    <tr>
                        <td><strong>ลักษณะแมว :</strong></td>
                        <td>{{ $cats[0]['body'] }}</td>
                    </tr>

                    <tr>
                        <td><strong>Status:</strong></td>
                        <td>
                            @if ($cats[0]['status'])
                            <strong>มีเจ้าของ</strong>
                            @else
                            <strong>ไม่มีเจ้าของ</strong>
                            @endif
                        </td>
                    </tr>
                </table>
                <div class="body">
                    {{-- <img class="img-responsive thumbnail" src="{{ Storage::disk('public')->url('cat/'.$cats[0]['image']) }}" alt=""> --}}
                    <img src="../../storage/cat/{{ $cats[0]['image'] }}" width="40%" height="40%" alt="">
                </div>
            </div>
        </div>
        <br /><br />
        <div id="map" style="width:1100px; height:600px"></div>
        <br /><br />
        <a href="{{ route('author.catowner.booking', $cats[0]) }}" class="btn btn-success waves-effect">
            booking
        </a>
        <form action="{{ route('author.catowner.duplicate') }}" method="POST" enctype="multipart/form-data">
        <div class="form-group">
    <label for="exampleFormControlSelect1">เลือกแมว</label>
    <select name="selcat_id" class="form-control" id="exampleFormControlSelect1">
        @foreach($allcats as $allcat)
        <option value="{{ $allcat->id }}">{{ $allcat->name }}</option>
        @endforeach
    </select>
    <input type="hidden" value="{{$cats[0]['id']}}" name="cat_id">
    <button type="submit">Submit</button>
    </div>
    @csrf
        </form>
    </div>

</body>

@endsection

@push('js')

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDw9PYl-xqySFpYTTUkalB2GBL_9W53gJ0&libraries=places" async defer></script>
<script>
    const labels = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    let labelIndex = 0;

    function initMap() {
        const myLatLng = {
            lat: {{ $cats[0]['latitude'] }},
            lng: {{ $cats[0]['longitude']}}
        };

        const bangalore = {
            lat: 18.898309197261717,
            lng: 99.00446459999999
        };
        const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 15,
            center: bangalore,
        });
        // This event listener calls addMarker() when the map is clicked.
        // google.maps.event.addListener(map, "click", (event) => {
        //     addMarker(event.latLng, map);
        new google.maps.Marker({
            position: myLatLng,
            map,
            label: "{{ $cats[0]['name'] }}",
        });
        // });

    }

    // Adds a marker to the map.
    function addMarker(location, map) {
        // Add the marker at the clicked location, and add the next-available label
        // from the array of alphabetical characters.

        valuelocate = "latitude=" + location.lat() + "&longitude=" + location.lng();

        // window.location = "{{ route('author.catowner.create') }}?f=0&" + valuelocate;
        new google.maps.Marker({
            position: location,
            label: labels[labelIndex++ % labels.length],
            map: map,
        });
    }
    $(document).ready(function() {
        initMap();
    });
</script>
@endpush