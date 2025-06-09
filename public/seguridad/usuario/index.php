<?php 
require __DIR__.'../../../security/init.php';
authorize('usuario');
include __DIR__ . '../../../partials/header.php'; 
?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<section>
  <div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h2>Usuarios</h2>
      <button id="btnCreate" class="btn btn-primary">Crear Nuevo</button>
    </div>
    <table id="table" class="table table-striped" style="width:100%">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Apellido</th>
          <th>Correo</th>
          <th>Usuario</th>
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
              <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Nombre" required>
            </div>
            <div class="mb-3">
              <input type="text" id="apellido" name="apellido" class="form-control" placeholder="Apellido" required>
            </div>
            <div class="mb-3">
              <input type="email" id="correo" name="correo" class="form-control" placeholder="Correo" required>
            </div>
            <div class="mb-3">
              <input type="text" id="usuarioField" name="usuario" class="form-control" placeholder="Usuario" required>
            </div>
            <div class="mb-3">
              <input type="password" id="contrasena" name="contrasena" class="form-control" placeholder="Contraseña" required>
            </div>
            <div class="mb-3">
              <input type="password" id="contrasena2" name="contrasena2" class="form-control" placeholder="Confirmar Contraseña" required>
            </div>
            <!-- <div class="mb-3">
              <input type="text" id="tipoField" name="tipo" class="form-control" placeholder="Tipo (sólo números)" required>
            </div>
            <div class="mb-3">
              <input type="text" id="categoriaField" name="categoria" class="form-control" placeholder="Categoría (sólo números)" required>
            </div> -->
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" id="btnSave" class="btn btn-success">Guardar</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="perfilModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Perfiles de Usuario</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <select id="perfilSelect" class="form-select mb-2">
            <option value="">Seleccione Perfil</option>
          </select>
          <button id="btnAddPerfil" class="btn btn-primary mb-3">Agregar Perfil</button>
          <ul id="assignedPerfList" class="list-group"></ul>
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
      var baseURL = '<?= BASE_URL ?>controllers/seguridad/usuario/';
      var relURL = '<?= BASE_URL ?>controllers/seguridad/usuario_perfil/';
      var basePerfilURL = '<?= BASE_URL ?>controllers/seguridad/perfil/';

      var table = $('#table').DataTable({
        ajax: { url: baseURL + 'fetch.php', dataSrc: 'data.data' },
        columns: [
          { data: 'id' },
          { data: 'nombre' },
          { data: 'apellido' },
          { data: 'correo' },
          { data: 'usuario' },
          { data: null, render: function(d){
              return '<button class="btn btn-sm btn-warning edit" data-id="'+d.id+'">Editar</button> '+
                    '<button class="btn btn-sm btn-danger delete" data-id="'+d.id+'">Eliminar</button> '+
                    '<button class="btn btn-sm btn-info profiles" data-id="'+d.id+'">Perfiles</button>';
            }}
        ]
      });

      $('#btnCreate').on('click', function(){
        $('#modalTitle').text('Crear Usuario');
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
              $('#modalTitle').text('Editar Usuario');
              $('#id').val(r.data.id);
              $('#nombre').val(r.data.nombre);
              $('#apellido').val(r.data.apellido);
              $('#correo').val(r.data.correo);
              $('#usuarioField').val(r.data.usuario);
              new bootstrap.Modal($('#entityModal')).show();
            } else {
              Swal.fire('Error', r.message, 'error');
            }
          },
          error: function(){ Swal.close(); Swal.fire('Error de red','', 'error'); }
        });
      });

      $('#table').on('click', '.delete', function(){
        var id = $(this).data('id');
        Swal.fire({ title: '¿Eliminar usuario?', showCancelButton: true }).then(res=>{
          if(res.isConfirmed){
            $.ajax({
              type: 'POST', url: baseURL + 'delete.php', data: { id: id }, dataType: 'json',
              beforeSend: function(){ Swal.fire({ title: 'Eliminando...', allowOutsideClick: false, didOpen: ()=> Swal.showLoading() }); },
              success: function(r){
                Swal.close();
                if(r.success){
                  table.row($('button.delete[data-id="'+id+'"]').parents('tr')).remove().draw(false);
                  Swal.fire('¡Eliminado!', r.message, 'success');
                } else {
                  Swal.fire('Error', r.message, 'error');
                }
              },
              error: function(){ Swal.close(); Swal.fire('Error de red','', 'error'); }
            });
          }
        });
      });

      function validarFormulario(){
        var email = $('#correo').val();
        var pass1 = $('#contrasena').val();
        var pass2 = $('#contrasena2').val();
        var re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if(!re.test(email)) { Swal.fire('Email inválido','','error'); return false; }
        if(pass1.length < 6) { Swal.fire('La contraseña debe tener al menos 6 caracteres','','warning'); return false; }
        if(pass1 !== pass2) { Swal.fire('Las contraseñas no coinciden','','warning'); return false; }
        return true;
      }

      $('#btnSave').on('click', function(){
        if(!validarFormulario()) return;
        var form = $('#entityForm');
        var idVal = $('#id').val();
        $.ajax({
          type: 'POST', url: baseURL + 'save.php', data: form.serialize(), dataType: 'json',
          beforeSend: function(){ Swal.fire({ title: idVal ? 'Actualizando...' : 'Creando...', allowOutsideClick: false, didOpen: ()=> Swal.showLoading() }); },
          success: function(r){
            Swal.close();
            if(r.success){
              var newData = {
                id: r.data.id,
                nombre: $('#nombre').val(),
                apellido: $('#apellido').val(),
                correo: $('#correo').val(),
                usuario: $('#usuarioField').val(),
              };
              if(idVal) table.row($('button.edit[data-id="'+idVal+'"]').parents('tr')).data(newData).draw(false);
              else table.row.add(newData).draw(false);
              bootstrap.Modal.getInstance($('#entityModal')).hide();
              Swal.fire('¡Éxito!', r.message, 'success');
            } else {
              Swal.fire('Error', r.message, 'error');
            }
          },
          error: function(jqXHR, textStatus){
            Swal.close();
            Swal.fire('Error de red: '+textStatus,'','error');
          }
        });
      });

      $('#tipoField, #categoriaField').on('keypress', function(e){
        if(e.which < 48 || e.which > 57) e.preventDefault();
      });

      function loadPerfiles(){
        $.getJSON(basePerfilURL+'fetch.php', function(r){
          var sel = $('#perfilSelect').empty().append('<option value="">Seleccione Perfil</option>');
          r.data.data.forEach(p=> sel.append('<option value="'+p.id+'">'+p.nombre+'</option>'));
        });
      }

      function loadAssigned(userId){
        $.getJSON(relURL+'fetch_by_user.php',{user:userId}, function(r){
          var ul = $('#assignedPerfList').empty();
          r.data.forEach(item=> ul.append('<li class="list-group-item d-flex justify-content-between align-items-center">'+
            item.nombre+
            '<button class="btn btn-sm btn-outline-danger remove-perf" data-id="'+item.id+'">×</button></li>'));
        });
      }

      $('#table').on('click','.profiles',function(){
        var userId = $(this).data('id');
        $('#perfilModal').data('user',userId);
        loadPerfiles();
        loadAssigned(userId);
        new bootstrap.Modal($('#perfilModal')).show();
      });

      $('#btnAddPerfil').on('click', function(){
        var user = $('#perfilModal').data('user');
        var perfil = $('#perfilSelect').val();
        if(!perfil) return Swal.fire('Selecciona un perfil','','info');
        if($('#assignedPerfList').find('button.remove-perf[data-id="'+perfil+'"]').length)
          return Swal.fire('Ya tienes asignado ese perfil','','warning');
        $.post(relURL+'agregar_perfil.php',{ usuario:user, perfil:perfil },function(r){
          if(r.success){ loadAssigned(user); Swal.fire('¡Agregado!',r.message,'success'); }
          else Swal.fire('Error',r.message,'error');
        },'json');
      });

      $('#assignedPerfList').on('click','.remove-perf',function(){
        var uid = $('#perfilModal').data('user');
        var id = $(this).data('id');
        $.post(relURL+'eliminar_perfil.php',{ usuario:uid, perfil:id },function(r){
          if(r.success){ loadAssigned(uid); Swal.fire('¡Eliminado!',r.message,'success'); }
          else Swal.fire('Error',r.message,'error');
        },'json');
      });
    });
  </script>
</section>

<?php include __DIR__ . '../../../partials/footer.php'; ?>
