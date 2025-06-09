<?php
  $_POST["id"];
?>
<h3>
  Editar Entrada
</h3>

<section class="entrada">
  <div class="info">
   <div class="fecha">
     <div class="groupForm">
       <label>Fecha</label>
       <input class="input-field check-in fechaInput" type="text" placeholder="Fecha de Entrada"/>
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
       <label>Benefactor</label>
       <select id="benefactor" placeholder="Seleccione...">
          <option value="">Seleccione...</option>


       </select>
       <input placeholder="NIT" value="" disabled/>
     </div>
   </div>
   <div class="recibido">
     <div class="groupForm">
       <label>Recibido por</label>
       <select id="recibido" placeholder="Seleccione...">
          <option value="">Seleccione...</option>


       </select>
       <input placeholder="Documento" class="number" value="" disabled/>
     </div>
   </div>
   <div class="digito">
     <div class="groupForm">
       <label>Recibido por</label>
       <select id="digito" placeholder="Seleccione...">
          <option value="">Seleccione...</option>


       </select>
       <input placeholder="Documento" class="number" value="" disabled/>
     </div>
   </div>

   <div class="placa">
     <div class="groupForm">
       <label>Recibido por</label>
       <select id="placa" placeholder="Seleccione...">
          <option value="">Seleccione...</option>


       </select>
       
     </div>
     <div class="certificado">
     <div class="groupForm">
       <label>Recibido por</label>
       <select id="certificado" placeholder="Seleccione...">
          <option value="">Seleccione...</option>


       </select>
       
     </div>
   </div>
   <div class="tipo">
     <div class="groupForm">
       <label>Centro de costos</label>
       <select id="tipo" placeholder="Seleccione...">
          <option value="">Seleccione...</option>
       </select>
       
     </div>
   </div>
   <div class="cCostos">
     <div class="groupForm">
       <label>Centro de costos</label>
       <select id="cCostos" placeholder="Seleccione...">
          <option value="">Seleccione...</option>


       </select>
       
     </div>
   </div>

   <div class="bodega">
     <div class="groupForm">
       <label>Recibido por</label>
       <select id="bodega" placeholder="Seleccione...">
          <option value="">Seleccione...</option>


       </select>
       
     </div>
   </div>
   <div class="factura">
     <div class="groupForm">
       <label>Factura</label>
       <input class="facturaNumber" placeholder="Factura"/>


     </div>
     <div class="groupForm traslado">
       <input type="checkbox" name="hidden">
       <label>Traslado</label>
     </div>
   </div>
  </div>
  <div class="content-lote">
    <ul>
      <li>
        <div>
          <p>39</p>
          <p>Cantidad</p>
        </div>
        <div>
          <p>Unidad</p>
        </div>
        <div>
          <p>FR</p>
        </div>
        <div>
          <p>030420</p>
        </div>
        <div>
          <p>Label1</p>
        </div>
        <div>
          <p>26 Marzo 2020</p>
        </div>
        <div class="btns">
          <div class="btn edit" title="Editar"></div>
          <div class="btn delete" title="Eliminar"></div>
          <div class="btn duplicate" title="Duplicar"></div>
        </div>
      </li>
    </ul>
   <div class="nuevo">
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
         <select id="categorias" name="categorias" placeholder="Seleccione...">
           <option value=""></option>


         </select>
       </div>
     </div>
     <div>
       <div class="groupForm">
         <label>Lote</label>
         <input disabled class="lote"/>
       </div>
     </div>
     <div class="hide">
       <div class="groupForm">
         <label>Benefactor</label>
         <select id="cars" ,="," name="cars">
           <option value="NVR">NVR</option>
           <option value="GR">GR</option>
           <option value="IZR">IZR</option>
           <option value="PR">PR</option>
         </select>
       </div>
     </div>
     <div class="hide">
       <div class="groupForm">
         <label>Benefactor</label>
         <input/>
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
         <label>Ubicación bodega</label>
         <select id="bodega" name="bodega" placeholder="Seleccione...">
           <option value=""></option>


         </select>
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
         <div class="btn save add" title="Agregar Lote"></div>
         <div class="btn cancel" title="Cancelar"></div>
       </div>
     </div>
   </div>

   <div class="acciones">
     <div class="btn crear" title="Guardar Entrada"></div>
   </div>
  </div>
</section>
