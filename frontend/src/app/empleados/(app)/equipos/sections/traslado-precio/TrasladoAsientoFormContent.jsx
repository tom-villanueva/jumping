'use client'

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
import { storeFetcher } from '@/lib/utils'
import { useToast } from '@/components/ui/use-toast'
import useSWRMutation from 'swr/mutation'
import { useSWRConfig } from 'swr'
import { zodResolver } from '@hookform/resolvers/zod'
import { z } from 'zod'
import { Button } from '@/components/ui/button'
import axios from 'axios'

const trasladoAsientoSchema = z.object({
  cantidad: z
    .number({
      required_error: 'Se requiere precio',
      invalid_type_error: 'Tiene que ser un número',
    })
    .nonnegative('No puede ser negativo'),
})

export default function TrasladoAsientoFormContent({ onFormSubmit }) {
  const { toast } = useToast()
  const { mutate } = useSWRConfig()

  const form = useForm({
    resolver: zodResolver(trasladoAsientoSchema),
    defaultValues: {
      cantidad: 0,
    },
  })

  const { trigger, isMutating } = useSWRMutation(
    '/api/traslado-asientos',
    storeFetcher,
    {
      onSuccess() {
        toast({
          title: `😄 Asiento agregado con éxito`,
        })
        form.reset()
        mutate(key => Array.isArray(key) && key[0] === '/api/traslado-asientos')
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
    trigger({ data: values })
  }

  return (
    <Form {...form}>
      <form
        onSubmit={form.handleSubmit(onSubmit)}
        className="grid w-full grid-cols-12 items-end gap-4 pb-4">
        <FormField
          control={form.control}
          name="cantidad"
          render={({ field }) => (
            <FormItem className="col-span-12 sm:col-span-5">
              <FormLabel>Cantidad de asientos</FormLabel>
              <FormControl>
                <Input
                  id="cantidad"
                  name="cantidad"
                  type="number"
                  placeholder="Escriba cantidad"
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

        <Button type="submit" className="col-span-12 sm:col-span-2">
          {isMutating ? 'Guardando...' : 'Guardar'}
        </Button>

        {form.formState.errors.root && (
          <p className="col-span-12 text-sm text-red-500">
            {form.formState.errors.root.serverError.message}
          </p>
        )}
      </form>
    </Form>
  )
}
