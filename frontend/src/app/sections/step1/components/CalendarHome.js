'use client'
import * as React from 'react'

import { Calendar } from '@/components/ui/calendar'
import { useState } from 'react'
import { Button } from '@/components/ui/button'
import { addDays } from 'date-fns'
import { DateRange, DayPicker } from 'react-day-picker'
import IconSection from './IconSection.js'
import { useToast } from '@/components/ui/use-toast'

export default function CalendarHome({ setStep1, setSteps, setBgStyle }) {
  const { toast } = useToast()

  const initialRange = {
    from: new Date(),
    to: addDays(new Date(), 2),
  }

  const [range, setDateRange] = React.useState(initialRange)
  const [disableButton, setDisableButton] = useState(false)

  const handleDayClick = day => {
    setDateRange(prev => {
      if (prev?.to) {
        // If 'to' is already set, reset the range
        return { from: day, to: undefined }
      } else if (prev?.from) {
        // If 'from' is set and 'to' is not
        if (day < prev.from) {
          // If the new day is before the 'from' date, reset the range
          return { from: day, to: undefined }
        } else {
          // Otherwise, set the 'to' date
          return { from: prev.from, to: day }
        }
      } else {
        // If neither 'from' nor 'to' is set, set 'from'
        return { from: day, to: undefined }
      }
    })
  }

  function dateSubmit(e) {
    // e.preventDefault()

    if (range.from === undefined || range.to === undefined) {
      toast({
        title: 'Error',
        description: 'El minimo de alquiler es de 3 dias',
        variant: 'destructive',
      })
      return
    }

    const fromDay = range.from.getDate()

    if (fromDay < new Date().getDate()) {
      toast({
        title: 'No puedes elegir un dia que ya paso',
        variant: 'destructive',
      })
      return
    }

    setDisableButton(true)

    toast({
      title: 'Exito!',
      description: 'Buscando equipos disponibles',
      variant: 'success',
    })
    setStep1(range)
    setBgStyle(2)
    setSteps(2)
  }

  return (
    <div className="mt-16">
      <div className="flex flex-col items-center justify-center gap-10">
        <Calendar
          initialFocus
          mode="range"
          defaultMonth={range.from}
          selected={range}
          onDayClick={handleDayClick}
          numberOfMonths={1}
          weekStartsOn={1}
          min={3}
          fromMonth={new Date(new Date().getFullYear(), 5)}
          toMonth={new Date(new Date().getFullYear(), 8)}
          fromYear={new Date().getFullYear()}
          toYear={new Date().getFullYear()}
          disabled={{
            before: new Date(
              new Date().getFullYear(),
              new Date().getMonth(),
              new Date().getDate(),
            ),
          }}
        />
        <div className="flex flex-col items-center justify-center">
          <p className="mb-5 font-montserrat">
            {range.from.toDateString()} -{' '}
            {range.to ? range.to.toDateString() : 'Esperando fecha'}
          </p>
          {!disableButton ? (
            <Button
              variant="primary"
              className="rounded-full bg-red-700"
              onClick={() => dateSubmit()}>
              VER EQUIPOS
            </Button>
          ) : (
            <Button
              variant="primary"
              className="rounded-full bg-gray-600"
              disabled>
              VER EQUIPOS
            </Button>
          )}
        </div>
      </div>
      <IconSection />
    </div>
  )
}
