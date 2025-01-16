import { Calendar } from '@fullcalendar/core';
import timeGridPlugin from '@fullcalendar/timegrid';
import interactionPlugin from '@fullcalendar/interaction';

document.addEventListener('DOMContentLoaded', () => {
    let calendarElement = document.getElementById('calendar-preview');

    if (calendarElement) {
        let calendar = new Calendar(calendarElement, {
            plugins: [timeGridPlugin, interactionPlugin],
            timeZone: 'UTC',
            initialView: 'timeGridWeek',
            /*height: '100%',*/
            editable: false,
            selectable: false,
            allDaySlot: false,
            slotDuration: '01:00:00',
            nowIndicator: true,
            expandRows: true,
            headerToolbar: {
                left: 'title',
                right: 'prev,next',
            },
            firstDay: 1,
            slotMinTime: '08:00:00',
            slotMaxTime: '20:00:00',
            validRange: {
                start: new Date(),
                end: new Date(new Date().setDate(new Date().getDate() + 10)),
            },
            events: function (fetchInfo, successCallback, errorCallback) {
                fetch('/reservations?darkroom_id=1')
                    .then(response => response.json())
                    .then(events => successCallback(events))
                    .catch(error => {
                        alert(error.message);
                        errorCallback(error)
                    });
            },
        });

        calendar.render();
    }
})
