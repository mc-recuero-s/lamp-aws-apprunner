<?php 
  require __DIR__.'../../../security/init.php';
  authorize('funcionalidad');
  include __DIR__ . '../../../partials/header.php'; 
?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<section>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Funcionalidades</h2>
            <button id="btnCreate" class="btn btn-primary">Crear Nuevo</button>
        </div>
        <table id="table" class="table table-striped" style="width:100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Abreviatura</th>
                    <th>Elemento</th>
                    <th>Ver</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                    <th>Módulo</th>
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
                        <div class="mb-3">
                            <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Nombre">
                        </div>
                        <div class="mb-3">
                            <input type="text" id="abreviatura" name="abreviatura" class="form-control" placeholder="Abreviatura">
                        </div>
                        <div class="mb-3">
                            <input type="text" id="elemento" name="elemento" class="form-control" placeholder="Elemento">
                        </div>
                        <div class="form-check form-switch mb-3">
                            <input   type="checkbox" id="ver" name="ver" value="1">
                            <label class="form-check-label" for="ver">Ver</label>
                        </div>
                        <div class="form-check form-switch mb-3">
                            <input   type="checkbox" id="editar" name="editar" value="1">
                            <label class="form-check-label" for="editar">Editar</label>
                        </div>
                        <div class="form-check form-switch mb-3">
                            <input   type="checkbox" id="eliminar" name="eliminar" value="1">
                            <label class="form-check-label" for="eliminar">Eliminar</label>
                        </div>
                        <div class="mb-3">
                            <select id="moduloSelect" name="modulo" class="form-select">
                                <option value="">Seleccione Módulo</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btnSave" class="btn btn-success">Guardar</button>
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
            var baseURL = '../../controllers/seguridad/funcionalidad/';
            var baseModulo = '../../controllers/seguridad/modulo/';
            var baseSubModulo = '../../controllers/seguridad/submodulo/';

            let currentModulo=null;
            async function loadModulos(){
                $.ajax({ type: 'GET', url: baseSubModulo+'fetch.php', dataType: 'json',
                    success: function(r){ if(r.success){
                        var sel = $('#moduloSelect'); sel.empty().append('<option value="">Seleccione Módulo</option>');
                        r.data.data.forEach(function(m){ sel.append('<option value="'+m.id+'">'+m.nombre+'</option>'); });
                        $('#moduloSelect').val(currentModulo).trigger('change'); 
                    }}
                });
            }

            var table = $('#table').DataTable({
                ajax: { url: baseURL + 'fetch.php', dataSrc: function(json){ return json.data.data; } },
                columns: [
                    { data: 'id' },
                    { data: 'nombre' },
                    { data: 'abreviatura' },
                    { data: 'elemento' },
                    { data: 'ver', render: d => d? 'Sí':'No' },
                    { data: 'editar', render: d => d? 'Sí':'No' },
                    { data: 'eliminar', render: d => d? 'Sí':'No' },
                    { data: 'modulo_nombre' },
                    { data: null, render: function(data){
                        return '<button class="btn btn-sm btn-warning edit" data-id="'+data.id+'">Editar</button>'
                            + ' <button class="btn btn-sm btn-danger delete" data-id="'+data.id+'">Eliminar</button>';
                    } }
                ]
            });

            $('#btnCreate').on('click', function(){
                $('#modalTitle').text('Crear Funcionalidad');
                $('#entityForm')[0].reset();
                $('#id').val('');
                currentModulo=null;
                loadModulos();
                new bootstrap.Modal($('#entityModal')).show();
            });

            $('#table').on('click', '.edit', function(){
                var id = $(this).data('id');
                $.ajax({ type:'GET', url: baseURL+'get.php', data:{id:id}, dataType:'json',
                    beforeSend:function(){ Swal.fire({title:'Espere...',allowOutsideClick:false,didOpen:()=>Swal.showLoading()}); },
                    success: async function(r){ Swal.close(); if(r.success){
                        $('#modalTitle').text('Editar Funcionalidad');
                        $('#id').val(r.data.id);
                        $('#nombre').val(r.data.nombre);
                        $('#abreviatura').val(r.data.abreviatura);
                        $('#elemento').val(r.data.elemento);
                        $('#ver').prop('checked', !!r.data.ver);
                        $('#editar').prop('checked', !!r.data.editar);
                        $('#eliminar').prop('checked', !!r.data.eliminar);
                        currentModulo=r.data.modulo
                        loadModulos();
                        $('#moduloSelect').val(r.data.modulo);                ;
                        new bootstrap.Modal($('#entityModal')).show();
                    } else Swal.fire('Error',r.message,'error'); },
                    error:function(j){ Swal.close(); Swal.fire('Error','Error de red: '+j.responseText,'error'); }
                });
            });

            $('#table').on('click', '.delete', function(){
                var id = $(this).data('id');
                Swal.fire({title:'¿Eliminar funcionalidad?',showCancelButton:true}).then(res=>{
                    if(res.isConfirmed){
                        $.ajax({ type:'POST', url:baseURL+'delete.php', data:{id:id}, dataType:'json',
                            beforeSend:function(){Swal.fire({title:'Eliminando...',allowOutsideClick:false,didOpen:()=>Swal.showLoading()});},
                            success:function(r){Swal.close(); if(r.success){ table.row($('button.delete[data-id="'+id+'"]').parents('tr')).remove().draw(false); Swal.fire('¡Eliminado!',r.message,'success'); } else Swal.fire('Error',r.message,'error'); },
                            error:function(j){Swal.close();Swal.fire('Error','Error de red: '+j.responseText,'error');}
                        });
                    }
                });
            });

            $('#btnSave').on('click', function(){
                var form = $('#entityForm'), idVal = $('#id').val(), data = form.serialize();
                $.ajax({ type:'POST', url:baseURL+'save.php', data:data, dataType:'json',
                    beforeSend:function(){ Swal.fire({title:idVal?'Actualizando...':'Creando...',allowOutsideClick:false,didOpen:()=>Swal.showLoading()}); },
                    success:function(r){ Swal.close(); if(r.success){
                        var row = {
                            id:r.data.id,
                            nombre:$('#nombre').val(),
                            abreviatura:$('#abreviatura').val(),
                            elemento:$('#elemento').val(),
                            ver: $('#ver').prop('checked')?1:0,
                            editar: $('#editar').prop('checked')?1:0,
                            eliminar: $('#eliminar').prop('checked')?1:0,
                            modulo_nombre: $('#moduloSelect option:selected').text(),
                            modulo: $('#moduloSelect').val()
                        };
                        if(idVal) table.row($('button.edit[data-id="'+idVal+'"]').parents('tr')).data(row).draw(false);
                        else table.row.add(row).draw(false);
                        bootstrap.Modal.getInstance($('#entityModal')).hide();
                        Swal.fire('¡Éxito!',r.message,'success');
                    } else Swal.fire('Error',r.message,'error'); },
                    error:function(j){Swal.close();Swal.fire('Error','Error de red: '+j.responseText,'error');}
                });
            });
        });
    </script>
</section>
<?php include __DIR__ . '../../../partials/footer.php'; ?>