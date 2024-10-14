'use client'

import { Input } from '@/components/ui/input'
import { Label } from '@/components/ui/label'
import { Separator } from '@/components/ui/separator'
import { optionSchema, storeFetcher, updateFetcher } from '@/lib/utils'
// import { useContext } from 'react'
import { useToast } from '@/components/ui/use-toast'
// import SelectManyEntitiesContext from '../SelectManyEntitiesContext'
// import TipoArticuloTalleTable from './TipoArticuloTalleTable'
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
import MultipleSelector from '@/components/ui/multiple-select'
import axios from 'axios'
import { useMemo } from 'react'

const tipoArticuloSchema = z.object({
  descripcion: z.string().min(1, 'Se requiere descripcion'),
  talles: z.array(optionSchema).nullable(),
  marcas: z.array(optionSchema).nullable(),
})

export default function TipoArticuloFormContent({
  onFormSubmit,
  tipoArticulo,
  talles,
  marcas,
  editing,
}) {
  const { toast } = useToast()
  const { mutate } = useSWRConfig()

  const form = useForm({
    resolver: zodResolver(tipoArticuloSchema),
    defaultValues: {
      descripcion: tipoArticulo?.descripcion ?? '',
      talles: tipoArticulo?.talles?.map(t => ({
        label: t.descripcion,
        value: String(t.id),
        disable: false,
      })),
      marcas: tipoArticulo?.marcas?.map(m => ({
        label: m.descripcion,
        value: String(m.id),
        disable: false,
      })),
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
      throwOnError: false,
    },
  )

  const tallesOptions = useMemo(() => {
    return (
      talles?.map(t => ({
        label: t.descripcion,
        value: String(t.id),
        disable: false,
      })) ?? []
    )
  }, [talles])

  const marcasOptions = useMemo(() => {
    return (
      marcas?.map(m => ({
        label: m.descripcion,
        value: String(m.id),
        disable: false,
      })) ?? []
    )
  }, [marcas])

  function onSubmit(values) {
    const data = {
      descripcion: values.descripcion,
      talle_ids:
        values.talles.length > 0
          ? values.talles.map(talle => ({ talle_id: talle.value }))
          : [],
      marca_ids:
        values.marcas.length > 0
          ? values.marcas.map(marca => ({ marca_id: marca.value }))
          : [],
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
        {/* <TipoArticuloTalleTable /> */}
        <FormField
          control={form.control}
          name="talles"
          render={({ field }) => (
            <FormItem className="col-span-12">
              <FormLabel>Talles</FormLabel>
              <FormControl>
                <MultipleSelector
                  {...field}
                  defaultOptions={tallesOptions}
                  placeholder="Selecciona los talles relacionados"
                  emptyIndicator={
                    <p className="text-center text-lg leading-10 text-gray-600 dark:text-gray-400">
                      no se encuentran resultados.
                    </p>
                  }
                />
              </FormControl>
              <FormMessage />
            </FormItem>
          )}
        />

        <FormField
          control={form.control}
          name="marcas"
          render={({ field }) => (
            <FormItem className="col-span-12">
              <FormLabel>Marcas</FormLabel>
              <FormControl>
                <MultipleSelector
                  {...field}
                  defaultOptions={marcasOptions}
                  placeholder="Selecciona las marcas relacionados"
                  emptyIndicator={
                    <p className="text-center text-lg leading-10 text-gray-600 dark:text-gray-400">
                      no se encuentran resultados.
                    </p>
                  }
                />
              </FormControl>
              <FormMessage />
            </FormItem>
          )}
        />

        <FormField
          control={form.control}
          name="articulos_asociados"
          render={({ field }) => (
            <FormItem className="col-span-12">
              <FormControl></FormControl>
              <FormMessage />
            </FormItem>
          )}
        />

        <Button type="submit" className="col-span-6">
          {isMutating ? 'Guardando...' : 'Guardar'}
        </Button>
      </form>
    </Form>
  )
}
