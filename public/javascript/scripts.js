
$(document).ready(function () {

  const isFixed = localStorage.getItem("menuFixed");
  if (isFixed === "true") {
    $("body").addClass("nav-fixed");
  }

  $("header .logo img").click(function(){
    window.location.href = "./index.php";
  });

  $(".nav-fix").click(()=>{
    if ($("body").hasClass("nav-fixed")) {
      $("body").removeClass("nav-fixed");
      localStorage.setItem("menuFixed", "false");
    } else {
      $("body").addClass("nav-fixed");
      localStorage.setItem("menuFixed", "true");
    }
  })

  $.ajaxPrefilter(function(options, originalOptions, jqXHR) {
    const token = localStorage.getItem('token');
    
    const type = currentProfile.type;
    const id = currentProfile.id;
    if (token) {
      jqXHR.setRequestHeader('Authorization', 'Bearer ' + token);
      jqXHR.setRequestHeader('type', type);
      jqXHR.setRequestHeader('id', id);
    }
  
    jqXHR.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
  
    if (!options.contentType) {
      options.contentType = 'application/x-www-form-urlencoded; charset=UTF-8';
    }
  
    if (options.contentType.indexOf('application/json') === 0) {
      let payload = options.data ? JSON.parse(options.data) : {};
      payload.extraInfo = 'algo';
      options.data = JSON.stringify(payload);
    }
  });

  const STORAGE_KEY = 'activeTabText';

  const savedText = localStorage.getItem(STORAGE_KEY);
  if (savedText) {
    $('.accordion').each(function () {
      const $tab = $(this).find('> .tab').first();
      if ($tab.text().trim() === savedText) {
        $(this).addClass('auto-open');
        $(this).addClass('open');
        setTimeout(()=>{
          $(this).removeClass('auto-open');
        }, 100)
      }
    });
  }

  $('.tabs').on('click', '.accordion > .tab', function () {
    const $accordion = $(this).parent();
    const tabText = $(this).text().trim();

    if ($accordion.hasClass('open')) {
      $accordion.removeClass('open');
      localStorage.removeItem(STORAGE_KEY);
    } else {
      $('.accordion').removeClass('open');
      $accordion.addClass('open');
      localStorage.setItem(STORAGE_KEY, tabText);
    }
  });


  const key = 'modoEdicion';  
  const saved = localStorage.getItem(key) === 'true';
  
  $('#editToggle').prop('checked', saved);
  $('body').toggleClass('edit', saved);
  $('.toggle-mode .label-text').text(saved ? 'Edición' : 'Modo edición');
  
  $('#editToggle').on('change', function(){
    const activo = $(this).is(':checked');
    localStorage.setItem(key, activo);
    $('body').toggleClass('edit', activo);
    $('.toggle-mode .label-text').text(activo ? 'Edición' : 'Modo edición');
    if(!activo){
      $("#customModal").hide();
    }
  });

  $(document).on("click", ".edit [data-per]", function(e) {
    e.preventDefault();
    e.stopPropagation();
  
    let $el    = $(this);
    let posX   = $el.offset().left;
    let posY   = $el.offset().top;
    let width  = $el.outerWidth();
    let height = $el.outerHeight();
  
    console.log("Elemento seleccionado:", this);
    console.log(`Ubicación: X=${posX}, Y=${posY}, Ancho=${width}, Alto=${height}`);
  
    $("#customModal")
    .css({
      top:  posY + height + 5 + "px",
      left: posX + "px",
      display: "block"
    })
    .html(`
      <p>Elemento seleccionado</p>
      <p>X: ${posX}, Y: ${posY}</p>
    `);
  });
  

  $('#profile-toggle').on('click', function(){
    $('#profile-list').toggle();
    $("header .header .header-config .user ul").fadeOut();
    $("header .header .header-config .user h4").removeClass("active");
  });
  function addItem(type, data, label){
    console.log(data);
    var id   = data?.id || '',
        logo = data?.logo || '',
        src  = (!data?.logo)
              ? '/abaco/images/abaco small.jpg'
              : logo.startsWith('http')
                ? logo
                : '/abaco/images/uploads/bancos/' + logo,
        $figure = $('<figure>').append(
          $('<img>').attr('src', src)
        ),
        $li = $('<li>').addClass('profile-item').data({ type: type, id: id })
              .append($figure)
              .append($('<span>').text(label));
    $('#profile-list').append($li);
  }
  if(profiles.superadmin) addItem('superadmin',null,'Superadmin - admin');
  profiles.banco.forEach(function(b){ addItem('banco',b, b.nombre+' - Admin'); });
  profiles.bodega.forEach(function(b){ 
    addItem('bodega',b,b.banco_nombre+' - '+b.nombre);
  });
  $(document).on('click','.profile-item',function(){
    var d=$(this).data();
    $.ajax({
      url:'/abaco/controllers/setProfile.php',
      method:'POST',
      data:d,
      success:function(r){ if(r.success) location.href ="http://localhost/abaco/"; }
    });
  });

});
