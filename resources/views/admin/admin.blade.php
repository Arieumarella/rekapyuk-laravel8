@extends('tamplate')

@section('tittle', 'admin')


@section('content-header')
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-lift">
              <li class="breadcrumb-item"><a href="{{ asset('style/') }}#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
@endsection

@section('content')
    <div class="content">
      <div class="container">
         <!-- Info boxes -->
        <div class="card">
          <div class="card-header">
              <a href="#" class="btn btn-sm btn-primary pull-right" data-toggle="modal" data-target="#tambahAdmin"><b><i class="fa fa-plus" aria-hidden="true"></i>  TAMBAH DATA</b></a>
          </div>
          <div class="card-body"> 
            <table id="TabelAdmin" class="table table-striped table-bordered dt-responsive nowrap table-sm" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Aksi</th>
            </tr>
        </thead>
        
    </table>
          </div>
        </div>
        
  
      </div>
      <!-- /.container-fluid -->
    </div>
@endsection

@section('modal')
  <div class="modal fade" id="tambahAdmin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tambahAdmin">Tambah Admin</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formTambah">
          @csrf
          <div class="form-group">
            <label for="email" class="col-form-label">Email:</label>
            <input type="Email" name="email" class="form-control" id="Email" placeholder="input email.." required>
          </div>
          <div class="form-group">
            <label for="name" class="col-form-label">Name:</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="input name.." required>
          </div>
          <div class="form-group">
            <label for="password" class="col-form-label">Password:</label>
            <input type="password" name="password" class="form-control" id="password" placeholder="Input password.." required>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        <button type="button" id="saveAdmin" class="btn btn-success"><i class="fa fa-save"></i> Save</button>
      </div>
    </div>
  </div>
</div>

  <div class="modal fade" id="editAdmin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tambahAdmin">Edit Admin</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formEdit">
          @csrf
          <input type="hidden" id="idx">
          <div class="form-group">
            <label for="email2" class="col-form-label">Email:</label>
            <input type="Email" name="email2" class="form-control" id="Email2" placeholder="input email.." required>
          </div>
          <div class="form-group">
            <label for="name2" class="col-form-label">Name:</label>
            <input type="text" name="name2" class="form-control" id="name2" placeholder="input name.." required>
          </div>
          <div class="form-group">
            <label for="password2" class="col-form-label">Password:</label>
            <input type="password" name="password2" class="form-control" id="password2" placeholder="Input password.." required>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        <button type="button" id="saveEdit" class="btn btn-success"><i class="fa fa-save"></i> Save</button>
      </div>
    </div>
  </div>
</div>
@endsection

@section('JsDataTble')
  <script>
    
    
     $(function () {
        $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
      var Table = $('#TabelAdmin').DataTable({
        processing : true,
        serverSide : true,
        paging: true,
        searching: true,
        ajax : {
          url: "{{ url('admin') }}",
          type: 'GET'
        },
        columns: [
          {data:'name', name:'name'},
          {data:'email', name:'email'},
          {data:'aksi', name:'aksi', orderable: false, searchable: false},
        ],
        order: [[0, 'asc']]
      });
      Pace.restart();
     });

$('#dataTable')
          .on( 'processing.dt', function ( e, settings, processing ) {
                  if(processing){
                      Pace.start();
                  } else {
                      Pace.stop();
                  }
              })
          .DataTable();
    
    $('#saveAdmin').click(function (e) {
        e.preventDefault();
        var Table = $('#TabelAdmin').DataTable();
    
        $.ajax({
            data: $('#formTambah').serialize(),
            url: "{{ route('admin.store') }}",
            type: "POST",
            dataType: 'json',
            success: function (data) {
                $('#tambahAdmin').modal('hide');
                $('#formTambah').trigger("reset"); 
                successNotif(data);
                Table.draw();
                Pace.restart();
            },
            error: function (data) {
                console.log('Error:', data);
                errorNotif(data);
                //$('#saveAdmin').html('Save Changes');
            }
        });
    });

    $('body').on('click', '.adminok', function () {
    let id = $(this).attr('edit-admin');
      $.ajax({
            url: "admin/"+id+"/edit",
            type: "GET",
            dataType: 'json',
            success: function (data) {
               $('#idx').val(data.id);
               $('#name2').val(data.name);
               $('#Email2').val(data.email);
                $('#editAdmin').modal('show');
                Pace.restart();
            },
            error: function (data) {
                console.log('Error:', data);
                errorNotif(data);
                //$('#saveAdmin').html('Save Changes');
            }
        });

   });

    $('#saveEdit').click(function (e) {
        e.preventDefault();
        let Table = $('#TabelAdmin').DataTable();
        let id=$('#idx').val();
        let name=$('#name2').val();
        let email=$('#Email2').val();
        let password=$('#password2').val();
    
        $.ajax({
            data: {idx:id, name:name, email:email, password:password},
            url: "{{ route('admin.store') }}",
            type: "POST",
            dataType: 'json',
            success: function (data) {
                $('#formEdit').trigger("reset"); 
                $('#editAdmin').modal('hide');
                successNotif(data);
                Table.draw();
                Pace.restart();
            },
            error: function (data) {
                console.log('Error:', data);
                errorNotif(data);
                //$('#saveAdmin').html('Save Changes');
            }
        });
    });

    function hapusAdmin(id) {
      let valid = confirm("Are You sure want to delete !");
      let table = $('#TabelAdmin').DataTable();
      if (valid){
      $.ajax({
            type: "DELETE",
            url: "admin/"+id+"",
            success: function (data) {
                successNotif(data);
                table.draw();
                Pace.restart();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
      };
    };


  </script>
@endsection

