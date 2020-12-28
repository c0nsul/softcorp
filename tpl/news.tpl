
        <!-- DataTables Example -->
        <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-table"></i>
                Новости</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Дата</th>
                            <th>Время</th>
                            <th>Заголовок</th>
                            <th>Коротко</th>
                            <th>Источник</th>
                        </tr>
                        </thead>
                        <tbody>
                        {NEWS_IN}
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Дата</th>
                            <th>Время</th>
                            <th>Заголовок</th>
                            <th>Коротко</th>
                            <th>Источник</th>
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
</script>