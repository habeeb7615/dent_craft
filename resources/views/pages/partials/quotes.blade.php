@if (count($quotes) == 0)
    <div class="no-car-data-wrapper">
        <div class="no-car-data-content">
             <h6 style = "font-family: BANKGTHD_0;">There is no data available in table</h6>
            {{-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.</p> --}}
        </div>
    </div>
@else
    <div class="car-quotation-wrapper">
        @foreach ($quotes as $quote)
            <div class="car-quotation-box">
                <div class="car-info-wrapper">
                    <div class="car-info-image">
                        <figure>
                            <img src="{{ count($quote->assessed_images) > 0 ? $quote->assessed_images->first()->image_url : asset('new-theme/images/not_avaliable.png') }}" alt="">
                        </figure>
                    </div>
                    <div class="car-info-content">
                        <ul>
                            <li>
                                <span class="col-5 pl-0">Quote ID</span>
                                <strong class="text-primary word-break">{{ $quote->quote_id }}</strong>
                            </li>
                            <li>
                                <span class="col-5 pl-0">Quote Date</span>
                                <strong>{{ $quote->created_at }}</strong>
                            </li>
                            <li>
                                <span class="col-5 pl-0">Customer</span>
                                
                                
                                <strong>{{ $quote->customer_detail ? $quote->customer_detail->customer_name : "--"  }}</strong>
                            </li>
                            <li>
                                <span class="col-5 pl-0">Technician</span>
                                <strong>{{ $quote->customer_detail ?  $quote->customer_detail->technician : "--" }}</strong>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="car-info-edit-delete">
                    <a href="{{ route('admin.quotation.quotation-summary', base64_encode($quote->id)) }}" target="_blank">
                        <img class="view-quote" />
                        <span>View</span>
                    </a>
                    <a href="{{ route('admin.quotation.edit_quote', base64_encode($quote->id)) }}" target="_blank">
                        <img class="edit-quote" />
                        <span>Edit</span>
                    </a>
                    {{-- <a href="{{ route('admin.quotation.edit_quote_summary', base64_encode($quote->id)) }}" target="_blank">
                        <img src="{{ asset('new-theme/images/edit-icon2.svg') }}" alt="">
                        <span>Edit Summary</span>
                    </a> --}}
                    <a href="#" class="delete-quote" data-id="{{ base64_encode($quote->id) }}">
                        <img class="destroy-quote" />
                        <span>Delete</span>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
    {{ $quotes->appends(request()->query())->links() }}
@endif
