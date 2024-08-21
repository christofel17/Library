@include('style.stylesheet')
@include('script.script')
@include('partials.navbar')
@include('partials.sidebar')
<body>
  @include('partials.bubble')
  <div class="container">
    <div class="col-sm-6">
      <h1 class="m-0">Daftar Peminjaman</h1>
    </div>
      <table class="table table-bordered data-table">
          <thead>
              <tr>
                  <th width="25px">No</th>
                  <th width="25px">Id</th>
                  <th>Title</th>
                  <th>Name</th>
                  <th>Status</th>
                  <th>Borrow Date</th>
                  <th>Return Date</th>
                  <th width="115px">Action</th>
              </tr>
          </thead>
          <tbody>
          </tbody>
      </table>
  </div>
       
  </body>


<script type="text/javascript">
  $(function () {
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('borrows.index') }}",
        columns: [
            // DT_RowIndex cara membuat barisnya angka
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable:false, searchable:false},
            {data: 'id', name: 'id'},
            {data: 'title', name: 'title'},
            {data: 'name', name: 'name'},
            {data: 'status', name: 'status'},
            {data: 'borrow_date', name: 'borrow_date'},
            {data: 'return_date', name: 'return_date'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
      
  });
</script>