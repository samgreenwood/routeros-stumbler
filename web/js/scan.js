$(document).ready(function()
{

    function stumble() {

        var scanUrl = "/api/scan";

        $.getJSON(scanUrl, function (scans) {
            $.each(scans, function (index, scan) {
                var rowId = scan.ssid;
                var row = $('#' + rowId);

                if (row.length) {
                    var lastSignal = scan.signalStrength;
                    var bestSignal = row.children('.last-signal').text();

                    if (lastSignal > bestSignal) {
                        row.children('.best-signal').text(bestSignal);
                    }

                    row.children('.last-signal').text(lastSignal);
                }
                else {
                    var source = $("#scan-row-template").html();
                    var template = Handlebars.compile(source);
                    var context = {ssid: scan.ssid, signal: scan.signalStrength};
                    var html = template(context);

                    $('#scans-table tbody').append(html);

                }

            });

        });
    }

    setInterval(function(){ stumble(); }, 100);
});