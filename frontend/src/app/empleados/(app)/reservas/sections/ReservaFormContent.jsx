'use client'

import { Input } from '@/components/ui/input'
import { Separator } from '@/components/ui/separator'
import { useToast } from '@/components/ui/use-toast'
import useSWRMutation from 'swr/mutation'
import { useSWRConfig } from 'swr'
import { useForm } from 'react-hook-form'
import { zodResolver } from '@hookform/resolvers/zod'
import {
  convertToUTC,
  formatDate,
  storeFetcher,
  updateFetcher,
} from '@/lib/utils'
import { Button } from '@/components/ui/button'
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
import {
  Select,
  SelectContent,
  SelectItem,
  SelectTrigger,
  SelectValue,
} from '@/components/ui/select'
import { Textarea } from '@/components/ui/textarea'
import { reservaSchema, reservaSchemaEdit } from './ReservaSchemas'

const today = formatDate(convertToUTC(new Date().setHours(0, 0, 0, 0)))

export default function ReservaFormContent({
  onFormSubmit,
  reserva,
  editing,
  apiKey,
}) {
  const { toast } = useToast()
  const { mutate } = useSWRConfig()

  const form = useForm({
    resolver: zodResolver(editing ? reservaSchemaEdit : reservaSchema),
    defaultValues: {
      comentario: reserva?.comentario ?? '',
      nombre: reserva?.cliente?.nombre ?? '',
      apellido: reserva?.cliente?.apellido ?? '',
      email: reserva?.cliente?.email ?? '',
      telefono: reserva?.cliente?.telefono ?? '',
      fecha_desde: reserva?.fecha_desde ?? '',
      fecha_hasta: reserva?.fecha_hasta ?? '',
      fecha_prueba: reserva?.fecha_prueba ?? '',
    },
  })

  const { trigger, isMutating } = useSWRMutation(
    '/api/reservas',
    editing ? updateFetcher : storeFetcher,
    {
      onSuccess() {
        toast({
          title: editing
            ? `😄 Reserva modificada con éxito`
            : `😄 Reserva agregada con éxito`,
        })
        form.reset()
        mutate(key => Array.isArray(key) && key[0] === apiKey)
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

    if (editing) {
      trigger({ id: reserva?.id, data })
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
          name="apellido"
          render={({ field }) => (
            <FormItem className="col-span-12 md:col-span-6">
              <FormLabel>Apellido</FormLabel>
              <FormControl>
                <Input
                  id="apellido"
                  name="apellido"
                  placeholder="Escriba apellido"
                  className="col-span-12 "
                  {...field}
                />
              </FormControl>
              <FormMessage />
            </FormItem>
          )}
        />

        <FormField
          control={form.control}
          name="nombre"
          render={({ field }) => (
            <FormItem className="col-span-12 md:col-span-6">
              <FormLabel>Nombre</FormLabel>
              <FormControl>
                <Input
                  id="nombre"
                  name="nombre"
                  placeholder="Escriba nombre"
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
          name="email"
          render={({ field }) => (
            <FormItem className="col-span-12 md:col-span-6">
              <FormLabel>Email</FormLabel>
              <FormControl>
                <Input
                  id="email"
                  name="email"
                  type="email"
                  placeholder="Escriba email"
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
          name="telefono"
          render={({ field }) => (
            <FormItem className="col-span-12 md:col-span-6">
              <FormLabel>Nro. de Teléfono</FormLabel>
              <FormControl>
                <Input
                  id="telefono"
                  name="telefono"
                  placeholder="Escriba Nro. teléfono"
                  className="col-span-12"
                  {...field}
                />
              </FormControl>
              <FormMessage />
            </FormItem>
          )}
        />

        {!editing && (
          <>
            <FormField
              control={form.control}
              name="fecha_desde"
              render={({ field }) => (
                <FormItem className="col-span-12 md:col-span-4">
                  <FormLabel>Fecha Inicio</FormLabel>
                  <FormControl>
                    <Input
                      type="date"
                      name="fecha_desde"
                      min={editing ? '' : today}
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
                <FormItem className="col-span-12 md:col-span-4">
                  <FormLabel>Fecha Fin</FormLabel>
                  <FormControl>
                    <Input
                      type="date"
                      name="fecha_hasta"
                      min={editing ? '' : today}
                      {...field}
                    />
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
                    <Input
                      type="date"
                      name="fecha_prueba"
                      min={editing ? '' : today}
                      {...field}
                    />
                  </FormControl>
                  <FormMessage />
                </FormItem>
              )}
            />
          </>
        )}

        {/* <FormField
          control={form.control}
          name="estado_id"
          render={({ field }) => (
            <FormItem className="col-span-12">
              <FormLabel>Estado</FormLabel>
              <Select onValueChange={field.onChange} value={field.value}>
                <FormControl>
                  <SelectTrigger>
                    <SelectValue placeholder="Seleccione un estado" />
                  </SelectTrigger>
                </FormControl>
                <SelectContent>
                  {estados?.map(estado => (
                    <SelectItem key={estado?.id} value={String(estado?.id)}>
                      {estado?.descripcion}
                    </SelectItem>
                  ))}
                </SelectContent>
              </Select>
              <FormMessage />
            </FormItem>
          )}
        /> */}

        <FormField
          control={form.control}
          name="comentario"
          render={({ field }) => (
            <FormItem className="col-span-12">
              <FormLabel>Comentario</FormLabel>
              <FormControl>
                <Textarea
                  id="comentario"
                  name="comentario"
                  placeholder="Escriba comentario"
                  className="col-span-12"
                  {...field}
                />
              </FormControl>
              <FormMessage />
            </FormItem>
          )}
        />

        <Separator className="col-span-12" />

        {form.formState.errors.root && (
          <p className="col-span-12 text-sm text-red-500">
            {form.formState.errors.root.serverError.message}
          </p>
        )}

        <Button type="submit" className="col-span-6">
          {isMutating ? 'Guardando...' : 'Guardar'}
        </Button>
      </form>
    </Form>
  )
}
