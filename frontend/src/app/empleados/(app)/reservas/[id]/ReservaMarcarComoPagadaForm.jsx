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
import { useMonedas } from '@/services/monedas'
import { useMetodoPagos } from '@/services/metodo-pagos'
import {
  Select,
  SelectContent,
  SelectItem,
  SelectTrigger,
  SelectValue,
} from '@/components/ui/select'
import { useTipoPersonas } from '@/services/tipo-personas'
import ReservaMarcarComoPagadaDetallePrecio from './ReservaMarcarComoPagadaDetallePrecio'

const reservaMarcarPagadaSchema = z.object({
  metodo_pago_id: z.string().min(1, 'Se requiere metodo'),
  moneda_id: z.string().min(1, 'Se requiere moneda'),
  tipo_persona_id: z.string().nullable(),
})

export default function ReservaMarcarComoPagadaForm({
  reservaId,
  reserva,
  onFormSubmit = () => {},
}) {
  const { toast } = useToast()
  const { mutate } = useSWRConfig()

  const { monedas, isLoading: isLoadingMonedas } = useMonedas({})
  const { metodos, isLoading: isLoadingMetodos } = useMetodoPagos({
    params: { include: 'descuento' },
  })
  const { tipoPersonas, isLoading: isLoadingTipos } = useTipoPersonas({
    params: { include: 'descuento' },
  })

  const form = useForm({
    resolver: zodResolver(reservaMarcarPagadaSchema),
    defaultValues: {
      metodo_pago_id: String(1),
      moneda_id: String(1),
      tipo_persona_id: '',
    },
  })

  const metodoSeleccionado = form.watch('metodo_pago_id')
  const tipoSeleccionado = form.watch('tipo_persona_id')

  const { trigger, isMutating } = useSWRMutation(
    '/api/reservas/marcar-pagada',
    updateFetcher,
    {
      onSuccess() {
        toast({
          title: `😄 Reserva marcada como paga con éxito`,
        })
        form.reset()
        mutate(
          key => Array.isArray(key) && key[0] === `/api/reservas/${reservaId}`,
        )
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

    trigger({ id: reservaId, data })
  }

  return (
    <Form {...form}>
      <form
        onSubmit={form.handleSubmit(onSubmit)}
        className="grid w-full grid-cols-12 gap-2 gap-y-4 rounded p-2">
        {!isLoadingMonedas && (
          <FormField
            control={form.control}
            name="moneda_id"
            render={({ field }) => (
              <FormItem className="col-span-12">
                <FormLabel>Moneda</FormLabel>
                <Select onValueChange={field.onChange} value={field.value}>
                  <FormControl>
                    <SelectTrigger>
                      <SelectValue placeholder="Seleccione una moneda" />
                    </SelectTrigger>
                  </FormControl>
                  <SelectContent>
                    {monedas?.map(moneda => (
                      <SelectItem key={moneda?.id} value={String(moneda?.id)}>
                        {moneda?.descripcion}
                      </SelectItem>
                    ))}
                  </SelectContent>
                </Select>
                <FormMessage />
              </FormItem>
            )}
          />
        )}

        {!isLoadingMetodos && (
          <FormField
            control={form.control}
            name="metodo_pago_id"
            render={({ field }) => (
              <FormItem className="col-span-12">
                <FormLabel>Método de Pago</FormLabel>
                <Select onValueChange={field.onChange} value={field.value}>
                  <FormControl>
                    <SelectTrigger>
                      <SelectValue placeholder="Seleccione un Método" />
                    </SelectTrigger>
                  </FormControl>
                  <SelectContent>
                    {metodos?.map(metodo => (
                      <SelectItem key={metodo?.id} value={String(metodo?.id)}>
                        {metodo?.descripcion}{' '}
                        {`(${metodo?.descuento ? metodo?.descuento?.descripcion : '-'})`}
                      </SelectItem>
                    ))}
                  </SelectContent>
                </Select>
                <FormMessage />
              </FormItem>
            )}
          />
        )}

        {!isLoadingTipos && (
          <FormField
            control={form.control}
            name="tipo_persona_id"
            render={({ field }) => (
              <FormItem className="col-span-12">
                <FormLabel>Tipo de Persona</FormLabel>
                <Select onValueChange={field.onChange} value={field.value}>
                  <FormControl>
                    <SelectTrigger>
                      <SelectValue placeholder="Seleccione un Tipo de persona" />
                    </SelectTrigger>
                  </FormControl>
                  <SelectContent>
                    {tipoPersonas?.map(tipo => (
                      <SelectItem key={tipo?.id} value={String(tipo?.id)}>
                        {tipo?.descripcion}{' '}
                        {`(${tipo?.descuento ? tipo?.descuento?.descripcion : '-'})`}
                      </SelectItem>
                    ))}
                  </SelectContent>
                </Select>
                <FormMessage />
              </FormItem>
            )}
          />
        )}

        {!isLoadingMetodos && !isLoadingTipos && (
          <ReservaMarcarComoPagadaDetallePrecio
            precioTotal={reserva.precio_total}
            metodoSeleccionado={metodoSeleccionado}
            tipoSeleccionado={tipoSeleccionado}
            metodos={metodos}
            tipoPersonas={tipoPersonas}
          />
        )}

        <FormField
          control={form.control}
          name="pagada"
          render={({ field }) => (
            <FormItem className="col-span-12 flex flex-row items-center justify-between rounded-lg border p-4">
              <div className="space-y-0.5">
                <FormLabel className="text-base">
                  Marcar reserva como pagada
                </FormLabel>
                <FormDescription>
                  Se marcará la reserva como pagada y no se podrán agregar
                  equipos.
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
          name="reserva_pagada"
          render={({ field }) => (
            <FormItem className="col-span-12">
              <FormControl></FormControl>
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
