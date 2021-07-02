@extends('back.master')
@section('judul')
    Kalender Acara
@endsection
@section('custom-css')

@endsection
@section('content')
    <div class="row">

        <div class="col-12">

            <!-- Default Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="row">
                        <div class="col-6">
                            <h6 class="m-0 font-weight-bold text-primary">Kalender Acara</h6>
                        </div>
                        {{-- <div class="col-6">
                        <a href="{{ route('user.add') }}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm mb-1 float-right"><i class="fas fa-plus fa-sm text-white-50"></i> Tambah User</a>
                    </div> --}}
                    </div>
                </div>
                <div class="card-body">
                    <div id='calendar'></div>
                </div>
            </div>

        </div>

    </div>
@endsection
@section('custom-js')
    <script>

        $.ajax({
            url : '{{ route("getEvent") }}',
            type : 'get',
            success : function(res){
                renderCalendar(res);
            },
            error : function(){
                alert('server bermasalah');
            }
        })

        function renderCalendar(data) {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                eventClick: function(info) {
                    var eventObj = info.event;

                    if (eventObj.url) {
                        
                        window.open(eventObj.url);

                        info.jsEvent
                            .preventDefault(); // prevents browser from following link in current tab.
                    } else {
                        alert('Clicked ' + eventObj.title);
                    }
                },
                initialDate: '{{ date("Y-m-d") }}',
                events: data,
            });

            calendar.render();
        }
    </script>
@endsection
