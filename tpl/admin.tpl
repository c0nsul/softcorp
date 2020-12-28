<a class="float-right" href="login.php?logout=1">Logout</a></br></br>


<!-- DataTables Example -->
<div class="card mb-3">
    <div class="card-header">
        <i class="fas fa-table"></i>
        Источники новостей</div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>N</th>
                    <th>Имя</th>
                    <th>URL</th>
                    <th>Удалить</th>
                    <th>Запустить</th>
                </tr>
                </thead>
                <tbody>
                {SRC_IN}
                </tbody>
                <tfoot>
                <tr>
                    <th>N</th>
                    <th>Имя</th>
                    <th>URL</th>
                    <th>Удалить</th>
                    <th>Запустить</th>
                </tr>
                </tfoot>

            </table>
        </div>
    </div>
    <div class="card-footer small text-muted"></div>
</div>


<div class="card-header">
    <i class="fas fa-table"></i>Новый источник</div>
<div class="card-body">
    <div class="table-responsive">
        <form  method="post" action="admin.php" class="row g-3">
            <div class="col-auto">
                <label for="staticEmail2" class="visually-hidden">Имя</label>
                <input type="text" class="form-control" id="name" placeholder="Имя">
            </div>
            <div class="col-auto">
                <label for="inputPassword2" class="visually-hidden">URL</label>
                <input type="text" class="form-control" id="url" placeholder="URL">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary mb-3">добавить</button>
            </div>
        </form>
    </div>
</div>


<!-- /#wrapper -->
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable( {
            stateSave: true
        } );
    } );
</script>