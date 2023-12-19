@extends('layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Data Electrik</h4>

        <!-- DataTable with Buttons -->
        <div class="card">
            <div class="card-datatable table-responsive pt-0">
                <table class="datatables-basic table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Type</th>
                            <th>Merek</th>
                            <th>Kategori</th>
                            <th>Watt</th>
                            <th>Hemat Energi</th>
                            <th>Created At</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>




    </div>

    <!-- Modal -->
    <div class="modal fade" id="basicModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="equipmentForm" action="{{ route('survey.store') }}" method="POST">
                    @csrf

                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Peralatan Listrik</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                                <label for="dobBasic" class="form-label">SKU</label>
                                <div class="position-relative">
                                    <input type="text" class="form-control" name="SKU">

                                    </input>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="submitForm()">Save
                            changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="editWattForm" action="{{ route('survey.edit.watt') }}" method="POST">
                    @csrf

                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel1">Peralatan Listrik</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col mb-3">
                                <label for="dobBasic" class="form-label">Watt</label>
                                <div class="position-relative">
                                    <input type="hidden" class="form-control" name="id" id="idedit">
                                    <input type="text" class="form-control" name="watt" id="wattedit">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="saveChangesBtn">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="../../assets/vendor/libs/select2/select2.css" />
    <link rel="stylesheet" href="../../assets/vendor/libs/sweetalert2/sweetalert2.css" />
@endsection

@section('script')
    <!-- Vendors JS -->
    <script src="../../assets/vendor/libs/datatables/jquery.dataTables.js"></script>
    <script src="../../assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>
    <script src="../../assets/vendor/libs/datatables-responsive/datatables.responsive.js"></script>
    <script src="../../assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.js"></script>
    <script src="../../assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.js"></script>
    <script src="../../assets/vendor/libs/datatables-buttons/datatables-buttons.js"></script>
    <script src="../../assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.js"></script>
    <script src="../../assets/vendor/libs/jszip/jszip.js"></script>
    <script src="../../assets/vendor/libs/pdfmake/pdfmake.js"></script>
    <script src="../../assets/vendor/libs/datatables-buttons/buttons.html5.js"></script>
    <script src="../../assets/vendor/libs/datatables-buttons/buttons.print.js"></script>
    <!-- Flat Picker -->
    <script src="../../assets/vendor/libs/moment/moment.js"></script>
    <script src="../../assets/vendor/libs/flatpickr/flatpickr.js"></script>
    <!-- Row Group JS -->
    <script src="../../assets/vendor/libs/datatables-rowgroup/datatables.rowgroup.js"></script>
    <script src="../../assets/vendor/libs/datatables-rowgroup-bs5/rowgroup.bootstrap5.js"></script>
    <!-- Form Validation -->
    <script src="../../assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js"></script>
    <script src="../../assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js"></script>
    <script src="../../assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js"></script>


    <script src="../../assets/vendor/libs/select2/select2.js"></script>
    <script src="../../assets/vendor/libs/sweetalert2/sweetalert2.js"></script>
    <!-- Page JS -->
    <script>
        

        function updateHemat(id) {
            var confirmationText = (status != 1) ? 'Apakah Anda yakin ingin mematikan status Hemat?' :
                'Apakah Anda yakin ingin menghidupkan status Hemat?';
            // Show SweetAlert2 confirmation dialog
            Swal.fire({
                title: 'Are you sure?',
                text: confirmationText,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, update it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Make an AJAX request to update the 'hemat' field
                    $.ajax({
                        url: `/electrics/${id}/update-hemat`,
                        type: 'PUT',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },

                        success: function(data) {
                            // Show SweetAlert2 success message
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: data.message,
                            }).then(function() {
                                // Reload the page
                                $('.datatables-basic').DataTable().ajax.reload();
                                // Close the modal or perform any other actions
                               
                            });
                        },
                        error: function() {
                            // Show SweetAlert2 error message
                            Swal.fire({
                                icon: 'error',
                                title: 'Error!',
                                text: 'An error occurred while updating Hemat status',
                            });
                        }
                    });
                }
            });
        }

        $(document).ready(function() {
            // Capture click event on the 'Save changes' button
            $('#saveChangesBtn').on('click', function() {
                // Prepare the data to be sent
                var formData = {
                    _token: '{{ csrf_token() }}',
                    id: $('#idedit').val(),
                    watt: $('#wattedit').val()
                };

                // Perform the AJAX request
                $.ajax({
                    url: '{{ route('survey.edit.watt') }}',
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Survey answer created successfully!',
                        }).then(function() {
                            $('.datatables-basic').DataTable().ajax.reload();
                            // Close the modal or perform any other actions
                            $('#editModal').modal('hide');
                        });

                    },
                    error: function(xhr, status, error) {
                        // Handle errors
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            // Capture click event on the 'Info' button
            $('body').on('click', '.btn-info', function() {
                // Get the electric ID from the data attribute
                var electricId = $(this).data('electric-id');

                // Perform your AJAX request with the electricId
                // You can use the electricId variable in your AJAX data
                $.ajax({
                    url: '/electric/' + electricId,
                    type: 'POST',
                    data: {
                        electric_id: electricId,
                        _token: '{{ csrf_token() }}', // Add the CSRF token
                    },
                    success: function(response) {


                        // Set the value of the input field with the watt value from the response
                        $('#wattedit').val(response.electric.watt);
                        $('#idedit').val(response.electric.id);


                    },
                    error: function(xhr, status, error) {
                        // Handle errors
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>
    <script>
        $(function() {
            var dt_basic_table = $('.datatables-basic'),
                dt_complex_header_table = $('.dt-complex-header'),
                dt_row_grouping_table = $('.dt-row-grouping'),
                dt_multilingual_table = $('.dt-multilingual'),
                dt_basic;

            // DataTable with buttons
            // --------------------------------------------------------------------

            if (dt_basic_table.length) {
                dt_basic = dt_basic_table.DataTable({
                    ajax: '{{ route('electric.data') }}',
                    columns: [{
                            data: 'id',
                            name: 'id'
                        },
                        {
                            data: 'nama_electric',
                            name: 'nama_electric'
                        },
                        {
                            data: 'merek_nama',
                            name: 'merek.nama_merek'
                        },
                        {
                            data: 'category_nama',
                            name: 'category.nama_kategori'
                        },

                        {
                            data: 'watt',
                            name: 'watt'
                        },
                        {
                            data: 'hemat',
                            name: 'hemat',
                            render: function(data, type, row) {
                                if (data === 1) {
                                    return '<i class="fas fa-seedling"></i> Hemat Energi';
                                } else {
                                    return '';
                                }
                            }
                        },

                        {
                            data: 'created_at',
                            name: 'created_at',
                            render: function(data, type, row) {
                                // Format the 'created_at' timestamp to 'DD MMMM YYYY'
                                return moment(data).format('DD MMMM YYYY');
                            }
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        },
                    ],
                    order: [
                        [6, 'desc']
                    ],
                    dom: '<"card-header flex-column flex-md-row"<"head-label text-center"><"dt-action-buttons text-end pt-3 pt-md-0"B>><"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                    displayLength: 10,
                    lengthMenu: [10, 25, 50, 75, 100],
                    buttons: [{
                        text: '<i class="ti ti-plus me-sm-1"></i> <span class="d-none d-sm-inline-block">Tambah Peralatan Listrik</span>',
                        className: 'create-new btn btn-primary',
                        action: function() {
                            // Open the modal when the button is clicked
                            $('#basicModal').modal('show');
                        }
                    }],

                    responsive: {
                        details: {
                            display: $.fn.dataTable.Responsive.display.modal({
                                header: function(row) {
                                    var data = row.data();
                                    return 'Details of ' + data['full_name'];
                                }
                            }),
                            type: 'column',
                            renderer: function(api, rowIdx, columns) {
                                var data = $.map(columns, function(col, i) {
                                    return col.title !==
                                        '' // ? Do not show row in modal popup if title is blank (for check box)
                                        ?
                                        '<tr data-dt-row="' +
                                        col.rowIndex +
                                        '" data-dt-column="' +
                                        col.columnIndex +
                                        '">' +
                                        '<td>' +
                                        col.title +
                                        ':' +
                                        '</td> ' +
                                        '<td>' +
                                        col.data +
                                        '</td>' +
                                        '</tr>' :
                                        '';
                                }).join('');

                                return data ? $('<table class="table"/><tbody />').append(data) : false;
                            }
                        }
                    }
                });
                $('div.head-label').html('<h5 class="card-title mb-0">List Data</h5>');
            }


        });
    </script>

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
        function submitForm() {
            // Serialize the form data
            var formData = $('#equipmentForm').serialize();

            // Make an AJAX POST request
            $.ajax({
                type: 'POST',
                url: "{{ route('electric.store') }}",
                data: formData,
                success: function(data) {

                    // Show SweetAlert success notification
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Survey answer created successfully!',
                    }).then(function() {
                        $('.datatables-basic').DataTable().ajax.reload();
                        // Close the modal or perform any other actions
                        $('#basicModal').modal('hide');
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
                            text: 'An error occurred while submitting the survey answer.',
                        });
                    }
                }
            });
        }
    </script>
@endsection
