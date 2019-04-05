var LandingPage = {
    formControl: '',
    deleteText: '',
    nameText: '',
    menuText: '',
    publishText: '',
    metaTitle: '',
    metaDesc: '',
    alias: '',
    addRow: function (name, id) {
        var i = 1;
        while (jQuery('#' + id + '-name-' + i).length > 0) {
            i++;
        }
        var html =
            '\t\t\t\t\t<tr>\n' +
            '\t\t\t\t\t\t<td><input type="text" name="'+name+'['+i+'][name]" id="'+id+'-name-'+i+'" value="" style="width: 100%"></td>\n' +
            '\t\t\t\t\t\t<td><input type="text" name="'+name+'['+i+'][desc]" id="'+id+'-desc-'+i+'" value="" style="width: 100%"></td>\n' +
            '\t\t\t\t\t\t<td><input type="button" value="X" onclick="LandingPage.deleteRow(this);"></td>\n' +
            '\t\t\t\t\t</tr>';
        jQuery('#multiple-field').append(html);
    },
    deleteRow: function (button) {
        jQuery(button).parents('tr').remove();
    },
    storeordering: function ()
    {
        var parent_element = jQuery('#sortableUsed');
        var fields = [];
        var used, val;
        used = jQuery('#used');
        i = 0;
        parent_element.children('li').each(function(){
            fields[i++] = jQuery(this).attr('id');
        });
        val = fields.join(',');
        used.val(val)
    },
    initordering: function () {
        this.storeordering(jQuery('#sortableUsed'));
    }
};

jQuery(function() {
    jQuery( '#sortableNotUsed,#sortableUsed' ).sortable({
        connectWith: '#sortableNotUsed,#sortableUsed',
        update: function(event, ui) {
            if(ui.sender) {
                LandingPage.storeordering(jQuery(ui.sender));
            }else{
                LandingPage.storeordering(jQuery(ui.item).parent());
            }
        }
    });
    LandingPage.initordering();
});