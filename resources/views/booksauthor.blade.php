@include('style.stylesheet')
@include('script.script')
@include('partials.navbar')
@include('partials.sidebar')
<body>
    <div class="container">
      <h1>Daftar Buku oleh {{ $book->author->name }}</h1>
      <a href="/book/create" class="btn btn-success btn-sm">Add book</a>
      <table class="table table-bordered data-table">
          <thead>
              <tr>
                  <th>No</th>
                  <th>Title</th>
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
        ajax: "{{ route('booksauthor.index', $book) }}",
        columns: [
            // DT_RowIndex cara membuat barisnya angka
           
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable:false, searchable:false},
            { data: 'title', name: 'title', render:function(data, type, row){
                return "<a href='/volume/"+ row.slug +"'>" + row.title + "</a>"
            }},
            {data: 'publisher', name: 'publisher'},
            {data: 'stock', name: 'stock', orderable:false, searchable:false},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
      
  });
</script>