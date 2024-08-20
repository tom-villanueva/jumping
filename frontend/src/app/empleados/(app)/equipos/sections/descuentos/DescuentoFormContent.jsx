'use client'
import { Input } from '@/components/ui/input'
import { Checkbox } from '@/components/ui/checkbox'
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

const descuentoSchema = z.object({
  descripcion: z.string(),
  valor: z
    .number({
      required_error: 'Se requiere valor',
      invalid_type_error: 'Tiene que ser un número',
    })
    .nonnegative('No puede ser negativo'),
  tipo_descuento: z.boolean(),
})

export default function DescuentoFormContent({
  onFormSubmit,
  descuento,
  editing,
}) {
  const { toast } = useToast()
  const { mutate } = useSWRConfig()

  const form = useForm({
    resolver: zodResolver(descuentoSchema),
    defaultValues: {
      descripcion: descuento?.descripcion ?? '',
      valor: Number(descuento?.valor) ?? 0,
      tipo_descuento: descuento?.tipo_descuento ?? true,
    },
  })

  const { trigger, isMutating } = useSWRMutation(
    '/api/descuentos',
    editing ? updateFetcher : storeFetcher,
    {
      onSuccess() {
        toast({
          title: editing
            ? `😄 Descuento modificado con éxito`
            : `😄 Descuento agregado con éxito`,
        })
        form.reset()
        mutate(key => Array.isArray(key) && key[0] === '/api/descuentos')
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
    },
  )

  function onSubmit(values) {
    const data = {
      ...values,
    }

    if (editing) {
      trigger({ id: descuento?.id, data })
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
          name="valor"
          render={({ field }) => (
            <FormItem className="col-span-12">
              <FormLabel>Valor</FormLabel>
              <FormControl>
                <Input
                  id="valor"
                  name="valor"
                  type="number"
                  placeholder="Escriba valor"
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
          name="tipo_descuento"
          render={({ field }) => (
            <FormItem className="col-span-12 flex items-center space-x-2">
              <FormControl>
                <Checkbox
                  id="tipo_descuento"
                  name="tipo_descuento"
                  checked={field.value}
                  onCheckedChange={field.onChange}
                />
              </FormControl>
              <FormLabel className="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">
                (descuento o aumento)
              </FormLabel>
              <p className="col-span-12 text-sm text-white">
                Checkbox seleccionado significa que es descuento
              </p>
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
