<?php 
  require __DIR__.'../../../security/init.php';
  authorize('rol');
  include __DIR__ . '../../../partials/header.php'; 
?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<section>
<div class="container mt-5">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Roles</h2>
    <button id="btnCreate" class="btn btn-primary">Crear Nuevo</button>
  </div>
  <table id="table" class="table table-striped" style="width:100%">
    <thead>
      <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Categoría</th>
        <th>Acciones</th>
      </tr>
    </thead>
  </table>
</div>

<!-- Modal Crear/Editar Rol -->
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
          <div class="mb-3"><input type="text" id="categoria" name="categoria" class="form-control" placeholder="Categoría"></div>
        </form>
      </div>
      <div class="modal-footer">
        <button id="btnSave" class="btn btn-success">Guardar</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Módulos -->
<div class="modal fade" id="modModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Módulos del Rol</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <select id="modSelect" class="form-select mb-2">
          <option value="">Seleccione Módulo</option>
        </select>
        <button id="btnAddMod" class="btn btn-primary mb-3">Agregar Módulo</button>
        <ul id="assignedModList" class="list-group"></ul>
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

      var baseURL = '../../controllers/seguridad/rol/';
      var relURL  = '../../controllers/seguridad/rol_modulo/';
      var submModuloURL  = '../../controllers/seguridad/submodulo/';

      var table = $('#table').DataTable({
        ajax: { url: baseURL + 'fetch.php', dataSrc: json => json.data.data },
        columns: [
          { data: 'id' },
          { data: 'nombre' },
          { data: 'categoria' },
          { data: null, render: d =>
              `<button class="btn btn-sm btn-warning edit" data-id="${d.id}">Editar</button>
              <button class="btn btn-sm btn-danger delete" data-id="${d.id}">Eliminar</button>
              <button class="btn btn-sm btn-info modules" data-id="${d.id}">Módulos</button>`
          }
        ]
      });

      $('#btnCreate').on('click', () => {
        $('#modalTitle').text('Crear Rol');
        $('#entityForm')[0].reset();
        $('#id').val('');
        new bootstrap.Modal($('#entityModal')).show();
      });

      table.on('click', '.edit', function(){
        let id = $(this).data('id');
        $.getJSON(baseURL + 'get.php', { id }, r => {
          if (r.success) {
            $('#modalTitle').text('Editar Rol');
            $('#id').val(r.data.id);
            $('#nombre').val(r.data.nombre);
            $('#categoria').val(r.data.categoria);
            new bootstrap.Modal($('#entityModal')).show();
          } else Swal.fire('Error', r.message, 'error');
        }).fail(() => Swal.fire('Error', 'Error de red', 'error'));
      });

      table.on('click', '.delete', function(){
        let id = $(this).data('id');
        Swal.fire({ title: '¿Eliminar rol?', showCancelButton: true }).then(res => {
          if (res.isConfirmed) {
            $.post(baseURL + 'delete.php', { id }, r => {
              if (r.success) {
                table.row($(this).parents('tr')).remove().draw();
                Swal.fire('¡Eliminado!', r.message, 'success');
              } else Swal.fire('Error', r.message, 'error');
            }, 'json');
          }
        });
      });

      $('#btnSave').on('click', () => {
        let idVal = $('#id').val(), data = $('#entityForm').serialize();
        $.post(baseURL + 'save.php', data, r => {
          if (r.success) {
            let row = { id: r.data.id, nombre: $('#nombre').val(), categoria: $('#categoria').val() };
            if (idVal) table.row($(`button.edit[data-id="${idVal}"]`).parents('tr')).data(row).draw();
            else table.row.add(row).draw();
            bootstrap.Modal.getInstance($('#entityModal')).hide();
            Swal.fire('¡Éxito!', r.message, 'success');
          } else Swal.fire('Error', r.message, 'error');
        }, 'json').fail(() => Swal.fire('Error', 'Error de red', 'error'));
      });

      // Funciones para Rol-Modulo
      function loadModules() {
        $.getJSON('../../controllers/seguridad/submodulo/fetch.php', r => {
          let sel = $('#modSelect').empty().append('<option value="">Seleccione Módulo</option>');
          r.data.data.forEach(m => sel.append(`<option value="${m.id}">${m.nombre}</option>`));
        });
      }

      function loadAssignedModules(roleId) {
        $.getJSON(relURL + 'fetch_by_rol.php', { rol: roleId }, r => {
          let ul = $('#assignedModList').empty();
          r.data.forEach(item => {
            ul.append(
              `<li class="list-group-item d-flex justify-content-between align-items-center">
                ${item.nombre}
                <button class="btn btn-sm btn-outline-danger remove-mod" data-id="${item.id}">&times;</button>
              </li>`
            );
          });
        });
      }

      table.on('click', '.modules', function(){
        let roleId = $(this).data('id');
        $('#modModal').data('role', roleId);
        loadModules();
        loadAssignedModules(roleId);
        new bootstrap.Modal($('#modModal')).show();
      });

      $('#btnAddMod').on('click', () => {
        let role = $('#modModal').data('role');
        let mod = $('#modSelect').val();
        if (!mod) return Swal.fire('Selecciona un módulo', '', 'info');
        if ($('#assignedModList').find(`[data-id="${mod}"]`).length) return Swal.fire('Duplicado', '', 'warning');
        $.post(relURL + 'agregar_modulo.php', { rol: role, modulo: mod }, r => {
          if (r.success) { loadAssignedModules(role); Swal.fire('¡Agregado!', r.message, 'success'); }
          else Swal.fire('Error', r.message, 'error');
        }, 'json');
      });

      $('#assignedModList').on('click', '.remove-mod', function(){
        let role = $('#modModal').data('role');
        let mod = $(this).data('id');
        $.post(relURL + 'eliminar_modulo.php', { rol: role, modulo: mod }, r => {
          if (r.success) { loadAssignedModules(role); Swal.fire('¡Eliminado!', r.message, 'success'); }
          else Swal.fire('Error', r.message, 'error');
        }, 'json');
      });
    });
</script>
</section>
<?php include __DIR__ . '../../../partials/footer.php'; ?>