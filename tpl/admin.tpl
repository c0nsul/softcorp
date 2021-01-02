<br>
<br>
<div class="card-header">
    <i class="fas fa-table"></i>Новый источник</div>
<div class="card-body">
    <div class="table">

        <form method="post" action="admin.php" class="form-inline">
            <div class="form-group mb-2">
                <input type="text"  class="form-control" required name="srcName" placeholder="Наименование">
            </div>
            <div class="form-group mx-sm-3 mb-2">
                <input type="text" class="form-control" required name="srcUrl" style="width: 500px" placeholder="URL">
            </div>
            <button type="submit" class="btn btn-primary mb-2">Добавить</button>
        </form>


    </div>
</div>


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
                    <th>Действие</th>
                    <th>Запуск</th>
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
                    <th>Действие</th>
                    <th>Запуск</th>
                </tr>
                </tfoot>

            </table>
        </div>
    </div>
    <div class="card-footer small text-muted"></div>
</div>



<!-- /#wrapper -->
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable( {
            stateSave: true
        } );
    } );

    function confirmDelete() {
        if (confirm("Вы подтверждаете удаление?")) {
            return true;
        } else {
            return false;
        }
    }

    function startParser(id){
        $('#src_'+id).html('In progress...');
    }
</script>



