'use client'

import {
  Dialog,
  DialogContent,
  DialogDescription,
  DialogHeader,
  DialogTitle,
} from '@/components/ui/dialog'
// import { useMemo } from 'react'
import {
  getCoreRowModel,
  getPaginationRowModel,
  useReactTable,
} from '@tanstack/react-table'
import { DataTable } from '@/components/client-table/data-table'
import { useReservaDesglosePrecios } from '@/services/reservas'

export default function ReservaVerDesgloseDePreciosDialog({
  openForm,
  setOpenForm,
  reservaId,
  reserva,
}) {
  const { precios, isLoading, isError, isValidating } =
    useReservaDesglosePrecios({
      id: reservaId,
      params: {},
    })

  const columnsPrecios = [
    {
      header: 'Equipo',
      accessorKey: 'equipo_descripcion',
    },
    {
      header: 'Precio base',
      cell: ({ row }) => {
        return (
          <span>
            {new Intl.NumberFormat('es-AR', {
              style: 'currency',
              currency: 'ARS',
            }).format(row.original.precio)}
          </span>
        )
      },
    },
    {
      header: 'Días',
      cell: ({ row }) => {
        return <span>{row.original.dias}</span>
      },
    },
    {
      header: 'Descuento',
      cell: ({ row }) => {
        return (
          <span>
            {row.original.descuento ? `${row.original.descuento}%` : '-'}
          </span>
        )
      },
    },
    {
      header: 'Precio final',
      cell: ({ row }) => {
        return (
          <span>
            {new Intl.NumberFormat('es-AR', {
              style: 'currency',
              currency: 'ARS',
            }).format(row.original.total)}
          </span>
        )
      },
      footer: new Intl.NumberFormat('es-AR', {
        style: 'currency',
        currency: 'ARS',
      }).format(reserva.precio_total),
    },
  ]

  const tablePrecios = useReactTable({
    data: precios || [],
    columns: columnsPrecios,
    getCoreRowModel: getCoreRowModel(),
    getPaginationRowModel: getPaginationRowModel(),
  })

  return (
    <Dialog open={openForm} onOpenChange={() => setOpenForm(!openForm)}>
      <DialogContent className="sm:max-w-2xl">
        <DialogHeader>
          <DialogTitle>
            Deslgose de precios reserva Nro. {reservaId}
          </DialogTitle>
          <DialogDescription></DialogDescription>
        </DialogHeader>
        <div className="grid grid-cols-12">
          <div className="col-span-12">
            <DataTable
              table={tablePrecios}
              columns={columnsPrecios}
              isLoading={isLoading || isValidating}
              filters={[]}
            />
          </div>
        </div>
      </DialogContent>
    </Dialog>
  )
}
