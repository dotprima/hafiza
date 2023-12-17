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
                    @foreach ($surveys as $item)
                        @foreach ($item->answers as $answers)
                            <div class="card accordion-item">
                                <h2 class="accordion-header" id="headingDeliveryAddress">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseDeliveryAddress{{$answers->id}}" aria-expanded="true"
                                        aria-controls="collapseDeliveryAddress{{$answers->id}}">
                                        {{$answers->electrics->category->nama_kategori}}
                                    </button> 
                                </h2>
                                <div id="collapseDeliveryAddress{{$answers->id}}"  class="accordion-collapse collapse"
                                    aria-labelledby="headingDeliveryAddress" data-bs-parent="#collapsibleSection">
                                    <div class="accordion-body">
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <label class="col-sm-3 col-form-label text-sm-end"
                                                        for="collapsible-fullname">Full
                                                        Name</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" id="collapsible-fullname" class="form-control"
                                                            placeholder="John Doe" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <label class="col-sm-3 col-form-label text-sm-end"
                                                        for="collapsible-phone">Phone
                                                        No</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" id="collapsible-phone"
                                                            class="form-control phone-mask" placeholder="658 799 8941"
                                                            aria-label="658 799 8941" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <label class="col-sm-3 col-form-label text-sm-end"
                                                        for="collapsible-address">Address</label>
                                                    <div class="col-sm-9">
                                                        <textarea name="collapsible-address" class="form-control" id="collapsible-address" rows="4"
                                                            placeholder="1456, Mall Road"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <div class="row">
                                                        <label class="col-sm-3 col-form-label text-sm-end"
                                                            for="collapsible-pincode">Pincode</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" id="collapsible-pincode"
                                                                class="form-control" placeholder="658468" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <div class="row">
                                                        <label class="col-sm-3 col-form-label text-sm-end"
                                                            for="collapsible-landmark">Landmark</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" id="collapsible-landmark"
                                                                class="form-control" placeholder="Nr. Wall Street" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <label class="col-sm-3 col-form-label text-sm-end"
                                                        for="collapsible-city">City</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" id="collapsible-city" class="form-control"
                                                            placeholder="Jackson" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <label class="col-sm-3 col-form-label text-sm-end"
                                                        for="collapsible-state">State</label>
                                                    <div class="col-sm-9">
                                                        <select id="collapsible-state" class="select2 form-select"
                                                            data-allow-clear="true">
                                                            <option value="">Select</option>
                                                            <option value="AL">Alabama</option>
                                                            <option value="AK">Alaska</option>
                                                            <option value="AZ">Arizona</option>
                                                            <option value="AR">Arkansas</option>
                                                            <option value="CA">California</option>
                                                            <option value="CO">Colorado</option>
                                                            <option value="CT">Connecticut</option>
                                                            <option value="DE">Delaware</option>
                                                            <option value="DC">District Of Columbia</option>
                                                            <option value="FL">Florida</option>
                                                            <option value="GA">Georgia</option>
                                                            <option value="HI">Hawaii</option>
                                                            <option value="ID">Idaho</option>
                                                            <option value="IL">Illinois</option>
                                                            <option value="IN">Indiana</option>
                                                            <option value="IA">Iowa</option>
                                                            <option value="KS">Kansas</option>
                                                            <option value="KY">Kentucky</option>
                                                            <option value="LA">Louisiana</option>
                                                            <option value="ME">Maine</option>
                                                            <option value="MD">Maryland</option>
                                                            <option value="MA">Massachusetts</option>
                                                            <option value="MI">Michigan</option>
                                                            <option value="MN">Minnesota</option>
                                                            <option value="MS">Mississippi</option>
                                                            <option value="MO">Missouri</option>
                                                            <option value="MT">Montana</option>
                                                            <option value="NE">Nebraska</option>
                                                            <option value="NV">Nevada</option>
                                                            <option value="NH">New Hampshire</option>
                                                            <option value="NJ">New Jersey</option>
                                                            <option value="NM">New Mexico</option>
                                                            <option value="NY">New York</option>
                                                            <option value="NC">North Carolina</option>
                                                            <option value="ND">North Dakota</option>
                                                            <option value="OH">Ohio</option>
                                                            <option value="OK">Oklahoma</option>
                                                            <option value="OR">Oregon</option>
                                                            <option value="PA">Pennsylvania</option>
                                                            <option value="RI">Rhode Island</option>
                                                            <option value="SC">South Carolina</option>
                                                            <option value="SD">South Dakota</option>
                                                            <option value="TN">Tennessee</option>
                                                            <option value="TX">Texas</option>
                                                            <option value="UT">Utah</option>
                                                            <option value="VT">Vermont</option>
                                                            <option value="VA">Virginia</option>
                                                            <option value="WA">Washington</option>
                                                            <option value="WV">West Virginia</option>
                                                            <option value="WI">Wisconsin</option>
                                                            <option value="WY">Wyoming</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <label class="col-sm-3 col-form-label text-sm-end">Address Type</label>
                                                    <div class="col-sm-9">
                                                        <div class="form-check mb-2">
                                                            <input name="collapsible-addressType" class="form-check-input"
                                                                type="radio" value=""
                                                                id="collapsible-addressType-home" checked="" />
                                                            <label class="form-check-label"
                                                                for="collapsible-addressType-home">
                                                                Home (All day delivery)
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input name="collapsible-addressType" class="form-check-input"
                                                                type="radio" value=""
                                                                id="collapsible-addressType-office" />
                                                            <label class="form-check-label"
                                                                for="collapsible-addressType-office">
                                                                Office (Delivery between 10 AM - 5 PM)
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
@endsection

@section('script')
@endsection
