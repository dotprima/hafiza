@extends('layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Account Settings /</span> Account</h4>

        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-pills flex-column flex-md-row mb-4">
                    <li class="nav-item">
                        <a class="nav-link active" href="javascript:void(0);"><i class="ti-xs ti ti-users me-1"></i>
                            Account</a>
                    </li>

                </ul>
                <div class="card mb-4">
                    <h5 class="card-header">Profile Details</h5>

                    <hr class="my-0" />
                    <div class="card-body">


                        <!-- Contoh Form dengan Data Profil dari Database -->
                        <form id="formAccountSettings" method="POST" action="{{ route('update.profile') }}">
                            @csrf
                            <div class="row">
                                <!-- Input Full Name -->
                                <div class="mb-3 col-md-6">
                                    <label for="firstName" class="form-label">Full Name</label>
                                    <input class="form-control" type="text" id="firstName" name="firstName"
                                        value="{{ $user->name }}" autofocus />
                                </div>

                                <!-- Input Total Watt -->
                                <!-- Input Total Watt -->
                                <div class="mb-3 col-md-6">
                                    <label for="totalWatt" class="form-label">Total Watt</label>
                                    <select class="form-select" name="totalWatt" id="totalWatt">
                                        <option value="" disabled>Pilih Total Watt</option>
                                        <option value="900" {{ $user->total_watt == 900 ? 'selected' : '' }}>900 VA
                                            (R-1/TR - Konsumen rumah tangga kecil)</option>
                                        <option value="1300" {{ $user->total_watt == 1300 ? 'selected' : '' }}>1,300 VA -
                                            2,200 VA (R-1/TR - Konsumen rumah tangga kecil)</option>
                                        <option value="3500" {{ $user->total_watt == 3500 ? 'selected' : '' }}>3,500 VA -
                                            5,500 VA (R-2/TR - Konsumen rumah tangga menengah)</option>
                                        <option value="6600" {{ $user->total_watt == 6600 ? 'selected' : '' }}>6,600 VA ke
                                            atas (R-3/TR - Konsumen rumah tangga besar)</option>
                                     
                                    </select>
                                </div>


                                <!-- Input E-mail -->
                                <div class="mb-3 col-md-6">
                                    <label for="email" class="form-label">E-mail</label>
                                    <input class="form-control" type="text" id="email" name="email"
                                        value="{{ $user->email }}" placeholder="{{ $user->email }}" />
                                </div>

                                <!-- Dropdown Provinsi -->
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="provinsi">Provinsi</label>
                                    <select id="provinsi" class="select2 form-select" name="provinsi_">
                                        <option value="{{ $user->provinsi }}" selected>{{ $user->provinsi }}</option>
                                    </select>
                                </div>

                                <!-- Dropdown Kabupaten/Kota -->
                                <div class="mb-3 col-md-6">
                                    <label for="kabkota" class="form-label">Kota / Kabupaten</label>
                                    <select id="kabkota" class="select2 form-select" name="kabupaten_">
                                        <option value="{{ $user->kota }}" selected>{{ $user->kota }}</option>
                                    </select>
                                </div>

                                <!-- Dropdown Kecamatan -->
                                <div class="mb-3 col-md-6">
                                    <label for="kecamatan" class="form-label">Kecamatan</label>
                                    <select id="kecamatan" class="select2 form-select" name="kecamatan_">
                                        <option value="{{ $user->kecamatan }}" selected>{{ $user->kecamatan }}</option>
                                    </select>
                                </div>

                                <!-- Dropdown Desa/Kelurahan -->
                                <div class="mb-3 col-md-6">
                                    <label for="desakel" class="form-label">Desa</label>
                                    <select id="desakel" class="select2 form-select" name="desa_">
                                        <option value="{{ $user->desa }}" selected>{{ $user->desa }}</option>
                                    </select>
                                </div>

                                <input type="hidden" name="provinsi">
                                <input type="hidden" name="kota">
                                <input type="hidden" name="kecamatan">
                                <input type="hidden" name="desa">

                            </div>
                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary me-2">Save changes</button>
                                <button type="reset" class="btn btn-label-secondary">Cancel</button>
                            </div>
                        </form>

                    </div>
                    <!-- /Account -->
                </div>

            </div>
        </div>
    </div>
@endsection

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection


@section('script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            // Inisialisasi Select2 untuk setiap dropdown
            $('.select2').select2();

            // Ambil data Provinsi dari API saat halaman dimuat
            $.ajax({
                url: 'https://alamat.thecloudalert.com/api/provinsi/get/',
                type: 'GET',
                success: function(data) {
                    // Isi dropdown Provinsi dengan data dari API
                    var provinsiDropdown = $('#provinsi');

                    $.each(data.result, function(index, item) {
                        provinsiDropdown.append($('<option>', {
                            value: item.id,
                            text: item.text
                        }));
                    });
                }
            });

            // Tanggapi perubahan pada dropdown Provinsi
            $('#provinsi').on('change', function() {
                var selectedProvinsiId = $(this).val();
                var provinsi = $(this).find('option:selected').text();
                $('input[name="provinsi"]').val(provinsi);

                // Ambil data Kabupaten/Kota dari API berdasarkan Provinsi yang dipilih
                $.ajax({
                    url: 'https://alamat.thecloudalert.com/api/kabkota/get/?d_provinsi_id=' +
                        selectedProvinsiId,
                    type: 'GET',
                    success: function(data) {
                        // Isi dropdown Kabupaten/Kota dengan data dari API
                        var kabkotaDropdown = $('#kabkota');
                        kabkotaDropdown.empty(); // Kosongkan dropdown sebelum mengisi kembali
                        $.each(data.result, function(index, item) {
                            kabkotaDropdown.append($('<option>', {
                                value: item.id,
                                text: item.text
                            }));
                        });

                        // Perbarui tampilan Select2 setelah mengisi data
                        kabkotaDropdown.trigger('change');
                    }
                });
            });

            // Tanggapi perubahan pada dropdown Kabupaten/Kota
            $('#kabkota').on('change', function() {
                var selectedKabKotaId = $(this).val();
                var kota = $(this).find('option:selected').text();
                $('input[name="kota"]').val(kota);
                // Ambil data Kecamatan dari API berdasarkan Kabupaten/Kota yang dipilih
                $.ajax({
                    url: 'https://alamat.thecloudalert.com/api/kecamatan/get/?d_kabkota_id=' +
                        selectedKabKotaId,
                    type: 'GET',
                    success: function(data) {
                        // Isi dropdown Kecamatan dengan data dari API
                        var kecamatanDropdown = $('#kecamatan');
                        kecamatanDropdown.empty(); // Kosongkan dropdown sebelum mengisi kembali
                        $.each(data.result, function(index, item) {
                            kecamatanDropdown.append($('<option>', {
                                value: item.id,
                                text: item.text
                            }));
                        });

                        // Perbarui tampilan Select2 setelah mengisi data
                        kecamatanDropdown.trigger('change');
                    }
                });
            });

            // Tanggapi perubahan pada dropdown Kecamatan
            $('#kecamatan').on('change', function() {
                var selectedKecamatanId = $(this).val();
                var kecamatan = $(this).find('option:selected').text();
                $('input[name="kecamatan"]').val(kecamatan);
                // Ambil data Desa/Kelurahan dari API berdasarkan Kecamatan yang dipilih
                $.ajax({
                    url: 'https://alamat.thecloudalert.com/api/kelurahan/get/?d_kecamatan_id=' +
                        selectedKecamatanId,
                    type: 'GET',
                    success: function(data) {
                        // Isi dropdown Desa/Kelurahan dengan data dari API
                        var desakelDropdown = $('#desakel');
                        desakelDropdown.empty(); // Kosongkan dropdown sebelum mengisi kembali
                        $.each(data.result, function(index, item) {
                            desakelDropdown.append($('<option>', {
                                value: item.id,
                                text: item.text
                            }));
                        });

                        // Perbarui tampilan Select2 setelah mengisi data
                        desakelDropdown.trigger('change');
                    }
                });
            });

            $('#desakel').on('change', function() {
                var desa = $(this).find('option:selected').text();
                $('input[name="desa"]').val(desa);
                console.log(desa);
            });

            // Anda dapat menambahkan tanggapan serupa untuk dropdown Kecamatan dan Desa/Kelurahan.
        });
    </script>
@endsection
