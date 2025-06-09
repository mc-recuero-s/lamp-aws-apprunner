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
      <h2>Categorizaciones</h2>
      <button id="btnCreate" class="btn btn-primary">Crear Nueva</button>
    </div>
    <table id="table" class="table table-striped" style="width:100%">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Versión</th>
          <th>Actual</th>
          <th>Creado</th>
          <th>Acciones</th>
        </tr>
      </thead>
    </table>
  </div>

  <!-- Modal Crear/Editar Categorización -->
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
              <input type="number" id="version" name="version" class="form-control" placeholder="Versión">
            </div>
            <div class="form-check mb-3">
              <input class="form-check-input" type="checkbox" id="actual" name="actual">
              <label class="form-check-label" for="actual">Actual</label>
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

  <!-- Modal Items de Categorización -->
  <div class="modal fade" id="itemsModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Items de Categorización</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div id="dragContainer" class="d-flex flex-wrap mb-3 p-2 border" style="min-height:80px"></div>
          <div class="row g-2">
            <div class="col">
              <select id="sel_fragmento" class="form-select">
                <option value="" disabled>Selecciona Fragmento</option>
                <option value="codigo_categoria">Código Categoría</option>
                <option value="codigo_subcategoria">Código Subcategoría</option>
                <option value="fecha">Fecha</option>
                <option value="numeral">Numeral</option>
                <option value="codigo_benefactor">Código Benefactor</option>
                <option value="personalizado">Personalizado</option>
              </select>
            </div>
            <div class="col">
              <input id="inp_personalizado" class="form-control" placeholder="Texto Personalizado" disabled>
            </div>
            <div class="col-auto">
              <button id="btnAddItem" class="btn btn-primary">Agregar</button>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
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
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
$(document).ready(function(){
  var baseURL = '../../controllers/categorizacion/';
  var baseIt  = '../../controllers/categorizacion_item/';

  var table = $('#table').DataTable({
    ajax: { url: baseURL + 'fetch.php', dataSrc: json => json.data.data },
    columns: [
      { data: 'id' },
      { data: 'nombre' },
      { data: 'version' },
      { data: d => d.actual ? 'Sí' : 'No' },
      { data: 'creado' },
      { data: null, render: d =>
          `<button class="btn btn-sm btn-warning edit" data-id="${d.id}">Editar</button>
           <button class="btn btn-sm btn-danger delete" data-id="${d.id}">Eliminar</button>
           <button class="btn btn-sm btn-info items" data-id="${d.id}">Items</button>`
      }
    ]
  });

  $('#btnCreate').click(function(){
    $('#modalTitle').text('Crear Categorización');
    $('#entityForm')[0].reset();
    $('#id').val('');
    new bootstrap.Modal($('#entityModal')).show();
  });

  table.on('click','.edit',function(){
    var id = $(this).data('id');
    $.getJSON(baseURL + 'get.php',{id},r=>{
      $('#modalTitle').text('Editar Categorización');
      $('#id').val(r.data.data.id);
      $('#nombre').val(r.data.data.nombre);
      $('#version').val(r.data.data.version);
      $('#actual').prop('checked',r.data.data.actual==1);
      new bootstrap.Modal($('#entityModal')).show();
    });
  });

  table.on('click','.delete',function(){
    var id = $(this).data('id');
    Swal.fire({title:'¿Eliminar?',showCancelButton:true})
      .then(res=>res.isConfirmed && $.post(baseURL+'delete.php',{id},r=>{
        table.row($(this).parents('tr')).remove().draw();
        Swal.fire('Eliminado',r.message,'success');
      },'json'));
  });

  $('#btnSave').click(function(){
    $.post(baseURL+'save.php',$('#entityForm').serialize(),r=>{
      table.ajax.reload();
      bootstrap.Modal.getInstance($('#entityModal')).hide();
      Swal.fire('¡Éxito!',r.message,'success');
    },'json');
  });

  // Items
  var sortable;
  table.on('click','.items',function(){
    var cat = $(this).data('id');
    $('#itemsModal').data('cat',cat);
    loadItems(cat);
    new bootstrap.Modal($('#itemsModal')).show();
  });

  function loadItems(cat){
    $.getJSON(baseIt+'fetch.php',{categorizacion:cat},r=>{
      const cont = $('#dragContainer').empty();
      r.data.data.forEach(item=>{
        cont.append(
          `<div class="badge bg-secondary me-2 mb-2 p-2" data-id="${item.id}">
            ${item.tipo}
          </div>`
        );
      });
      sortable = new Sortable(cont[0], {
        animation: 150,
        onEnd: () => {
          const order = $(cont).children().map((_,el)=>$(el).data('id')).get();
          $.post(baseIt+'reorder.php',{categorizacion:cat,order},()=>{});
        }
      });
    });
  }

  $('#sel_fragmento').change(function(){
    $('#inp_personalizado').prop('disabled', this.value!=='personalizado');
  });

  $('#btnAddItem').click(function(){
    var cat = $('#itemsModal').data('cat');
    var tipo = $('#sel_fragmento').val()==='personalizado'
               ? $('#inp_personalizado').val()
               : $('#sel_fragmento').val();
    if(!tipo) return Swal.fire('Selecciona o escribe un fragmento','','info');
    $.post(baseIt+'save.php',{categorizacion:cat,tipo:tipo},()=>{
      loadItems(cat);
      $('#sel_fragmento').val('');
      $('#inp_personalizado').val('').prop('disabled',true);
    },'json');
  });
});
</script>

</section>
<?php include __DIR__ . '../../../partials/footer.php'; ?>
