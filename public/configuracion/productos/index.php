<?php
require __DIR__.'../../../security/init.php';
authorize('productos');
include __DIR__ . '../../../partials/header.php';
?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<section>
  <div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h2>Productos</h2>
      <button id="btnCreate" class="btn btn-primary">Crear Nuevo</button>
    </div>
    <table id="table" class="table table-striped" style="width:100%">
      <thead>
        <tr>
          <th>ID</th>
          <th>Código</th>
          <th>Nombre</th>
          <th>Unidad</th>
          <th>Subcategoría</th>
          <th>Valor Comercial</th>
          <th>Etiqueta</th>
          <th>Institución</th>
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
              <input type="text" id="codigo" name="codigo" class="form-control" placeholder="Código">
            </div>
            <div class="mb-3">
              <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Nombre">
            </div>
            <div class="mb-3">
              <input type="text" id="unidad" name="unidad" class="form-control" placeholder="Unidad">
            </div>

            <!-- 1. SELECT DE CATEGORÍA -->
            <div class="mb-3">
              <select id="categoria" name="categoria" class="form-select">
                <option value="">Seleccione Categoría</option>
              </select>
            </div>

            <!-- 2. SELECT DE SUBCATEGORÍA (se rellena según categoría seleccionada) -->
            <div class="mb-3">
              <select id="subcategoria" name="subcategoria" class="form-select">
                <option value="">Seleccione Subcategoría</option>
              </select>
            </div>

            <div class="mb-3">
              <textarea id="observaciones" name="observaciones" class="form-control" placeholder="Observaciones"></textarea>
            </div>
            <div class="mb-3">
              <input type="number" step="0.01" id="valor_comercial" name="valor_comercial" class="form-control" placeholder="Valor Comercial">
            </div>
            <!-- <div class="mb-3">
              <input type="text" id="etiqueta" name="etiqueta" class="form-control" placeholder="Etiqueta">
            </div> -->
            <hr>
            <!-- <div class="mb-3">
              <label class="form-label">Tipo de Institución</label>
              <select id="tipo" name="tipo" class="form-select">
                <option value="">Seleccione Tipo</option>
                <option value="abaco">Ábaco</option>
                <option value="banco">Banco</option>
              </select>
            </div> -->
            <!-- <div class="mb-3" id="bancoContainer" style="display:none;">
              <label class="form-label">Banco</label>
              <select id="institucion" name="institucion" class="form-select">
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
</section>

