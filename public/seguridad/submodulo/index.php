<?php 
  require __DIR__.'../../../security/init.php';
  authorize('submodulo');
  include __DIR__ . '../../../partials/header.php'; 
?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<section>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Submódulos</h2>
            <button id="btnCreate" class="btn btn-primary">Crear Nuevo</button>
        </div>
        <table id="table" class="table table-striped" style="width:100%">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Abreviatura</th>
                <th>Elemento</th>
                <th>Módulo Padre</th>
                <th>Acciones</th>
            </tr>
            </thead>
        </table>
    </div>

    <div class="modal fade" id="entityModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitle"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="entityForm">
                <input type="hidden" id="id" name="id">
                <div class="mb-3"><input type="text" id="nombre" name="nombre" class="form-control" placeholder="Nombre"></div>
                <div class="mb-3"><input type="text" id="abreviatura" name="abreviatura" class="form-control" placeholder="Abreviatura"></div>
                <div class="mb-3"><input type="text" id="elemento" name="elemento" class="form-control" placeholder="Elemento"></div>
                <div class="mb-3">
                    <select id="parentSelect" name="modulo" class="form-select">
                    <option value="">Seleccione Módulo Padre</option>
                    </select>
                </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="btnSave" class="btn btn-success">Guardar</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function () {
            var baseURL = '../../controllers/seguridad/submodulo/';
            var subURL  = '../../controllers/seguridad/submodulo/';
            var moduloURL  = '../../controllers/seguridad/modulo/';
            let currentModulo=null;

            function loadParents(){
            $.getJSON(moduloURL+'fetch.php',function(r){
                var sel = $('#parentSelect').empty().append('<option value="">Seleccione Padre</option>');
                r.data.data.forEach(function(m){ sel.append('<option value="'+m.id+'">'+m.nombre+'</option>'); });
                $('#parentSelect').val(currentModulo).trigger('change'); 
            });
            }

            var table = $('#table').DataTable({
            ajax: { url: baseURL + 'fetch.php', dataSrc: function(json){ return json.data.data; } },
            columns: [
                { data: 'id' },
                { data: 'nombre' },
                { data: 'abreviatura' },
                { data: 'elemento' },
                { data: 'parent_name' },
                { data: null, render: function(d){
                    return '<button class="btn btn-sm btn-warning edit" data-id="'+d.id+'">Editar</button> '
                        + '<button class="btn btn-sm btn-danger delete" data-id="'+d.id+'">Eliminar</button>';
                } }
            ]
            });

            $('#btnCreate').on('click', function(){
            $('#modalTitle').text('Crear Submódulo');
            $('#entityForm')[0].reset();
            $('#id').val('');
            currentModulo=null;
            loadParents();
            new bootstrap.Modal($('#entityModal')).show();
            });

            table.on('click','.edit', function(){
            var id = $(this).data('id');
            $.getJSON(baseURL+'get.php',{id:id},function(r){
                $('#modalTitle').text('Editar Submódulo');
                $('#id').val(r.data.id);
                $('#nombre').val(r.data.nombre);
                $('#abreviatura').val(r.data.abreviatura);
                $('#elemento').val(r.data.elemento);
                currentModulo=r.data.modulo
                loadParents();
                $('#parentSelect').val(r.data.modulo);
                new bootstrap.Modal($('#entityModal')).show();
            });
            });

            table.on('click','.delete', function(){
            var id = $(this).data('id');
            Swal.fire({title:'¿Eliminar submódulo?',showCancelButton:true}).then(function(res){
                if(res.isConfirmed){
                $.post(baseURL+'delete.php',{id:id},function(r){
                    if(r.success){ table.row($('button.delete[data-id="'+id+'"]').parents('tr')).remove().draw(false); }
                },'json');
                }
            });
            });

            $('#btnSave').on('click', function(){
            var idVal = $('#id').val(), data = $('#entityForm').serialize();
            $.post(baseURL + 'save.php', data, function(r){
                if(r.success){
                var row = {
                    id: r.data.id,
                    nombre: $('#nombre').val(),
                    abreviatura: $('#abreviatura').val(),
                    elemento: $('#elemento').val(),
                    parent_name: $('#parentSelect option:selected').text()
                };
                if(idVal) table.row($('button.edit[data-id="'+idVal+'"]').parents('tr')).data(row).draw(false);
                else table.row.add(row).draw(false);
                bootstrap.Modal.getInstance($('#entityModal')).hide();
                }
            }, 'json');
            });
        });
    </script>
</section>
<?php include __DIR__ . '../../../partials/footer.php'; ?>