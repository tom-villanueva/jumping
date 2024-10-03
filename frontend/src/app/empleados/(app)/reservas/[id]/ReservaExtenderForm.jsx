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

const reservaExtenderSchema = z
  .object({
    es_extension: z.boolean(),
    fecha_desde: z
      .string({
        required_error: 'Se requiere fecha inicio',
      })
      .date('Se requiere fecha inicio')
      .refine(data => convertToUTC(data) >= new Date().setHours(0, 0, 0, 0), {
        message: 'Fecha inicio tiene que ser igual o mayor a hoy.',
      }),
    fecha_hasta: z
      .string({
        required_error: 'Se requiere fecha fin',
      })
      .date('Se requiere fecha fin'),
    fecha_prueba: z
      .string({
        required_error: 'Se requiere fecha prueba',
      })
      .date('Se requiere fecha prueba'),
  })
  .refine(
    data => convertToUTC(data.fecha_hasta) >= convertToUTC(data.fecha_desde),
    {
      message: 'Fecha fin no puede ser menor a fecha inicio',
      path: ['fecha_hasta'],
    },
  )
  .refine(
    data => convertToUTC(data.fecha_prueba) >= convertToUTC(data.fecha_desde),
    {
      message: 'Fecha prueba no puede ser menor a fecha inicio',
      path: ['fecha_prueba'],
    },
  )

export default function ReservaExtenderForm({
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
      es_extension: true,
      fecha_desde: today,
      fecha_hasta: '',
      fecha_prueba: today,
    },
  })

  const { trigger, isMutating } = useSWRMutation(
    '/api/reservas/extender',
    updateFetcher,
    {
      onSuccess(data) {
        toast({
          title: `😄 Reserva extendida con éxito`,
        })
        form.reset()
        router.push(`${data?.data?.id}`)
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
      reserva_equipo_ids,
    }

    trigger({ id: reservaId, data })
  }

  return (
    <Form {...form}>
      <form
        onSubmit={form.handleSubmit(onSubmit)}
        className="grid w-full grid-cols-12 gap-2 gap-y-4 rounded p-2">
        <FormField
          control={form.control}
          name="es_extension"
          render={({ field }) => (
            <FormItem className="col-span-12 flex items-center space-x-2">
              <FormControl>
                <Checkbox
                  id="es_extension"
                  name="es_extension"
                  checked={field.value}
                  onCheckedChange={field.onChange}
                />
              </FormControl>
              <FormLabel className="text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70">
                Es extensión
              </FormLabel>
            </FormItem>
          )}
        />

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
          name="fecha_desde"
          render={({ field }) => (
            <FormItem className="col-span-12 md:col-span-4">
              <FormLabel>Fecha Inicio</FormLabel>
              <FormControl>
                <Input type="date" name="fecha_desde" min={today} {...field} />
              </FormControl>
              <FormMessage />
            </FormItem>
          )}
        />
        <FormField
          control={form.control}
          name="fecha_hasta"
          render={({ field }) => (
            <FormItem className="col-span-12 md:col-span-4">
              <FormLabel>Fecha Fin</FormLabel>
              <FormControl>
                <Input type="date" name="fecha_hasta" min={today} {...field} />
              </FormControl>
              <FormMessage />
            </FormItem>
          )}
        />
        <FormField
          control={form.control}
          name="fecha_prueba"
          render={({ field }) => (
            <FormItem className="col-span-12 md:col-span-4">
              <FormLabel>Fecha Prueba</FormLabel>
              <FormControl>
                <Input type="date" name="fecha_prueba" min={today} {...field} />
              </FormControl>
              <FormMessage />
            </FormItem>
          )}
        />

        <FormField
          control={form.control}
          name="pagada"
          render={({ field }) => (
            <FormItem className="col-span-12 flex flex-row items-center justify-between rounded-lg border p-4">
              <div className="space-y-0.5">
                <FormLabel className="text-base">Extender reserva</FormLabel>
                <FormDescription>
                  Se marcarán los artículos como devueltos. Si "es extensión"
                  está tildado, se pasan los artículos a la nueva reserva.
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
