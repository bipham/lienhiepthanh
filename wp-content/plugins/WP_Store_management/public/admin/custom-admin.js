/**
 * Created by nobikun1412 on 28-Apr-17.
 */

    // Edit store
jQuery(window).load(function(){
    var number_selected = 0;
    // Add new store
    jQuery("select.select-city-new-store").change(function() {
        jQuery("select.select-district-new-store").find("option").remove();
        var type_action = 'change_city';
        var idCity = jQuery(this).val();
        jQuery.ajax({
            type: "POST",
            url: ajaxurl,
            data: { action: 'my_action' , type_action: type_action, idCity: idCity }
        }).done(function( msg ) {
            console.log(msg);
            jQuery("select.select-district-new-store").html(msg);
        });
    });
    jQuery(".btn-add-new-store").click(function() {
        var name = jQuery('.input-name-new-store').val();
        var phone = jQuery('.input-phone-new-store').val();
        var tele = jQuery('.input-tele-new-store').val();
        var website = jQuery('.input-web-new-store').val();
        var address = jQuery('.input-address-new-store').val();
        var district = jQuery('select.select-district-new-store').val();
        var city = jQuery('select.select-city-new-store').val();
        var modal = jQuery(".modal.modal-add-new");
        var type_action = 'add_new';
        jQuery.ajax({
            type: "POST",
            url: ajaxurl,
            data: { action: 'my_action' , type_action: type_action, name: name, phone: phone, tele: tele, website: website, address: address, district: district, city: city }
        }).done(function( msg ) {
            if (msg == 'OK') {
                modal.find(".alert-danger").hide();
                modal.find(".modal-body").prepend(
                    "<div class='alert alert-success' role='alert'><strong>Chúc mừng!</strong> Cửa hàng đã được thêm thành công! </div>"
                );
                jQuery(this).prop("disabled", true);
                location.reload();
            }
            else {
                modal.find(".modal-body").prepend(
                    "<div class='alert alert-danger' role='alert'>" + msg + "</div>"
                );
            }
        });
    });
    jQuery('.input-data-add-new').on('input',function(e){
        jQuery(".btn-add-new-store").prop("disabled", false);
    });

    jQuery('.input-data-edit').on('input',function(e){
        var idInfo = jQuery(this).data('id-info');
        var btn_update = jQuery("button.btn-update-" + idInfo);
        btn_update.prop("disabled", false);
    });
    jQuery("button.btn-close-edit").click(function () {
        var modal =  jQuery(this).parents('.modal.modal-edit');
        var idInfo = modal.data('id-info');
        jQuery("button.btn-update-" + idInfo).prop("disabled", true);
    });
    jQuery("select.list-store-city").change(function() {
        var idInfo = jQuery(this).data('id-info');
        jQuery("select.select-district-store-" + idInfo).find("option").remove();
        var type_action = 'change_city';
        var idCity = jQuery(this).val();
        jQuery.ajax({
            type: "POST",
            url: ajaxurl,
            data: { action: 'my_action' , type_action: type_action, idCity: idCity }
        }).done(function( msg ) {
            console.log(msg);
            jQuery("select.select-district-store-" + idInfo).html(msg);
        });
    });
    jQuery(".btn-update-info").click(function() {
        var idInfo = jQuery(this).data('id-info');
        var name = jQuery('.input-name-store-' + idInfo).val();
        var phone = jQuery('.input-phone-store-' + idInfo).val();
        var tele = jQuery('.input-tele-store-' + idInfo).val();
        var website = jQuery('.input-web-store-' + idInfo).val();
        var address = jQuery('.input-address-store-' + idInfo).val();
        var district = jQuery('select.select-district-store-' + idInfo).val();
        var city = jQuery('select.select-city-store-' + idInfo).val();
        var modal = jQuery(".modal.infoStore-" + idInfo);
        var type_action = 'update';
        console.log('action: ' + type_action + 'ID: ' + idInfo + " | name: " + name + " | address: " + address+ " | district: " + district+ " | city: " + city);
        jQuery.ajax({
            type: "POST",
            url: ajaxurl,
            data: { action: 'my_action' , type_action: type_action, id: idInfo, name: name, phone: phone, tele: tele, website: website, address: address, district: district, city: city }
        }).done(function( msg ) {
            if (msg == 'OK') {
                modal.find(".alert-danger").hide();
                modal.find(".modal-body").prepend(
                    "<div class='alert alert-success' role='alert'><strong>Chúc mừng!</strong> Thông tin cửa hàng đã thay đổi thành công! </div>"
                );
                jQuery("button.btn-update-" + idInfo).prop("disabled", true);
                location.reload();
            }
            else {
                modal.find(".modal-body").prepend(
                    "<div class='alert alert-danger' role='alert'>" + msg + "</div>"
                );
            }
        });
    });

    // Delete single store
    jQuery(".btn-delete-store").click(function () {
        var idInfo = jQuery(this).data('id-info');
        var type_action = 'delete';
        var modal = jQuery(".modal.deleteStore-" + idInfo);
        jQuery.ajax({
            type: "POST",
            url: ajaxurl,
            data: { action: 'my_action' , type_action: type_action, id: idInfo }
        }).done(function( msg ) {
            if (msg == 'OK') {
                modal.find(".modal-body").prepend(
                    "<div class='alert alert-success' role='alert'><strong>Chúc mừng!</strong> Thông tin cửa hàng đã xóa thành công! </div>"
                );
                jQuery("button.btn-delete-store-" + idInfo).prop("disabled", true);
                location.reload();
            }
        });
    });

    // Select stores
    jQuery(".select-all-stores").change(function () {
        if (jQuery(this).prop('checked')==true){
            //do something
            jQuery('input[name="item-store"]').prop('checked', true);
            jQuery('tr.item_row').addClass('selected');
            jQuery("button.btn-delete-mutli-stores").prop("disabled", false)
        }
        else {
            jQuery('input[name="item-store"]').prop('checked', false);
            jQuery('tr.item_row').removeClass('selected');
            jQuery("button.btn-delete-mutli-stores").prop("disabled", true);
        }
    });
    jQuery('input[name="item-store"]').change(function () {
        var idInfo = jQuery(this).val();
        if (jQuery(this).prop('checked')==true){
            //do something
            jQuery('tr.item-store-' + idInfo).addClass('selected');
            number_selected += 1;
        }
        else {
            jQuery('tr.item-store-' + idInfo).removeClass('selected');
            number_selected -= 1;
        }
        if (number_selected != 0) {
            jQuery("button.btn-delete-mutli-stores").prop("disabled", false)
        }
        else {
            jQuery("button.btn-delete-mutli-stores").prop("disabled", true);
        }
    });

    // Delete multi stores
    jQuery(".btn-delete-mutli-stores-action").click(function () {
        var type_action = 'delete_multi';
        var modal = jQuery(".modal.deleteMultiStores");
        var list_selected = [];
        jQuery('input[name="item-store"]:checked').each(function () {
            list_selected.push(jQuery(this).val());
        });
        console.log(list_selected);
        jQuery.ajax({
            type: "POST",
            url: ajaxurl,
            data: { action: 'my_action' , type_action: type_action, list_selected: list_selected }
        }).done(function( msg ) {
            if (msg == 'OK') {
                modal.find(".modal-body").prepend(
                    "<div class='alert alert-success' role='alert'><strong>Chúc mừng!</strong> Thông tin cửa hàng đã xóa thành công! </div>"
                );
                jQuery("button.btn-delete-mutli-stores-action").prop("disabled", true);
                location.reload();
            }
        });
    });

    var table = jQuery('#list-stores-table').DataTable({
        // "paging": false,
        // "scrollX": true,
        responsive: true,
        "language": {
            "lengthMenu": "Hiển thị _MENU_ kết quả mỗi trang",
            "zeroRecords": "Xin lỗi - không tìm thấy kết quả",
            "info": "Đang hiển thị trang _PAGE_ trên _PAGES_",
            "infoEmpty": "Dữ liệu rỗng, vui lòng thêm dữ liệu mới!",
            "infoFiltered": "(filtered from _MAX_ total records)",
            "search": "Tìm kiếm:",
            "paginate": {
                "first":      "Trang đầu",
                "last":       "Trang cuối",
                "next":       "Trang tiếp",
                "previous":   "Trang trước"
            },
        },
        "columnDefs": [ {
            "orderable": false,
            "width": "7%",
            "targets": 0
        } ]
    });
});

