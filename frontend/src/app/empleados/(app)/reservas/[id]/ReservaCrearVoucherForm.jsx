'use client'

import { useToast } from '@/components/ui/use-toast'
import useSWRMutation from 'swr/mutation'
import { useSWRConfig } from 'swr'
import { useForm } from 'react-hook-form'
import { zodResolver } from '@hookform/resolvers/zod'
import {
  convertToUTC,
  formatDate,
  storeFetcher,
  updateFetcher,
} from '@/lib/utils'
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
import { Checkbox } from '@/components/ui/checkbox'
import { Input } from '@/components/ui/input'
import { useReservaEquipos } from '@/services/reserva-equipos'
import {
  getCoreRowModel,
  getPaginationRowModel,
  useReactTable,
} from '@tanstack/react-table'
import { useState } from 'react'
import { DataTable } from '@/components/client-table/data-table'
import { useRouter } from 'next/navigation'

const today = formatDate(convertToUTC(new Date().setHours(0, 0, 0, 0)))

const reservaExtenderSchema = z.object({
  descripcion: z.string().nullable(),
  dias: z
    .number({
      required_error: 'Se requiere días',
      invalid_type_error: 'Tiene que ser un número',
    })
    .nonnegative('No puede ser negativo'),
  fecha_expiracion: z
    .string({
      required_error: 'Se requiere fecha expiración',
    })
    .date('Se requiere fecha expiración')
    .refine(data => convertToUTC(data) >= new Date().setHours(0, 0, 0, 0), {
      message: 'Fecha inicio tiene que ser igual o mayor a hoy.',
    }),
})

export default function ReservaCrearVoucherForm({
  reserva,
  reservaId,
  onFormSubmit = () => {},
}) {
  const { toast } = useToast()
  const router = useRouter()
  const [rowSelection, setRowSelection] = useState({})

  const { reservaEquipos, isLoading, isError } = useReservaEquipos({
    params: {
      include: 'equipo',
    },
    filters: [{ id: 'reserva_id', value: reservaId }],
  })

  const columns = [
    {
      id: 'select',
      header: ({ table }) => (
        <Checkbox
          checked={
            table.getIsAllPageRowsSelected() ||
            (table.getIsSomePageRowsSelected() && 'indeterminate')
          }
          onCheckedChange={value => table.toggleAllPageRowsSelected(!!value)}
          aria-label="Select all"
          className="translate-y-0.5"
        />
      ),
      cell: ({ row }) => (
        <Checkbox
          checked={row.getIsSelected()}
          onCheckedChange={value => row.toggleSelected(!!value)}
          aria-label="Select row"
          className="translate-y-0.5"
        />
      ),
      enableSorting: false,
      enableHiding: false,
    },
    {
      header: 'Equipo',
      accessorKey: 'equipo.descripcion',
    },
    {
      header: 'Apellido',
      accessorKey: 'apellido',
    },
    {
      header: 'Nombre',
      accessorKey: 'nombre',
    },
  ]

  const table = useReactTable({
    data: reservaEquipos || [],
    state: {
      rowSelection,
    },
    columns,
    enableRowSelection: true,
    onRowSelectionChange: setRowSelection,
    getCoreRowModel: getCoreRowModel(),
    getPaginationRowModel: getPaginationRowModel(),
    getRowId: row => row.id,
  })

  const form = useForm({
    resolver: zodResolver(reservaExtenderSchema),
    defaultValues: {
      descripcion: '',
      dias: 0,
      fecha_expiracion: today,
    },
  })

  const { trigger, isMutating } = useSWRMutation(
    '/api/vouchers',
    storeFetcher,
    {
      onSuccess(data) {
        toast({
          title: `😄 Voucher creado con éxito`,
        })
        form.reset()
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
    const reserva_equipo_ids = []

    for (let key in rowSelection) {
      if (rowSelection[key]) {
        reserva_equipo_ids.push({
          reserva_equipo_id: key,
        })
      }
    }

    const data = {
      ...values,
      cliente_id: reserva?.cliente_id,
      reserva_equipo_ids,
    }

    trigger({ data })
  }

  return (
    <Form {...form}>
      <form
        onSubmit={form.handleSubmit(onSubmit)}
        className="grid w-full grid-cols-12 gap-2 gap-y-4 rounded p-2">
        <div className="col-span-12">
          <DataTable
            table={table}
            columns={columns}
            isLoading={isLoading}
            filters={[]}
          />
        </div>

        <FormField
          control={form.control}
          name="fecha_expiracion"
          render={({ field }) => (
            <FormItem className="col-span-12 md:col-span-6">
              <FormLabel>Fecha Expiración</FormLabel>
              <FormControl>
                <Input
                  type="date"
                  name="fecha_expiracion"
                  min={today}
                  {...field}
                />
              </FormControl>
              <FormMessage />
            </FormItem>
          )}
        />

        <FormField
          control={form.control}
          name="dias"
          render={({ field }) => (
            <FormItem className="col-span-12 sm:col-span-6">
              <FormLabel>Días</FormLabel>
              <FormControl>
                <Input
                  id="dias"
                  name="dias"
                  type="number"
                  placeholder="Escriba dias"
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

        <FormField
          control={form.control}
          name="guardado"
          render={({ field }) => (
            <FormItem className="col-span-12 flex flex-row items-center justify-between rounded-lg border p-4">
              <div className="space-y-0.5">
                <FormLabel className="text-base">Guardar voucher</FormLabel>
                <FormDescription>
                  Crear voucher. Se podrá visualizar en la pestaña de Vouchers
                </FormDescription>
              </div>
              <FormControl>
                <Button
                  disabled={isMutating}
                  type="submit"
                  className="col-span-6">
                  {isMutating ? 'Creando...' : 'Aceptar'}
                </Button>
              </FormControl>
            </FormItem>
          )}
        />

        {/* <FormField
          control={form.control}
          name="reserva_pagada"
          render={({ field }) => (
            <FormItem className="col-span-12">
              <FormControl></FormControl>
              <FormMessage />
            </FormItem>
          )}
        /> */}

        {form.formState.errors.root && (
          <p className="col-span-12 text-sm text-red-500">
            {form.formState.errors.root.serverError.message}
          </p>
        )}
      </form>
    </Form>
  )
}
