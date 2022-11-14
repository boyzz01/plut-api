@extends('main2')

@section('container')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
       
        <div class="container-fluid">



    
            <div class="card card-custom">
             
                <div class="card-body">
                    <!--begin: Datatable-->
                    <table class="table table-bordered table-checkable" id="kt_datatable2">
                        <thead>
                            <tr>
                                <th style="width: 5%">No</th>
                                <th>Produk</th>
                                <th>Terjual</th>

                            </tr>
                        </thead>
                        <tbody>


                            @php
                                $nomor = 1;
                            @endphp
                            @foreach ($data as $d)
                                <tr id="tr{{ $d->id }}">
                                    <td style=" width:5%">{{ $nomor }}</td>
                                    <td>{{ $d->nama }}</td>
                                    <td>{{ $d->total }}</td>
                                  
                                </tr>

                                @php
                                    $nomor++;
                                @endphp
                            @endforeach




                        </tbody>
                    </table>
                    <!--end: Datatable-->
                </div>
            </div>

        </div>
        <!-- Container-fluid starts-->

    </div>
    <!-- Container-fluid Ends-->
    </div>
@endsection
