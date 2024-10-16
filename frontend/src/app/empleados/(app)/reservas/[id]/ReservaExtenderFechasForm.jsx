'use client'

import { useToast } from '@/components/ui/use-toast'
import useSWRMutation from 'swr/mutation'
import { useForm } from 'react-hook-form'
import { zodResolver } from '@hookform/resolvers/zod'
import { convertToUTC, formatDate, updateFetcher } from '@/lib/utils'
import {
  Form,
  FormControl,
  FormDescription,
  FormField,
  FormItem,
  FormLabel,
  FormMessage,
} from '@/components/ui/form'
import { z } from 'zod'
import axios from 'axios'
import { Button } from '@/components/ui/button'
import { Input } from '@/components/ui/input'
import { useSWRConfig } from 'swr'

const today = formatDate(convertToUTC(new Date().setHours(0, 0, 0, 0)))

const reservaExtenderSchema = z
  .object({
    fecha_desde: z
      .string({
        required_error: 'Se requiere fecha inicio',
      })
      .date('Se requiere fecha inicio')
      .refine(data => convertToUTC(data) >= new Date().setHours(0, 0, 0, 0), {
        message: 'Fecha inicio tiene que ser igual o mayor a hoy.',
      }),
    fecha_hasta: z
      .string({
        required_error: 'Se requiere fecha fin',
      })
      .date('Se requiere fecha fin'),
    fecha_prueba: z
      .string({
        required_error: 'Se requiere fecha prueba',
      })
      .date('Se requiere fecha prueba'),
  })
  .refine(
    data => convertToUTC(data.fecha_hasta) >= convertToUTC(data.fecha_desde),
    {
      message: 'Fecha fin no puede ser menor a fecha inicio',
      path: ['fecha_hasta'],
    },
  )

export default function ReservaExtenderFechasForm({
  reserva,
  reservaId,
  onFormSubmit = () => {},
}) {
  const { toast } = useToast()
  const { mutate } = useSWRConfig()

  const form = useForm({
    resolver: zodResolver(reservaExtenderSchema),
    defaultValues: {
      fecha_desde: reserva?.fecha_desde ?? '',
      fecha_hasta: reserva?.fecha_hasta ?? '',
      fecha_prueba: reserva?.fecha_prueba ?? '',
    },
  })

  const { trigger, isMutating } = useSWRMutation(
    '/api/reservas/extender-fechas',
    updateFetcher,
    {
      onSuccess(data) {
        toast({
          title: `😄 Fechas de reserva extendida con éxito`,
        })
        form.reset()
        mutate(
          key => Array.isArray(key) && key[0] === `/api/reservas/${reservaId}`,
        )
        mutate(key => Array.isArray(key) && key[0] === `/api/reserva-equipos`)
        onFormSubmit()
      },
      onError(err) {
        if (axios.isAxiosError(err)) {
          if (err.response.status === 422) {
            const errors = err.response.data.errors ?? {}
            for (const [key, value] of Object.entries(errors)) {
              form.setError(key, { type: 'manual', message: value.join(', ') })
            }
          } else {
            form.setError('root.serverError', {
              type: 'server',
              message: err.response.data.message,
            })
          }
        } else {
          toast({
            title: `🥲 Ocurrió un error ${err.message}`,
            description: 'Intente de nuevo más tarde.',
            variant: 'destructive',
          })
        }
      },
      throwOnError: false,
    },
  )

  function onSubmit(values) {
    const data = {
      ...values,
    }

    trigger({ id: reservaId, data })
  }

  return (
    <Form {...form}>
      <form
        onSubmit={form.handleSubmit(onSubmit)}
        className="grid w-full grid-cols-12 gap-2 gap-y-4 rounded p-2">
        <FormField
          control={form.control}
          name="fecha_desde"
          render={({ field }) => (
            <FormItem className="col-span-12 md:col-span-4">
              <FormLabel>Fecha Inicio</FormLabel>
              <FormControl>
                <Input type="date" name="fecha_desde" min={today} {...field} />
              </FormControl>
              <FormMessage />
            </FormItem>
          )}
        />
        <FormField
          control={form.control}
          name="fecha_hasta"
          render={({ field }) => (
            <FormItem className="col-span-12 md:col-span-4">
              <FormLabel>Fecha Fin</FormLabel>
              <FormControl>
                <Input type="date" name="fecha_hasta" min={today} {...field} />
              </FormControl>
              <FormMessage />
            </FormItem>
          )}
        />
        <FormField
          control={form.control}
          name="fecha_prueba"
          render={({ field }) => (
            <FormItem className="col-span-12 md:col-span-4">
              <FormLabel>Fecha Prueba</FormLabel>
              <FormControl>
                <Input type="date" name="fecha_prueba" min={today} {...field} />
              </FormControl>
              <FormMessage />
            </FormItem>
          )}
        />

        <FormField
          control={form.control}
          name="extender"
          render={({ field }) => (
            <FormItem className="col-span-12 flex flex-row items-center justify-between rounded-lg border p-4">
              <div className="space-y-0.5">
                <FormLabel className="text-base">Modificar fechas</FormLabel>
                <FormDescription>
                  Se actualizarán las fechas y se recalcula el precio de los
                  equipos.
                </FormDescription>
              </div>
              <FormControl>
                <Button
                  disabled={isMutating}
                  type="submit"
                  className="col-span-6">
                  {isMutating ? 'Actualizando...' : 'Aceptar'}
                </Button>
              </FormControl>
            </FormItem>
          )}
        />

        <FormField
          control={form.control}
          name="reserva_pagada"
          render={({ field }) => (
            <FormItem className="col-span-12">
              <FormControl></FormControl>
              <FormMessage />
            </FormItem>
          )}
        />

        {form.formState.errors.root && (
          <p className="col-span-12 text-sm text-red-500">
            {form.formState.errors.root.serverError.message}
          </p>
        )}
      </form>
    </Form>
  )
}
