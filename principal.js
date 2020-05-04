$(document).ready(function(){

    //Menu
    $(document).on('click','.close_menu',function(){
        $('.menu').removeClass('show');
    });
    $(document).on('click','.open_menu',function(){
        $('.menu').addClass('show');
    });
    if( $('body').hasClass('fondo_negro') ){
        $('.menu_top').css('background-color', 'white' );
    }

    //Expositorio
    /////////////

    setTimeout(function(){
        $('.elementos_expositorio').css('opacity',1);
    },700);
    //Al inicio, pilla los elementos de la base de datos y los carga en la portada
    $.ajax({
    	url:'llamadas/getElementosPortada.php',
        dataType: 'json',
    	success: function(elementosPortada){
            console.log(elementosPortada);
            cargarElementosPortada(elementosPortada);
    	}
    });
    function cargarElementosPortada(elementosPortada){
        let clase_capa = '';

    	$.each(elementosPortada,function(key,val){
    		if(elementosPortada[key].tipo_elemento == 'noticia'){
                $('.elementos_expositorio').append(
    				`<a href='single_noticia.php?noticia=${elementosPortada[key].id_elemento}' id='elemento_${key}' data-id_real='${elementosPortada[key].id_elemento}' data-posicion='elemento_${key}' class='elemento elemento_${key} ${clase_capa} elemento_video elemento_size_video' style='background-image: url("elements/noticias/${elementosPortada[key].recurso_elemento}")'>` +
                    "<div class='background_gradient'></div>" +
                        "<div class='informacion_elemento'>" +
                            "<div class='texto_elemento'>" +
                				"<h1>"+elementosPortada[key].nombre_elemento+"</h1>" +
                            "</div>" +
                        "</div>" +
                    "</div>");
            }else if(elementosPortada[key].tipo_elemento == 'video'){
    			$('.elementos_expositorio').append(
    				"<div id='elemento_"+key+"' data-id_real='"+elementosPortada[key].id_elemento+"' data-posicion='elemento_"+key+"' class='elemento elemento_"+key+" "+clase_capa+" elemento_video elemento_size_video' style='background-image: url(elements/videos/"+elementosPortada[key].recurso_elemento+".png)'>" +
                    "<div class='play_button'><div class='triangle'></div></div>" +
                    "<div class='background_gradient'></div>" +
                        "<div class='informacion_elemento'>" +
                            "<img src='assets/icons/camera.svg' width='35px'>" +
                            "<div class='texto_elemento'>" +
                				"<h1>"+elementosPortada[key].nombre_elemento+"</h1>" +
                                "<p class='autor'>"+elementosPortada[key].autor_elemento+"</p>" +
                                "<p class='subtitulo'>"+elementosPortada[key].subtitulo_elemento+"</p>" +
                            "</div>" +
                        "</div>" +
                    "</div>");
                $('.fondo_negro_fullscreen').append(
                    "<video class='video_portada' id='"+elementosPortada[key].id_elemento+"' controls>" +
                        "<source src='elements/videos/"+elementosPortada[key].recurso_elemento+".mp4' type='video/mp4'>" +
                        "<source src='elements/videos/"+elementosPortada[key].recurso_elemento+".mp4' type='video/ogg'>" + 
                        "Your browser does not support the video tag." +
                    "</video>"
                );
            }else if(elementosPortada[key].tipo_elemento == 'audio'){
    			$('.elementos_expositorio').append(
    				"<div id='elemento_"+key+"' data-id_real='"+elementosPortada[key].id_elemento+"' data-posicion='elemento_"+key+"' class='elemento elemento_"+key+" elemento_capa3 elemento_audio elemento_size_rectangle'>" +
                        "<div class='background_gradient'></div>" +
                        "<div class='info_audio'>" +
                            "<img src='assets/icons/audio.svg' width='35px'>" +
                            "<div class='informacion_elemento'>" +
                                "<h1>"+elementosPortada[key].nombre_elemento+"</h1>" +
                                "<p class='autor'>"+elementosPortada[key].autor_elemento+"</p>" +
                                "<p class='subtitulo'>"+elementosPortada[key].subtitulo_elemento+"</p>" +
                                "<img class='grafico_audio' src='assets/icons/grafico_audio.svg'>" +
                            "</div>" +
                        "</div>" +
                    "</div>");
                $('.fondo_negro_fullscreen').append(
                    "<audio class='audio_portada' id='"+elementosPortada[key].id_elemento+"' controls>" +
                        "<source src='elements/audios/"+elementosPortada[key].recurso_elemento+".mp3' type='video/mp3'>" +
                        "<source src='elements/audios/"+elementosPortada[key].recurso_elemento+".mp3' type='video/ogg'>" + 
                        "Your browser does not support the audio tag." +
                    "</audio>"
                );
            }
            /*else if(elementosPortada[key].tipo_elemento == 'instagram'){
                if( c_instagram==2 ){
                    clase_capa = "elemento_capa2";
                    c_instagram++;
                }else{
                    clase_capa = "elemento_capa3";
                }
    			$('.elementos_expositorio').append(
    				"<div id='elemento_"+key+"' data-id_real='"+elementosPortada[key].id_elemento+"' data-posicion='elemento_"+key+"' class='elemento elemento_"+key+" "+clase_capa+" elemento_instagram elemento_size_cube' style='background-image: url(elements/images/"+elementosPortada[key].recurso_elemento+")'>" +
        				"<div class='background_gradient'></div>" +
                        "<div class='informacion_elemento'>" +
                            "<h1>"+elementosPortada[key].nombre_elemento+"</h1>" +
                            "<div class='info_insta'>" +
                                "<img src='assets/icons/instagram.svg' width='35px'>" +
                                "<p class='autor'>"+elementosPortada[key].autor_elemento+"</p>" +
                                "<p class='subtitulo'>"+elementosPortada[key].subtitulo_elemento+"</p>" +
                            "</div>" +
                        "</div>" +
                    "</div>");
    		}else if(elementosPortada[key].tipo_elemento == 'twitter'){
                if( c_twitter==2 ){
                    clase_capa = "elemento_capa2";
                    c_twitter++;
                }else{
                    clase_capa = "elemento_capa3";
                }
    			$('.elementos_expositorio').append(
    				"<div id='elemento_"+key+"' data-id_real='"+elementosPortada[key].id_elemento+"' data-posicion='elemento_"+key+"' class='elemento elemento_"+key+" "+clase_capa+" elemento_twitter elemento_size_cube'>" +
        				"<div class='informacion_elemento'>" +
                            "<img src='assets/icons/twitter.svg' width='35px'>" +
                            "<p class='autor'>"+elementosPortada[key].autor_elemento+"</p>" +
                            "<p class='subtitulo'>"+elementosPortada[key].subtitulo_elemento+"</p>" +
                            "<p class='texto'>"+elementosPortada[key].texto_elemento+"</p>" +
                        "</div>" +
    				"</div>");
    		}*//*else if(elementosPortada[key].tipo_elemento == 'evento'){
    			$('.elementos_expositorio').append(
    				"<div id='elemento_"+key+"' data-id_real='"+elementosPortada[key].id_elemento+"' data-posicion='elemento_"+key+"' class='elemento elemento_"+key+" elemento_capa2 elemento_evento elemento_size_rectangle'>" +
        				"<div class='informacion_elemento'>" +
                            "<img src='assets/icons/mascaras.svg' width='35px'>" +
                            "<h1>"+elementosPortada[key].nombre_elemento+"</h1>" +
                            "<p class='autor'>"+elementosPortada[key].autor_elemento+"</p>" +
                            "<p class='texto'>"+elementosPortada[key].texto_elemento+"</p>" +
                        "</div>" +
    				"</div>");
            }*/
    	});
    }
    
    function traer_capa1(id){
        //Intercambia el elemento clicado por el que esta en la primera capa
        const elemento = $('#'+id);
        const elemento_medio = $('.elemento_capa1');
        const elemento_posicion = elemento.data('posicion');
       
        //Traer el elemento del centro a la posicion del clicado
        elemento_medio.removeClass('elemento_0 elemento_1 elemento_2 elemento_3 elemento_4 elemento_5 elemento_6 elemento_7 elemento_8 elemento_9 elemento_10');
        elemento_medio.addClass(elemento_posicion);
        elemento_medio.data('posicion', elemento_posicion);

        if( elemento.hasClass('elemento_capa1') ){
            abrir_elemento(id)
        }else if( elemento.hasClass('elemento_capa2') ){
            elemento_medio.addClass('elemento_capa2');
        }else if( elemento.hasClass('elemento_capa3') ){
            elemento_medio.addClass('elemento_capa3');
        }
        elemento_medio.removeClass('elemento_capa1');
        
        //Traer el elemento clicado al centro
        elemento.removeClass('elemento_capa2 elemento_capa3');
        elemento.addClass('elemento_capa1');
        
        elemento.removeClass('elemento_1 elemento_2 elemento_3 elemento_4 elemento_5 elemento_6 elemento_7 elemento_8 elemento_9 elemento_10');
        elemento.addClass('elemento_0');
        elemento.data('posicion','elemento_0');
    }

    function abrir_elemento(id){
        let elemento = $('#'+id);
        let id_db = $('#'+id).data('id_real');
        let media = document.getElementById(id_db);
        media.play();
        $('.fondo_negro_fullscreen').addClass('elemento_activo');
        $('.cerrar_fondo_negro').fadeIn();
        if( elemento.hasClass('elemento_video') ){ $('.go_element').attr('href','single_video.php?id='+id_db); }
        if( elemento.hasClass('elemento_audio') ){ $('.go_element').attr('href','single_audio.php?id='+id_db); }
        $('#'+id_db).addClass('activo');
    }

    function cerrar_elemento(id){
        let elemento = document.getElementById(id);
        elemento.pause();
        setTimeout(function(){
            elemento.currentTime=0;
        },1000);
        $('.fondo_negro_fullscreen').removeClass('elemento_activo');
        $('.fondo_negro_fullscreen video').removeClass('activo');
        $('.fondo_negro_fullscreen audio').removeClass('activo');
        $('.cerrar_fondo_negro').fadeOut();
    }

    $('.expositorio').on( 'click','.elemento', function(){
        traer_capa1( $(this).attr('id') );
    });
    $('.expositorio').on( 'click','.cerrar_fondo_negro', function(){
        let elemento_activo = $(this).parent().find('.activo').attr('id');
        cerrar_elemento(elemento_activo);
    });
    window.onscroll = function() {
        let elemento_activo = $('.fondo_negro_fullscreen').find('.activo').attr('id');
        if(elemento_activo){
            cerrar_elemento(elemento_activo);
        }
    };

    //Showcase
    //////////
    let pag_n=0;
    let pag_a=0;
    $tag='none';

    $(document).on('click','.pag',function(){
        var seccion_actual = $(this).data('seccion');
        if( $(this).hasClass('prev_pag') ){
            if(seccion_actual == 'narrazioni') {
                if(!pag_n==0){
                    let e = $(this).parent().find('.content_elements');
                    let mover = e.width();
                    pag_n--;
                    e.css('margin-left', -mover * pag_n);
                }
            }
            else if(seccion_actual == 'atelier'){
                if(!pag_a==0){
                    let e = $(this).parent().find('.content_elements');
                    let mover = e.width();
                    pag_a--;
                    e.css('margin-left', -mover * pag_a);
                }
            }
        }else if( $(this).hasClass('next_pag') ){
            if (seccion_actual == 'narrazioni') {
                let elementos_narrazioni = $('.content_elements_narrazioni a').length;
                let paginas_limite = Math.floor(elementos_narrazioni/3);
                if(!(pag_n==paginas_limite)){
                    let e = $(this).parent().find('.content_elements');
                    let mover = e.width();
                    pag_n++;
                    e.css('margin-left',-mover * pag_n);
                }
            }
            else if(seccion_actual == 'atelier'){
                let elementos_atelier = $('.content_elements_atelier a').length;
                let paginas_limite = Math.floor(elementos_atelier/2);
                if(!(pag_a==paginas_limite)){
                    let e = $(this).parent().find('.content_elements');
                    let mover = e.width();
                    pag_a++;
                    e.css('margin-left',-mover * pag_a);
                }
            }
        }
    });

    //GALERIA
    /////////
    $(document).on('click','.miniatura_galeria',function(){
        let img = $(this).data('ruta');
        $('.imagen_creaciones').attr('src','elements/galerias/'+img);
    });

    //PAGINA BUSQUEDA
    /////////////////
    $(document).on('click','.titulo_seccion_busqueda',function(){
        $(this).next('.desplegable_buscador').toggleClass('desplegado');
    });
    
});