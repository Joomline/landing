var LandingmanagementMap = {
    add: function (button, name) {
        var i = 1;
        while (jQuery('[name="'+name+'[points]['+i+'][desc]"]').length > 0) {
            i++;
        }
        var html =
            '        <tr>\n' +
            '            <td><input type="text" name="'+name+'[points]['+i+'][desc]" value="" style="width: 100%"></td>\n' +
            '            <td><input type="text" name="'+name+'[points]['+i+'][site]" value="" style="width: 100%"></td>\n' +
            '            <td><input type="text" name="'+name+'[points]['+i+'][lat]"  value="" style="width: 100%"></td>\n' +
            '            <td><input type="text" name="'+name+'[points]['+i+'][lng]"  value="" style="width: 100%"></td>\n' +
            '            <td><input type="button" value="X" onclick="LandingmanagementMap.del(this)"></td>\n' +
            '        </tr>';
        jQuery(button).parent().find('tbody.map-body').append(html);
    },
    del: function (button) {
        jQuery(button).parents('tr').remove();
    }
};