'use client'
import * as React from 'react'
import { Calendar } from '@/components/ui/calendar'
import { useState } from 'react'
import { Button } from '@/components/ui/button'
import { addDays } from 'date-fns'
import { DateRange, DayPicker } from 'react-day-picker'
import IconSection from './IconSection.js'
import { useToast } from '@/components/ui/use-toast'
import FormContext from '../../context/FormContext.jsx'
import { useContext } from 'react'
import { useEquiposClientes } from '@/services/clientes.js'
import { formatDate } from '@/lib/utils.js'
import axios from '@/lib/axios.js'

export default function CalendarHome({ setSteps, setBgStyle }) {
  const { toast } = useToast()
  const { range, setDateRange, setProducts } = useContext(FormContext)

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

  // const { equipos, isLoading, isError, fetchEquipos } = useEquiposClientes({
  //   fecha_desde: formatDate(range.from ?? new Date()),
  //   fecha_hasta: formatDate(range.to ?? new Date()),
  //   onSuccess: data => setProducts(data),
  // })

  async function dateSubmit(e) {
    // e.preventDefault()

    if (range.from === undefined || range.to === undefined) {
      toast({
        title: 'Error',
        description: 'El minimo de alquiler es de 3 dias',
        variant: 'destructive',
      })
      return
    }

    // const fromDay = range.from.getDate()

    // if (fromDay < new Date().getDate()) {
    //   toast({
    //     title: 'No puedes elegir un dia que ya paso',
    //     variant: 'destructive',
    //   })
    //   return
    // }
    try {
      setDisableButton(true)
      const queryParams = new URLSearchParams()

      queryParams.append('fecha_desde', formatDate(range.from))
      queryParams.append('fecha_hasta', formatDate(range.to))

      const qs = queryParams.toString()
      const endpoint = qs
        ? `/api/clientes/equipos?${qs}`
        : '/api/clientes/equipos'

      //fetchEquipos()
      const response = await axios.get(endpoint)

      setProducts(response.data)

      toast({
        title: 'Exito!',
        description: 'Buscando equipos disponibles',
        variant: 'success',
      })

      //setStep1(range)
      setBgStyle(2)
      setSteps(2)
    } catch (error) {
      toast({
        title: `error ${error}`,
        variant: 'destructive',
      })
    }
  }

  const fromMonth =
    new Date().getMonth() + 1 > 9
      ? new Date(new Date().getFullYear() + 1, 5)
      : new Date(new Date().getFullYear(), 5)

  const toMonth =
    new Date().getMonth() + 1 > 9
      ? new Date(new Date().getFullYear() + 1, 8)
      : new Date(new Date().getFullYear(), 8)

  const fromYear =
    new Date().getMonth() + 1 > 9
      ? new Date().getFullYear() + 1
      : new Date().getFullYear()

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
          fromMonth={fromMonth}
          toMonth={toMonth}
          fromYear={fromYear}
          toYear={fromYear}
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
