'use client'

import { Input } from '@/components/ui/input'
import { Checkbox } from '@/components/ui/checkbox'
import { Label } from '@/components/ui/label'
import EquipoTipoArticuloTable from './EquipoTipoArticuloTable'
import { Separator } from '@/components/ui/separator'
import { useContext } from 'react'
import { useToast } from '@/components/ui/use-toast'
import SelectManyEntitiesContext from '../SelectManyEntitiesContext'
import useSWRMutation from 'swr/mutation'
import { useSWRConfig } from 'swr'
import { useForm } from 'react-hook-form'
import { zodResolver } from '@hookform/resolvers/zod'
import { storeFetcher, updateFetcher } from '@/lib/utils'
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

const equipoSchema = z.object({
  descripcion: z.string().min(1, 'Se requiere descripcion'),
  precio: z
    .number({
      required_error: 'Se requiere precio',
      invalid_type_error: 'Tiene que ser un número',
    })
    .nonnegative('No puede ser negativo'),
  disponible: z.boolean(),
  // tipo_articulo_ids: z.array(tipoArticuloSchema).nullable(),
})

export default function EquipoFormContent({ onFormSubmit, equipo, editing }) {
  const { toast } = useToast()
  const { selected } = useContext(SelectManyEntitiesContext)
  const { mutate } = useSWRConfig()

  const form = useForm({
    resolver: zodResolver(equipoSchema),
    defaultValues: {
      descripcion: equipo?.descripcion ?? '',
      precio: equipo?.precio_vigente?.precio ?? 0,
      disponible: equipo?.disponible ?? false,
    },
  })

  const { trigger, isMutating } = useSWRMutation(
    '/api/equipos',
    editing ? updateFetcher : storeFetcher,
    {
      onSuccess() {
        toast({
          title: editing
            ? `😄 Equipo modificado con éxito`
            : `😄 Equipo agregado con éxito`,
        })
        form.reset()
        mutate(key => Array.isArray(key) && key[0] === '/api/equipos')
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
    },
  )

  function onSubmit(values) {
    const data = {
      tipo_articulo_ids:
        selected.length > 0
          ? selected.map(tipo => ({ tipo_articulo_id: tipo.id }))
          : [],
      ...values,
    }

    if (editing) {
      trigger({ id: equipo?.id, data })
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
          name="descripcion"
          render={({ field }) => (
            <FormItem className="col-span-12">
              <FormLabel>Descripcion</FormLabel>
              <FormControl>
                <Input
                  id="descripcion"
                  name="descripcion"
                  placeholder="Escriba descripcion"
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
          name="precio"
          render={({ field }) => (
            <FormItem className="col-span-12">
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

        <FormField
          control={form.control}
          name="disponible"
          render={({ field }) => (
            <FormItem className="col-span-12 flex items-center space-x-2">
              <FormControl>
                <Checkbox
                  id="disponible"
                  name="disponible"
                  checked={field.value}
                  onCheckedChange={field.onChange}
                />
              </FormControl>
              <FormLabel className="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">
                Disponible (visible para reservar)
              </FormLabel>
            </FormItem>
          )}
        />

        <Separator className="col-span-12" />

        {form.formState.errors.root && (
          <p className="col-span-12 text-sm text-red-500">
            {form.formState.errors.root.serverError.message}
          </p>
        )}

        <Label className="col-span-12 font-medium">Compuesto por:</Label>
        <EquipoTipoArticuloTable />

        <Button type="submit" className="col-span-6">
          {isMutating ? 'Guardando...' : 'Guardar'}
        </Button>
      </form>
    </Form>
  )
}
