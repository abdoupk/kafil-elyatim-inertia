<script lang="ts" setup>
import { type CalendarOptions } from '@fullcalendar/core'
import '@fullcalendar/core/index.js'
import dayGridPlugin from '@fullcalendar/daygrid'
import interactionPlugin from '@fullcalendar/interaction'
import listPlugin from '@fullcalendar/list'
import rrulePlugin from '@fullcalendar/rrule'
import timeGridPlugin from '@fullcalendar/timegrid'
import FullCalendar from '@fullcalendar/vue3'

import { getLocale } from '@/utils/i18n'

const props = defineProps<{ events: any }>()

const emit = defineEmits(['dateClick'])

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
                today: 'Aujourd\'hui',
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
    dateClick(arg) {
        emit('dateClick', arg)
    },
    events: props.events,
    drop: function(info) {
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
