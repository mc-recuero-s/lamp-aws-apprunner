<?php 
require __DIR__.'../../../security/init.php';
authorize('categorias');
include __DIR__ . '../../../partials/header.php';
?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<section>
  <div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h2>Categorías</h2>
      <button id="btnCreate" class="btn btn-primary">Crear Nueva</button>
    </div>
    <table id="table" class="table table-striped" style="width:100%">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Código</th>
          <th>Descripción</th>
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
              <input type="text" id="codigo" name="codigo" class="form-control" placeholder="Código">
            </div>
            <div class="mb-3">
              <textarea id="descripcion" name="descripcion" class="form-control" placeholder="Descripción"></textarea>
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
</section>

<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  $(document).ready(function () {
    var baseURL = '../../controllers/configuracion/categoria/';
    var table = $('#table').DataTable({
      ajax: { url: baseURL + 'fetch.php', dataSrc: json => json.data.data },
      columns: [
        { data: 'id' },
        { data: 'nombre' },
        { data: 'codigo' },
        { data: 'descripcion' },
        {
          data: null, render: d =>
            `<button class="btn btn-sm btn-warning edit" data-id="${d.id}">Editar</button>
             <button class="btn btn-sm btn-danger delete" data-id="${d.id}">Eliminar</button>`
        }
      ]
    });

    $('#btnCreate').on('click', () => {
      $('#modalTitle').text('Crear Categoría');
      $('#entityForm')[0].reset();
      $('#id').val('');
      new bootstrap.Modal($('#entityModal')).show();
    });

    table.on('click', '.edit', function(){
      let id = $(this).data('id');
      $.getJSON(baseURL + 'get.php', { id }, r => {
        if (r.success) {
          $('#modalTitle').text('Editar Categoría');
          $('#id').val(r.data.id);
          $('#nombre').val(r.data.nombre);
          $('#codigo').val(r.data.codigo);
          $('#descripcion').val(r.data.descripcion);
          new bootstrap.Modal($('#entityModal')).show();
        } else {
          Swal.fire('Error', r.message, 'error');
        }
      }).fail(() => Swal.fire('Error', 'Error de red', 'error'));
    });

    table.on('click', '.delete', function(){
      let id = $(this).data('id');
      Swal.fire({ title: '¿Eliminar categoría?', showCancelButton: true }).then(res => {
        if (res.isConfirmed) {
          $.post(baseURL + 'delete.php', { id }, r => {
            if (r.success) {
              table.row($(this).parents('tr')).remove().draw();
              Swal.fire('¡Eliminado!', r.message, 'success');
            } else {
              Swal.fire('Error', r.message, 'error');
            }
          }, 'json');
        }
      });
    });

    $('#btnSave').on('click', () => {
      let idVal = $('#id').val(), data = $('#entityForm').serialize();
      $.post(baseURL + 'save.php', data, r => {
        if (r.success) {
          let row = {
            id: r.data.id,
            nombre: $('#nombre').val(),
            codigo: $('#codigo').val(),
            descripcion: $('#descripcion').val()
          };
          if (idVal) {
            table.row($(`button.edit[data-id="${idVal}"]`).parents('tr')).data(row).draw();
          } else {
            table.row.add(row).draw();
          }
          bootstrap.Modal.getInstance($('#entityModal')).hide();
          Swal.fire('¡Éxito!', r.message, 'success');
        } else {
          Swal.fire('Error', r.message, 'error');
        }
      }, 'json').fail(() => Swal.fire('Error', 'Error de red', 'error'));
    });
  });
</script>

<?php include __DIR__ . '../../../partials/footer.php'; ?>
