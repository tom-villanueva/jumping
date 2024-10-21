'use client'
import { Input } from '@/components/ui/input'
import { useToast } from '@/components/ui/use-toast'
import { useForm } from 'react-hook-form'
import { useSWRConfig } from 'swr'
import useSWRMutation from 'swr/mutation'
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
import { Button } from '@/components/ui/button'
import { z } from 'zod'
import {
  Select,
  SelectContent,
  SelectItem,
  SelectTrigger,
  SelectValue,
} from '@/components/ui/select'
import { useDescuentos } from '@/services/descuentos'
import axios from 'axios'

const tipoSchema = z.object({
  descripcion: z.string().min(1, 'Se requiere descripcion'),
  descuento_id: z.string().nullable(),
})

export default function TipoPersonaFormContent({
  onFormSubmit,
  tipo,
  editing,
}) {
  const { toast } = useToast()
  const { mutate } = useSWRConfig()

  const form = useForm({
    resolver: zodResolver(tipoSchema),
    defaultValues: {
      descripcion: tipo?.descripcion ?? '',
      descuento_id: tipo?.descuento_id ? String(tipo?.descuento_id) : '',
    },
  })

  const {
    descuentos,
    isLoading: isLoadingDescuentos,
    isError: isErrorMarcas,
  } = useDescuentos({
    params: {
      sort: 'id',
    },
    filters: [],
  })

  const { trigger, isMutating } = useSWRMutation(
    '/api/tipo-personas',
    editing ? updateFetcher : storeFetcher,
    {
      onSuccess() {
        toast({
          title: editing
            ? `😄 Tipo modificado con éxito`
            : `😄 Tipo agregado con éxito`,
        })
        form.reset()
        mutate(key => Array.isArray(key) && key[0] === '/api/tipo-personas')
        onFormSubmit()
      },
      onError(err) {
        if (axios.isAxiosError(err)) {
          if (err.response.status === 422) {
            const errors = err.response.data.errors ?? {}
            for (const [key, value] of Object.entries(errors)) {
              form.setError(key, {
                type: 'manual',
                message: value.join(', '),
              })
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
      trigger({ id: tipo?.id, data })
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
              <FormLabel>Descripción</FormLabel>
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

        {isLoadingDescuentos ? (
          <p>Cargando descuentos</p>
        ) : (
          <FormField
            control={form.control}
            name="descuento_id"
            render={({ field }) => (
              <FormItem className="col-span-12">
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
                        {descuento?.descripcion}
                      </SelectItem>
                    ))}
                  </SelectContent>
                </Select>
                <FormMessage />
              </FormItem>
            )}
          />
        )}

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
