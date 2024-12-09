'use client'
import * as React from 'react'
import { Calendar } from '@/components/ui/calendar'
import { useState } from 'react'
import { Button } from '@/components/ui/button'
import IconSection from './IconSection.js'
import { useToast } from '@/components/ui/use-toast'
import FormContext from '../../context/FormContext.jsx'
import { useContext } from 'react'
import { formatDate } from '@/lib/utils.js'
import axios from '@/lib/axios.js'
import { z } from 'zod'
import { Controller, useForm } from 'react-hook-form'
import { zodResolver } from '@hookform/resolvers/zod'

const schema = z
  .object({
    from: z.date({
      required_error: 'Se requiere fecha inicio',
    }),
    to: z.date({
      required_error: 'Se requiere fecha fin',
    }),
  })
  .superRefine((data, ctx) => {
    if (data.to <= data.from) {
      ctx.addIssue({
        path: ['to'],
        message: 'La fecha de fin debe ser posterior a la fecha de inicio.',
      })
    }
  })

export default function CalendarStep({ onNext, setBgStyle }) {
  const { toast } = useToast()
  const { setProducts, setRange } = useContext(FormContext)

  const [disableButton, setDisableButton] = useState(false)

  const {
    control,
    handleSubmit,
    setValue,
    watch,
    clearErrors,
    formState: { errors },
  } = useForm({
    defaultValues: {
      from: undefined,
      to: undefined,
    },
    resolver: zodResolver(schema),
  })

  const range = watch()

  const handleDayClick = day => {
    const { from, to } = range

    clearErrors()

    if (to) {
      // Reset the range if 'to' is already set
      setValue('from', day)
      setValue('to', undefined)
    } else if (from) {
      // Set 'to' if 'from' exists and new day is valid
      if (day < from) {
        setValue('from', day)
      } else {
        setValue('to', day)
      }
    } else {
      // Set 'from' if nothing is set
      setValue('from', day)
    }
  }

  async function onSubmit(data) {
    if (data.from === undefined || data.to === undefined) {
      toast({
        title: 'Error',
        description: 'El mínimo de alquiler es de 3 dias',
        variant: 'destructive',
      })
      return
    }

    try {
      setDisableButton(true)
      const queryParams = new URLSearchParams()

      queryParams.append('fecha_desde', formatDate(data.from))
      queryParams.append('fecha_hasta', formatDate(data.to))

      const qs = queryParams.toString()
      const endpoint = qs
        ? `/api/clientes/equipos?${qs}`
        : '/api/clientes/equipos'

      const response = await axios.get(endpoint)

      setProducts(response.data)

      toast({
        title: '¡Éxito!',
        description: 'Buscando equipos disponibles',
        variant: 'success',
      })

      setRange(range)
      setBgStyle(2)
      onNext()
    } catch (error) {
      toast({
        title: `Error`,
        description: error.message,
        variant: 'destructive',
      })
    } finally {
      setDisableButton(false)
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
      <form onSubmit={handleSubmit(onSubmit)}>
        <div className="flex flex-col items-center justify-center gap-10">
          <Controller
            name="from"
            control={control}
            render={() => (
              <Calendar
                initialFocus
                mode="range"
                defaultMonth={range.from}
                selected={range}
                onDayClick={handleDayClick}
                numberOfMonths={2}
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
            )}
          />
          <div className="flex flex-col items-center justify-center">
            <p className="mb-5 font-montserrat">
              {range?.from
                ? range?.from?.toLocaleDateString('es-AR', {
                    year: 'numeric',
                    month: '2-digit',
                    day: '2-digit',
                  })
                : ''}{' '}
              -{' '}
              {range?.to
                ? range?.to?.toLocaleDateString('es-AR', {
                    year: 'numeric',
                    month: '2-digit',
                    day: '2-digit',
                  })
                : 'Esperando fechas -'}
            </p>
            <p
              className={`pb-4 font-bold ${errors.from || errors.to ? ' text-red-600' : 'text-gray-600'}`}>
              {(errors.from || errors.to) && 'Seleccione fechas, por favor'}
            </p>
            <Button
              variant="primary"
              className={`rounded-full ${errors.from || errors.to ? ' bg-gray-600' : 'bg-red-600'}`}
              type="submit"
              disabled={!!errors.from || !!errors.to || disableButton}>
              VER EQUIPOS
            </Button>
          </div>
        </div>
      </form>
      <IconSection />
    </div>
  )
}
