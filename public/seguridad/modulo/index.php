<?php 
  require __DIR__.'../../../security/init.php';
  authorize('modulo');
  include __DIR__ . '../../../partials/header.php'; 
?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<section>
  <div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h2>Módulos</h2>
      <button id="btnCreate" class="btn btn-primary">Crear Nuevo</button>
    </div>
    <table id="table" class="table table-striped" style="width:100%">
      <thead><tr><th>ID</th><th>Nombre</th><th>Abreviatura</th><th>Elemento</th><th>Acciones</th></tr></thead>
    </table>
  </div>

  <!-- Modal Crear/Editar Módulo -->
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
          </form>
        </div>
        <div class="modal-footer">
          <button id="btnSave" class="btn btn-success">Guardar</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Submodulos -->
  <div class="modal fade" id="funcModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Submodulos del Módulo</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <ul id="assignedFuncList" class="list-group"></ul>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
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
    var baseURL = '../../controllers/seguridad/modulo/';
    var relURL  = '../../controllers/seguridad/modulo/'; // reutilizamos funcionalidad fetch

    var table = $('#table').DataTable({
      ajax: { url: baseURL + 'fetch.php', dataSrc: json => json.data.data },
      columns: [
        { data: 'id' },
        { data: 'nombre' },
        { data: 'abreviatura' },
        { data: 'elemento' },
        { data: null, render: d =>
          `<button class="btn btn-sm btn-warning edit" data-id="${d.id}">Editar</button>
          <button class="btn btn-sm btn-danger delete" data-id="${d.id}">Eliminar</button>
          <button class="btn btn-sm btn-info funcs" data-id="${d.id}">Submodulos</button>`
        }
      ]
    });

    $('#btnCreate').click(()=>{
      $('#modalTitle').text('Crear Módulo');
      $('#entityForm')[0].reset();
      $('#id').val('');
      new bootstrap.Modal($('#entityModal')).show();
    });

    table.on('click','.edit',function(){
      let id=$(this).data('id');
      $.getJSON(baseURL+'get.php',{id},r=>{
        if(r.success){
          $('#modalTitle').text('Editar Módulo');
          $('#id').val(r.data.id);
          $('#nombre').val(r.data.nombre);
          $('#abreviatura').val(r.data.abreviatura);
          $('#elemento').val(r.data.elemento);
          new bootstrap.Modal($('#entityModal')).show();
        }
      });
    });

    table.on('click','.delete',function(){
      let id=$(this).data('id');
      Swal.fire({title:'¿Eliminar módulo?',showCancelButton:true}).then(res=>{
        if(res.isConfirmed){
          $.post(baseURL+'delete.php',{id},r=>{
            if(r.success) table.row($(this).parents('tr')).remove().draw();
          },'json');
        }
      });
    });

    $('#btnSave').click(()=>{
      let idVal=$('#id').val(), data=$('#entityForm').serialize();
      $.post(baseURL+'save.php',data,r=>{
        if(r.success){
          let row={id:r.data.id,nombre:$('#nombre').val(),abreviatura:$('#abreviatura').val(),elemento:$('#elemento').val()};
          if(idVal) table.row($(`button.edit[data-id="${idVal}"]`).parents('tr')).data(row).draw();
          else table.row.add(row).draw();
          bootstrap.Modal.getInstance($('#entityModal')).hide();
        }
      },'json');
    });

    // Mostrar funcionalidades (solo lectura)
    function loadAssignedFuncs(modId){
      $.getJSON('../../controllers/seguridad/submodulo/get-modulo.php?id='+modId, r=>{
        let ul=$('#assignedFuncList').empty();
        r.data.data
          .filter(f => f.modulo == modId)
          .forEach(item => ul.append(`
            <li class="list-group-item">${item.nombre}</li>
          `));
      });
    }

    table.on('click','.funcs',function(){
      let modId=$(this).data('id');
      $('#funcModal').data('mod',modId);
      loadAssignedFuncs(modId);
      new bootstrap.Modal($('#funcModal')).show();
    });
  });
  </script>
</section>
<?php include __DIR__ . '../../../partials/footer.php'; ?>