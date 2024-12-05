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
import {
  Select,
  SelectContent,
  SelectItem,
  SelectTrigger,
  SelectValue,
} from '@/components/ui/select'
import { Button } from '@/components/ui/button'
import { z } from 'zod'
import axios from 'axios'
import { useTipoPersonas } from '@/services/tipo-personas'

const clienteSchema = z.object({
  nombre: z.string().min(1, 'Se requiere nombre'),
  apellido: z.string().min(1, 'Se requiere apellido'),
  email: z.string().email().min(1, 'Se requiere email'),
  telefono: z.string().nullable(),
  tipo_persona_id: z.string().min(1, 'Se requiere tipo persona'),
})

export default function ClienteFormContent({ onFormSubmit, cliente, editing }) {
  const { toast } = useToast()
  const { mutate } = useSWRConfig()

  const form = useForm({
    resolver: zodResolver(clienteSchema),
    defaultValues: {
      nombre: cliente?.nombre ?? '',
      apellido: cliente?.apellido ?? '',
      email: cliente?.email ?? '',
      telefono: cliente?.telefono ?? '',
      tipo_persona_id: cliente?.tipo_persona_id
        ? String(cliente?.tipo_persona_id)
        : '',
    },
  })

  const {
    tipoPersonas,
    isLoading: isLoadingTipos,
    isError: isErrorTipos,
  } = useTipoPersonas({
    params: {
      sort: 'id',
      include: 'descuento',
    },
    filters: [],
  })

  const { trigger, isMutating } = useSWRMutation(
    '/api/clientes',
    editing ? updateFetcher : storeFetcher,
    {
      onSuccess() {
        toast({
          title: editing
            ? `😄 Cliente modificada con éxito`
            : `😄 Cliente agregada con éxito`,
        })
        form.reset()
        mutate(key => Array.isArray(key) && key[0] === '/api/clientes')
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
      trigger({ id: cliente?.id, data })
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
          name="nombre"
          render={({ field }) => (
            <FormItem className="col-span-6">
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
          name="apellido"
          render={({ field }) => (
            <FormItem className="col-span-6">
              <FormLabel>Apellido</FormLabel>
              <FormControl>
                <Input
                  id="apellido"
                  name="apellido"
                  placeholder="Escriba apellido"
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
            <FormItem className="col-span-6">
              <FormLabel>Email</FormLabel>
              <FormControl>
                <Input
                  id="email"
                  name="email"
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
            <FormItem className="col-span-6">
              <FormLabel>Telefono</FormLabel>
              <FormControl>
                <Input
                  id="telefono"
                  name="telefono"
                  placeholder="Escriba telefono"
                  className="col-span-12"
                  {...field}
                />
              </FormControl>
              <FormMessage />
            </FormItem>
          )}
        />

        {isLoadingTipos ? (
          <p>Cargando tipos de persona</p>
        ) : (
          <FormField
            control={form.control}
            name="tipo_persona_id"
            render={({ field }) => (
              <FormItem className="col-span-12">
                <FormLabel>Tipo</FormLabel>
                <Select onValueChange={field.onChange} value={field.value}>
                  <FormControl>
                    <SelectTrigger>
                      <SelectValue placeholder="Seleccione un tipo de persona" />
                    </SelectTrigger>
                  </FormControl>
                  <SelectContent>
                    {tipoPersonas?.map(tipo => (
                      <SelectItem key={tipo?.id} value={String(tipo?.id)}>
                        {`${tipo?.descripcion} (${tipo?.descuento?.descripcion ?? 'Sin'} descuento)`}
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
