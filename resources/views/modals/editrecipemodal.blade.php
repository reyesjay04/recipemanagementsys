<div class="modal fade" id="recipe-modal-edit" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="RecipeModalEdit"></h4>
            </div>
            <form action="javascript:void(0)" id="RecipeFormEdit" name="RecipeFormEdit" class="form-horizontal" method="POST" enctype="multipart/form-data">

                <div class="modal-body">
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Recipe</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Recipe Name" maxlength="50" required="">
                            <span class="text-danger" id="nameErrorEdit"></span>
                        </div>

                    </div>
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Serving Size</label>
                        <div class="col-sm-12">
                            <input type="number" class="form-control" id="servings" name="servings" placeholder="Enter Serving Size" maxlength="50" required="">
                            <span class="text-danger" id="servingsErrorEdit"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Procedure</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="procedure" name="procedure" placeholder="Enter Procedure" required="">
                            <span class="text-danger" id="procedureErrorEdit"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="submit" class="btn btn-primary" id="btn-update">Save changes</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
