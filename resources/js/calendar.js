import { Calendar } from "@fullcalendar/core";
import dayGridPlugin from "@fullcalendar/daygrid";

let calendarEl = document.getElementById("calendar");

let calendar = new Calendar(calendarEl, {
    plugins: [dayGridPlugin],
    locale: 'ja',
    initialView: "dayGridMonth",
    headerToolbar: {
        left: "prev,next today",
        center: "title",
        right: "",
    },
    buttonText: {
        today: '今日',
    },
    eventSources: [
        {
            googleCalendarApiKey: 'AIzaSyDP2t1IJv8TlQO_bSsd52bK12KeQEHrjzg',
            googleCalendarId: 'ja.japanese#holiday@group.v.calendar.google.com',
            rendering: 'background',
            color: "#ffd0d0"
        }
    ],
});
calendar.render();
