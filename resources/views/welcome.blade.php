<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Ajax</title>
    <script src="sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="card shadow mt-5 bg-light p-5">
            <div class="card-body">
              <div class="row">
                <div class=" card col-8 p-3">
                    
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>name</th>
                                <th>password</th>
                                <th>reg</th>
                                <th>Action</th>
                                
                                
                            </tr>
                        </thead>
                        <tbody>
                           
                        </tbody>
                    </table>
                </div>
                <div class=" card col-4 shadow p-3">
                    <h3 id="add_member">Add member</h3>
                    <h3 id="update_member">update member</h3>
                    <form action="{{ url('form_data') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <label for="text">Name</label>
                        <input type="text" id="name" class="form-control mb-2" placeholder="Enter your name">
                        <label class="text-danger" id="nameValid"></label>
                        <br>
                        <label for="text">Password</label>
                        <input type="password" id="password" class="form-control mb-2"  placeholder="Enter your password">
                        <label class="text-danger" id="passwordValid"></label>
                        <br>
                        <label for="text">Reg</label>
                        <input type="text" id="photo" class="form-control mb-2"  placeholder="Enter your roll">
                        <label class="text-danger" id="photoValid"></label>
                        <br>
                        <input type="hidden" id="id">
                        <input onclick="alldata2()" type="submit" id="add_input" class="btn btn-success" name="submit" value="send">
                        <input onclick='updateData()' type="submit" id="update_input" class="btn btn-success" name="submit" value="update">
                        
                    </form>
                </div>
              </div>
            </div>
          </div>
    </div>
    <script>
        $('#update_input').hide();
        $('#add_input').show();
        $('#add_member').show();
        $('#update_member').hide();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        function alldata(){
            $.ajax({
                type:'get',
                data:'json',
                url:'form_data/all',
                success:function(response){
                    var data = "";
                    $.each(response , function(key,value){
                        
                       
                        data = data + "<tr>";
                            data = data +"<td>"+key+"</td>"
                            data = data +"<td>"+value.name+"</td>"
                            data = data +"<td>"+value.password+"</td>"
                            data = data +"<td>"+value.photo+"</td>"
                            data = data +"<td>" 
                            data = data +"<button class='btn btn-danger mr-2'>Delete</button>"
                            data = data +"<button class='btn btn-success mr-2' onclick='editData("+value.id+")'>Edit</button>"
                            data = data +"</td>" 
                                                         
                        data = data + "<tr>";
                    });
                    //key++;

                    $('tbody').html(data);
                }
            });
        }



        alldata();
        function valueClear(){
            var name = $('#name').val('');
            var pass = $('#password').val('');
            var photo = $('#photo').val('');
        }
      function alldata2(){
        var name = $('#name').val();
        var password = $('#password').val();
        var photo = $('#photo').val();

        $.ajax({
            type:'POST',
            datatype:'json',
            data:{name:name,password:password,photo:photo},
            url:"form_data",
            success:function(data){
                alldata();
                valueClear();
                
            },
            error:function(error){
                $('#nameValid').text(error.responseJSON.errors.name);
                $('#passwordValid').text(error.responseJSON.errors.password);
                $('#photoValid').text(error.responseJSON.errors.photo);

                //console.log(error);
            }
        })
        
        }
        
       function editData(id){
        // alert(id);
        $.ajax({
            type:'GET',
            datatype:'json',
            url:"form/edit/"+id,
            success: function(data){
                $('#update_input').show();
                $('#add_input').hide();
                $('#add_member').hide();
                $('#update_member').show();
                var name = $('#name').val(data.name);
                var pass = $('#password').val(data.password);
                var photo = $('#photo').val(data.photo);
                var id = $('#id').val(data.id);
            }
        })
       } 

    function updateData(){
        var name = $('#name').val();
        var password = $('#password').val();
        var photo = $('#photo').val();
        var id = $('#id').val();
        $.ajax({
            type:'POST',
            datatype:'json',
            data:{name:name,password:password,photo:photo},
            url:"form_data/update/"+id,
            success:function(data){
                alldata();
                valueClear();
                console.log('successfully data add');
                
            },
            error:function(error){
                $('#nameValid').text(error.responseJSON.errors.name);
                $('#passwordValid').text(error.responseJSON.errors.name);
                $('#photoValid').text(error.responseJSON.errors.name);

            }
        })


             }
             

             

        

    </script>
</body>
</html>