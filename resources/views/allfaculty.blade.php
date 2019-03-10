<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <!-- Sweet Alert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
     <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
     <link href="https://maxcdn.bootstrapcdn.com/css/ie10-viewport-bug-workaround.css" rel="stylesheet">
     <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    
    <title>Ajax Crude!</title>
  </head>
  <body>
    <div class="container">
     <h1 style="color:green;text-align:center;">Faculty Information!</h1>
     <div class="row">
      <div class="col-lg-12">
        <a onclick="addForm()" class="btn btn-sm btn-primary pull-right">Add New</a>
        <table id="faculty-table" class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Faculty</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
       </div>
     </div>
     @include('form');
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <!-- Validator -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/validator/10.11.0/validator.min.js"></script>
   
    <script type="text/javascript">
       var table1= $('#faculty-table').DataTable({
                processing:true,
                serverSide:true,
                ajax: "{!! url('/all/faculty') !!}",
                columns:[
                    {data:'id', name:'id'},
                    {data:'name', name:'name'},
                    {data:'email', name:'email'},
                    {data:'phone', name:'phone'},
                    {data:'faculty', name:'faculty'},
                    {data:'action', name:'action', orderable: false, searchable: false}
                ]
       });
       //Add form function at here to show
    function addForm(){
        save_method='add';
        $('input[name_method]').val('POST');
        $('#modal-form').modal('show');
        $('#modal-form form')[0].reset();
        $('.modal-title').text('Add Faculty');
        $('#insertbutton').text('Add Faculty');
    }

    //Insert data by Ajax
    $(function(){
            $('#modal-form form').validator().on('submit', function (e) {
                if (!e.isDefaultPrevented()){
                    var id = $('#id').val();
                    if (save_method == 'add') url = "{{ url('faculty') }}";
                    else url = "{{ url('faculty') }}" + id;
                    $.ajax({
                        url : url,
                        type : "POST",
                        data: new FormData($("#modal-form form")[0]),
                       contentType: false,
                       processData: false,
                        success : function(data) {
                            $('#modal-form').modal('hide');
                            table1.ajax.reload();
                            swal({
                              title: "Good job!",
                              text: "You clicked the button!",
                              icon: "success",
                              button: "Great!",
                            });
                        },
                        error : function(data){
                            swal({
                                title: 'Oops...',
                                text: data.message,
                                type: 'error',
                                timer: '1500'
                            })
                        }
                    });
                    return false;
                }
            });
        });

        //show single data ajax part here
       function showData(id) {
          $.ajax({
              url: "{{ url('faculty') }}" + '/' + id,
              type: "GET",
              dataType: "JSON",
            success: function(data) {
              $('#single-data').modal('show');
              $('.modal-title').text(data.name +' '+'Informations');
              $('#facultyid').text(data.id); 
              $('#fullname').text(data.name);
              $('#facultyemail').text(data.email);
              $('#facultynumber').text(data.phone);
              $('#dfaculty').text(data.faculty);
            },
            error : function() {
                alert("Ghorar DIm");
            }
          });
        }

        //Edit data by ajax
      function editForm(id){
        save_method='edit';
        $('input[name_method]').val('PATCH');
        $('#modal-form form')[0].reset();
        $.ajax({
        url:"{{ url('faculty')}}"+'/' + id + "/edit",
        type:"GET",
        DataTpe:"JSON",
        success:function(data){
         $('#modal-form').modal("show");
         $('.modal-title').text('Edit Faculty');
         $('#insertbutton').text('Update Faculty');
         $('#id').val(data.id);
         $('#name').val(data.name);
         $('#email').val(data.email);
         $('#phone').val(data.phone);
         $('#faculty').val(data.faculty);
        },
        error:function(){
          alert("It's not worrking an approprieatly");
        }
        });
      }

      //delete ajax request are here
      function deleteData(id){
          var csrf_token = $('meta[name="csrf-token"]').attr('content');
          swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this imaginary file!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              $.ajax({
                  url : "{{ url('faculty') }}" + '/' + id,
                  type : "POST",
                  data : {'_method' : 'DELETE', '_token' : csrf_token},
                  success : function(data) {
                      table1.ajax.reload();
                      swal({
                        title: "Delete Done!",
                        text: "You clicked the button!",
                        icon: "success",
                        button: "Done",
                      });
                  },
                  error : function () {
                      swal({
                          title: 'Oops...',
                          text: data.message,
                          type: 'error',
                          timer: '1500'
                      })
                  }
              });
            } else {
              swal("Your imaginary file is safe!");
            }
          });
        } 
    </script>
  </body>
</html>