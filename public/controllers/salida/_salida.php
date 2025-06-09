<?php
  $_POST["id"];
?>
<h3>
  Editar Salida
</h3>

<section class="salida">
  <div class="info">
    <div class="fecha">
      <div class="groupForm">
        <label>Fecha</label>
        <input disabled class="input-field check-in fechaInput" id="fecha" type="text" name="Fecha de Salida" placeholder="Fecha de Salida"/>
      </div>
      <div class="groupForm">
        <div class="formFIle">
          <input id="file" type="file"/>
        </div>
      </div>
      <ul class="listFiles"></ul>
    </div>
    <div class="institucion">
      <div class="groupForm">
        <label>Institución Beneficiada
          <div class="info-globo">
            <p></p>
          </div>
        </label>
        <select id="beneficiado" placeholder="Seleccione..." name="beneficiado">
          <option value="">Seleccione...</option>
        </select>
        <input placeholder="NIT" disabled/>
      </div>
    </div>
    <div class="recibido">
      <div class="groupForm">
        <label>Recibido por</label>
        <select id="recibido" placeholder="Seleccione...">
           <option value="">Seleccione...</option>
        </select>
        <input placeholder="Documento" class="number" disabled/>
      </div>
    </div>
    <div class="factura">
      <div class="groupForm">
        <label>Factura</label>
        <input class="facturaNumber" placeholder="Factura"/>
      </div>
    </div>
  </div>
  <div class="resultados">
    <div class="titulo">
      <h2>Resultados</h2>
    </div>
    <div class="fecha">
      <div class="groupForm">
        <label>Fecha</label>
        <input class="input-field check-in" type="text" name="Fecha de Salida" placeholder="Fecha de Salida"/>
      </div>
    </div>
    <div class="institucion">
      <div class="groupForm">
        <label>Institución Beneficiada</label>
        <input placeholder="Instirución Beneficiada"/>
        <input placeholder="NIT"/>
      </div>
    </div>
    <div class="recibido">
      <div class="groupForm">
        <label>Recibido por</label>
        <input placeholder="Nombre"/>
        <input placeholder="Documento" class="number"/>
      </div>
    </div>
    <div class="factura">
      <div class="groupForm">
        <label>Factura</label>
        <input placeholder="Factura"/>
      </div>
    </div>
  </div>
  <div class="content-lote">
    <div class="busqueda">
      <div>
        <div class="groupForm">
          <label>Cantidad</label>
          <input class="decimal"/>
        </div>
      </div>
      <div>
        <div class="groupForm">
          <label title="kg - lt - un">Unidad</label>
          <input class="unidad"/>
        </div>
      </div>
      <div>
        <div class="groupForm">
          <label>Categoria</label>
          <select id="categoria" placeholder="Seleccione..." name="categoria">
            <option value="">Ninguno</option>
          </select>
        </div>
      </div>
      <div>
        <div class="groupForm">
          <label>Lote</label>
          <input class="lote" data-date-end-date="0d" onfocus="this.value=''"/>
        </div>
      </div>
      <div class="benefactor-form">
        <div class="groupForm selectize-control single">
          <label>Benefactor</label>
          <select id="benefactor" placeholder="Seleccione..." name="benefactores">
            <option value="">Ninguno</option>
          </select>
        </div>
      </div>
      <div class="hide">
        <div class="groupForm">
          <label>Benefactor</label>
          <input disabled/>
        </div>
      </div>
      <div>
        <div class="groupForm">
          <label>Producto</label>
          <input/>
        </div>
      </div>
      <div>
        <div class="groupForm">
          <label>Vencimiento</label>
          <input class="check-in vencimiento"/>
        </div>
      </div>
      <div class="btns">
        <div class="groupForm">
          <div class="btn buscar" title="Buscar"></div>
        </div>
      </div>
    </div>
    <ul>
    </ul>
    <div class="acciones">
      <div class="btn crear" title="Editar Salida"></div>
    </div>
  </div>
</section>
