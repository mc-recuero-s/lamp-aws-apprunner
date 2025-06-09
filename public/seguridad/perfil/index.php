<?php 
  require __DIR__.'../../../security/init.php';
  authorize('perfil');
  include __DIR__ . '../../../partials/header.php'; 
?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<section>
  <div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h2>Perfiles</h2>
      <button id="btnCreate" class="btn btn-primary">Crear Nuevo</button>
    </div>
    <table id="table" class="table table-striped" style="width:100%">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Código</th>
          <th>Acciones</th>
        </tr>
      </thead>
    </table>
  </div>

  <!-- Modal Crear/Editar Perfil -->
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
              <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Nombre" required>
            </div>
            <div class="mb-3">
              <label for="codigo" class="form-label">Código</label>
              <select id="codigo" name="codigo" class="form-select" required>
                <option value="">Seleccione Código</option>
                <option value="superadmin">superadmin</option>
                <option value="banco">banco</option>
                <option value="bodega">bodega</option>
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

  <!-- Modal Roles -->
  <div class="modal fade" id="rolesModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Roles del Perfil</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <select id="roleSelect" class="form-select mb-2">
            <option value="">Seleccione Rol</option>
          </select>
          <button id="btnAddRole" class="btn btn-primary mb-3">Agregar Rol</button>
          <ul id="assignedRoleList" class="list-group"></ul>
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
      var baseURL = '../../controllers/seguridad/perfil/';
      var relURL  = '../../controllers/seguridad/perfil_rol/';

      var table = $('#table').DataTable({
        ajax: { url: baseURL + 'fetch.php', dataSrc: 'data.data' },
        columns: [
          { data: 'id' },
          { data: 'nombre' },
          { data: 'codigo' },
          { data: null, render: function(d){
              return '<button class="btn btn-sm btn-warning edit" data-id="'+d.id+'">Editar</button> '
                   + '<button class="btn btn-sm btn-danger delete" data-id="'+d.id+'">Eliminar</button> '
                   + '<button class="btn btn-sm btn-info roles" data-id="'+d.id+'">Roles</button>';
            }}
        ]
      });

      $('#btnCreate').on('click', function(){
        $('#modalTitle').text('Crear Perfil');
        $('#entityForm')[0].reset();
        $('#id').val('');
        new bootstrap.Modal($('#entityModal')).show();
      });

      $('#table').on('click', '.edit', function(){
        var id = $(this).data('id');
        $.ajax({
          type: 'GET', url: baseURL + 'get.php', data: { id: id }, dataType: 'json',
          beforeSend: function(){ Swal.fire({ title: 'Espere...', allowOutsideClick: false, didOpen: ()=> Swal.showLoading() }); },
          success: function(r){
            Swal.close();
            if(r.success){
              $('#modalTitle').text('Editar Perfil');
              $('#id').val(r.data.id);
              $('#nombre').val(r.data.nombre);
              $('#codigo').val(r.data.codigo);
              new bootstrap.Modal($('#entityModal')).show();
            } else Swal.fire('Error', r.message, 'error');
          },
          error: function(){ Swal.close(); Swal.fire('Error de red','', 'error'); }
        });
      });

      $('#table').on('click', '.delete', function(){
        var id = $(this).data('id');
        Swal.fire({ title: '¿Eliminar perfil?', showCancelButton: true }).then(res => {
          if(res.isConfirmed){
            $.ajax({
              type: 'POST', url: baseURL + 'delete.php', data: { id: id }, dataType: 'json',
              beforeSend: function(){ Swal.fire({ title: 'Eliminando...', allowOutsideClick: false, didOpen: ()=> Swal.showLoading() }); },
              success: function(r){
                Swal.close();
                if(r.success){
                  table.row($('button.delete[data-id="'+id+'"]').parents('tr')).remove().draw(false);
                  Swal.fire('¡Eliminado!', r.message, 'success');
                } else Swal.fire('Error', r.message, 'error');
              },
              error: function(){ Swal.close(); Swal.fire('Error de red','', 'error'); }
            });
          }
        });
      });

      $('#btnSave').on('click', function(){
        var form = $('#entityForm');
        var idVal = $('#id').val();
        if(!$('#nombre').val() || !$('#codigo').val()) return Swal.fire('Todos los campos son obligatorios', '', 'warning');
        $.ajax({
          type: 'POST', url: baseURL + 'save.php', data: form.serialize(), dataType: 'json',
          beforeSend: function(){ Swal.fire({ title: idVal ? 'Actualizando...' : 'Creando...', allowOutsideClick: false, didOpen: ()=> Swal.showLoading() }); },
          success: function(r){
            Swal.close();
            if(r.success){
              var newData = { id: r.data.id, nombre: $('#nombre').val(), codigo: $('#codigo').val() };
              if(idVal) table.row($('button.edit[data-id="'+idVal+'"]').parents('tr')).data(newData).draw(false);
              else table.row.add(newData).draw(false);
              bootstrap.Modal.getInstance($('#entityModal')).hide();
              Swal.fire('¡Éxito!', r.message, 'success');
            } else Swal.fire('Error', r.message, 'error');
          },
          error: function(){ Swal.close(); Swal.fire('Error de red','', 'error'); }
        });
      });

      // Funciones para Roles
      function loadRoles(){
        $.getJSON('../../controllers/seguridad/rol/fetch.php', function(r){
          var sel = $('#roleSelect').empty().append('<option value="">Seleccione Rol</option>');
          r.data.data.forEach(function(x){ sel.append('<option value="'+x.id+'">'+x.nombre+'</option>'); });
        });
      }

      function loadAssignedRoles(perfilId){
        $.getJSON(relURL + 'fetch_by_perfil.php', { perfil: perfilId }, function(r){
          var ul = $('#assignedRoleList').empty();
          r.data.forEach(function(item){
            ul.append(
              '<li class="list-group-item d-flex justify-content-between align-items-center">' +
              item.nombre +
              '<button class="btn btn-sm btn-outline-danger remove-role" data-id="'+item.id+'">×</button>' +
              '</li>'
            );
          });
        });
      }

      $('#table').on('click', '.roles', function(){
        var perfilId = $(this).data('id');
        $('#rolesModal').data('perfil', perfilId);
        loadRoles();
        loadAssignedRoles(perfilId);
        new bootstrap.Modal($('#rolesModal')).show();
      });

      $('#btnAddRole').on('click', function(){
        var perfil = $('#rolesModal').data('perfil');
        var rol    = $('#roleSelect').val();
        if(!rol) return Swal.fire('Selecciona un rol','','info');
        if($('#assignedRoleList').find('[data-id="'+rol+'"]').length)
          return Swal.fire('Rol duplicado','','warning');
        $.post(relURL + 'agregar_rol.php', { perfil: perfil, rol: rol }, function(r){
          if(r.success){ loadAssignedRoles(perfil); Swal.fire('¡Agregado!', r.message, 'success'); }
          else Swal.fire('Error', r.message, 'error');
        }, 'json');
      });

      $('#assignedRoleList').on('click', '.remove-role', function(){
        var perfil = $('#rolesModal').data('perfil');
        var rol    = $(this).data('id');
        $.post(relURL + 'eliminar_rol.php', { perfil: perfil, rol: rol }, function(r){
          if(r.success){ loadAssignedRoles(perfil); Swal.fire('¡Eliminado!', r.message, 'success'); }
          else Swal.fire('Error', r.message, 'error');
        }, 'json');
      });
    });
  </script>
</section>
<?php include __DIR__ . '../../../partials/footer.php'; ?>
