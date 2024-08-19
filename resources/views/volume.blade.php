@include('style.stylesheet')
@include('script.script')
@include('partials.navbar')
@include('partials.sidebar')
<body>
     
  <div class="container">
      <h1>Daftar Volume dari Buku "{{ $book->title }}"</h1>
      @can('admin')
      <a href="/volume/create/{{ $book->slug }}" class="btn btn-success btn-sm">Add volume</a>
      @endcan
      <table class="table table-bordered data-table">
          <thead>
              <tr>
                  <th width="25px">No</th>
                  <th width="25px">Id</th>
                  <th>Format</th>
                  <th>Edition</th>
                  <th>Condition</th>
                  <th>Status</th>
                  <th width="150px">Action</th>
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
        ajax: "{{ route('volumes.index', $book) }}",
        columns: [
            // DT_RowIndex cara membuat barisnya angka
           
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable:false, searchable:false},
            {data: 'id', name: 'id'},
            {data: 'format', name: 'format'},
            {data: 'edition', name: 'edition'},
            {data: 'state', name: 'state'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
      
  });
</script>