$(document).ready(function () {

    $("#dTable").bootstrapTable({
        responseHandle: function (res) { return responseHandler1(res); },
        columns: tbheader,
        filter: true,
        detailFormatter: function (index, row) { return detailFormatter(index, row); }
    });
});

function detailFormatter(index, row) {
    var html = [];
    if (row['crtest'])
        html.push("<p><a class=\"btn btn-info\" href=\"jsroot/?file=../result.root&layout=grid4x4&load=../drawTest.js\"><b>Cosmic-ray Test</b> </a></p>");
    if (row['beamtest'])
        html.push("<p><a class=\"btn btn-info\" href=\"jsroot/?file=../result.root&layout=grid4x4&load=../drawTest.js\"><b>Beam Test</b> </a></p>");
    return html.join('');
};

function loadData(query) {
    $.getJSON(query + "?" + Math.random(), function (data) {
        $("#dTable").bootstrapTable('append', data['mrpc']);
    })
};

$(function () {
    $('#dTable').bootstrapTable({
        onExpandRow: function (index, row, $detail) {
            $detail.hide().fadeIn('slow');
        },
        onCollapseRow: function (index, row, $detail) {
            $detail.clone().insertAfter($detail).fadeOut('slow', function () {
                $(this).remove();
            })
        }
    })
});

var $table = $('#dTable');
$(function () {
    $('#toolbar').find('select').change(function () {
        $table.bootstrapTable('destroy').bootstrapTable({
            exportDataType: $(this).val()
        });
    });
})