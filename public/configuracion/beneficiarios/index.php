<?php
require __DIR__.'../../../security/init.php';
authorize('beneficiarios');
include __DIR__ . '../../../partials/header.php';
?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<section>
  <div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h2>Beneficiarios</h2>
      <button id="btnCreate" class="btn btn-primary">Crear Nuevo</button>
    </div>
    <table id="table" class="table table-striped" style="width:100%">
      <thead>
        <tr>
          <th>ID</th>
          <th>Tipo Doc.</th>
          <th>Documento</th>
          <th>Nombre</th>
          <th>Proveedor</th>
          <th>Sector Público</th>
          <th>Sector Económico</th>
          <th>Tipo Inst.</th>
          <th>Departamento</th>
          <th>Municipio</th>
          <th>Banco</th>
          <th>Acciones</th>
        </tr>
      </thead>
    </table>
  </div>

  <div class="modal fade" id="entityModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalTitle"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <form id="entityForm">
            <input type="hidden" id="id" name="id">
            <div class="row">
              <div class="col-md-4 mb-3">
                <select id="tipo_documento" name="tipo_documento" class="form-select">
                  <option value="">Seleccione Tipo de Documento</option>
                  <option value="CC">Cédula Ciudadanía</option>
                  <option value="NIT">NIT</option>
                </select>
              </div>
              <div class="col-md-4 mb-3">
                <input type="number" id="documento" name="documento" class="form-control" placeholder="Documento">
              </div>
              <div class="col-md-4 mb-3">
                <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Nombre">
              </div>
            </div>
            <div class="row">
              <div class="col-md-5 mb-3">
                <input type="text" id="proveedor" name="proveedor" class="form-control" placeholder="Proveedor">
              </div>
              <div class="col-md-3 form-check mb-3">
                <input class="form-check-input" style="margin-left: 30px;" type="checkbox" id="sector_publico" name="sector_publico">
                <label class="form-check-label" for="sector_publico">Sector Público</label>
              </div>
              <div class="col-md-3 form-check mb-3">
                <input class="form-check-input" style="margin-left: 30px;" type="checkbox" id="sector_economico" name="sector_economico">
                <label class="form-check-label" for="sector_economico">Sector Económico</label>
              </div>
            </div>
            <div class="mb-3">
              <input type="text" id="tipo_institucion" name="tipo_institucion" class="form-control" placeholder="Tipo de institución">
            </div>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label">Departamento</label>
                <select id="departamento" name="departamento" class="form-select">
                  <option value="">Seleccione Departamento</option>
                </select>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label">Municipio</label>
                <select id="municipio" name="municipio" class="form-select">
                  <option value="">Seleccione Municipio</option>
                </select>
              </div>
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

  <div class="modal fade" id="sedeModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Sedes del Beneficiario</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <form id="sedeForm" class="mb-3">
            <input type="hidden" id="sede_id" name="id">
            <div class="mb-3">
              <input type="text" id="nit" name="nit" class="form-control" placeholder="NIT">
            </div>
            <div class="mb-3">
              <input type="text" id="sede_nombre" name="nombre" class="form-control" placeholder="Nombre Sede">
            </div>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label class="form-label">Departamento</label>
                <select id="sede_departamento" name="departamento" class="form-select">
                  <option value="">Seleccione Departamento</option>
                </select>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label">Municipio</label>
                <select id="sede_municipio" name="municipio" class="form-select">
                  <option value="">Seleccione Municipio</option>
                </select>
              </div>
            </div>
            <button id="btnAddSede" type="button" class="btn btn-primary">Agregar Sede</button>
          </form>
          <ul id="sedeList" class="list-group"></ul>
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
<script>
$(document).ready(function () {
  var baseURL  = '../../controllers/configuracion/beneficiario/';
  var sedeURL  = '../../controllers/configuracion/beneficiario_sede/';
  var table = $('#table').DataTable({
    ajax: { url: baseURL + 'fetch.php', dataSrc: json => json.data },
    columns: [
      { data: 'id' },
      { data: 'tipo_documento' },
      { data: 'documento' },
      { data: 'nombre' },
      { data: 'proveedor' },
      { data: 'sector_publico', render: v => v ? 'Sí' : 'No' },
      { data: 'sector_economico', render: v => v ? 'Sí' : 'No' },
      { data: 'tipo_institucion' },
      { data: 'departamento' },
      { data: 'municipio' },
      { data: 'banco_label', title: 'Banco' },
      { data: null, render: d =>
          `<button class="btn btn-sm btn-warning edit" data-id="${d.id}">Editar</button>
           <button class="btn btn-sm btn-info sedes" data-id="${d.id}">Sedes</button>
           <button class="btn btn-sm btn-danger delete" data-id="${d.id}">Eliminar</button>`
      }
    ]
  });

  function loadDepartamentos(selectId) {
    var sel = $(selectId).empty().append('<option value="">Seleccione Departamento</option>');
    $.getJSON('../../controllers/configuracion/util/fetch_departamentos.php', r => {
      r.data.forEach(d => sel.append(`<option value="${d.id}">${d.nombre}</option>`));
    });
  }

  function loadMunicipios(deptoId, selectId, callback) {
    var sel = $(selectId).empty().append('<option value="">Seleccione Municipio</option>');
    if (!deptoId) {
      if (typeof callback === 'function') callback();
      return;
    }
    $.getJSON('../../controllers/configuracion/util/fetch_municipios.php', { departamento: deptoId }, r => {
      r.data.forEach(m => sel.append(`<option value="${m.id}">${m.nombre}</option>`));
      if (typeof callback === 'function') callback();
    });
  }

  loadDepartamentos('#departamento');
  loadDepartamentos('#sede_departamento');

  $('#departamento').change(function () {
    loadMunicipios(this.value, '#municipio');
  });
  $('#sede_departamento').change(function () {
    loadMunicipios(this.value, '#sede_municipio');
  });

  $('#btnCreate').on('click', () => {
    $('#modalTitle').text('Crear Beneficiario');
    $('#entityForm')[0].reset();
    loadDepartamentos('#departamento');
    loadMunicipios('', '#municipio');

    new bootstrap.Modal($('#entityModal')).show();
  });

  table.on('click', '.edit', function () {
    var id = $(this).data('id');
    $.getJSON(baseURL + 'get.php', { id }, r => {
      var d = r.data;
      $('#modalTitle').text('Editar Beneficiario');
      $('#id').val(d.id);
      $('#tipo_documento').val(d.tipo_documento);
      $('#documento').val(d.documento);
      $('#nombre').val(d.nombre);
      $('#proveedor').val(d.proveedor);
      $('#sector_publico').prop('checked', d.sector_publico == 1);
      $('#sector_economico').prop('checked', d.sector_economico == 1);
      $('#tipo_institucion').val(d.tipo_institucion);
      $('#departamento').val(d.departamento);
      loadMunicipios(d.departamento, '#municipio', function() {
        $('#municipio').val(d.municipio_id);
      });
      
      new bootstrap.Modal($('#entityModal')).show();
    }).fail(() => Swal.fire('Error', 'Error de red', 'error'));
  });

  $('#btnSave').on('click', () => {
    let formString = $('#entityForm').serialize();
    let banco = (currentProfile.type == "superadmin") ? "0" : currentProfile.id;
    let dataString = formString
      + '&banco=' + encodeURIComponent(banco);
    $.post(baseURL + 'save.php', dataString, r => {
      if (r.success) {
        table.ajax.reload(null, false);
        bootstrap.Modal.getInstance($('#entityModal')).hide();
        Swal.fire('¡Éxito!', r.message, 'success');
      } else {
        Swal.fire('Error', r.message, 'error');
      }
    }, 'json').fail(() => Swal.fire('Error', 'Error de red', 'error'));
  });

  table.on('click', '.delete', function () {
    var id = $(this).data('id');
    Swal.fire({ title: '¿Eliminar beneficiario?', showCancelButton: true })
      .then(res => res.isConfirmed && $.post(baseURL + 'delete.php', { id }, r => {
        if (r.success) {
          table.row($(this).parents('tr')).remove().draw();
          Swal.fire('¡Eliminado!', '', 'success');
        } else {
          Swal.fire('Error', r.message, 'error');
        }
      }, 'json'));
  });

  let currentBeneficiarioId = null;

  $('#sedeModal').on('shown.bs.modal', function () {
    loadDepartamentos('#sede_departamento');
    loadMunicipios('', '#sede_municipio');

    $.getJSON(sedeURL + 'fetch_by_beneficiario.php', { beneficiario_id: currentBeneficiarioId }, r => {
      const ul = $('#sedeList').empty();
      r.data.forEach(s => {
        ul.append(
          `<li class="list-group-item d-flex justify-content-between align-items-center">
            ${s.nombre} (${s.nit}) – ${s.departamento} / ${s.municipio}
            <div>
              <button
                class="btn btn-sm btn-warning edit-sede"
                data-id="${s.id}"
                data-nit="${s.nit}"
                data-nombre="${s.nombre}"
                data-departamento_id="${s.departamento_id}"
                data-municipio_id="${s.municipio_id}"
              >✎</button>
              <button class="btn btn-sm btn-outline-danger remove-sede" data-id="${s.id}">×</button>
            </div>
          </li>`
        );
      });
    });
  });

  table.on('click', '.sedes', function () {
    currentBeneficiarioId = $(this).data('id');
    $('#sedeForm')[0].reset();
    $('#sede_id').val('');
    $('#sedeList').empty();
    $('#sede_departamento').val('');
    $('#sede_municipio').val('');
    new bootstrap.Modal($('#sedeModal')).show();
  });

  $('#btnAddSede').off().on('click', function () {
    const data = $('#sedeForm').serialize() + '&beneficiario_id=' + currentBeneficiarioId;
    const url = $('#sede_id').val() ? 'update.php' : 'save.php';
    $.post(sedeURL + url, data, r => {
      if (r.success) {
        $.getJSON(sedeURL + 'fetch_by_beneficiario.php', { beneficiario_id: currentBeneficiarioId }, r => {
          const ul = $('#sedeList').empty();
          r.data.forEach(s => {
            ul.append(
              `<li class="list-group-item d-flex justify-content-between align-items-center">
                ${s.nombre} (${s.nit}) – ${s.departamento} / ${s.municipio}
                <div>
                  <button
                    class="btn btn-sm btn-warning edit-sede"
                    data-id="${s.id}"
                    data-nit="${s.nit}"
                    data-nombre="${s.nombre}"
                    data-departamento_id="${s.departamento_id}"
                    data-municipio_id="${s.municipio_id}"
                  >✎</button>
                  <button class="btn btn-sm btn-outline-danger remove-sede" data-id="${s.id}">×</button>
                </div>
              </li>`
            );
          });
        });
        $('#sedeForm')[0].reset();
        $('#sede_id').val('');
      } else {
        Swal.fire('Error', r.message, 'error');
      }
    }, 'json');
  });

  $('#sedeList').on('click', '.remove-sede', function () {
    const sid = $(this).data('id');
    $.post(sedeURL + 'delete.php', { id: sid }, r => {
      if (r.success) {
        $.getJSON(sedeURL + 'fetch_by_beneficiario.php', { beneficiario_id: currentBeneficiarioId }, r => {
          const ul = $('#sedeList').empty();
          r.data.forEach(s => {
            ul.append(
              `<li class="list-group-item d-flex justify-content-between align-items-center">
                ${s.nombre} (${s.nit}) – ${s.departamento} / ${s.municipio}
                <div>
                  <button class="btn btn-sm btn-warning edit-sede" data-id="${s.id}" data-nit="${s.nit}" data-nombre="${s.nombre}" data-departamento_id="${s.departamento_id}" data-municipio_id="${s.municipio_id}">✎</button>
                  <button class="btn btn-sm btn-outline-danger remove-sede" data-id="${s.id}">×</button>
                </div>
              </li>`
            );
          });
        });
        $('#sedeForm')[0].reset();
        $('#sede_id').val('');
      }
    }, 'json');
  });

  $('#sedeList').on('click', '.edit-sede', function () {
    var sid   = $(this).data('id');
    var nit   = $(this).data('nit');
    var sname = $(this).data('nombre');
    var depId = $(this).data('departamento_id');
    var munId = $(this).data('municipio_id');

    $('#sede_id').val(sid);
    $('#nit').val(nit);
    $('#sede_nombre').val(sname);

    $('#sede_departamento').val(depId);
    loadMunicipios(depId, '#sede_municipio', function() {
      $('#sede_municipio').val(munId);
    });
  });
});
</script>
<?php include __DIR__ . '../../../partials/footer.php'; ?>
