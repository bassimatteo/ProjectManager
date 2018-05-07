<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
	

	<script type="text/javascript" src="{{ URL::asset('js/daypilot-all.min.js') }}"></script>

	<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    


        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
    
    
     <div id="dp"></div>
            <script type="text/javascript">
                var dp = new DayPilot.Scheduler("dp");

                dp.viewType = "Days";
                dp.startDate = new DayPilot.Date().firstDayOfMonth();
                dp.days = dp.startDate.daysInMonth();

                dp.timeHeaders = [
                    { groupBy: "Day", format: "MMMM yyyy" },
                    { groupBy: "Hour"}
                ];

                dp.heightSpec = "Max";
                dp.height = 400;

                dp.cellWidthSpec = "Auto";

                dp.rowHeaderColumns = [
                    { title: "Day", width: 100},
                    { title: "Total", width: 100}
                ];

                dp.onBeforeRowHeaderRender = function(args) {
                    var duration = args.row.events.totalDuration();
                    var str;
                    if (duration.totalDays() >= 1) {
                        str = Math.floor(duration.totalHours()) + ":" + duration.toString("mm");
                    }
                    else {
                        str = duration.toString("H:mm");
                    }

                    args.row.columns[0].html = str + " hours";
                };

                // http://api.daypilot.org/daypilot-scheduler-oneventmoved/
                dp.onEventMoved = function (args) {
                    $.post("backend_move.php",
                    {
                        id: args.e.id(),
                        newStart: args.newStart.toString(),
                        newEnd: args.newEnd.toString(),
                        newResource: args.newResource
                    },
                    function() {
                        dp.message("Moved.");
                    });
                };

                // http://api.daypilot.org/daypilot-scheduler-oneventresized/
                dp.onEventResized = function (args) {
                    $.post("backend_resize.php",
                    {
                        id: args.e.id(),
                        newStart: args.newStart.toString(),
                        newEnd: args.newEnd.toString()
                    },
                    function() {
                        dp.message("Resized.");
                    });
                };

                // event creating
                // http://api.daypilot.org/daypilot-scheduler-ontimerangeselected/
                dp.onTimeRangeSelected = function (args) {
                    var name = prompt("New event name:", "Event");
                    dp.clearSelection();
                    if (!name) return;

                    $.post("backend_create.php",
                        {
                            start: args.start.toString(),
                            end: args.end.toString(),
                            resource: $("#employee").val(),
                            name: name
                        },
                        function(data) {
                            var e = new DayPilot.Event({
                                start: args.start,
                                end: args.end,
                                id: data.id,
                                resource: args.resource,
                                text: name
                            });
                            dp.events.add(e);

                            dp.message(data.message);
                        });
                };

                dp.onEventClick = function(args) {
                    var modal = new DayPilot.Modal();
                    modal.closed = function() {
                        // reload all events
                        var data = this.result;
                        if (data && data.result === "OK") {
                            loadEvents();
                        }
                    };
                    modal.showUrl("edit.php?id=" + args.e.id());
                };

                dp.init();

                $(document).ready(function() {
                    loadResources();
                    $("#employee").change(function() {
                        loadEvents();
                    });
                });

                function loadResources() {
                    $.post("backend_resources.php", function(data) {
                        for (var i = 0; i < data.length; i++) {
                            var item = data[i];
                            $("#employee").append($('<option/>', {
                                value: item.id,
                                text : item.name
                            }));
                        }
                        loadEvents();
                    });
                }

                function loadEvents() {
                    var url = "backend_events.php?resource=" + $("#employee").val() + "&start=" + dp.startDate + "&end=" + dp.startDate.addDays(dp.days);
                    dp.events.load(url, function() {
                        dp.message("Events for " + $("#employee option:selected").text() + " loaded.");
                    });
                }

            </script>
    
      
      
      
    </body>
</html>
