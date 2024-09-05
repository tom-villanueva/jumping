'use client'
import {
  Dialog,
  DialogContent,
  DialogHeader,
  DialogTitle,
} from '@/components/ui/dialog'
import { convertToUTC, formatDate, updateFetcher } from '@/lib/utils'
import { useEffect } from 'react'
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
import { useToast } from '@/components/ui/use-toast'
import { zodResolver } from '@hookform/resolvers/zod'
import { z } from 'zod'
import useSWRMutation from 'swr/mutation'
import { useSWRConfig } from 'swr'
import { Button } from '@/components/ui/button'
import axios from 'axios'

const today = formatDate(convertToUTC(new Date().setHours(0, 0, 0, 0)))

const equipoPrecioEditSchema = z.object({
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

export default function EquipoPrecioUpdateFormModal({
  openForm,
  setOpenForm,
  onFormSubmit,
  precio,
  equipo,
}) {
  const { toast } = useToast()
  const { mutate } = useSWRConfig()

  const { trigger, isMutating } = useSWRMutation(
    '/api/equipo-precios',
    updateFetcher,
    {
      onSuccess() {
        toast({
          title: `😄 Precio modificado con éxito`,
        })
        form.reset()
        onFormSubmit()
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

  const form = useForm({
    resolver: zodResolver(equipoPrecioEditSchema),
    defaultValues: {
      equipo_id: equipo?.id,
      precio: 0,
      fecha_desde: '',
    },
  })

  useEffect(() => {
    form.setValue('equipo_id', equipo?.id)
    form.setValue('precio', precio?.precio)
    form.setValue('fecha_desde', precio?.fecha_desde)
  }, [precio, equipo])

  function onSubmit(values) {
    const data = {
      ...values,
    }
    trigger({ id: precio?.id, data })
  }

  return (
    <Dialog open={openForm} onOpenChange={() => setOpenForm(!openForm)}>
      <DialogContent className="sm:max-w-[425px]">
        <DialogHeader>
          <DialogTitle>Actualizar precio</DialogTitle>
        </DialogHeader>
        <Form {...form}>
          <form
            onSubmit={form.handleSubmit(onSubmit)}
            className="grid w-full grid-cols-12 gap-2">
            <FormField
              name="fecha_desde"
              control={form.control}
              render={({ field }) => (
                <FormItem className="col-span-6">
                  <FormLabel>Fecha Inicio</FormLabel>
                  <FormControl>
                    <Input
                      type="date"
                      name="fecha_desde"
                      min={today}
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
                <FormItem className="col-span-6">
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

            <Button type="submit" className="col-span-12">
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
      </DialogContent>
    </Dialog>
  )
}
