'use client'

import { useToast } from '@/components/ui/use-toast'
import useSWRMutation from 'swr/mutation'
import { useSWRConfig } from 'swr'
import { useForm } from 'react-hook-form'
import { zodResolver } from '@hookform/resolvers/zod'
import { updateFetcher } from '@/lib/utils'
import { Form, FormControl, FormField, FormItem } from '@/components/ui/form'
import { z } from 'zod'
import axios from 'axios'
import { Switch } from '@/components/ui/switch'

const reservaEquipoDevolverSchema = z.object({
  devuelto: z.boolean(),
})

export default function ReservaEquipoArticuloDevolverForm({
  reservaEquipoArticulo,
}) {
  const { toast } = useToast()
  const { mutate } = useSWRConfig()

  const form = useForm({
    resolver: zodResolver(reservaEquipoDevolverSchema),
    defaultValues: {
      devuelto: reservaEquipoArticulo?.devuelto,
    },
  })

  const { trigger, isMutating } = useSWRMutation(
    '/api/reserva-equipo-articulos',
    updateFetcher,
    {
      onSuccess() {
        toast({
          title: `😄 Artículo actualizado con éxito`,
        })
        form.reset()
        mutate(
          key =>
            Array.isArray(key) && key[0] === '/api/reserva-equipo-articulos',
        )
        // onFormSubmit()
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
      reserva_equipo_id: reservaEquipoArticulo?.reserva_equipo_id,
      articulo_id: reservaEquipoArticulo?.articulo_id,
    }

    trigger({ id: reservaEquipoArticulo?.id, data })
  }

  return (
    <Form {...form}>
      <form onSubmit={form.handleSubmit(onSubmit)} className="">
        <FormField
          control={form.control}
          name="devuelto"
          render={({ field }) => (
            <FormItem className="">
              <FormControl>
                <Switch
                  disabled={isMutating}
                  checked={field.value}
                  onCheckedChange={async e => {
                    field.onChange(e)
                    const isValid = await form.trigger()

                    if (isValid) {
                      form.handleSubmit(onSubmit)()
                    }
                  }}
                />
              </FormControl>
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
  )
}
