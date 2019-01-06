$(function () {

    /**
     * 参加者行削除
     */
    $('#lesson-create,#lesson-edit').off('click', '#form-participants .btn-delete');
    $('#lesson-create,#lesson-edit').on('click', '#form-participants .btn-delete', function () {
        $(this).closest('tr').remove();
        return false;
    });

    /**
     * 収入行削除
     */
    $('#lesson-create,#lesson-edit').off('click', '#form-revenues .btn-delete');
    $('#lesson-create,#lesson-edit').on('click', '#form-revenues .btn-delete', function () {
        $(this).closest('tr').remove();
        return false;
    });

    /**
     * 刑事行削除
     */
    $('#lesson-create,#lesson-edit').off('click', '#form-expenses .btn-delete');
    $('#lesson-create,#lesson-edit').on('click', '#form-expenses .btn-delete', function () {
        $(this).closest('tr').remove();
        return false;
    });

    /**
     * 参加者行追加
     */
    $('#lesson-create,#lesson-edit').off('click', '#form-participants .btn-add');
    $('#lesson-create,#lesson-edit').on('click', '#form-participants .btn-add', function () {

        var tbody = $('#lesson-create,#lesson-edit').find('#form-participants tbody');
        var idx = $(tbody).find('tr').length + 1;
        html = '';
        html += '<tr>';
        html += '   <td>';
        html += '       <input name="participants[' + idx + '][name]" type="text" class="form-control form-control-sm col-12" required="required">';
        html += '   </td>';
        html += '   <td>';
        html += '       <input name="participants[' + idx + '][parent_name]" type="text" class="form-control form-control-sm col-12" required="required">';
        html += '   </td>';
        html += '   <td class="text-right">';
        html += '       <a href="#" class="btn btn-outline-secondary btn-delete">削除</a>';
        html += '   </td>';
        html += '</tr>';
        $(tbody).append(html);
        return false;
    });

    /**
     * 収入行追加
     */
    $('#lesson-create,#lesson-edit').off('click', '#form-revenues .btn-add');
    $('#lesson-create,#lesson-edit').on('click', '#form-revenues .btn-add', function () {

        var tbody = $('#lesson-create,#lesson-edit').find('#form-revenues tbody');
        var idx = $(tbody).find('tr').length + 1;
        html = '';
        html += '<tr>';
        html += '   <td>';
        html += '       <input name="revenues[' + idx + '][item]" type="text" class="form-control form-control-sm col-12" required="required">';
        html += '   </td>';
        html += '   <td>';
        html += '       <input name="revenues[' + idx + '][amount]" type="number" class="form-control form-control-sm col-12" required="required">';
        html += '   </td>';
        html += '   <td class="text-right">';
        html += '       <a href="#" class="btn btn-outline-secondary btn-delete">削除</a>';
        html += '   </td>';
        html += '</tr>';
        $(tbody).append(html);
        return false;
    });

    /**
     * 収入計算
     */
    $('#lesson-create,#lesson-edit').off('change', '#form-revenues [name$="[amount]"]');
    $('#lesson-create,#lesson-edit').on('change', '#form-revenues [name$="[amount]"]', function () {

        var tbody = $('#lesson-create,#lesson-edit').find('#form-revenues tbody');
        var sum = 0;
        $(tbody).find('[name$="[amount]"]').each(function () {
            var amount = parseInt($(this).val());
            if (!isNaN(amount)) {
                sum += amount;
            }
        });
        $('#lesson-create,#lesson-edit').find('[name="total_revenue"]').val(sum);
        calcTotalBudget();
    });

    /**
     * 経費行追加
     */
    $('#lesson-create,#lesson-edit').off('click', '#form-expenses .btn-add');
    $('#lesson-create,#lesson-edit').on('click', '#form-expenses .btn-add', function () {

        var tbody = $('#lesson-create,#lesson-edit').find('#form-expenses tbody');
        var idx = $(tbody).find('tr').length + 1;
        html = '';
        html += '<tr>';
        html += '   <td>';
        html += '       <input name="expenses[' + idx + '][item]" type="text" class="form-control form-control-sm col-12" required="required">';
        html += '   </td>';
        html += '   <td>';
        html += '       <input name="expenses[' + idx + '][amount]" type="number" class="form-control form-control-sm col-12" required="required">';
        html += '   </td>';
        html += '   <td>';
        html += '       <div class="row">';
        html += '           <input name="expenses[' + idx + '][receipt]" type="file" class="form-control form-control-sm col-6">';
        html += '       </div>';
        html += '   </td>';
        html += '   <td class="text-right">';
        html += '       <a href="#" class="btn btn-outline-secondary btn-delete">削除</a>';
        html += '   </td>';
        html += '</tr>';
        $(tbody).append(html);
        return false;
    });

    /**
     * 経費計算
     */
    $('#lesson-create,#lesson-edit').off('change', '#form-expenses [name$="[amount]"]');
    $('#lesson-create,#lesson-edit').on('change', '#form-expenses [name$="[amount]"]', function () {

        var tbody = $('#lesson-create,#lesson-edit').find('#form-expenses tbody');
        var sum = 0;
        $(tbody).find('[name$="[amount]"]').each(function () {
            var amount = parseInt($(this).val());
            if (!isNaN(amount)) {
                sum += amount;
            }
        });
        $('#lesson-create,#lesson-edit').find('[name="total_expense"]').val(sum);
        calcTotalBudget();
    });

    /**
     * 収支計算
     */
    var calcTotalBudget = function () {
        $('#lesson-create,#lesson-edit').find('[name="total_budget"]').val(
            $('#lesson-create,#lesson-edit').find('[name="total_revenue"]').val()
            -
            $('#lesson-create,#lesson-edit').find('[name="total_expense"]').val()
        );
    };

});
