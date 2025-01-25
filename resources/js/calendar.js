import { Calendar } from '@fullcalendar/core';
import timeGridPlugin from '@fullcalendar/timegrid';
import interactionPlugin from '@fullcalendar/interaction';

document.addEventListener('DOMContentLoaded', async () => {
    let currentDarkroom = {id: null, name: null};
    let reservationData = null;
    let calendar = null;

    const dropdownElement = document.getElementById('darkrooms-dropdown');
    const calendarElement = document.getElementById('calendar');
    const confirmButton = document.getElementById('confirm-button');
    const isEditable = calendarElement.dataset.isEditable;

    const fetchDarkrooms = async () => {
        try {
            const response = await fetch('darkrooms/names');
            return await response.json();
        } catch (error) {
            alert('Error while fetching darkrooms:\n"' + error.message);
            console.error('Error fetching darkrooms: ', error);
        }
    };

    const populateDropdown = async () => {
        const darkrooms = await fetchDarkrooms();
        if (darkrooms) {
            dropdownElement.innerHTML = '';
            darkrooms.forEach(({ id, name }) => {
                const option = document.createElement('option');
                option.value = id;
                option.text = name;
                dropdownElement.appendChild(option);
            });

            const firstDarkroom = darkrooms[0];
            if (firstDarkroom) {
                currentDarkroom.id = firstDarkroom.id;
                currentDarkroom.name = firstDarkroom.name;
                dropdownElement.value = firstDarkroom.id;
                await initializeCalendar(firstDarkroom.id);
            }
        }
    };

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
            console.error('Error fetching opening time: ', error);
        }
    };

    const fetchReservations = async (darkroomId, successCallback, errorCallback) => {
        try {
            const response = await fetch(`/darkrooms/${darkroomId}/reservations`);
            const events = await response.json();
            successCallback(events);
        } catch (error) {
            alert('Error while fetching reservations:\n' + error);
            console.error('Error fetching reservations: ', error);
            errorCallback(error);
        }
    };
    const createReservation = async (reservationData) => {
        try {
            const response = await fetch(`/darkrooms/${reservationData.darkroom_id}/reservations`, {
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
                console.error('Error creating reservation: ', data.error);
            }
        } catch (error) {
            alert('Error while creating reservation:\n' + error);
            console.error('Error creating reservation: ', error);
        }
    };

    const initializeCalendar = async (darkroomId) => {
        if (calendar) {
            calendar.destroy();
        }

        const { openingTime, closingTime } = await fetchOperatingTime(darkroomId);

        calendar = new Calendar(calendarElement, {
            plugins: [timeGridPlugin, interactionPlugin],
            timeZone: 'UTC',
            initialView: 'timeGridWeek',
            /*height: '100%',*/
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
            editable: false,
            selectable: isEditable,
            eventAllow: (dropInfo, draggedEvent) => {
                return draggedEvent.extendedProps.is_user_reservation === false;
            },
            validRange: {
                start: new Date(),
                end: new Date(new Date().setDate(new Date().getDate() + 30)),
            },
            eventOverlap: false,
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
                    darkroom_id: darkroomId,
                };

                confirmButton.removeAttribute('disabled');

            },
        });
        calendar.render();
    }

    dropdownElement.addEventListener('change', async (event) => {
        const selectedDarkroom = event.target.value;
        currentDarkroom.id = selectedDarkroom;
        currentDarkroom.name = dropdownElement.options[dropdownElement.selectedIndex].text;
        await initializeCalendar(selectedDarkroom);
    });

    if (confirmButton) {
        confirmButton.addEventListener('click', () => {
            createReservation(reservationData);
            confirmButton.setAttribute('disabled', 'disabled');
        });
    }

    await populateDropdown();
})
