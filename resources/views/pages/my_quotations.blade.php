<x-app-layout>
    @push('styles')
        <style>
            #myTable_wrapper{
                margin-top:20px;
            }

            .show-mobile {
            display: none;
        }

            @media only screen and (max-width: 767px) {

        .show-mobile {
            display: block;
        }
        }

        </style>
    @endpush


      <div class="app-content content">
        <div class="content-wrapper">
          <div class="content-header row">
          </div>
          <div class="content-body">
            <div class="row">
                <div class="col-md-8">
                    <h3 class="card-title">My Quotations</h3>
                </div>
                <div class="col-md-4 mb-md-3 text-right">
                    <a href="{{ route('admin.quotation.new_quotation')}}"> <button type="button" class="btn  my-quotations-btn"> Create a New Quote</button></a>

                </div>
             </div>
             <div class="row" id="configuration">
                <div class="col-12">
                  <div class="card">
                    <div class="card-content collapse show">
                      <div class="card-body card-dashboard">
                        <table id="myTable" class="table table-striped table-bordered show-child-rows ">
                          <thead class="thead-mb">
                            <tr>
                              <th>Quote ID</th>
                              <th>Quote Date</th>
                              <th>Customer Name</th>
                                <th>Technician</th>
                              <th>Status</th>
                              <th>Details</th>
                            </tr>
                          </thead>
                          <tbody >
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
          </div>
        </div>
      </div>

      @push('scripts')
        <script src="{{ asset('theme/app-assets/vendors/js/tables/datatable/datatables.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('theme/app-assets/js/scripts/tables/datatables/datatable-basic.js') }}" type="text/javascript"></script>
        <script>
            $(document).ready( function () {

            var table = $('#myTable').DataTable( {
                "ordering": false,
                "lengthMenu": [ [10, 25, 50,100, -1], [10, 25, 50,100, "All"] ],
                'serverSide': true,
                "ajax": {
                    url: "{{ route('admin.quotation.my_quotations') }}",
                    data: function(d) {
                        d.search = '{{ $search }}'
                    }
                },
                "columns": [
                    { data: 'quote_id', name: 'quote_id' },
                    { data: 'quote_date', name: 'quote_date' },
                    { data: 'customer_name', name: 'customer_name' },
                    { data: 'technician', name: 'technician' },
                    { data: 'status', name: 'status' },
                    { data: 'actions', name: 'actions' }
                ]
            });
        } );
        </script>
      @endpush


</x-app-layout>
