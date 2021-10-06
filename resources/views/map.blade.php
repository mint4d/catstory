@extends('layouts.backend.style')

@section('title', 'Map')

    @push('css')
        <link href="{{ asset('assets/frontend/css/home/styles.css') }}" rel="stylesheet">

        <link href="{{ asset('assets/frontend/css/home/responsive.css') }}" rel="stylesheet">

        <!-- JQuery DataTable Css -->
    <link href="{{ asset('assets/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">
        <!-- Bootstrap Select Css -->
        <link href="{{ asset('assets/backend/plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
        <style>
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

            /* The popup bubble styling. */
            .popup-bubble {
                /* Position the bubble centred-above its parent. */
                position: absolute;
                top: 0;
                left: 0;
                transform: translate(-50%, -100%);
                /* Style the bubble. */
                background-color: white;
                padding: 5px;
                border-radius: 5px;
                font-family: sans-serif;
                overflow-y: auto;
                max-height: 60px;
                box-shadow: 0px 2px 10px 1px rgba(0, 0, 0, 0.5);
            }

            /* The parent of the bubble. A zero-height div at the top of the tip. */
            .popup-bubble-anchor {
                /* Position the div a fixed distance above the tip. */
                position: absolute;
                width: 100%;
                bottom: 8px;
                left: 0;
            }

            /* This element draws the tip. */
            .popup-bubble-anchor::after {
                content: "";
                position: absolute;
                top: 0;
                left: 0;
                /* Center the tip horizontally. */
                transform: translate(-50%, 0);
                /* The tip is a https://css-tricks.com/snippets/css/css-triangle/ */
                width: 0;
                height: 0;
                /* The tip is 8px high, and 12px wide. */
                border-left: 6px solid transparent;
                border-right: 6px solid transparent;
                border-top: 8px solid white;
            }

            /* JavaScript will position this div at the bottom of the popup tip. */
            .popup-container {
                cursor: auto;
                height: 0;
                position: absolute;
                /* The max width of the info window. */
                width: 200px;
            }

        </style>
    @endpush

@section('content')
    <br /><br />
    <body>
        <div id="map" style="width:1100px; height:600px"></div>
        <br /><br />
         <!-- Exportable Table -->
         <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 center-block">
                <div class="card">
                    <div class="header">
                        <h5>
                            ALL Form Cats
                            
                        </h5>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table
                                class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>ชื่อแมว</th>
                                        <th>ผู้ลงทะเบียน</th>
                                        <th>ลักษณะแมว</th>
                                        <th>สถานะ</th>
                                        <th>รายละเอียด</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cats as $key => $cat)
                                    @if ($cat->is_approved == true)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ str_limit($cat->name, '10') }}</td>
                                            <td>{{ $cat->user->name }}</td>
                                            <td>{{ $cat->body }}</td>
                                            <td>
                                                @if ($cat->status == true)
                                                    <strong>มีเจ้าของ</strong>
                                                @else
                                                    <strong>ไม่มีเจ้าของ</strong>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('author.catowner.show', $cat->id) }}"
                                                class="btn btn-success waves-effect">
                                                รายละเอียด
                                            </a>
                                            </td>
                                            
                                        </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Exportable Table -->
    </body>
@endsection


