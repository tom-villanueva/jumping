'use client'

import { Input } from '@/components/ui/input'
import { Checkbox } from '@/components/ui/checkbox'
import { Label } from '@/components/ui/label'
import { Separator } from '@/components/ui/separator'
import { useToast } from '@/components/ui/use-toast'
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
import {
  Select,
  SelectContent,
  SelectItem,
  SelectTrigger,
  SelectValue,
} from '@/components/ui/select'
import { useMemo } from 'react'

const equipoSchema = z.object({
  descripcion: z.string().min(1, 'Se requiere descripcion'),
  codigo: z.string().min(1, 'Se requiere codigo'),
  observacion: z.string().nullable(),
  tipo_articulo_id: z.string().min(1, 'Se requiere tipo artículo'),
  talle_id: z.string().min(1, 'Se requiere talle'),
  marca_id: z.string().min(1, 'Se requiere marca'),
  modelo_id: z.string().min(1, 'Se requiere modelo'),
  nro_serie: z.string().nullable(),
  disponible: z.boolean(),
})

export default function ArticuloFormContent({
  onFormSubmit,
  articulo,
  tipoArticulos,
  talles,
  marcas,
  modelos,
  editing,
}) {
  const { toast } = useToast()
  const { mutate } = useSWRConfig()

  const form = useForm({
    resolver: zodResolver(equipoSchema),
    defaultValues: {
      descripcion: articulo?.descripcion ?? '',
      codigo: articulo?.codigo ?? '',
      observacion: articulo?.observacion ?? '',
      tipo_articulo_id: articulo?.tipo_articulo
        ? String(articulo?.tipo_articulo?.id)
        : '',
      talle_id: articulo?.talle ? String(articulo?.talle?.id) : '',
      marca_id: articulo?.marca ? String(articulo?.marca?.id) : '',
      modelo_id: articulo?.modelo ? String(articulo?.modelo?.id) : '',
      nro_serie: articulo?.nro_serie ?? '',
      disponible: articulo?.disponible ?? false,
    },
  })

  const marcaId = form.watch('marca_id')

  const filteredModelos = useMemo(() => {
    return marcaId !== ''
      ? modelos.filter(modelo => modelo.marca_id === Number(marcaId))
      : modelos
  }, [marcaId])

  const { trigger, isMutating } = useSWRMutation(
    '/api/articulos',
    editing ? updateFetcher : storeFetcher,
    {
      onSuccess() {
        toast({
          title: editing
            ? `😄 Artículo modificado con éxito`
            : `😄 Artículo agregado con éxito`,
        })
        form.reset()
        mutate(key => Array.isArray(key) && key[0] === '/api/articulos')
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
      trigger({ id: articulo?.id, data })
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
          name="codigo"
          render={({ field }) => (
            <FormItem className="col-span-12">
              <FormLabel>Código</FormLabel>
              <FormControl>
                <Input
                  id="codigo"
                  name="codigo"
                  placeholder="Escriba código"
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
                Disponible
              </FormLabel>
            </FormItem>
          )}
        />

        <Label className="col-span-12 font-medium">Es un:</Label>
        <FormField
          control={form.control}
          name="tipo_articulo_id"
          render={({ field }) => (
            <FormItem className="col-span-12 sm:col-span-6">
              <FormLabel>Tipo artículo</FormLabel>
              <Select onValueChange={field.onChange} value={field.value}>
                <FormControl>
                  <SelectTrigger>
                    <SelectValue placeholder="Seleccione un tipo artículo" />
                  </SelectTrigger>
                </FormControl>
                <SelectContent>
                  {tipoArticulos?.map(tipo => (
                    <SelectItem key={tipo?.id} value={String(tipo?.id)}>
                      {tipo?.descripcion}
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
          name="talle_id"
          render={({ field }) => (
            <FormItem className="col-span-12 sm:col-span-6">
              <FormLabel>Talle</FormLabel>
              <Select onValueChange={field.onChange} value={field.value}>
                <FormControl>
                  <SelectTrigger>
                    <SelectValue placeholder="Seleccione un talle" />
                  </SelectTrigger>
                </FormControl>
                <SelectContent>
                  {talles?.map(talle => (
                    <SelectItem key={talle?.id} value={String(talle?.id)}>
                      {talle?.descripcion}
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
          name="marca_id"
          render={({ field }) => (
            <FormItem className="col-span-12 sm:col-span-6">
              <FormLabel>Marca</FormLabel>
              <Select onValueChange={field.onChange} value={field.value}>
                <FormControl>
                  <SelectTrigger>
                    <SelectValue placeholder="Seleccione una marca" />
                  </SelectTrigger>
                </FormControl>
                <SelectContent>
                  {marcas?.map(marca => (
                    <SelectItem key={marca?.id} value={String(marca?.id)}>
                      {marca?.descripcion}
                    </SelectItem>
                  ))}
                </SelectContent>
              </Select>
              <FormMessage />
            </FormItem>
          )}
        />

        {marcaId !== '' && (
          <FormField
            control={form.control}
            name="modelo_id"
            render={({ field }) => (
              <FormItem className="col-span-12 sm:col-span-6">
                <FormLabel>Modelo</FormLabel>
                <Select onValueChange={field.onChange} value={field.value}>
                  <FormControl>
                    <SelectTrigger>
                      <SelectValue placeholder="Seleccione un modelo" />
                    </SelectTrigger>
                  </FormControl>
                  <SelectContent>
                    {filteredModelos?.map(modelo => (
                      <SelectItem key={modelo?.id} value={String(modelo?.id)}>
                        {modelo?.descripcion}
                      </SelectItem>
                    ))}
                  </SelectContent>
                </Select>
                <FormMessage />
              </FormItem>
            )}
          />
        )}

        <FormField
          control={form.control}
          name="nro_serie"
          render={({ field }) => (
            <FormItem className="col-span-12">
              <FormLabel>Nro. serie</FormLabel>
              <FormControl>
                <Input
                  id="nro_serie"
                  name="nro_serie"
                  placeholder="Escriba Nro. serie"
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
          name="observacion"
          render={({ field }) => (
            <FormItem className="col-span-12">
              <FormLabel>Observación</FormLabel>
              <FormControl>
                <Input
                  id="observacion"
                  name="observacion"
                  placeholder="Escriba observación"
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
