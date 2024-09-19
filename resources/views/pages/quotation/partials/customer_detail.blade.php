<div class="app-content content" id="page1">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-center  col-12 mb-2 text-center">
                <h3 class="content-header-title mb-0 d-inline-block">Customer Details</h3>
            </div>
        </div>
        <div class="content-body">
            <section id="basic-form-layouts">
                <!--<div class="row">
            <div class="col-12">
                <div class="alert alert-success" role="alert">
                <strong>Success!</strong> Your profile has been updated.
                </div>
            </div>
            </div>-->
                <div class="row match-height">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-content collapse show">
                                <div class="card-body card-inner">
                                    <div class="col-md-12 row">
                                        <div class="col-md-8 mx-auto">
                                            <form class="form" id="pageoneform">
                                                @csrf
                                                <div class="form-body">
                                                    <div class="row">

                                                        <div class="col-md-3 tr"> <label for="customer-name"
                                                                class="fw-600">Customer Name</label></div>
                                                        <div class="col-md-9">
                                                            <div class="form-group ui-widget">
                                                                <input type="hidden" name="main_id"
                                                                    value="{{ !empty($quote) ? $quote->id : '' }}">
                                                                <input type="text"
                                                                    class="form-control border-primary"
                                                                    placeholder="" name="customer"
                                                                    id="customer-name" autocomplete="off"
                                                                    value="{{ !empty($quote) && $quote->customer_detail ? $quote->customer_detail->customer_name : '' }}"
                                                                    required>
                                                                <input type="hidden" name="if_new"
                                                                    value="{{ !empty($quote) && $quote->customer_detail ? $quote->customer_detail->id : '' }}"
                                                                    id="if_new">


                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 tr"> <label for="userinput1"
                                                                class="fw-600">Contact Number</label></div>
                                                        <div class="col-md-9">
                                                            <div class="form-group">
                                                                <input name="contact_num" id="contact_num"
                                                                    type="text"
                                                                    value="{{ !empty($quote) && $quote->customer_detail ? $quote->customer_detail->contact_number : '' }}"
                                                                    class="form-control border-primary"
                                                                    placeholder="">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 tr"> <label for="userinput1"
                                                                class="fw-600">Address</label></div>
                                                        <div class="col-md-9">
                                                            <div class="form-group">
                                                                <input name="address" id="address" type="text"
                                                                    value="{{ !empty($quote) && $quote->customer_detail ? $quote->customer_detail->address : '' }}"
                                                                    class="form-control border-primary"
                                                                    placeholder="">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 tr"> <label for="userinput1"
                                                                class="fw-600">Email</label></div>
                                                        <div class="col-md-9">
                                                            <div class="form-group">
                                                                <input name="email" id="email" type="email"
                                                                    value="{{ !empty($quote) && $quote->customer_detail ? $quote->customer_detail->email : '' }}"
                                                                    aria-required="true" aria-invalid="false"
                                                                    class="form-control border-primary valid"
                                                                    placeholder="">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 tr"> <label for="userinput1"
                                                                class="fw-600">Technician</label></div>
                                                        <div class="col-md-9">
                                                            <div class="form-group">
                                                                <input name="tech" id="tech" type="text"
                                                                    value="{{ !empty($quote) && $quote->customer_detail ? $quote->customer_detail->technician : '' }}"
                                                                    class="form-control border-primary"
                                                                    placeholder="">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 tr"> <label for="userinput1"
                                                                class="fw-600">Estimator</label></div>
                                                        <div class="col-md-9">
                                                            <div class="form-group">
                                                                <input name="quote_cust_estmtr"
                                                                    id="quote_cust_estmtr" type="text"
                                                                    value="{{ !empty($quote) && $quote->customer_detail ? $quote->customer_detail->estimator : '' }}"
                                                                    class="form-control border-primary"
                                                                    placeholder="">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 text-center">
                                                            <h4 class="card-title">
                                                                <input type="checkbox" name="email_check"
                                                                    id="email_check" class="checkbox-custom"
                                                                    value="{{ !empty($quote) && $quote->customer_detail ? $quote->customer_detail->send_email_to_customer : '' }}">
                                                                <strong>Checking this box will
                                                                    send email to the above mentioned Customer
                                                                    email</strong>
                                                            </h4>
                                                        </div>

                                                        <div class="col-md-12 text-center">
                                                            <button id="ss" type="button"
                                                                class="btn  my-quotations-btn next-btn">Next</button>
                                                        </div>
                                                    </div>

                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
<!--Modal-->
<div class="modal fade" id="userdetailmodal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Confirm User Details</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body text-center modal-inner">
                <p class="modal-text">Are the customer details correct?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn  my-quotations-btn next-btn" data-dismiss="modal">No, Edit
                    Details</button>
                <button onclick="next_page_vehical(2) " type="button" class="btn  my-quotations-btn next-btn"
                    data-dismiss="modal">Yes, Confirm</button>
            </div>
        </div>

    </div>
</div>
