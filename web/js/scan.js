function stumble(surveyId, device) {

        var scanUrl = "/surveys/" + surveyId + "/scan/" + device;

        $.getJSON(scanUrl, function (scans) {

            $.each(scans, function (index, scan) {
                if (scan.ssidSlug.substring(0,3) !== "as-") {
                  if (scan.ssidSlug.substring(0,4) !== "air-") {
                    return;
                  }
                }
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
                    var snr = Math.round(scan.snr * 100) / 100
                    row.children('.snr').text(snr);
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

            $.each(scans, function (index, scan2) {
                var rowId = scan2.ssidSlug;
                var row = $('#' + rowId);
                if (scan2.ssidSlug.substring(0,3) === "as-") {
                  return;
                }
                if (scan2.ssidSlug.substring(0,4) === "air-") {
                  return;
                }

                if (row.length) {
                    var lastSignal = scan2.signalStrength;
                    var bestSignal = row.children('.last-signal').text();

                    if (lastSignal > bestSignal) {
                        row.children('.best-signal').text(bestSignal);
                    }

                    row.children('.last-signal').text(lastSignal);
                    row.children('.noise-floor').text(scan2.noiseFloor);
                    var snr = Math.round(scan2.snr * 100) / 100
                    row.children('.snr').text(snr);
                    row.children('.last-seen').text(scan2.seen);

                }
                else {
                    var source2 = $("#scan2-row-template").html();
                    var template2 = Handlebars.compile(source2);
                    var context2 = scan2;
                    var html2 = template2(context2);

                    $('#scans2-table tbody').append(html2);

                }

                $("#scans2-table").tablesorter( {sortList: [[1,1]]} );
            });

        });
    }
