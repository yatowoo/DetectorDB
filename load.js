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
    return "<a class=\"label label-info\" target=\"_blank\" href=\"" + encodeURI(uri) + "\">" + text + "</a>";
}

function buildList(header, data){
    html = [];
    html.push("<p>" + header + "</p>");
    $.each(data,function(k,v){
        html.push("<p><b>"+k+"</b>: "+v+"</p>");
    });   
    return html.join('');
}

function getLabelPass(){
    return "<span class=\"label label-success\">PASS</span>";
}

function getLabelFail(){
    return "<span class=\"label label-danger\">FAIL</span>";
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
        // List
        html.push(buildList("Current / A", row['current']));    
    }else if(tbname == 'epd-sipm'){
        // List
        html.push('<div class="col-sm-2 column">');
        html.push(buildList("Height / mm", row['vis-test']));
        html.push('</div>');
        // Image
        html.push('<div class="col-sm-10 column">');
        if(row['vis']){
            var uri = '/detdb/getImage.php?exp=EPD&type=SiPM&uid=' + row['uid'] + '&test=Visual';
            html.push(
                "<img src='" + uri + "' class=\"img-rounded\" height=\"180px\"></img>"
            );
        }else{
            html.push('<p>No Image.</p>');
        }
        html.push('</div>');
    }
    return html.join('');
}

function loadData(query) {
    $.getJSON(query + "?tbname=" + tbname + "&" + Math.random(), function (data) {
        $.each(data, function(idx,row){
            // Check if result file (.root) exist
            var hasResult = true;
            // Convert boolean value to pass/fail label
            $.each(row, function(key, val){
                if(typeof val == 'boolean' && key != 'result'){
                    if(val){
                        data[idx][key] = getLabelPass();
                    }else{
                        data[idx][key] = getLabelFail();
                        hasResult = false;
                    }
                }
            });
            // Build a button point to result file (.root)
                // and show with jsroot
	    if(row.result != undefined){
		hasResult = row.result;
                row.result = null;
            }
            if(hasResult){
                var tbType = '';
                if(tbname == 'epd-fee'){
                    tbType = 'FEE';
                }else if(tbname == 'epd-rxb'){
                    tbType = 'RXB';
                }else if(tbname == 'epd-sipm'){
                    tbType = 'SiPM';
                }
                row.result = buildJsRootBtn("SHOW", '\"/detdb/getFile.php?exp=EPD&type=' + tbType + '&uid=' + row['uid'] + '"', "simple", "/detdb/drawTest.js");
            }
        });
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
