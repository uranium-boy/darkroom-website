import { Calendar } from '@fullcalendar/core';
import timeGridPlugin from '@fullcalendar/timegrid';
import interactionPlugin from '@fullcalendar/interaction';

document.addEventListener('DOMContentLoaded', async () => {
    let calendarElement = document.getElementById('calendar');
    let confirmButton = document.getElementById('confirm-button');
    let reservationData = null;

    if (calendarElement) {
        const darkroomId = calendarElement.dataset.darkroomId;
        const isEditable = calendarElement.dataset.isEditable;
        const userId = calendarElement.dataset.userId;


        // fetching data from database
        const fetchOperatingTime = async (darkroomId) => {
            try {
                const response = await fetch(`/darkrooms/${darkroomId}/operating-time`);
                const data = await response.json();
                return {
                    openingTime: data.opening_time,
                    closingTime: data.closing_time,
                };
            } catch (error) {
                alert('Error while fetching opening time:\n' + error);
            }
        };

        const fetchReservations = async (darkroomId, successCallback, errorCallback) => {
            try {
                const response = await fetch(`/darkrooms/${darkroomId}/reservations`);
                const events = await response.json();
                successCallback(events);
            } catch (error) {
                alert('Error while fetching reservations:\n' + error);
                errorCallback(error);
            }
        };

        const createReservation = async (reservationData, calendar) => {
            try {
                const response = await fetch(`/darkrooms/${darkroomId}/reservations`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    },
                    body: JSON.stringify(reservationData),
                });

                const data = await response.json();

                if (data.success) {
                    alert('Reservation successfully created!');
                    calendar.refetchEvents();
                } else {
                    alert(data.error);
                }
            } catch (error) {
                alert('Error while creating reservation:\n' + error);
            }
        };

        const { openingTime, closingTime } = await fetchOperatingTime(darkroomId);

        let calendar = new Calendar(calendarElement, {
            plugins: [timeGridPlugin, interactionPlugin],
            timeZone: 'UTC',
            initialView: 'timeGridWeek',
            /*height: '100%',*/
            editable: isEditable,
            selectable: isEditable,
            allDaySlot: false,
            slotDuration: '01:00:00',
            nowIndicator: true,
            expandRows: true,
            headerToolbar: {
                left: 'title',
                right: 'prev,next',
            },
            firstDay: 1,
            slotMinTime: openingTime,
            slotMaxTime: closingTime,
            validRange: {
                start: new Date(),
                end: new Date(new Date().setDate(new Date().getDate() + 10)),
            },
            eventOverlap: false,
            eventResizableFromStart: true,
            events: (fetchInfo, successCallback, errorCallback) => {
                fetchReservations(
                    darkroomId,
                    (events) => {
                        const formattedEvents = events.map((event) => ({
                            ...event,
                            title: event.is_user_reservation ? 'Your Reservation' : 'Reserved',
                            backgroundColor: event.is_user_reservation ? '#137f43' : '#3788d8',
                        }));
                        successCallback(formattedEvents);
                    },
                    errorCallback);
            },
            select: (info) => {
                reservationData = {
                    start_time: info.startStr,
                    end_time: info.endStr,
                    user_id: userId,
                    darkroom_id: darkroomId,
                };

                confirmButton.removeAttribute('disabled');

            },
        });

        calendar.render();

        confirmButton.addEventListener('click', () => {
            createReservation(reservationData, calendar);
            confirmButton.setAttribute('disabled', 'disabled');
        })
    }
})
