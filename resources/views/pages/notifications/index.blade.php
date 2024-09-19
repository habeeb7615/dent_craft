<x-app-layout>
    @push('styles')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.7/tailwind.min.css">
    @endpush

    <div class="page-content window-height">
        @include('layouts.header', ['title' => 'Notifications', 'description' => '', 'show_search' => true])
        <div class="dashboard-wrapper window-height after-header-section common-padding-lr">
            @if (count($notifications) == 0)
                <div class="no-car-data-wrapper">
                    <div class="no-car-data-content">
                        <h6  style = "font-family: BANKGTHD_0;">There is no data available in table</h6>
                        {{-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.</p> --}}
                    </div>
                </div>
            @else
                <div class="car-quotation-wrapper" style = "  font-family: sans-serif !important;">
                    @foreach ($notifications as $notification)
                    @if($notification->type == 'quote' || $notification->type == 'email')
                    <div class="car-quotation-box">
                        <div class="car-info-wrapper">
                            <div class="car-info-content">
                                <ul>
                                    <li>
                                        {{-- <span>Title</span> --}}
                                        <strong class="text-primary">
                                            @switch($notification->type)
                                                @case('quote')
                                                    New Quote Added
                                                    @break
                                                @case('email')
                                                    Email Sent
                                                    @break
                                             
                                            @endswitch
                                        </strong>
                                    </li>
                                    <li>
                                        {{-- <span>Description</span> --}}
                                        <strong >
                                            @switch($notification->type)
                                                @case('quote')
                                                    Quote {{ $notification->name }} has been added
                                                    @break
                                                @case('email')
                                                    Email of quote {{ $notification->name }} sent to {{ $notification->to_email }}
                                                    @break
                                               
                                                @default

                                            @endswitch
                                        </strong>
                                    </li>
                                     @if($notification->type == 'quote' || $notification->type == 'email')
                                     
                                    <li>
                                        {{-- <span>Customer</span> --}}
                                        <strong>
                                            {{ $notification->created_at }}
                                        </strong>
                                    </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
            @endif
            {{ $notifications->links() }}
        </div>
        @include('layouts.footer')
    </div>
</x-app-layout>
