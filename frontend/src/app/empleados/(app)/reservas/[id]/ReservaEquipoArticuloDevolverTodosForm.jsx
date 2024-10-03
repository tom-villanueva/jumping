'use client'

import { useToast } from '@/components/ui/use-toast'
import useSWRMutation from 'swr/mutation'
import { useSWRConfig } from 'swr'
import { useForm } from 'react-hook-form'
import { zodResolver } from '@hookform/resolvers/zod'
import { updateFetcher } from '@/lib/utils'
import {
  Form,
  FormControl,
  FormDescription,
  FormField,
  FormItem,
  FormLabel,
  FormMessage,
} from '@/components/ui/form'
import { z } from 'zod'
import axios from 'axios'
import { Button } from '@/components/ui/button'

const reservaEquipoDevolverSchema = z.object({
  devuelto: z.boolean(),
})

export default function ReservaEquipoArticuloDevolverTodosForm({
  reservaEquipo,
}) {
  const { toast } = useToast()
  const { mutate } = useSWRConfig()

  const form = useForm({
    resolver: zodResolver(reservaEquipoDevolverSchema),
    defaultValues: {
      devuelto: true,
    },
  })

  const { trigger, isMutating } = useSWRMutation(
    '/api/reserva-equipo-articulos/devolver-todos',
    updateFetcher,
    {
      onSuccess() {
        toast({
          title: `😄 Artículos actualizados con éxito`,
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
    }

    trigger({ id: reservaEquipo?.id, data })
  }

  return (
    <Form {...form}>
      <form onSubmit={form.handleSubmit(onSubmit)} className="">
        <FormField
          control={form.control}
          name="devuelto"
          render={({ field }) => (
            <FormItem className="flex flex-row items-center justify-between rounded-lg border p-4">
              <div className="space-y-0.5">
                <FormLabel className="text-base">
                  Marcar todos como devueltos
                </FormLabel>
                <FormDescription>
                  Todos los artículos se marcarán como devueltos.
                </FormDescription>
              </div>
              <FormControl>
                <Button
                  disabled={isMutating}
                  type="submit"
                  className="col-span-6">
                  {isMutating ? 'Marcando...' : 'Aceptar'}
                </Button>
              </FormControl>
            </FormItem>
          )}
        />

        <FormField
          control={form.control}
          name="reserva_equipo_articulos"
          render={({ field }) => (
            <FormItem className="col-span-12">
              <FormControl>
                {/* <Input type="hidden" {...field} /> */}
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
  )
}