@push('js')

    <!-- Jquery DataTable Plugin Js -->
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/backend/plugins/jquery-datatable/extensions/export/buttons.print.min.js') }}"></script>

    <script src="{{ asset('assets/backend/js/pages/tables/jquery-datatable.js') }}"></script>
    <!-- Select Plugin Js -->
    <script src="{{ asset('assets/backend/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>
    <!-- Jquery CountTo Plugin Js -->
    <script src="{{ asset('assets/backend/plugins/jquery-countto/jquery.countTo.js') }}"></script>

    <script src="{{ asset('assets/backend/js/pages/index.js') }}"></script>
    <!-- Custom Js -->
    <script src="{{ asset('assets/backend/js/admin.js') }}"></script>
    <script src="https://unpkg.com/sweetalert2@7.19.1/dist/sweetalert2.all.js"></script>
    <script type="text/javascript">
        function deletePost(id) {
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    event.preventDefault();
                    document.getElementById('delete-form-' + id).submit();
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    swal(
                        'Cancelled',
                        'Your data is safe :)',
                        'error'
                    )
                }
            })
        }

    </script>
    {{-- javascript code --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/openlayers/2.11/lib/OpenLayers.js"></script>


    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDw9PYl-xqySFpYTTUkalB2GBL_9W53gJ0&libraries=places&callback=initMap" async
        defer></script>
        <script>
             var arrMarkers = [];
            function initMap(pv_values = 0) {
                // map options
                const bangalore = {
                lat: 18.898309197261717,
                lng: 99.00446459999999
            };
                var options = {
                    zoom: 15,
                    streetViewControl: false,
                    center: bangalore
    
                }
    
    
                // new maps
                var map = new google.maps.Map(document.getElementById('map'), options);
               
    
            @foreach($cats as $cat)
            @if ($cat->is_approved == true)
                // <?php  //foreach ($arr_cmap as $key):
                    if(empty($cat['latitude']) || empty($cat['longitude'])){
                        continue;
                    }
    
              ?>

                var latlng = {
                    lat: <?php echo $cat['latitude'] ?>,
                    lng: <?php echo $cat['longitude'] ?>
                }
    
                var contentString =
                    '<div id="content">' +
                    '<div id="siteNotice">' +
                    "</div>" +
                    '<h3 id="firstHeading" class="firstHeading text-center"><?php echo $cat['name'] ?></h3>' +
                    '<div id="bodyContent">' +
                    "<div style='float:right;'>" +
                    "<p style='padding-left:1rem;'><?php echo $cat['body']; ?></p>" +
                    "<div class='text-right'><p style='padding-left:1rem;'><a target='_blank' class='btn btn-primary btn-sm' href='{{ route('author.catowner.show',$cat->id) }}'>รายละเอียด</a></div></p>" +
                    "</div>" +
                    "<div style='float:left'>" +
                    "<img style='width:100px;' src='storage/cat/{{ $cat->image }}'>" +
                    "</div>" +
                    "</div>" +
                    "</div>";
    
                arrMarkers.push({
                    coords: latlng,
                    content: contentString,
    
                });
    
                // <?php //endforeach ?>
                @endif
            @endforeach
    
    
    
                // Loop through markers
                for (var i = 0; i < arrMarkers.length; i++) {
                    // if (pv_values && pv_values != arrMarkers[i]['pv_id']) {
                    //     continue;
                    // }
                    addMarker(arrMarkers[i]);
                }
                // add marker function
    
                function addMarker(props) {
    
                    var marker = new google.maps.Marker({
                        position: props.coords,
                        map: map,
                        icon: props.iconImage
                    });
    
    
                    // check for custom icon
                    if (props.iconImage) {
                        // set icon
                        marker.setIcon(props.iconImage);
                    }
    
                    // check content
                    if (props.content) {
                        // set content
                        var infoWindow = new google.maps.InfoWindow({
                            content: props.content
                        });
    
    
                    }
                    google.maps.event.addListener(marker, 'click', function() {
    
                        if (!marker.open) {
                            infoWindow.open(map, marker);
                            //map.setZoom(8);
                            marker.open = true;
                        } else {
                            infoWindow.close();
                            marker.open = false;
                            //map.setZoom(5);
                            //map.setCenter(thailand);
                        }
                        google.maps.event.addListener(map, 'click', function() {
                            infoWindow.close();
                            //map.setZoom(5);
                            //map.setCenter(thailand);
    
    
                        });
    
                        google.maps.event.addListener(infoWindow, 'closeclick', function() {
                           // map.setZoom(5);
                           // map.setCenter(thailand);
    
                        });
                    });
    
    
                }
    
            }
        </script>
@endpush
