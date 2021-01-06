
        <!-- DataTables Example -->
        <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-table"></i>
                Новости</div>
            <div class="card-body">
                {NEWS_ALERT}
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Время</th>
                            <th>Дата</th>
                            <th>Заголовок</th>
                            <th>Коротко</th>
                            <th>Источник</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        {NEWS_IN}
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Время</th>
                            <th>Дата</th>
                            <th>Заголовок</th>
                            <th>Коротко</th>
                            <th>Источник</th>
                            <th></th>
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

    function confirmDeleteNews() {
        if (confirm("Вы подтверждаете удаление?")) {
            return true;
        } else {
            return false;
        }
    }
</script>