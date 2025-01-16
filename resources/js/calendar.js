import { Calendar } from '@fullcalendar/core';
import timeGridPlugin from '@fullcalendar/timegrid';
import interactionPlugin from '@fullcalendar/interaction';

document.addEventListener('DOMContentLoaded', async () => {
    let calendarElement = document.getElementById('calendar');

    if (calendarElement) {
        const darkroomId = 1;
        const userId = calendarElement.dataset.userId;

        // fetching data from database
        const fetchOpeningHours = async (darkroomId) => {
            try {
                const response = await fetch('/darkrooms/' + darkroomId + '/opening-hours');
                const data = await response.json();
                return {
                    openingHour: data.opening_time,
                    closingHour: data.closing_time,
                };
            } catch (error) {
                alert('Error while fetching opening time:\n' + error);
            }
        };

        const fetchReservations = async (darkroomId, successCallback, errorCallback) => {
            try {
                const response = await fetch('/darkrooms/${darkroomId}/reservations');
                const events = await response.json();
                successCallback(events);
            } catch (error) {
                alert('Error while fetching reservations:\n' + error);
                errorCallback(error);
            }
        };

        const createReservation = async (reservationData, calendar) => {
            try {
                const response = await fetch('/darkrooms/' + darkroomId + '/reservations', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]'),
                    },
                    body: JSON.stringify(reservationData),
                });

                const data = await response.json();

                if (data.success) {
                    alert('Reservation successfully created!');
                    calendar.refetchEvents();
                }
            } catch (error) {
                alert('Error while creating reservation:\n' + error);
            }
        };

        const { openingHour, closingHour } = await fetchOpeningHours(darkroomId);

        let calendar = new Calendar(calendarElement, {
            plugins: [timeGridPlugin, interactionPlugin],
            timeZone: 'UTC',
            initialView: 'timeGridWeek',
            /*height: '100%',*/
            editable: true,
            selectable: true,
            allDaySlot: false,
            slotDuration: '01:00:00',
            nowIndicator: true,
            expandRows: true,
            headerToolbar: {
                left: 'title',
                right: 'prev,next',
            },
            firstDay: 1,
            slotMinTime: openingHour,
            slotMaxTime: closingHour,
            validRange: {
                start: new Date(),
                end: new Date(new Date().setDate(new Date().getDate() + 10)),
            },
            events: (fetchInfo, successCallback, errorCallback) => {
                fetchReservations(darkroomId, successCallback, errorCallback);
            },
            select: (info) => {
                const reservationData = {
                    start_time: info.startStr,
                    end_time: info.endStr,
                    user_id: userId,
                    darkroom_id: darkroomId,
                };
                createReservation(reservationData);
            },
        });

        calendar.render();
    }
})
