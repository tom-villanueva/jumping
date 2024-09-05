'use client'

import { useForm } from 'react-hook-form'
import {
  Form,
  FormControl,
  FormField,
  FormItem,
  FormLabel,
  FormMessage,
} from '@/components/ui/form'
import { Input } from '@/components/ui/input'
import { convertToUTC, formatDate, storeFetcher } from '@/lib/utils'
import { useToast } from '@/components/ui/use-toast'
import useSWRMutation from 'swr/mutation'
import { useSWRConfig } from 'swr'
import { zodResolver } from '@hookform/resolvers/zod'
import { z } from 'zod'
import { Button } from '@/components/ui/button'
import axios from 'axios'

// const today = formatDate(convertToUTC(new Date().setHours(0, 0, 0, 0)))

const equipoPrecioSchema = z.object({
  equipo_id: z.number(),
  precio: z
    .number({
      required_error: 'Se requiere precio',
      invalid_type_error: 'Tiene que ser un número',
    })
    .nonnegative('No puede ser negativo'),
  fecha_desde: z
    .string({
      required_error: 'Se requiere fecha inicio',
    })
    .date('Se requiere fecha inicio')
    .refine(data => convertToUTC(data) >= new Date().setHours(0, 0, 0, 0), {
      message: 'Fecha inicio tiene que ser igual o mayor a hoy.',
    }),
})

export default function EquipoPrecioForm({ equipo }) {
  const { toast } = useToast()
  const { mutate } = useSWRConfig()

  const form = useForm({
    resolver: zodResolver(equipoPrecioSchema),
    defaultValues: {
      equipo_id: equipo?.id,
      precio: 0,
      fecha_desde: '',
    },
  })

  const { trigger, isMutating } = useSWRMutation(
    '/api/equipo-precios',
    storeFetcher,
    {
      onSuccess() {
        toast({
          title: `😄 Precio agregado con éxito`,
        })
        form.reset()
        mutate(key => Array.isArray(key) && key[0] === '/api/equipos')
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
    },
  )

  function onSubmit(values) {
    trigger({ data: values })
  }

  return (
    <Form {...form}>
      <form
        onSubmit={form.handleSubmit(onSubmit)}
        className="grid w-full grid-cols-12 items-end gap-4 pb-4">
        <FormField
          control={form.control}
          name="fecha_desde"
          render={({ field }) => (
            <FormItem className="col-span-12 sm:col-span-5">
              <FormLabel>Fecha Inicio</FormLabel>
              <FormControl>
                <Input
                  type="date"
                  name="fecha_desde"
                  min={equipo?.precio_vigente?.fecha_desde}
                  {...field}
                />
              </FormControl>
              <FormMessage />
            </FormItem>
          )}
        />

        <FormField
          control={form.control}
          name="precio"
          render={({ field }) => (
            <FormItem className="col-span-12 sm:col-span-5">
              <FormLabel>Precio</FormLabel>
              <FormControl>
                <Input
                  id="precio"
                  name="precio"
                  type="number"
                  placeholder="Escriba precio"
                  className="col-span-12"
                  min="0"
                  {...field}
                  onChange={event => field.onChange(+event.target.value)}
                />
              </FormControl>
              <FormMessage />
            </FormItem>
          )}
        />

        <Button type="submit" className="col-span-12 sm:col-span-2">
          {isMutating ? 'Guardando...' : 'Guardar'}
        </Button>

        <FormField
          control={form.control}
          name="equipo_id"
          render={({ field }) => (
            <FormItem className="col-span-12">
              <FormControl>
                <Input type="hidden" name="equipo_id" {...field} />
              </FormControl>
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
