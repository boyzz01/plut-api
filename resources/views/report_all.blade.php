@extends('main2')

@section('container')

    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
       
        <div class="container-fluid">



    
            <div class="card card-custom" >
                <div class="card-header flex-wrap py-5" style="justify-content: center">
                <div class="card-toolbar">
                    <!--begin::Dropdown-->

                    <!--end::Dropdown-->
                   
                  
        
                 


                    <!--end::Button-->

                </div>
            </div>

                <div class="card-body">
                    <!--begin: Datatable-->
                    <table class="table table-bordered table-checkable" id="tes">
                        <thead>
                            <tr>
                                <th style="width: 5%">No</th>
                                <th>Produk</th>
                                <th>UMKM</th>
                                <th>Terjual</th>
                                <th>Tanggal</th>

                            </tr>
                        </thead>
                        <tbody>


                            @php
                                $nomor = 1;
                            @endphp
                            @foreach ($data as $d)
                                <tr id="tr{{ $d->id }}">
                                    <td style=" width:5%">{{ $nomor }}</td>
                                   
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="symbol symbol-circle symbol-35 mr-3">
                                                <p> <a href="#" class="ratio img-responsive img-circle" style="background-image: url({{ $d->foto }});width:50px"></a>
                                                </p>  {{-- <img class="rounded-circle" alt="Pic" src="{{ $d->foto }}"> --}}
                                            </div>
                                            <div>
                                                <a href="#" class="text-dark-75 "> &nbsp{{ $d->nama }}</a>
                                            
                                            </div>
                                        </div>
                                    </div></td>
                                    <td>{{ $d->nama_umkm }}</td>
                                    <td>{{ $d->total }}</td>

                                    @php
                                        $parts = explode(' ', $d->tanggal);
                                        $newDate = date("d-m-Y", strtotime($parts[0]));
                                    @endphp
                                    <td>{{  $newDate }}</td>
                                  
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
