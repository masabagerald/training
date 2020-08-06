@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.participant.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.participant.fields.first-name')</th>
                            <td field-key='first_name'>{{ $participant->first_name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.participant.fields.middle-name')</th>
                            <td field-key='middle_name'>{{ $participant->middle_name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.participant.fields.last-name')</th>
                            <td field-key='last_name'>{{ $participant->last_name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.participant.fields.mobile')</th>
                            <td field-key='mobile'>{{ $participant->mobile }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.participant.fields.sex')</th>
                            <td field-key='sex'>{{ $participant->sex }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.participant.fields.dob')</th>
                            <td field-key='dob'>{{ $participant->dob }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.participant.fields.health-facility')</th>
                            <td field-key='health_facility'>{{ $participant->health_facility }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.participant.fields.postal-address')</th>
                            <td field-key='postal_address'>{{ $participant->postal_address }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.participant.fields.physical-addr')</th>
                            <td>
                    <strong>{{ $participant->physical_addr_address }}</strong>
                    <div id='physical_addr-map' style='width: 600px;height: 300px;' class='map' data-key='physical_addr' data-latitude='{{$participant->physical_addr_latitude}}' data-longitude='{{$participant->physical_addr_longitude}}'></div>
                </td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.participant.fields.district')</th>
                            <td field-key='district'>{{ $participant->district }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.participant.fields.subcounty')</th>
                            <td field-key='subcounty'>{{ $participant->subcounty }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.participant.fields.parish')</th>
                            <td field-key='parish'>{{ $participant->parish }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.participant.fields.profession')</th>
                            <td field-key='profession'>{{ $participant->profession }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.participant.fields.previous-training')</th>
                            <td field-key='previous_training'>{{ $participant->previous_training }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.participant.fields.education-level')</th>
                            <td field-key='education_level'>{{ $participant->education_level }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.participant.fields.comments')</th>
                            <td field-key='comments'>{!! $participant->comments !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.participant.fields.documents')</th>
                            <td field-key='documents's> @foreach($participant->getMedia('documents') as $media)
                                <p class="form-group">
                                    <a href="{{ $media->getUrl() }}" target="_blank">{{ $media->name }} ({{ $media->size }} KB)</a>
                                </p>
                            @endforeach</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.participant.fields.photo')</th>
                            <td field-key='photo'>@if($participant->photo)<a href="{{ asset(env('UPLOAD_PATH').'/' . $participant->photo) }}" target="_blank"><img src="{{ asset(env('UPLOAD_PATH').'/thumb/' . $participant->photo) }}"/></a>@endif</td>
                        </tr>
                    </table>
                </div>
            </div>

            
            <ul class="nav nav-tabs" role="tablist"> 

                <li role="tab" class="active"><a href="#training" aria-controls="user_actions" role="tab" data-toggle="tab">Trainings</a></li>
                <li role="tab"><a href="#mentorship" aria-controls="user_actions" role="tab" data-toggle="tab">Mentorships</a></li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                
                <div role="tabpanel" class="tab-pane active" id="trainings">

                    <table class="table table-bordered table-striped datatable">
                        <thead>
                            <tr>
                                <th>Training Name</th>
                                <th>Venue</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Designation</th>
                                <th>Pre Score</th>
                                <th>post Score</th>
                            </tr>
                        </thead>

                        <tbody>
                            
                        </tbody>
                    </table>

                </div>
                <div role="tabpanel" class="tab-pane" id="mentorship">


                    <table class="table table-bordered table-striped datatable">
                        <thead>
                            <tr>
                                <th>Mentorship Name</th>
                                <th>Venue</th>
                                <th>Start Date</th>
                                <th>End Date</th>                               
                                            
                            </tr>
                        </thead>

                        <tbody>
                            
                        </tbody>
                    </table>

                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.participants.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop

@section('javascript')
    @parent
   <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&callback=initialize" async defer></script>
 
    <script>
        function initialize() {
            const maps = document.getElementsByClassName("map");
            for (let i = 0; i < maps.length; i++) {
                const field = maps[i]
                const fieldKey = field.dataset.key;
                const latitude = parseFloat(field.dataset.latitude) || -33.8688;
                const longitude = parseFloat(field.dataset.longitude) || 151.2195;
        
                const map = new google.maps.Map(document.getElementById(fieldKey + '-map'), {
                    center: {lat: latitude, lng: longitude},
                    zoom: 13
                });
                const marker = new google.maps.Marker({
                    map: map,
                    position: {lat: latitude, lng: longitude},
                });
        
                marker.setVisible(true);
            }    
              
          }
    </script>
    <script src="{{ url('adminlte/plugins/datetimepicker/moment-with-locales.min.js') }}"></script>
    <script src="{{ url('adminlte/plugins/datetimepicker/bootstrap-datetimepicker.min.js') }}"></script>
    <script>
        $(function(){
            moment.updateLocale('{{ App::getLocale() }}', {
                week: { dow: 1 } // Monday is the first day of the week
            });
            
            $('.date').datetimepicker({
                format: "{{ config('app.date_format_moment') }}",
                locale: "{{ App::getLocale() }}",
            });
            
        });
    </script>
            
@stop
