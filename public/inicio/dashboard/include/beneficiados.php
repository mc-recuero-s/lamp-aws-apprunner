<div class="content actual-list1">
  <div class="titulo">
    <section>

      <h4>Beneficiarios</h4>
      <div class="descargar descargarBeneficiados" title="Crear Lista de Instituciones">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M7 21h-4v-11h4v11zm7-11h-4v11h4v-11zm7 0h-4v11h4v-11zm2 12h-22v2h22v-2zm-23-13h24l-12-9-12 9z"/></svg>
      </div>
    </section>
    <section>
      <div class="beneficiados-check-in titulo-fecha">
        <input type="text" class="fecha-beneficiados" />
      </div>
      <div class="beneficiados-list">
        <select id="beneficiados" placeholder="Seleccione...">
           <option value="">Seleccione...</option>
           <?php
             $sql = "SELECT * FROM tipo_beneficiado";
             $result = $conexion->query($sql);

             if ($result->num_rows > 0) {
                 // output data of each row
                 while($row = $result->fetch_assoc()) {
                     echo '<option value="'.$row["id"].'&'.$row["nit"].'&'.$row["poblacion"].'&'.$row["municipio"].'">'.$row["nombre"].'</option>';
                 }
             }
           ?>
        </select>
      </div>
    </section>
  </div>
  <section class="container beneficiados">
    <ul class="instituciones task-items">
      <li class="item">
        <div class="item-item">
          <div class="task">
            <div class="icon"></div>
            <div class="name"></div>
          </div>

          <div class="status">
            <div class="factura">  </div>
            <div class="text">  </div>
            <div class="text1">  </div>
          </div>

          <div class="dates">
            <div class="unidad">  </div>
            <div class="vencimiento">  </div>
          </div>

          <div class="user">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-.001 5.75c.69 0 1.251.56 1.251 1.25s-.561 1.25-1.251 1.25-1.249-.56-1.249-1.25.559-1.25 1.249-1.25zm2.001 12.25h-4v-1c.484-.179 1-.201 1-.735v-4.467c0-.534-.516-.618-1-.797v-1h3v6.265c0 .535.517.558 1 .735v.999z"/></svg>
          </div>
        </div>
        <ol>

        </ol>
      </li>
    </ul>
  </section>
</div>
