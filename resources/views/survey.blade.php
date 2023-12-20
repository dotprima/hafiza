@extends('layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Survey Peralatan Listrik</h4>

        <!-- Collapsible Section -->
        <div class="row my-4">
            <div class="col">
                <h6></h6>
                <div class="accordion" id="collapsibleSection">
                    <!-- Delivery Address -->
                    <div class="text-end">
                        <button class="dt-button create-new btn btn-primary" tabindex="0" aria-controls="DataTables_Table_0"
                            type="button" data-bs-toggle="modal" data-bs-target="#basicModal">
                            <span><i class="ti ti-plus me-sm-1"></i> <span class="d-none d-sm-inline-block">Add New
                                    Record</span></span>
                        </button>
                    </div>
                    <br>
                    <!-- Modal -->
                    <div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <form id="equipmentForm" action="{{ route('survey.store') }}" method="POST">
                                    @csrf

                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel1">Peralatan Listrik</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">

                                        <div class="row g-2">
                                            <div class="col mb-0">
                                                <label for="emailBasic" class="form-label">Kategori</label>
                                                <select id="select2Basic1" class="select2 form-select form-select-lg"
                                                    data-allow-clear="true" name="kategori">
                                                    <option>Pilih</option>
                                                    @foreach ($category as $item)
                                                        <option value="{{ $item->id }}">{{ $item->nama_kategori }}
                                                        </option>
                                                    @endforeach
                                                </select>



                                            </div>
                                            <div class="col mb-0">
                                                <label for="dobBasic" class="form-label">Merek</label>
                                                <select id="select2Basic2" class="select2 form-select form-select-lg"
                                                    data-allow-clear="true" name="merek">
                                                    <option>Pilih</option>
                                                    @foreach ($merek as $item)
                                                        <option value="{{ $item->id }}">{{ $item->nama_merek }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col mb-3">
                                                <label for="nameBasic" class="form-label">Total Pemakain Rata - Rata / Hari
                                                </label>
                                                <input type="number" class="form-control" name="pemakaian" id="pemakaian">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col mb-3">
                                                <label for="dobBasic" class="form-label">SKU</label>
                                                <div class="position-relative">
                                                    <select id="select2-id" class="select2 form-select form-select-lg"
                                                        name="SKU">
                                                        <!-- Opsi akan ditambahkan oleh JavaScript -->
                                                    </select>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-label-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary" onclick="submitForm()">Save
                                            changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    @php
                        $data = [];
                        function formatRupiah($value)
                        {
                            return 'Rp.' . number_format($value, 2, ',', '.');
                        }
                        if (!function_exists('hitungBiayaListrik')) {
                            function hitungBiayaListrik($daya, $waktuPakai, $hargaPerKWh)
                            {
                                // Konversi daya dari Watt ke Kilowatt
                                $dayaKWh = $daya / 1000;

                                // Hitung konsumsi listrik dalam kWh
                                $konsumsiListrik = $dayaKWh * $waktuPakai;

                                // Hitung biaya listrik
                                $biayaListrik = $konsumsiListrik * $hargaPerKWh;

                                return $biayaListrik;
                            }
                        }
                    @endphp


                    @foreach ($surveys as $survey)
                        <div class="card accordion-item">
                            <h2 class="accordion-header" id="headingDeliveryAddress">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapseDeliveryAddress{{ $survey->id }}" aria-expanded="true"
                                    aria-controls="collapseDeliveryAddress{{ $survey->id }}">
                                    {{ optional(optional($survey->electric)->category)->nama_kategori }} &nbsp;&nbsp;
                                    {!! optional($survey->electric)->hemat ? '<i class="fas fa-seedling"></i>' : '' !!}
                                </button>
                            </h2>
                            <div id="collapseDeliveryAddress{{ $survey->id }}" class="accordion-collapse collapse"
                                aria-labelledby="headingDeliveryAddress" data-bs-parent="#collapsibleSection">
                                <div class="accordion-body">
                                    <h5 style="margin-left: 110px">Peralatan listrik Saya</h5>
                                    <div class="row g-3">

                                        <div class="col-md-6">
                                            <div class="row">
                                                <label class="col-sm-3 col-form-label text-sm-end"
                                                    for="collapsible-fullname">Merek</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="merek" class="form-control"
                                                        value="{{ optional($survey->electric)->merek->nama_merek }}"
                                                        readonly />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="row">
                                                <label class="col-sm-3 col-form-label text-sm-end"
                                                    for="collapsible-fullname">SKU</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="merek" class="form-control"
                                                        value="{{ optional($survey->electric)->nama_electric }}"
                                                        readonly />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <div class="row">
                                                <label class="col-sm-3 col-form-label text-sm-end"
                                                    for="collapsible-fullname">Watt</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="merek" class="form-control"
                                                        value="{{ optional($survey->electric)->watt }}" readonly />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="row">
                                                <label class="col-sm-3 col-form-label text-sm-end"
                                                    for="collapsible-fullname">Lama Pekaian / Hari</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="pemakaian" class="form-control"
                                                        value="{{ $survey->pemakaian }}" readonly />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <hr>
                                <div class="accordion-body">
                                    <h5 style="margin-left: 110px">Rekomendasi Peralatan listrik <i
                                            class="fas fa-seedling"></i></h5>
                                    @php
                                        $hemat = \App\Models\Electric::with('merek', 'category')
                                            ->where('hemat', 1)
                                            ->where('id_kategori', $survey->electric->id_kategori)
                                            ->first();

                                    @endphp

                                    @if ($hemat)
                                        <div class="row g-3">

                                            <div class="col-md-4">
                                                <div class="row">
                                                    <label class="col-sm-3 col-form-label text-sm-end"
                                                        for="collapsible-fullname">Merek</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="merek" class="form-control"
                                                            value="{{ optional($hemat)->merek->nama_merek }}" readonly />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="row">
                                                    <label class="col-sm-3 col-form-label text-sm-end"
                                                        for="collapsible-fullname">SKU</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="merek" class="form-control"
                                                            value="{{ optional($hemat)->nama_electric }}" readonly />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="row">
                                                    <label class="col-sm-3 col-form-label text-sm-end"
                                                        for="collapsible-fullname">Watt</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="merek" class="form-control"
                                                            value="{{ optional($hemat)->watt }}" readonly />
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        @php
                                            $responden = hitungBiayaListrik($survey->electric->watt, $survey->pemakaian, auth()->user()->tarif);

                                            $hemat_terus = hitungBiayaListrik($hemat->watt, $survey->pemakaian, auth()->user()->tarif);

                                        @endphp
                                        <hr>
                                        <div class="row g-3">
                                            <h5 style="margin-left: 110px">Perbandingan Listik</h5>
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <label class="col-sm-3 col-form-label text-sm-end"
                                                        for="collapsible-fullname">Biaya listrik Saya
                                                        {{ $survey->electric->watt }}W / Hari</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="merek" class="form-control"
                                                            value="{{ $responden }}" readonly />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="row">
                                                    <label class="col-sm-3 col-form-label text-sm-end"
                                                        for="collapsible-fullname">Biaya listrik Rekomenasi
                                                        {{ $hemat->watt }}W / Hari</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="merek" class="form-control"
                                                            value="{{ $hemat_terus }}" readonly />
                                                    </div>
                                                </div>
                                            </div>


                                            @php

                                                $data_baru = ['listrik_responden' => $responden, 'listrik_rekomendasi' => $hemat_terus, 'kategori' => $survey->electric->category->nama_kategori];

                                                array_push($data, $data_baru);

                                            @endphp
                                        </div>
                                    @endif



                                    <br>
                                    <div class="row g-3">
                                        <br>
                                        <form id="deleteForm{{ $survey->id }}"
                                            action="{{ route('survey.delete', ['id' => $survey->id]) }}" method="post">
                                            @csrf
                                            @method('DELETE')

                                            <button type="button" class="dt-button create-new btn btn-danger"
                                                onclick="confirmDelete()">
                                                <i class="ti ti-plus me-sm-1"></i> Hapus
                                                {{ optional(optional($survey->electric)->category)->nama_kategori }}
                                            </button>
                                            <script>
                                                function confirmDelete() {
                                                    Swal.fire({
                                                        title: 'Are you sure?',
                                                        text: 'You will not be able to recover this survey!',
                                                        icon: 'warning',
                                                        showCancelButton: true,
                                                        confirmButtonText: 'Yes, delete it!',
                                                        cancelButtonText: 'Cancel',
                                                        reverseButtons: true,
                                                    }).then((result) => {
                                                        if (result.isConfirmed) {
                                                            // Submit the form when confirmed
                                                            document.getElementById('deleteForm{{ $survey->id }}').submit();
                                                        }
                                                    });
                                                }
                                            </script>
                                        </form>
                                    </div>


                                </div>
                            </div>
                        </div>
                    @endforeach
                    @php
                        $totalResponden = 0;
                        $totalRekomendasi = 0;
                    @endphp
                    <div class="row mt-3">

                        @forelse ($data as $item)
                            @php
                                $totalResponden += $item['listrik_responden'];
                                $totalRekomendasi += $item['listrik_rekomendasi'];
                            @endphp
                            <div class="col-md-6" style="padding-bottom:20px">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                <h5 class="card-title">{{ $item['kategori'] }}</h5>
                                                <p class="card-text">Biaya Listrik Saya <br> Per Hari
                                                    {{ formatRupiah($item['listrik_responden']) }}</p>
                                                <p class="card-text">Total Listrik Saya <br> Per 30 Hari
                                                    {{ formatRupiah($item['listrik_responden'] * 30) }}</p>
                                            </div>
                                            <div class="col">
                                                <h5 class="card-title">&nbsp;</h5>
                                                <p class="card-text">Biaya Listrik Rekomendasi <br> Per Hari
                                                    {{ formatRupiah($item['listrik_rekomendasi']) }}</p>
                                                <p class="card-text">Total Listrik Rekomendasi <br> Per 30 Hari
                                                    {{ formatRupiah($item['listrik_rekomendasi'] * 30) }}</p>
                                            </div>



                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-md-12">
                                <p>No data available.</p>
                            </div>
                        @endforelse

                    </div>
                    <div class="row mt-3">
                        <div class="col" style="padding-bottom:20px">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h5 class="card-title">Total Biaya Peralatan Listrik</h5>
                                            <p class="card-text">Biaya Listrik Saya <br> Per Hari
                                                {{ formatRupiah($totalResponden) }}</p>
                                            <p class="card-text">Total Listrik Saya <br> Per 30 Hari
                                                {{ formatRupiah($totalResponden * 30) }}</p>
                                        </div>
                                        <div class="col">
                                            <h5 class="card-title">&nbsp;</h5>
                                            <p class="card-text">Biaya Listrik Rekomendasi <br> Per Hari
                                                {{ formatRupiah($totalRekomendasi) }}</p>
                                            <p class="card-text">Total Listrik Rekomendasi <br> Per 30 Hari
                                                {{ formatRupiah($totalRekomendasi * 30) }}</p>
                                        </div>
                                    </div>
                                    <br>
                                    <br>
                                    <div class="row">
                                        <div class="col" style="text-align: center">
                                            @php
                                                $harian = intval($totalResponden - $totalRekomendasi);
                                                $bulanan = intval($totalResponden-$totalRekomendasi)* 30;
                                            @endphp
                                            <h5 class="card-title">Anda Bisa Menghemat </h5>
                                            <p class="card-text">Biaya Listrik Saya <br> Per Hari
                                                {{ formatRupiah($harian) }}</p>
                                            <p class="card-text">Total Listrik Saya <br> Per 30 Hari
                                                {{ formatRupiah($bulanan) }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="../../assets/vendor/libs/select2/select2.css" />
    <link rel="stylesheet" href="../../assets/vendor/libs/sweetalert2/sweetalert2.css" />
@endsection

@section('script')
    <script src="../../assets/vendor/libs/select2/select2.js"></script>
    <script src="../../assets/vendor/libs/sweetalert2/sweetalert2.js"></script>
    <script>
        "use strict";
        $(function() {
            var e = $(".selectpicker"),
                t = $(".select2"),
                n = $(".select2-icons");

            function i(e) {
                return e.id ? "<i class='" + $(e.element).data("icon") + " me-2'></i>" + e.text : e.text
            }
            e.length && e.selectpicker(), t.length && t.each(function() {
                var e = $(this);
                e.wrap('<div class="position-relative"></div>').select2({
                    placeholder: "Select value",
                    tags: true,
                    dropdownParent: e.parent()
                })
            }), n.length && n.wrap('<div class="position-relative"></div>').select2({
                tags: true,
                minimumInputLength: 2,
                dropdownParent: n.parent(),
                templateResult: i,
                templateSelection: i,
                escapeMarkup: function(e) {
                    return e
                }
            })
        });
    </script>
    <script>
        $(document).ready(function() {
            var kategori, merek, pemakaian, sku;



            function updateSkuOptions() {
                // Panggil AJAX untuk mendapatkan data
                $.ajax({
                    url: '{{ route('electric.getDataElectric') }}',
                    data: {
                        kategori: kategori,
                        merek: merek
                    },
                    dataType: 'json',
                    success: function(response) {
                        // Handle response dari server
                        var select2Options = $('#select2-id'); // Gantilah dengan ID Select2 yang sesuai

                        // Hapus semua opsi sebelum menambahkan yang baru
                        select2Options.empty();

                        // Tambahkan opsi berdasarkan data dari server
                        if (response.status === 'success') {
                            $.each(response.data, function(index, item) {
                                select2Options.append($('<option>', {
                                    value: item.id,
                                    text: item.nama_electric
                                }));
                            });
                        } else {
                            // Jika data tidak tersedia, tambahkan opsi "New Option"
                            select2Options.append($('<option>', {
                                value: 'new-option',
                                text: 'New Option'
                            }));
                        }

                        // Trigger event change untuk Select2 agar memperbarui tampilan
                        select2Options.trigger('change');
                    },
                    error: function() {
                        // Handle jika terjadi error pada saat melakukan AJAX request
                        console.error('Error connecting to the server');
                    }
                });
            }

            // Capture the data when any of the input fields change
            $('#select2Basic1, #select2Basic2, #pemakaian').change(function() {
                // Get the values from the form
                kategori = $('#select2Basic1').val()
                merek = $('#select2Basic2').val()
                pemakaian = $('#pemakaian').val();

                // Check if all three fields have values
                if (kategori !== "Pilih" && merek !== "Pilih" && pemakaian !== '') {
                    // Enable or show the "Save changes" button
                    $('#saveChangesBtn').prop('disabled', false);

                    // Update SKU options based on selected kategori and merek
                    updateSkuOptions();
                } else {
                    // Disable or hide the "Save changes" button
                    $('#saveChangesBtn').prop('disabled', true);
                }
            });


        });
    </script>
    <script>
        // Display success or error messages from the session
        @if (session('success'))
            Swal.fire('Success', '{{ session('success') }}', 'success');
        @endif

        @if (session('error'))
            Swal.fire('Error', '{{ session('error') }}', 'error');
        @endif
    </script>
    <script>
        function submitForm() {
            // Serialize the form data
            var formData = $('#equipmentForm').serialize();

            // Make an AJAX POST request
            $.ajax({
                type: 'POST',
                url: "{{ route('survey.store') }}",
                data: formData,
                success: function(data) {
                    // Handle success, e.g., close the modal or show a success message
                    $('#myModal').modal('hide');
                    // Add any additional logic based on your requirements
                    // Show SweetAlert success notification
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Survey answer created successfully!',
                    }).then(function() {
                        // Reload the page
                        location.reload();
                    });
                },
                error: function(xhr) {
                    // Handle errors, e.g., show an error message
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        // Display validation errors
                        var errorMessages = xhr.responseJSON.errors;
                        var errorMessageString = '';

                        $.each(errorMessages, function(key, value) {
                            errorMessageString += value[0] + '<br>';
                        });

                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            html: errorMessageString,
                        });
                    } else {
                        // Generic error message
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Harap Mengisi Informasi Di Menu Profil.',
                        });
                    }
                }
            });
        }
    </script>
@endsection
