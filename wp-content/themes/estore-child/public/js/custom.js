/**
 * Created by nobikun1412 on 25-Apr-17.
 */
var sliders = new Array();
var sliders_brand = new Array();
jQuery(document).ready(function () {
    jQuery('.bxslider.stores_online').each(function (i, slider_brand) {
        sliders_brand[i] = jQuery(slider_brand).bxSlider({
            mode: 'vertical',
            minSlides: 3,
            maxSlides: 3,
            ticker: true,
            speed: 8000,
            tickerHover: true
        });
    });
    jQuery('.bxslider').each(function (i, slider) {
        sliders[i] = jQuery(slider).bxSlider({
            auto: true,
            controls: true
        });
    });

    jQuery("select.select-city-new-store").change(function() {
        jQuery("select.select-district-new-store").find("option").remove();
        jQuery("ul.store_list_result").addClass('hidden_class');
        jQuery(".alert-custom-danger").addClass('hidden_class');
        jQuery(".alert-custom-success").removeClass('hidden_class');
        jQuery(".loader").removeClass('hidden_class');
        var type_action = 'change_city';
        var idCity = jQuery(this).val();
        jQuery.ajax({
            type: "POST",
            dataType: 'json',
            url: ajaxurl,
            data: { action: 'my_action_name' , type_action: type_action, idCity: idCity }
        }).done(function( msg ) {
            console.log(msg);
            jQuery(".loader").addClass('hidden_class');
            jQuery(".alert-custom-success").addClass('hidden_class');
            jQuery("select.select-district-new-store").html(msg.html);
            if (msg.listStores == 'NO') {
                jQuery(".alert-custom-danger").removeClass('hidden_class');
            }
            else {
                jQuery("ul.store_list_result").removeClass('hidden_class');
                jQuery("ul.store_list_result").html(msg.listStores);
            }
        });
    });

    jQuery("select.select-district-new-store").change(function() {
        var type_action = 'change_district';
        var idDistrict = jQuery(this).val();
        var idCity = jQuery("select.select-city-new-store").val();
        jQuery("ul.store_list_result").addClass('hidden_class');
        jQuery(".alert-custom-danger").addClass('hidden_class');
        jQuery(".alert-custom-success").removeClass('hidden_class');
        jQuery(".loader").removeClass('hidden_class');
        jQuery.ajax({
            type: "POST",
            dataType: 'json',
            url: ajaxurl,
            data: { action: 'my_action_name' , type_action: type_action, idCity: idCity, idDistrict: idDistrict }
        }).done(function( msg ) {
            console.log(msg);
            jQuery(".loader").addClass('hidden_class');
            jQuery(".alert-custom-success").addClass('hidden_class');
            if (msg.listStores == 'NO') {
                jQuery(".alert-custom-danger").removeClass('hidden_class');
            }
            else {
                jQuery("ul.store_list_result").html(msg.listStores);
                jQuery("ul.store_list_result").removeClass('hidden_class');
            }
        });
    });

    jQuery(".icon-loc-custom").hover(
        function () {
            var loc_box = jQuery(this).parents('.loc-box');
            loc_box.find('.loca-name').removeClass('hidden_class');
        },

        function () {
            var loc_box = jQuery(this).parents('.loc-box');
            loc_box.find('.loca-name').addClass('hidden_class');
        }
    );

});
/*
 *  new_map
 *
 *  This function will render a Google Map onto the selected jQuery element
 *
 *  @type	function
 *  @date	8/11/2013
 *  @since	4.3.0
 *
 *  @param	$el (jQuery element)
 *  @return	n/a
 */

function new_map( $el ) {

    // var
    var $markers = $el.find('.marker');


    // vars
    var args = {
        scrollwheel: false,
        zoom		: 20,
        center		: new google.maps.LatLng(0, 0),
        mapTypeId	: google.maps.MapTypeId.ROADMAP
    };


    // create map
    var map = new google.maps.Map( $el[0], args);


    // add a markers reference
    map.markers = [];


    // add markers
    $markers.each(function(){

        add_marker( $(this), map );

    });


    // center map
    center_map( map );


    // return
    return map;

}

/*
 *  add_marker
 *
 *  This function will add a marker to the selected Google Map
 *
 *  @type	function
 *  @date	8/11/2013
 *  @since	4.3.0
 *
 *  @param	$marker (jQuery element)
 *  @param	map (Google Map object)
 *  @return	n/a
 */

function add_marker( $marker, map ) {

    // var
    var latlng = new google.maps.LatLng( $marker.attr('data-lat'), $marker.attr('data-lng') );

    // create marker
    var marker = new google.maps.Marker({
        position	: latlng,
        map			: map
    });

    // add to array
    map.markers.push( marker );

    // if marker contains HTML, add it to an infoWindow
    if( $marker.html() )
    {
        // create info window
        var infowindow = new google.maps.InfoWindow({
            content		: $marker.html()
        });

        // show info window when marker is clicked
        google.maps.event.addListener(marker, 'click', function() {

            infowindow.open( map, marker );

        });
    }

}

/*
 *  center_map
 *
 *  This function will center the map, showing all markers attached to this map
 *
 *  @type	function
 *  @date	8/11/2013
 *  @since	4.3.0
 *
 *  @param	map (Google Map object)
 *  @return	n/a
 */

function center_map( map ) {

    // vars
    var bounds = new google.maps.LatLngBounds();

    // loop through all markers and create bounds
    $.each( map.markers, function( i, marker ){

        var latlng = new google.maps.LatLng( marker.position.lat(), marker.position.lng() );

        bounds.extend( latlng );

    });

    // only 1 marker?
    if( map.markers.length == 1 )
    {
        // set center of map
        map.setCenter( bounds.getCenter() );
        map.setZoom( 16 );
    }
    else
    {
        // fit to bounds
        map.fitBounds( bounds );
    }

}

/*
 *  document ready
 *
 *  This function will render each map when the document is ready (page has loaded)
 *
 *  @type	function
 *  @date	8/11/2013
 *  @since	5.0.0
 *
 *  @param	n/a
 *  @return	n/a
 */
// global var
var map = null;

$(document).ready(function(){

    $('.acf-map').each(function(){

        // create map
        map = new_map( $(this) );

    });


});
