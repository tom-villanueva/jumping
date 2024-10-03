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
import {
  Select,
  SelectContent,
  SelectItem,
  SelectTrigger,
  SelectValue,
} from '@/components/ui/select'
import axios from 'axios'

const today = formatDate(convertToUTC(new Date().setHours(0, 0, 0, 0)))

const equipoDescuentoEditSchema = z.object({
  equipo_id: z.number(),
  descuento_id: z
    .string({
      required_error: 'Debe elegir un descuento',
    })
    .min(1, 'Debe elegir un descuento'),
  dias: z
    .number({
      required_error: 'Se requiere precio',
      invalid_type_error: 'Tiene que ser un número',
    })
    .nonnegative('No puede ser negativo'),
  // fecha_desde: z
  //   .string({
  //     required_error: 'Se requiere fecha inicio',
  //   })
  //   .date('Se requiere fecha inicio')
  //   .refine(data => convertToUTC(data) >= new Date().setHours(0, 0, 0, 0), {
  //     message: 'Fecha inicio tiene que ser igual o mayor a hoy.',
  //   }),
  // fecha_hasta: z
  //   .string({
  //     required_error: 'Se requiere fecha fin',
  //   })
  //   .date('Se requiere fecha fin'),
})
// .refine(
//   data => convertToUTC(data.fecha_hasta) >= convertToUTC(data.fecha_desde),
//   {
//     message: 'Fecha fin no puede ser menor a fecha inicio',
//     path: ['fecha_hasta'],
//   },
// )

export default function EquipoDescuentoUpdateFormModal({
  openForm,
  setOpenForm,
  onFormSubmit,
  descuento,
  equipo,
  descuentos,
}) {
  const { toast } = useToast()
  const { mutate } = useSWRConfig()

  const { trigger, isMutating } = useSWRMutation(
    '/api/equipos/descuentos',
    updateFetcher,
    {
      onSuccess() {
        toast({
          title: `😄 Descuento modificado con éxito`,
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
      throwOnError: false,
    },
  )

  const form = useForm({
    resolver: zodResolver(equipoDescuentoEditSchema),
    defaultValues: {
      equipo_id: equipo?.id,
      descuento_id: String(descuento?.pivot?.descuento_id),
      dias: descuento?.pivot?.dias,
      // fecha_desde: '',
      // fecha_hasta: '',
    },
  })

  useEffect(() => {
    form.setValue('equipo_id', equipo?.id)
    form.setValue('descuento_id', String(descuento?.pivot?.descuento_id))
    form.setValue('dias', descuento?.pivot?.dias)
    // form.setValue('fecha_desde', descuento?.pivot?.fecha_desde)
    // form.setValue('fecha_hasta', descuento?.pivot?.fecha_hasta)
  }, [descuento, equipo])

  function onSubmit(values) {
    const data = {
      id: descuento?.pivot?.id,
      // descuento_id: descuento?.id,
      ...values,
    }

    trigger({ id: descuento?.pivot?.id, data })
  }

  return (
    <Dialog open={openForm} onOpenChange={() => setOpenForm(!openForm)}>
      <DialogContent className="sm:max-w-[425px]">
        <DialogHeader>
          <DialogTitle>Editar descuento</DialogTitle>
        </DialogHeader>
        <Form {...form}>
          <form
            onSubmit={form.handleSubmit(onSubmit)}
            className="grid w-full grid-cols-12 gap-2">
            {/* <FormField
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
              name="fecha_hasta"
              control={form.control}
              render={({ field }) => (
                <FormItem className="col-span-6">
                  <FormLabel>Fecha Fin</FormLabel>
                  <FormControl>
                    <Input
                      type="date"
                      name="fecha_hasta"
                      min={today}
                      {...field}
                    />
                  </FormControl>
                  <FormMessage />
                </FormItem>
              )}
            /> */}
            <FormField
              control={form.control}
              name="descuento_id"
              render={({ field }) => (
                <FormItem className="col-span-12 sm:col-span-6">
                  <FormLabel>Descuento</FormLabel>
                  <Select onValueChange={field.onChange} value={field.value}>
                    <FormControl>
                      <SelectTrigger>
                        <SelectValue placeholder="Seleccione un descuento" />
                      </SelectTrigger>
                    </FormControl>
                    <SelectContent>
                      {descuentos?.map(descuento => (
                        <SelectItem
                          key={descuento?.id}
                          value={String(descuento?.id)}>
                          {`${descuento?.descripcion} (${descuento?.valor}%)`}
                        </SelectItem>
                      ))}
                    </SelectContent>
                  </Select>
                  <FormMessage />
                </FormItem>
              )}
            />

            <FormField
              control={form.control}
              name="dias"
              render={({ field }) => (
                <FormItem className="col-span-12 sm:col-span-6">
                  <FormLabel>Días</FormLabel>
                  <FormControl>
                    <Input
                      id="dias"
                      name="dias"
                      type="number"
                      placeholder="Escriba dias"
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

            {/* <FormField
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
            /> */}

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