<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(function(){
  var base = '../../controllers/configuracion/producto/';
  var table = $('#table').DataTable({
    ajax: { url: base+'fetch.php', dataSrc: j => j.data },
    columns: [
      { data: 'id' },
      { data: 'codigo' },
      { data: 'nombre' },
      { data: 'unidad' },
      { data: 'subcategoria_nombre' },
      { data: 'valor_comercial' },
      { data: 'etiqueta' },
      { data: 'institucion_label' },
      {
        data: null, render: d =>
          `<button class="btn btn-sm btn-warning edit" data-id="${d.id}">Editar</button>
           <button class="btn btn-sm btn-danger delete" data-id="${d.id}">Eliminar</button>`
      }
    ]
  });

  function loadBancos(done) {
    $('#institucion').empty().append('<option value="">Seleccione Banco</option>');
    $.getJSON('../../controllers/bancos/banco/fetch.php', function(r){
      r.data.forEach(function(b){
        $('#institucion').append(`<option value="${b.id}">${b.nombre}</option>`);
      });
      if (typeof done === 'function') done();
    });
  }

  function loadCategorias(done) {
    $('#categoria').empty().append('<option value="">Seleccione Categoría</option>');
    $.getJSON('../../controllers/configuracion/categoria/fetch.php', function(r){
      r.data.data.forEach(function(c){
        $('#categoria').append(`<option value="${c.id}">${c.nombre}</option>`);
      });
      if (typeof done === 'function') done();
    });
  }

  function loadSubcategorias(categoriaId, done) {
    $('#subcategoria').empty().append('<option value="">Seleccione Subcategoría</option>');
    if (!categoriaId) {
      if (typeof done === 'function') done();
      return;
    }
    $.getJSON('../../controllers/configuracion/subcategoria/fetch_by_categoria.php', { categoria: categoriaId }, function(r){
      r.data.data.forEach(function(s){
        $('#subcategoria').append(`<option value="${s.id}">${s.nombre}</option>`);
      });
      if (typeof done === 'function') done();
    });
  }

  $('#tipo').on('change', function(){
    if (this.value === 'banco') {
      $('#bancoContainer').show();
      loadBancos();
    } else {
      $('#bancoContainer').hide();
    }
  });

  $('#btnCreate').click(function(){
    $('#modalTitle').text('Crear Producto');
    $('#entityForm')[0].reset();
    $('#bancoContainer').hide();

    loadCategorias(function(){
      loadSubcategorias('', function(){
        $('#categoria').val('');
        $('#subcategoria').val('');
      });
    });

    new bootstrap.Modal($('#entityModal')).show();
  });

  $('#categoria').on('change', function(){
    var catId = $(this).val();
    loadSubcategorias(catId);
  });

  $('#table').on('click', '.edit', function(){
    var idProducto = $(this).data('id');
    $.getJSON(base + 'get.php', { id: idProducto }, function(r){
      var d = r.data;
      $('#modalTitle').text('Editar Producto');
      $('#id').val(d.id);
      $('#codigo').val(d.codigo);
      $('#nombre').val(d.nombre);
      $('#unidad').val(d.unidad);
      $('#observaciones').val(d.observaciones);
      $('#valor_comercial').val(d.valor_comercial);
      $('#etiqueta').val(d.etiqueta);
      $('#tipo').val(d.tipo);

      if (d.tipo === 'banco') {
        $('#bancoContainer').show();
        loadBancos(function(){
          $('#institucion').val(d.institucion);
        });
      } else {
        $('#bancoContainer').hide();
      }

      loadCategorias(function(){
        console.log(d);        
        $('#categoria').val(d.subcategoria ? d.categoria : '');
        loadSubcategorias(d.categoria, function(){
          $('#subcategoria').val(d.subcategoria);
        });
      });

      new bootstrap.Modal($('#entityModal')).show();
    }).fail(function(){
      Swal.fire('Error', 'No se pudo cargar datos de producto', 'error');
    });
  });

  $('#table').on('click', '.delete', function(){
    var idProd = $(this).data('id');
    Swal.fire({
      title: '¿Eliminar producto?',
      showCancelButton: true
    }).then(function(res){
      if (res.isConfirmed) {
        $.post(base + 'delete.php', { id: idProd }, function(r){
          if (r.success) {
            table.row($(this).parents('tr')).remove().draw();
            Swal.fire('¡Eliminado!', '', 'success');
          } else {
            Swal.fire('Error', r.message, 'error');
          }
        }.bind(this), 'json');
      }
    }.bind(this));
  });

  $('#btnSave').click(function(){
    let formString = $('#entityForm').serialize();
    let new_institucion = (currentProfile.type == "superadmin") ? "0" : currentProfile.id;
    let new_tipo       = (currentProfile.type == "superadmin") ? "abaco" : "banco";
    let dataString = formString
      + '&institucion=' + encodeURIComponent(new_institucion)
      + '&tipo='       + encodeURIComponent(new_tipo);

    $.post(base + 'save.php', dataString, function(r){
      if (r.success) {
        table.ajax.reload(null, false);
        bootstrap.Modal.getInstance($('#entityModal')).hide();
        Swal.fire('¡Éxito!', r.message, 'success');
      } else {
        Swal.fire('Error', r.message, 'error');
      }
    }, 'json').fail(function(){
      Swal.fire('Error', 'Error de red', 'error');
    });
  });
});
</script>

<?php include __DIR__ . '../../../partials/footer.php'; ?>
