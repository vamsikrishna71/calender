<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js"> </script>

        <script>
            var events = {!! json_encode($events->toArray(), JSON_HEX_TAG) !!};
            document.addEventListener('DOMContentLoaded', function() {
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    eventDisplay: 'list-item',
                    initialView: 'dayGridMonth',
                    locale:'fr',
                    events:events
                });
                calendar.render();
                calendar.on('eventClick', function(info) {
                    var modal = document.getElementById("editAndDeleteEventsModal");
                    var idEditInput = document.getElementById("editEventsModalIdInput");
                    idEditInput.value = info.event.id
                    var idDeleteInput = document.getElementById("deleteEventsModalIdInput");
                    idDeleteInput.value = info.event.id
                    var titleInput = document.getElementById("editEventsModalTitleInput");
                    titleInput.value = info.event.title
                    var startDateInput = document.getElementById("editEventsModalStartDateInput");
                    startDateInput.value = info.event.startStr.substr(0,16)
                    var endDateInput = document.getElementById("editEventsModalEndDateInput");
                    endDateInput.value = info.event.endStr.substr(0,16)
                    modal.style.display = "block";
                    var span = document.getElementsByClassName("close")[1];
                    span.onclick = function() {
                        modal.style.display = "none";
                    }
                })
                calendar.on('dateClick', function(info) {
                    var modal = document.getElementById("modal");
                    modal.style.display = "block";
                    var span = document.getElementsByClassName("close")[0];
                    span.onclick = function() {
                        modal.style.display = "none";
                    }
                    // console.log(info.dateStr);
                    // console.log(info.dayEl);
                });
            });
        </script>



        <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css" rel="stylesheet" />

        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--bg-opacity:1;background-color:#fff;background-color:rgba(255,255,255,var(--bg-opacity))}.bg-gray-100{--bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252,var(--bg-opacity))}.border-gray-200{--border-opacity:1;border-color:#edf2f7;border-color:rgba(237,242,247,var(--border-opacity))}.border-t{border-top-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{box-shadow:0 1px 3px 0 rgba(0,0,0,.1),0 1px 2px 0 rgba(0,0,0,.06)}.text-center{text-align:center}.text-gray-200{--text-opacity:1;color:#edf2f7;color:rgba(237,242,247,var(--text-opacity))}.text-gray-300{--text-opacity:1;color:#e2e8f0;color:rgba(226,232,240,var(--text-opacity))}.text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.text-gray-500{--text-opacity:1;color:#a0aec0;color:rgba(160,174,192,var(--text-opacity))}.text-gray-600{--text-opacity:1;color:#718096;color:rgba(113,128,150,var(--text-opacity))}.text-gray-700{--text-opacity:1;color:#4a5568;color:rgba(74,85,104,var(--text-opacity))}.text-gray-900{--text-opacity:1;color:#1a202c;color:rgba(26,32,44,var(--text-opacity))}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--bg-opacity:1;background-color:#2d3748;background-color:rgba(45,55,72,var(--bg-opacity))}.dark\:bg-gray-900{--bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44,var(--bg-opacity))}.dark\:border-gray-700{--border-opacity:1;border-color:#4a5568;border-color:rgba(74,85,104,var(--border-opacity))}.dark\:text-white{--text-opacity:1;color:#fff;color:rgba(255,255,255,var(--text-opacity))}.dark\:text-gray-400{--text-opacity:1;color:#cbd5e0;color:rgba(203,213,224,var(--text-opacity))}.dark\:text-gray-500{--tw-text-opacity:1;color:#6b7280;color:rgba(107,114,128,var(--tw-text-opacity))}}
            body {
                padding: 2% 10%;
            }

            hr {
                border: none;
                height: 2px;
                background-color: whitesmoke;
            }
            
            h1 {
                text-align: center;
                margin: 5% 0;
            }

            button {
                padding: 0.5% 1%;
                margin: 0.5%;
                color:white;
                background-color: black;
                border:none;
                border-radius: 2px;
            }

            table {
                border: 1px solid whitesmoke;
                border-radius: 4px;
            }

            input {
                border: 1px solid whitesmoke;
                display: block;
                margin: 0.5% auto;
                margin-bottom: 2%;
            }

            form label {
                display: block;
            }

            .calendar, .alerts {
                margin: 5% 5%;
            }

            .modal {
                border: 2px solid whitesmoke;
                border-radius: 4px;
                background-color: #fff;
                position: absolute;
                margin-left: auto;
                margin-right: auto;
                left: 0;
                right: 0;
                text-align: center;
                display: none;
                position: fixed;
                z-index: 3;
                top: 20%;
                width: 50%;
                height: 50%;
                overflow: auto; 
            }

            .editAndDeleteEventsModal {
                border: 2px solid whitesmoke;
                border-radius: 4px;
                background-color: #fff;
                position: absolute;
                margin-left: auto;
                margin-right: auto;
                left: 0;
                right: 0;
                text-align: center;
                display: none;
                position: fixed;
                z-index: 3;
                top: 20%;
                width: 50%;
                height: 50%;
                overflow: auto; 
            }

            .close {
                color: #aaa;
                float: right;
                font-size: 28px;
                font-weight: bold;
            }

            .close:hover,
            .close:focus {
                color: black;
                text-decoration: none;
                cursor: pointer;
            }

            .fc-daygrid-event-harness a {
                cursor: pointer;
                width:98%;
                margin: 1%;
                -webkit-box-shadow: 7px 7px 4px 1px rgba(0,0,0,0.11); 
                box-shadow: 7px 7px 4px 1px rgba(0,0,0,0.11);
            }

            .fc-col-header-cell {
                background-color: black;
                color: white;
                padding: 1% 0!important;
            }

            .fc-daygrid-day {
                cursor: pointer;
            }

        </style>

    </head>
    <body>

        <h1>Full calendar view with Laravel</h1>
        <hr>
        <div class="alerts">
            @if(Session::get('createSuccess'))
                    <span style="background-color:green; color:white; padding: 0.5% 1%;"> {{Session::get('createSuccess')}} </span>
                @endif
            @if(Session::get('createFail'))
                <span style="background-color:red; color:white; padding: 0.5% 1%;"> {{Session::get('fail')}} </span>
            @endif
            @if(Session::get('editSuccess'))
                    <span style="background-color:black; color:white; padding: 0.5% 1%;"> {{Session::get('editSuccess')}} </span>
                @endif
            @if(Session::get('deleteSuccess'))
                <span style="background-color:red; color:white; padding: 0.5% 1%;"> {{Session::get('deleteSuccess')}} </span>
            @endif
        </div>

        <div class="modal" id="modal">
            <h2>Ajouter un event</h2>
            <span class="close">&times;</span>
            <form action="createEvent" method="POST">
                @csrf 
                <label for="title">Titre</label>
                <input type="text" name="title">
                <label for="startDate">Date de début</label>
                <input type="datetime-local" name="startDate">
                <label for="endDate">Date de fin</label>
                <input type="datetime-local" name="endDate">
                <button type="submit">Valider</button>
            </form>
        </div>

        <div class="editAndDeleteEventsModal" id="editAndDeleteEventsModal">
            <h2>Event</h2>
            <span class="close">&times;</span>
            <form action="editEvent" method="POST">
                @csrf 
                <input style="display:none" id="editEventsModalIdInput" name="id">
                <label for="title">Titre</label>
                <input type="text" id="editEventsModalTitleInput" name="title">
                <label for="startDate">Date de début</label>
                <input type="datetime-local" id="editEventsModalStartDateInput" name="startDate">
                <label for="endDate">Date de fin</label>
                <input type="datetime-local" id="editEventsModalEndDateInput" name="endDate">
                <button type="submit">Modifier</button>
            </form>
            <form action="deleteEvent" method="POST">
                @csrf 
                <input style="display:none" id="deleteEventsModalIdInput" name="id">
                <button style="background-color:red;">Supprimer</button>
            </form>
        </div>

        <div class="calendar" id="calendar"></div>

    </body>
</html>