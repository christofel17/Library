@include('style.stylesheet')
@include('script.script')
@include('partials.navbar')
@include('partials.sidebar')
<body>
   @include('partials.particles')
  <div class="container">
    <div class="col-sm-6">
        <h1 class="m-0">Daftar User</h1>
      </div>
      <a href="/users/create" class="btn btn-success btn-sm">Add user</a>
      <table class="table table-bordered data-table">
          <thead>
              <tr>
                  <th>No</th>
                  <th>Name</th>
                  <th>Username</th>
                  <th>Email</th>
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
        ajax: "{{ route('users.index') }}",
        columns: [
            // DT_RowIndex cara membuat barisnya angka
           
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable:false, searchable:false},
            { data: 'name', name: 'name', render:function(data, type, row){
                return "<a href='borrow/users/"+ row.username +"'>" + row.name + "</a>"
            }},
            {data: 'username', name: 'username'},
            {data: 'email', name: 'email'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
      
  });
</script>