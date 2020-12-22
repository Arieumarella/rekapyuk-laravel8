@extends('tamplate')

@section('tittle', 'admin')
@section('cssDataTable')
  <link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="http://www.datatables.net/rss.xml">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.bootstrap4.min.css">
@endsection


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
              <a href="#" class="btn btn-sm btn-primary pull-right" data-toggle="modal" data-target="#exampleModal"><b><i class="fa fa-plus" aria-hidden="true"></i>  TAMBAH DATA</b></a>
          </div>
          <div class="card-body"> 
            <table id="TabelAdmin" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
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
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Admin</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
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
        <button type="button" class="btn btn-success"><i class="fa fa-save"></i> Save</button>
      </div>
    </div>
  </div>
</div>
@endsection

@section('JsDataTble')
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/responsive/2.2.6/js/responsive.bootstrap4.min.js"></script>
  <script type="text/javascript" class="init"></script>
  <script>
    
      $('#TabelAdmin').DataTable({
        processing : true,
        serverSide : true,
        ajax : {
          url: "{{ url('admin') }}",
          type: 'GET'
        },
        columns: [
          {data:'name', name:'name'},
          {data:'email', name:'email'},
        ],
        order: [[0, 'asc']]
      });
    


  </script>
@endsection

