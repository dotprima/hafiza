@extends('layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Forms/</span> Horizontal Layouts</h4>

        <!-- Collapsible Section -->
        <div class="row my-4">
            <div class="col">
                <h6>Collapsible Section</h6>
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
                                                @foreach ($category as $item)
                                                    <option value="{{ $item->id }}">{{ $item->nama_kategori }}</option>
                                                @endforeach
                                            </select>



                                        </div>
                                        <div class="col mb-0">
                                            <label for="dobBasic" class="form-label">Merek</label>
                                            <select id="select2Basic2" class="select2 form-select form-select-lg"
                                                data-allow-clear="true" name="merek">
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
                                            <input type="number" class="form-control" name="pemakaian" id="select2Basic3">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col mb-3">
                                            <label for="dobBasic" class="form-label">SKU</label>
                                            <select id="select2Basic3" class="select2 form-select form-select-lg"
                                                data-allow-clear="true" name="merek">

                                            </select>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-label-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    @foreach ($surveys as $item)
                        @foreach ($item->answers as $answers)
                            <div class="card accordion-item">
                                <h2 class="accordion-header" id="headingDeliveryAddress">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseDeliveryAddress{{ $answers->id }}" aria-expanded="true"
                                        aria-controls="collapseDeliveryAddress{{ $answers->id }}">
                                        {{ $answers->electrics->category->nama_kategori }}
                                    </button>
                                </h2>
                                <div id="collapseDeliveryAddress{{ $answers->id }}" class="accordion-collapse collapse"
                                    aria-labelledby="headingDeliveryAddress" data-bs-parent="#collapsibleSection">
                                    <div class="accordion-body">
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <label class="col-sm-3 col-form-label text-sm-end"
                                                        for="collapsible-fullname">Merek</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="merek" class="form-control"
                                                            value="{{ $answers->electrics->nama_electric }}" />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="row">
                                                    <label class="col-sm-3 col-form-label text-sm-end"
                                                        for="collapsible-fullname">SKU</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="merek" class="form-control"
                                                            value="{{ $answers->electrics->tipe_electric }}" />
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
                                                            value="{{ $answers->watt }}" />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="row">
                                                    <label class="col-sm-3 col-form-label text-sm-end"
                                                        for="collapsible-fullname">Lama Pekaian / Hari</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="merek" class="form-control"
                                                            value="{{ $answers->pemakaian }}" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button class="dt-button create-new btn btn-primary" tabindex="0"
                                            aria-controls="DataTables_Table_0" type="button"><span><i
                                                    class="ti ti-plus me-sm-1"></i> <span
                                                    class="d-none d-sm-inline-block">Update Data
                                                    {{ $answers->electrics->category->nama_kategori }}
                                                </span></span></button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endforeach


                </div>
            </div>
        </div>


    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="../../assets/vendor/libs/select2/select2.css" />
@endsection

@section('script')
    <script src="../../assets/vendor/libs/select2/select2.js"></script>
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
                    dropdownParent: e.parent()
                })
            }), n.length && n.wrap('<div class="position-relative"></div>').select2({
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

            // Function to update SKU options
            function updateSkuOptions() {
                // Make an AJAX request to fetch SKU options based on selected kategori and merek
                $.ajax({
                    type: 'GET',
                    url: '/get-sku-options', // Replace with your actual route to fetch SKU options
                    data: {
                        kategori: kategori,
                        merek: merek
                    },
                    success: function(data) {
                        // Example: Assuming the server returns SKU options in data.skuOptions
                        var skuOptions = data.skuOptions;

                        // Clear existing options and add new SKU options to the select2 dropdown
                        $('#select2SKU').empty().select2({
                            data: skuOptions
                        });
                    },
                    error: function(error) {
                        console.error('Error fetching SKU options:', error);
                    }
                });
            }

            // Capture the data when any of the input fields change
            $('#select2Basic1, #select2Basic2, #select2Basic3').change(function() {
                // Get the values from the form
                kategori = $('#select2Basic1').val()
                merek = $('#select2Basic2').val()
                pemakaian = $('#nameBasic1').val();
                console.log('sd');
                // Check if all three fields have values
                if (kategori && merek && pemakaian) {
                    // Enable or show the "Save changes" button
                    $('#saveChangesBtn').prop('disabled', false);
                    console.log('asd');
                    // Update SKU options based on selected kategori and merek
                    updateSkuOptions();
                } else {
                    // Disable or hide the "Save changes" button
                    $('#saveChangesBtn').prop('disabled', true);
                }
            });

            // Capture the click event for the "Save changes" button
            $('#saveChangesBtn').click(function() {
                // Create an object with the data
                var formData = {
                    'kategori': kategori,
                    'merek': merek,
                    'pemakaian': pemakaian,
                    'sku': $('#select2SKU').val() // Add SKU to the formData
                };

                // Make an AJAX request to post the data to the server
                $.ajax({
                    type: 'POST',
                    url: '/your-submit-route', // Replace with your actual route
                    data: formData,
                    success: function(data) {
                        // Handle the success response

                        // Example: Assuming the server returns new options for select2
                        var newOptions = data.newOptions;

                        // Add new options to the select2 dropdowns
                        $('#select2Basic2').empty().select2({
                            data: newOptions.kategori
                        });

                        $('#select2Basic').empty().select2({
                            data: newOptions.merek
                        });

                        // Update SKU options based on selected kategori and merek
                        updateSkuOptions();

                        // You can also close the modal or perform other actions here
                        console.log('Data submitted successfully:', data);
                    },
                    error: function(error) {
                        // Handle the error response
                        console.error('Error submitting data:', error);
                    }
                });
            });
        });
    </script>
@endsection
