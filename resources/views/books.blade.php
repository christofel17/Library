@include('style.stylesheet')
@include('script.script')
@include('partials.navbar')
@include('partials.sidebar')
<body>
  @include('partials.particles')
    <div class="container">
        <div class="col-sm-6">
          <h1 class="m-0">Daftar Buku</h1>
        </div>
      @can('admin')
      <a href="/create/books" class="btn btn-success btn-sm">Add book</a>
      @endcan
      <table class="table table-bordered data-table">
          <thead>
              <tr>
                  <th>No</th>
                  <th>Title</th>
                  <th>Author</th>
                  <th>Publisher</th>
                  <th>Stock</th>
                  <th width="105px">Action</th>
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
        ajax: "{{ route('books.index') }}",
        columns: [
            // DT_RowIndex cara membuat barisnya angka
           
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable:false, searchable:false},
            { data: 'title', name: 'title', render:function(data, type, row){
                return "<a href='/volume/"+ row.slug +"'>" + row.title + "</a>"
            }},
            {data: 'name', name: 'name', render:function(data, type, row){
                return "<a href='books/author/"+ row.slug +"'>" + row.name + "</a>"
            }},
            {data: 'publisher', name: 'publisher'},
            {data: 'stock', name: 'stock', orderable:false, searchable:false},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
      
  });
</script>