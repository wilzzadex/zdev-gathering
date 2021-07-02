@extends('back.master')
@section('judul')
    Laporan
@endsection
@section('custom-css')
    <link href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" rel="stylesheet" />
@endsection
@section('content')
    <div class="row">

        <div class="col-12">

            <!-- Default Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <div class="row">
                        <div class="col-6">
                            <h6 class="m-0 font-weight-bold text-primary">Cetak Laporan</h6>
                        </div>

                    </div>
                </div>
                <div class="card-body">
                    <form method="GET" action="{{ route('laporan.cetak') }}" target="_blank">
                        <div class="form-group row">
                            <div class="col-md-3">
                                <label>Jenis</label>
                                <select name="jenis" class="form-control">
                                    <option value="semua">Semua</option>
                                    <option value="menunggu-pembayaran">Menunggu Pembayaran</option>
                                    <option value="lunas">Lunas</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label>Periode</label>
                                <div class='input-group' id='kt_daterangepicker_6'>
                                    <input type='text' name="tanggal" required class="form-control" readonly
                                        placeholder="Pilih rentan tanggal ..." />
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary" style="margin-top: 30px">Cetak</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>

    </div>
@endsection
@section('custom-js')
    <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script>
        var start = moment().subtract(6, 'days');
        var end = moment();

        function cb(start, end) {
            $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            lstart = moment($('#reportrange').data('daterangepicker').startDate).toDate(),
                lend = moment($('#reportrange').data('daterangepicker').endDate).toDate();
            console.log(lstart, lend)
        }

        $('#kt_daterangepicker_6').daterangepicker({
            buttonClasses: ' btn',
            applyClass: 'btn-primary',
            cancelClass: 'btn-secondary',

            startDate: start,
            endDate: end,
            ranges: {
                'Hari Ini': [moment(), moment()],
                'Kemarin': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                '7 Hari Terakhir': [moment().subtract(6, 'days'), moment()],
                '30 Hari Terakhir': [moment().subtract(29, 'days'), moment()],
                'Bulan Ini': [moment().startOf('month'), moment().endOf('month')],
                'Bulan Kemarin': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month')
                    .endOf(
                        'month')
                ]
            }
        }, function(start, end, label) {
            $('#kt_daterangepicker_6 .form-control').val(start.format('MM/DD/YYYY') + ' - ' + end.format(
                'MM/DD/YYYY'));
        });

        // cb(start, end);
    </script>
@endsection
