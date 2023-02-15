<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
</head>

<body>
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">All Teacher Info</div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Sl No.</th>
                                        <th>Name</th>
                                        <th>Title</th>
                                        <th>Institute</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- <tr>
                                        <td>1</td>
                                        <td>Rakesh</td>
                                        <td>CSE</td>
                                        <td>Dhaka</td>
                                        <td>
                                            <button class="btn btn-success">Edit</button>
                                            <button class="btn btn-danger">Delete</button>

                                        </td>
                                    </tr> --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <span id="addT">Add Teacher</span>
                            <span id="updateT">Update Teacher</span>
                        </div>
                        <div class="card-body">
                            <form action="">
                                @csrf
                                <div class="form-group">
                                    <label for="">Full Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name">
                                </div>
                                <div class="form-group">
                                    <label for="">Title</label>
                                    <input type="text" class="form-control" id="title" name="title" placeholder="Enter Title">
                                </div>
                                <div class="form-group">
                                    <label for="">Institute</label>
                                    <input type="text" class="form-control" id="institute" name="institute"
                                        placeholder="Enter Institute">
                                </div>
                                <div class="form-group my-2">
                                    <label for=""></label>
                                    <button id="addButton" onclick="addData()" class="btn btn-success" >Add Teacher</button>
                                    <button id="updateButton" class="btn btn-primary" >Update Teacher</button>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        $("#addT").show();
        $("#updateT").hide();

        $("#addButton").show();
        $("#updateButton").hide();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function allData(){
            $.ajax({
                type:"GET",
                dataType:'json',
                url:"{{ route('all-data') }}",
                success:function(response){
                    var data = ""
                    $.each(response, function(key, value){
                        data = data + "<tr>"
                        data = data + "<td>"+value.id+"</td>"
                        data = data + "<td>"+value.name+"</td>"
                        data = data + "<td>"+value.title+"</td>"
                        data = data + "<td>"+value.institute+"</td>"
                        data = data + "<td>"
                        data = data + "<button class='btn btn-success btn-sm mx-2'>Edit</button>"
                        data = data + "<button class='btn btn-danger btn-sm'>Delete</button>"
                        data = data + "</td>"
                        data = data + "</tr>"
                    })
                    $('tbody').html(data);
                }
            });
        }
        allData();

        function clearData(){
            $("#name").val('');
            $("#title").val('');
            $("#institute").val('');

        }

        function addData(){
            var name        = $("#name").val();
            var title       = $("#title").val();
            var institute   = $("#institute").val();

            $.ajax({
                type: "post",
                dataType:'json',
                data:{name:name, title:title, institute:institute},
                url:"{{ route('store-data') }}",
                success:function(data){
                    clearData();

                    console.log('successfully data added');

                }
            });

        }
    </script>
</body>

</html>
