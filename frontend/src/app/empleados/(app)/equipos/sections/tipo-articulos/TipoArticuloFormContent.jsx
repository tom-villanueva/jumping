'use client'

import { Input } from '@/components/ui/input'
import { Label } from '@/components/ui/label'
import { Separator } from '@/components/ui/separator'
import { storeFetcher, updateFetcher } from '@/lib/utils'
import { useContext } from 'react'
import { useToast } from '@/components/ui/use-toast'
import SelectManyEntitiesContext from '../SelectManyEntitiesContext'
import TipoArticuloTalleTable from './TipoArticuloTalleTable'
import { useForm } from 'react-hook-form'
import { zodResolver } from '@hookform/resolvers/zod'
import { useSWRConfig } from 'swr'
import useSWRMutation from 'swr/mutation'
import { z } from 'zod'
import {
  Form,
  FormControl,
  FormField,
  FormItem,
  FormLabel,
  FormMessage,
} from '@/components/ui/form'
import { Button } from '@/components/ui/button'

const tipoArticuloSchema = z.object({
  descripcion: z.string().min(1, 'Se requiere descripcion'),
  // talle_ids: z.array(talleSchema).nullable(),
})

export default function TipoArticuloFormContent({
  onFormSubmit,
  tipoArticulo,
  editing,
}) {
  const { toast } = useToast()
  const { selected } = useContext(SelectManyEntitiesContext)
  const { mutate } = useSWRConfig()

  const form = useForm({
    resolver: zodResolver(tipoArticuloSchema),
    defaultValues: {
      descripcion: tipoArticulo?.descripcion ?? '',
    },
  })

  const { trigger, isMutating } = useSWRMutation(
    '/api/tipo-articulos',
    editing ? updateFetcher : storeFetcher,
    {
      onSuccess() {
        toast({
          title: editing
            ? `😄 Tipo de artículo modificado con éxito`
            : `😄 Tipo de artículo agregado con éxito`,
        })
        form.reset()
        mutate(key => Array.isArray(key) && key[0] === '/api/tipo-articulos')
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
      talle_ids:
        selected.length > 0
          ? selected.map(talle => ({ talle_id: talle.id, stock: talle.stock }))
          : [],
      ...values,
    }

    if (editing) {
      trigger({ id: tipoArticulo?.id, data })
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
        <Separator className="col-span-12" />

        {form.formState.errors.root && (
          <p className="col-span-12 text-sm text-red-500">
            {form.formState.errors.root.serverError.message}
          </p>
        )}

        <Label className="col-span-12 font-medium">Asociado a:</Label>
        <TipoArticuloTalleTable />

        <Button type="submit" className="col-span-6">
          {isMutating ? 'Guardando...' : 'Guardar'}
        </Button>
      </form>
    </Form>
  )
}
