'use client'

import { useToast } from '@/components/ui/use-toast'
import useSWRMutation from 'swr/mutation'
import { useSWRConfig } from 'swr'
import { useForm } from 'react-hook-form'
import { zodResolver } from '@hookform/resolvers/zod'
import { storeFetcher, updateFetcher } from '@/lib/utils'
import {
  Form,
  FormControl,
  FormField,
  FormItem,
  FormLabel,
  FormMessage,
} from '@/components/ui/form'
import { z } from 'zod'
import axios from 'axios'
import { Button } from '@/components/ui/button'
import { Input } from '@/components/ui/input'

const trasladoSchema = z.object({
  direccion: z.string().min(1, 'Se requiere dirección'),
  fecha_desde: z
    .string({
      required_error: 'Se requiere fecha inicio',
    })
    .date('Se requiere fecha inicio'),
  fecha_hasta: z
    .string({
      required_error: 'Se requiere fecha fin',
    })
    .date('Se requiere fecha fin'),
})

export default function ReservaTrasladoForm({
  traslado,
  reserva,
  reservaId,
  editing,
  onFormSubmit = () => {},
}) {
  const { toast } = useToast()
  const { mutate } = useSWRConfig()

  const form = useForm({
    resolver: zodResolver(trasladoSchema),
    defaultValues: {
      direccion: traslado?.direccion ?? '',
      fecha_desde: traslado?.fecha_desde ?? '',
      fecha_hasta: traslado?.fecha_hasta ?? '',
    },
  })

  const { trigger, isMutating } = useSWRMutation(
    '/api/traslados',
    editing ? updateFetcher : storeFetcher,
    {
      onSuccess(data) {
        toast({
          title: editing
            ? `😄 Traslado modificado con éxito`
            : `😄 Traslado agregado a reserva con éxito`,
        })
        form.reset()
        mutate(key => Array.isArray(key) && key[0] === '/api/traslados')
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
      reserva_id: reservaId,
    }

    if (editing) {
      trigger({ id: traslado?.id, data })
    } else {
      trigger({ data })
    }
  }

  return (
    <Form {...form}>
      <form
        onSubmit={form.handleSubmit(onSubmit)}
        className="grid w-full grid-cols-12 gap-2 gap-y-4 rounded p-2">
        <FormField
          control={form.control}
          name="direccion"
          render={({ field }) => (
            <FormItem className="col-span-12">
              <FormLabel>Dirección</FormLabel>
              <FormControl>
                <Input
                  id="direccion"
                  name="direccion"
                  placeholder="Escriba direccion"
                  className="col-span-12"
                  {...field}
                />
              </FormControl>
              <FormMessage />
            </FormItem>
          )}
        />

        <FormField
          control={form.control}
          name="fecha_desde"
          render={({ field }) => (
            <FormItem className="col-span-12 md:col-span-6">
              <FormLabel>Fecha Inicio</FormLabel>
              <FormControl>
                <Input
                  type="date"
                  name="fecha_desde"
                  min={reserva.fecha_desde}
                  max={reserva.fecha_hasta}
                  {...field}
                />
              </FormControl>
              <FormMessage />
            </FormItem>
          )}
        />
        <FormField
          control={form.control}
          name="fecha_hasta"
          render={({ field }) => (
            <FormItem className="col-span-12 md:col-span-6">
              <FormLabel>Fecha Fin</FormLabel>
              <FormControl>
                <Input
                  type="date"
                  name="fecha_hasta"
                  min={reserva.fecha_desde}
                  max={reserva.fecha_hasta}
                  {...field}
                />
              </FormControl>
              <FormMessage />
            </FormItem>
          )}
        />

        <FormField
          control={form.control}
          name="error"
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

        <Button type="submit" className="col-span-6">
          {isMutating ? 'Agregando...' : 'Agregar'}
        </Button>
      </form>
    </Form>
  )
}
