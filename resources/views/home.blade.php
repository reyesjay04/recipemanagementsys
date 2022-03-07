@extends('layouts.app')
@section('content')

    <div class="container">
        <hr>
        <h1>Recipe</h1>
        <hr>
        <div class="row">
            <div class="col-md-12">
                <a class="btn btn-secondary" onClick="add()" href="javascript:void(0)"> Create</a>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="card-body">
                <table id="ajax-crud-datatable" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Serving Size</th>
                        <th>Procedure</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>


    @extends('modals.addrecipemodal')
    @extends('modals.editrecipemodal')



    <script type="text/javascript">
        $(document).ready( function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#ajax-crud-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ url('ajax-crud-datatable') }}",
                columns: [
                    { data: 'name', name: 'name' },
                    { data: 'servings', name: 'servings' },
                    { data: 'procedure', name: 'procedure' },
                    {data: 'action', name: 'action', orderable: false},
                ],
                order: [[0, 'desc']]
            });
        });
        function add(){
            $('#RecipeFormAdd').trigger("reset");
            $('#RecipeModalAdd').html("Add Recipe");
            $('#recipe-modal-add').modal('show');
            $('#id').val('');
        }

        function editFunc(id){
            $.ajax({
                type:"POST",
                url: "{{ url('edit-recipe') }}",
                data: { id: id },
                dataType: 'json',
                success: function(res){

                    $('#RecipeModalEdit').html("Edit Recipe");
                    $('#recipe-modal-edit').modal('show');
                    $('#id').val(res.id);
                    $('#name').val(res.name);
                    $('#servings').val(res.servings);
                    $('#procedure').val(res.procedure);
                }
            });
        }

        function deleteFunc(id){
            if (confirm("Delete Record?") == true) {
                var id = id;
                // ajax
                $.ajax({
                    type:"POST",
                    url: "{{ url('delete-recipe') }}",
                    data: { id: id },
                    dataType: 'json',
                    success: function(res){
                        var oTable = $('#ajax-crud-datatable').dataTable();
                        oTable.fnDraw(false);
                    }
                });
            }
        }

        $('#RecipeFormAdd').submit(function(e) {
            e.preventDefault();
            $('#nameErrorAdd').text('');
            $('#servingsErrorAdd').text('');
            $('#procedureErrorAdd').text('');
            var formData = new FormData(this);
            $.ajax({
                type:'POST',
                url: "{{ url('store-recipe')}}",
                data: formData,
                cache:false,
                contentType: false,
                processData: false,
                success: (data) => {
                    $("#recipe-modal").modal('hide');
                    var oTable = $('#ajax-crud-datatable').dataTable();
                    oTable.fnDraw(false);
                },
                error: function(response){
                    $('#nameErrorAdd').text(response.responseJSON.errors.name);
                    $('#servingsErrorAdd').text(response.responseJSON.errors.servings);
                    $('#procedureErrorAdd').text(response.responseJSON.errors.procedure);
                }
            });
        });

        $('#RecipeFormEdit').submit(function(e) {
            e.preventDefault();
            $('#nameErrorEdit').text('');
            $('#servingsErrorEdit').text('');
            $('#procedureErrorEdit').text('');
            var formData = new FormData(this);

            $.ajax({
                type:'POST',
                url: "{{ url('update-recipe')}}",
                data: formData,
                cache:false,
                contentType: false,
                processData: false,
                success: (data) => {
                    $("#recipe-modal").modal('hide');
                    var oTable = $('#ajax-crud-datatable').dataTable();
                    oTable.fnDraw(false);
                },
                error: function(response){
                    //  alert(response.responseJSON.errors);
                    $('#nameErrorEdit').text(response.responseJSON.name);
                    // $('#servingsErrorEdit').text(response.responseJSON.errors.servings);
                    $('#procedureErrorEdit').text(response.responseJSON.procedure);
                }
            });
        });
    </script>
@endsection

