<x-app-layout>
    @push('styles')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.7/tailwind.min.css">
    @endpush

    <div class="page-content window-height">
        @include('layouts.header', ['title' => 'Dashboard', 'description' => '', 'show_search' => true])
        <div class="dashboard-wrapper window-height after-header-section common-padding-lr">
            <div class="latest-question-wrapper">
                <h5>Latest Quotation @if(count($quotes) > 0) <span>(Showing {{ count($quotes) }} entries)</span> @endif </h5>
                <div class="quotation-form-wrapper">
                    <input id="min" type="text" class="date-input" placeholder="From" value="{{ request()->min }}" />
                    <input id="max" type="text" class="date-input" placeholder="To" value="{{ request()->max }}" />
                    <button id="reset-dates" class="btn btn-primary" style="border-color:#000;border-radius:5px;">Clear Filters</button>
                    {{-- <input type="text" class="search-input" placeholder="Search (Customer Name, Technician)" value="{{ request()->q }}" /> --}}
                </div>
            </div>
            <div id="quotes" class="window-height">
                @include('pages.partials.quotes')
                {{-- <div class="d-flex justify-content-center">
                    <button type="button" class="btn btn-primary icon-btn" id="load-more">
                        <i class="fa fa-refresh"></i> Load More
                    </button>
                </div> --}}
            </div>
        </div>
        @include('layouts.footer')
    </div>
      @push('scripts')
        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/datepicker/0.6.5/datepicker.js" type="text/javascript"></script> --}}
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

        <script>
            $(document).ready( function () {
                var searchTimeout

                $('#reset-dates').click(function () {
                    minPickr.clear()
                    maxPickr.clear()
                    window.location.href = "{{ route('admin.dashboard') }}"
                })

                function filterQuotes() {
                    var min = $('#min').val()
                    var max = $('#max').val()

                    var dateMin = moment(min, 'DD-MM-YYYY')
                    var dateMax = moment(max, 'DD-MM-YYYY')
                    // var search = $('.search-input').val()

                    if ((min.length > 0 && max.length > 0 && dateMin.isSameOrBefore(dateMax))) {
                        window.location.href = `{{ route('admin.dashboard') }}?min=${min}&max=${max}`
                    }
                }

                $('body').on('click', '.delete-quote', function() {
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.value) {
                            var id = $(this).data('id')
                            deleteQuote(id, this)
                        }
                    })
                })

                function deleteQuote(id, el) {
                    var url = "{{ route('admin.quotation.delete_quote', ':id') }}"
                    url = url.replace(':id', id)

                    $.ajax({
                        url: url,
                        method: "POST",
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function (response) {
                            // $(el).parents('.car-quotation-box').remove()
                            window.location.reload()
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Quote deleted successfully.',
                                showConfirmButton: false,
                                timer: 1500
                            })
                        }
                    })
                }

                // datepicker
                var minPickr = $("#min").flatpickr({
                    altInput: true,
                    altFormat: 'F j, Y',
                    dateFormat: 'd-m-Y',
                    onChange: function (selectedDate, dateStr, instance) {
                        filterQuotes()
                    }
                })

                var maxPickr = $("#max").flatpickr({
                    altInput: true,
                    altFormat: 'F j, Y',
                    dateFormat: 'd-m-Y',
                    onChange: function (selectedDate, dateStr, instance) {
                        filterQuotes()
                    }
                })

                // $('.search-input').on('input', function() {
                //     clearTimeout(searchTimeout)

                //     searchTimeout = setTimeout(function() {
                //         filterQuotes()
                //     }, 500);
                // })
            });
        </script>
      @endpush


</x-app-layout>
