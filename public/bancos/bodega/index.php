<?php
require __DIR__ . '/../../security/init.php';
authorize('bodega');
include __DIR__ . '/../../partials/header.php';
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<section>
  <div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h2>Bodegas</h2>
      <?php
        if ($profile === 'banco'):
      ?>
        <button id="btnCreate" class="btn btn-primary">Crear Nueva Bodega</button>
      <?php endif; ?>
    </div>
    <table id="table" class="table table-striped" style="width:100%">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Código</th>
          <th>Banco</th>
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
              <label for="nombre" class="form-label">Nombre</label>
              <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Nombre">
            </div>
            <div class="mb-3">
              <label for="codigo" class="form-label">Código</label>
              <input type="text" id="codigo" name="codigo" class="form-control" placeholder="Código">
            </div>
            <!-- <div class="mb-3">
              <label for="bancoSelect" class="form-label">Banco</label>
              <select id="bancoSelect" name="banco" class="form-select">
                <option value="">Seleccione Banco</option>
              </select>
            </div> -->
          </form>
        </div>
        <div class="modal-footer">
          <button id="btnSave" class="btn btn-success">Guardar</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="userModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Usuarios de la Bodega</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <select id="userSelect" class="form-select mb-2">
            <option value="">Seleccione Usuario</option>
          </select>
          <button id="btnAddUser" class="btn btn-primary mb-3">Agregar Usuario</button>
          <ul id="assignedUserList" class="list-group"></ul>
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
      var baseURL = '../../controllers/bancos/bodega/';
      var bancoURL = '../../controllers/bancos/banco/fetch.php';

      var table = $('#table').DataTable({
        ajax: { url: baseURL + 'fetch.php', dataSrc: function(json){ return json.data; } },
        columns: [
          { data: 'id' },
          { data: 'nombre' },
          { data: 'codigo' },
          { data: 'banco_nombre' },
          { data: null, render: function(d){
              return ((currentProfile.type=="banco")?'<button class="btn btn-sm btn-warning edit me-1" data-id="'+d.id+'" data-id2="'+d.id2+'">Editar</button>':"")
                  + ((currentProfile.type=="banco")?'<button class="btn btn-sm btn-danger delete me-1" data-id="'+d.id+'" data-id2="'+d.id2+'">Eliminar</button>':"")
                  + ((currentProfile.type=="banco")?'<button class="btn btn-sm btn-info usuarios" data-id="'+d.id+'" data-id2="'+d.id2+'">Usuarios</button>':"");
            }
          }
        ]
      });

      function loadBancos(selected){
        $.getJSON(bancoURL, function(r){
          var sel = $('#bancoSelect').empty().append('<option value="">Seleccione Banco</option>');
          r.data.forEach(function(b){
            var o = $('<option>').val(b.id).text(b.nombre);
            if(b.id == selected) o.attr('selected', true);
            sel.append(o);
          });
        });
      }

      $('#btnCreate').on('click', function(){
        $('#modalTitle').text('Crear Bodega');
        $('#entityForm')[0].reset();
        $('#id').val('');
        loadBancos();
        new bootstrap.Modal($('#entityModal')).show();
      });

      $('#table').on('click', '.edit', function(){
        var id = $(this).data('id');
        $.getJSON(baseURL + 'get.php', { id: id }, function(r){
          $('#modalTitle').text('Editar Bodega');
          $('#id').val(r.data.id);
          $('#nombre').val(r.data.nombre);
          $('#codigo').val(r.data.codigo);
          loadBancos(r.data.banco);
          new bootstrap.Modal($('#entityModal')).show();
        });
      });

      $('#table').on('click', '.delete', function(){
        var id = $(this).data('id');
        Swal.fire({ title:'¿Eliminar bodega?', showCancelButton:true }).then(res=>{
          if(res.isConfirmed){
            $.post(baseURL+'delete.php',{id:id},function(r){
              if(r.success){ table.ajax.reload(); Swal.fire('¡Eliminado!',r.message,'success'); }
              else Swal.fire('Error',r.message,'error');
            },'json');
          }
        });
      });

      $('#btnSave').on('click', function(){
        let formString = $('#entityForm').serialize();
        let banco = (currentProfile.type == "superadmin") ? "0" : currentProfile.id;
        let dataString = formString
          + '&banco=' + encodeURIComponent(banco);
        Swal.fire({ title: $('#id').val() ? 'Actualizando...' : 'Creando...', allowOutsideClick:false, didOpen:()=>Swal.showLoading() });
        $.post(baseURL+'save.php', dataString, function(r){
          Swal.close();
          if(r.success){ table.ajax.reload(null,false); bootstrap.Modal.getInstance($('#entityModal')).hide(); Swal.fire('¡Éxito!',r.message,'success'); }
          else Swal.fire('Error',r.message,'error');
        },'json').fail(function(){ Swal.close(); Swal.fire('Error','Error de red','error'); });
      });

      $('#table').on('click', '.usuarios', function(){
        var bodega = $(this).data('id');
        $('#userModal').data('bodega',bodega);
        $('#userSelect').empty().append('<option value="">Seleccione Usuario</option>');
        loadAssignedUsers(bodega);
        loadAvailableUsers(bodega);
        new bootstrap.Modal($('#userModal')).show();
      });

      function loadAssignedUsers(bodega){
        $.getJSON(baseURL+'fetch_users.php',{bodega:bodega},function(r){
          var ul = $('#assignedUserList').empty();
          r.data.forEach(function(u){
            ul.append('<li class="list-group-item d-flex justify-content-between align-items-center">'+u.nombre+' '+(u.apellido||'')+'<button class="btn btn-sm btn-outline-danger remove-user" data-id="'+u.id+'">&times;</button></li>');
          });
        });
      }

      function loadAvailableUsers(bodega){
        $.getJSON(baseURL+'fetch_available_users.php',{bodega:bodega},function(r){
          var sel = $('#userSelect').empty().append('<option value="">Seleccione Usuario</option>');
          r.data.forEach(function(u){
            sel.append('<option value="'+u.id+'">'+u.nombre+' '+(u.apellido||'')+'</option>');
          });
        });
      }

      $('#btnAddUser').on('click', function(){
        var bodega = $('#userModal').data('bodega');
        var usuario = $('#userSelect').val();
        console.log(usuario);
        
        if(!usuario) return Swal.fire('Selecciona un usuario','','info');
        if($('#assignedUserList').find('[data-id2="'+usuario+'"]').length) return Swal.fire('Duplicado','','warning');
        $.post(baseURL+'agregar_usuario.php',{bodega:bodega,usuario:usuario},function(r){
          if(r.success){ loadAssignedUsers(bodega); loadAvailableUsers(bodega); Swal.fire('¡Agregado!',r.message,'success'); }
          else Swal.fire('Error',r.message,'error');
        },'json');
      });

      $('#assignedUserList').on('click','.remove-user',function(){
        var bodega = $('#userModal').data('bodega');
        var id = $(this).data('id');
        $.post(baseURL+'eliminar_usuario.php',{id:id},function(r){
          if(r.success){ loadAssignedUsers(bodega); loadAvailableUsers(bodega); Swal.fire('¡Eliminado!',r.message,'success'); }
          else Swal.fire('Error',r.message,'error');
        },'json');
      });
    });
  </script>
</section>

<?php include __DIR__ . '/../../partials/footer.php'; ?>
