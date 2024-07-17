<script lang="ts" setup>
import type { CalendarOptions } from '@fullcalendar/core'
import '@fullcalendar/core/index.js'
import dayGridPlugin from '@fullcalendar/daygrid'
import interactionPlugin from '@fullcalendar/interaction'
import listPlugin from '@fullcalendar/list'
import rrulePlugin from '@fullcalendar/rrule'
import timeGridPlugin from '@fullcalendar/timegrid'
import FullCalendar from '@fullcalendar/vue3'

import { getLocale } from '@/utils/i18n'

const options: CalendarOptions = {
    plugins: [rrulePlugin,
interactionPlugin,
dayGridPlugin,
timeGridPlugin,
listPlugin],
    droppable: true,
    locales: [
        {
            code: 'en',
            buttonText: {
                today: 'Today',
                month: 'Month',
                week: 'Week',
                day: 'Day',
                next: 'Next',
                prev: 'Prev',
                nextYear: 'Next Year',
                prevYear: 'Prev Year'
            }
        },
        {
            code: 'fr',
            buttonText: {
                today: "Aujourd'hui",
                month: 'Mois',
                week: 'Semaine',
                day: 'Jour',
                next: 'Suivant',
                prev: 'Precedent',
                nextYear: 'Prochain Annee',
                prevYear: 'Annee precedente'
            }
        },
        {
            code: 'ar',
            buttonText: {
                today: 'اليوم',
                month: 'شهر',
                week: 'اسبوع',
                day: 'يوم',
                next: 'التالي',
                prev: 'السابق',
                nextYear: 'السنة التالية',
                prevYear: 'السنة السابقة'
            }
        }
    ],
    locale: getLocale(),
    direction: getLocale() === 'ar' ? 'rtl' : 'ltr',
    headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
    },
    initialDate: new Date(),
    navLinks: true,
    editable: true,
    dayMaxEvents: true,
    events: [
        {
            title: 'Vue Vixens Day',

            rrule: {
                freq: 'weekly',
                interval: 5,
                byweekday: ['mo', 'fr'],
                dtstart: '2024-07-16T10:30:00', // Will also accept '20120201T103000'
                until: '2024-07-21' // Will also accept '20120201'
            }
        },
        {
            title: 'VueConfUS',
            start: '2024-07-11',
            end: '2024-07-15'
        },
        {
            title: 'VueJS Amsterdam',
            start: '2024-07-17',
            end: '2024-07-21'
        },
        {
            title: 'Vue Fes Japan 2019',
            start: '2024-07-21',
            end: '2024-07-24'
        },
        {
            title: 'Laracon 2021',
            start: '2024-07-24',
            end: '2024-07-27'
        }
    ],
    drop: function (info) {
        if (
            document.querySelectorAll('#checkbox-events').length &&
            (document.querySelectorAll('#checkbox-events')[0] as HTMLInputElement)?.checked
        ) {
            ;

(info.draggedEl.parentNode as HTMLElement).remove()

            if (document.querySelectorAll('#calendar-events')[0].children.length == 1) {
                document.querySelectorAll('#calendar-no-events')[0].classList.remove('hidden')
            }
        }
    }
}
</script>

<template>
    <div class="full-calendar">
        <FullCalendar :options="options" />
    </div>
</template>

<style lang="postcss">
@import url('/resources/css/components/base/_full-calendar.css');
</style>
