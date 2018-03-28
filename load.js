$(document).ready(function () {

    $("#dTable").bootstrapTable({
        responseHandle: function (res) {
            return responseHandler1(res);
        },
        columns: tbheader,
        filter: true,
        detailFormatter: function (index, row) {
            return detailFormatter(index, row);
        }
    });

    loadData("query.php");
});

function buildJsRootBtn(text, file, layout, action) {
    var uri = '/detdb/jsroot?file=' + file + '&layout=' + layout + "&load=" + action;
    return "<p><a class=\"btn btn-info\" href=\"" + encodeURI(uri) + "\"><b>" + text + "</b> </a></p>";
}

function buildList(header, data){
    html = [];
    html.push("<p>" + header + "</p>");
    $.each(data,function(k,v){
        html.push("<p><b>"+k+"</b>: "+v+"</p>");
    });   
    return html.join('');
}

function detailFormatter(index, row) {
    var html = [];
    if (tbname == "mrpc") {
        // Button - link to jsroot
        if (row['crtest'])
            html.push(
                buildJsRootBtn("Cosmic-ray Test", "/detdb/result.root", "grid4x4", "/detdb/drawTest.js"));
        if (row['beamtest'])
            html.push(
                buildJsRootBtn("Beam Test", "/detdb/result.root", "grid4x4", "/detdb/drawTest.js"));
    } else if (tbname == 'epd-fee') {
        // Button - link to jsroot
        html.push(
            buildJsRootBtn("Result", '"/detdb/getFile.php?exp=EPD&type=FEE&uid=' + row['uid'] + '"', "simple", "/detdb/drawTest.js")
        );
        // Table - pedestal
        html.push("<table class='table'>");
        html.push("<thead><tr><th>Pedestal</th>");
        for (var i = 0; i < 16; i++) {
            html.push("<th>CH-" + i + "</th>");
        }
        html.push("</tr></thead>");
        html.push("<tbody>");
        $.each(row["pedestal"], function (key, value) {
            html.push("<tr><td>" + key + "</td>");
            if ($.isArray(value)) {
                $.each(value, function (k, v) {
                    html.push("<td>" + v + "</td>");
                });
                html.push("</tr>");
            }
        });
        html.push("</tbody>");
        html.push("</table>");
    }
    else if(tbname == 'epd-rxb'){
        // Button - link to jsroot
        html.push(
            buildJsRootBtn("Result", '"/detdb/getFile.php?exp=EPD&type=RXB&uid=' + row['uid'] + '"', "simple", "/detdb/drawTest.js")
        );
        // List
        html.push(buildList("Current / A", row['current']));    
    }else if(tbname == 'epd-sipm'){
        // Button - link to jsroot
        html.push(
            buildJsRootBtn("Result", '"/detdb/getFile.php?exp=EPD&type=SiPM&uid=' + row['uid'] + '"', "simple", "/detdb/drawTest.js")
        );
        // List
        html.push(buildList("Height / mm", row['vis-test']));   
    }
    return html.join('');
}

function loadData(query) {
    $.getJSON(query + "?tbname=" + tbname + "&" + Math.random(), function (data) {
        $("#dTable").bootstrapTable('append', data);
    });
}

$(function () {
    $('#dTable').bootstrapTable({
        onExpandRow: function (index, row, $detail) {
            $detail.hide().fadeIn('slow');
        },
        onCollapseRow: function (index, row, $detail) {
            $detail.clone().insertAfter($detail).fadeOut('slow', function () {
                $(this).remove();
            });
        }
    });
});

var $table = $('#dTable');
$(function () {
    $('#toolbar').find('select').change(function () {
        $table.bootstrapTable('destroy').bootstrapTable({
            exportDataType: $(this).val()
        });
    });
});
