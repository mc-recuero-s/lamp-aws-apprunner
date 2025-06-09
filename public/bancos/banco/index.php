<?php
require __DIR__ . '/../../security/init.php';
authorize('banco');
include __DIR__ . '/../../partials/header.php';
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<section>
  <div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h2>Bancos</h2>
      <?php
        if ($profile === 'superadmin'):
      ?>
        <button id="btnCreate" class="btn btn-primary">Crear Nuevo Banco</button>
      <?php endif; ?>
    </div>

    <table id="table" class="table table-striped" style="width:100%">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Logo</th>
          <th>Colores</th>
          <th>Acciones</th>
        </tr>
      </thead>
    </table>
  </div>

  <!-- Modal Crear/Editar Banco -->
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
              <label for="logo" class="form-label">Logo (PNG)</label>
              <input type="file" id="logo" accept="image/png" class="form-control">
            </div>
            <div class="mb-3">
              <label class="form-label">Colores</label>
              <div class="row g-2">
                <div class="col"><label>Primario</label><input type="color" id="color_primario" class="form-control form-control-color"></div>
                <div class="col"><label>Secundario</label><input type="color" id="color_secundario" class="form-control form-control-color"></div>
                <div class="col"><label>Iconos</label><input type="color" id="color_iconos" class="form-control form-control-color"></div>
                <div class="col"><label>Fondos</label><input type="color" id="color_fondos" class="form-control form-control-color"></div>
                <div class="col"><label>Textos</label><input type="color" id="color_texto" class="form-control form-control-color"></div>
              </div>
            </div>
            <div class="mb-3">
              <label for="estilos" class="form-label">Estilos (JSON)</label>
              <textarea id="estilos" class="form-control" rows="3" placeholder='{"fontSize":"14px","borderRadius":"4px"}'></textarea>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button id="btnSave" class="btn btn-success">Guardar</button>
          <button type="button" class="btn btn-secundario" data-bs-dismiss="modal">Cancelar</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Usuarios -->
  <div class="modal fade" id="userModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Usuarios del Banco</h5>
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
          <button type="button" class="btn btn-secundario" data-bs-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
  <script>
    $(document).ready(function () {
      var baseURL = '../../controllers/bancos/banco/';
      var baseImagesURL = '../../images/uploads/bancos/';

      var table = $('#table').DataTable({
        ajax: { url: baseURL + 'fetch.php', dataSrc: function(json){ return json.data; } },
        columns: [
          { data: 'id' },
          { data: 'nombre' },
          { data: 'logo', render: function(d){ return d ? '<img src="'+baseImagesURL+d+'" width="50">' : ''; } },
          { data: 'colores', render: function(d){ var c=JSON.parse(d||'{}'), s=''; for(var k in c) s+='<div style="display:inline-block;width:20px;height:20px;background:'+c[k]+';margin:2px;border:1px solid #ccc;" title="'+k+'"></div>'; return s; } },
          { data: null, render: function(d){
              return ((currentProfile.type=="superadmin" || currentProfile.type=="banco")?'<button class="btn btn-sm btn-warning edit me-1" data-id="'+d.id+'">Editar</button>':"")
              + ((currentProfile.type=="superadmin")?'<button class="btn btn-sm btn-danger delete" data-id="'+d.id+'">Eliminar</button>':"")
              + '<button class="btn btn-sm btn-info usuarios me-1" data-id="'+d.id+'">Usuarios</button>';
            }
          }
        ]
      });

      $('#btnCreate').click(function(){
        $('#modalTitle').text('Crear Banco');
        $('#entityForm')[0].reset();
        $('#id').val('');
        $('#color_primario, #color_secundario, #color_iconos, #color_fondos, #color_texto').val('#000000');
        $('#estilos').val('');
        new bootstrap.Modal($('#entityModal')).show();
      });

      $('#table').on('click','.edit',function(){
        var id = $(this).data('id');
        $.getJSON(baseURL+'get.php',{id:id},function(r){
          if(!r.success) return Swal.fire('Error',r.message,'error');
          var d=r.data;
          $('#modalTitle').text('Editar Banco');
          $('#id').val(d.id);
          $('#nombre').val(d.nombre);
          var cols=JSON.parse(d.colores||'{}');
          $('#color_primario').val(cols.primario||'#000000');
          $('#color_secundario').val(cols.secundario||'#000000');
          $('#color_iconos').val(cols.iconos||'#000000');
          $('#color_fondos').val(cols.fondos||'#000000');
          $('#color_texto').val(cols.texto||'#000000');
          $('#estilos').val(d.estilos||'');
          new bootstrap.Modal($('#entityModal')).show();
        });
      });

      $('#table').on('click','.delete',function(){
        var id = $(this).data('id');
        Swal.fire({ title:'¿Eliminar banco?', showCancelButton:true }).then(res=>{
          if(res.isConfirmed){
            $.post(baseURL+'delete.php',{id:id},function(r){
              if(r.success){ table.ajax.reload(); Swal.fire('¡Eliminado!',r.message,'success'); }
              else Swal.fire('Error',r.message,'error');
            },'json');
          }
        });
      });

      $('#btnSave').click(function(){
        var payload = {
          id: $('#id').val() || null,
          nombre: $('#nombre').val(),
          colores: {
            primario: $('#color_primario').val(),
            secundario: $('#color_secundario').val(),
            iconos: $('#color_iconos').val(),
            fondos: $('#color_fondos').val(),
            texto: $('#color_texto').val()
          },
          estilos: $('#estilos').val()
        };
        var file = $('#logo')[0].files[0];
        function send(){
          Swal.fire({ title: payload.id? 'Actualizando...':'Creando...', allowOutsideClick:false, didOpen:()=>Swal.showLoading() });
          $.ajax({
            url: baseURL+'save.php',
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(payload),
            dataType: 'json'
          }).done(function(r){
            Swal.close();
            if(r.success){ table.ajax.reload(); bootstrap.Modal.getInstance($('#entityModal')).hide(); Swal.fire('¡Éxito!',r.message,'success'); }
            else Swal.fire('Error',r.message,'error');
          }).fail(function(){ Swal.close(); Swal.fire('Error','Error de red','error'); });
        }
        if(file){
          var reader = new FileReader();
          reader.onload = function(e){
            payload.logoBase64 = e.target.result.split(',')[1];
            send();
          };
          reader.readAsDataURL(file);
        } else send();
      });

      $('#table').on('click','.usuarios',function(){
        var banco = $(this).data('id');
        $('#userModal').data('banco', banco);
        $('#userSelect').empty().append('<option value="">Seleccione Usuario</option>');
        loadAssignedUsers(banco);
        loadAvailableUsers(banco);
        new bootstrap.Modal($('#userModal')).show();
      });

      function loadAssignedUsers(banco){
        $.getJSON(baseURL+'fetch_users.php',{banco:banco},function(r){
          var ul = $('#assignedUserList').empty();
          console.log(r);
          
          r.data.forEach(u=>{
            console.log(u);
            
            ul.append(
              '<li class="list-group-item d-flex justify-content-between align-items-center">'+
                u.nombre+' '+(u.apellido||'')+
                '<button class="btn btn-sm btn-outline-danger remove-user" data-id="'+u.id+'">&times;</button>'+
              '</li>'
            );
          });
        });
      }

      function loadAvailableUsers(banco){
        $.getJSON(baseURL+'fetch_available_users.php',{banco:banco},function(r){
          var sel = $('#userSelect').empty().append('<option value="">Seleccione Usuario</option>');
          r.data.forEach(u=>{
            sel.append('<option value="'+u.id+'">'+u.nombre+' '+(u.apellido||'')+'</option>');
          });
        });
      }

      $('#btnAddUser').on('click',()=>{
        var banco = $('#userModal').data('banco');
        var usuario = $('#userSelect').val();
        if(!usuario) return Swal.fire('Selecciona un usuario','','info');
        if($('#assignedUserList').find('[data-id="'+usuario+'"]').length) return Swal.fire('Duplicado','','warning');
        $.post(baseURL+'agregar_usuario.php',{banco,usuario},r=>{
          if(r.success){ loadAssignedUsers(banco); loadAvailableUsers(banco); Swal.fire('¡Agregado!',r.message,'success'); }
          else Swal.fire('Error',r.message,'error');
        },'json');
      });

      $('#assignedUserList').on('click','.remove-user',function(){
        var banco = $('#userModal').data('banco');
        var id = $(this).data('id');
        $.post(baseURL+'eliminar_usuario.php',{id:id},r=>{
          if(r.success){ loadAssignedUsers(banco); loadAvailableUsers(banco); Swal.fire('¡Eliminado!',r.message,'success'); }
          else Swal.fire('Error',r.message,'error');
        },'json');
      });
    });
  </script>
</section>
<?php include __DIR__ . '/../../partials/footer.php'; ?>
