function stumble(surveyId, device) {

        var scanUrl = "/surveys/" + surveyId + "/scan/" + device;

        $.getJSON(scanUrl, function (scans) {
            $.each(scans, function (index, scan) {
                var rowId = scan.ssidSlug;
                var row = $('#' + rowId);

                if (row.length) {
                    var lastSignal = scan.signalStrength;
                    var bestSignal = row.children('.last-signal').text();

                    if (lastSignal > bestSignal) {
                        row.children('.best-signal').text(bestSignal);
                    }

                    row.children('.last-signal').text(lastSignal);
                    row.children('.noise-floor').text(scan.noiseFloor);
                    row.children('.snr').text(scan.snr);
                    row.children('.last-seen').text(scan.seen);

                }
                else {
                    var source = $("#scan-row-template").html();
                    var template = Handlebars.compile(source);
                    var context = scan;
                    var html = template(context);

                    $('#scans-table tbody').append(html);

                }

                $("#scans-table").tablesorter( {sortList: [[1,1]]} );
            });

        });
    }