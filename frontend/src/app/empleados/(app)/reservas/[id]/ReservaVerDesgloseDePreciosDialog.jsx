'use client'

import {
  Dialog,
  DialogContent,
  DialogDescription,
  DialogHeader,
  DialogTitle,
} from '@/components/ui/dialog'
import { useMemo } from 'react'
import {
  getCoreRowModel,
  getPaginationRowModel,
  useReactTable,
} from '@tanstack/react-table'
import { DataTable } from '@/components/client-table/data-table'

const differenceInDays = (fecha_desde, fecha_hasta) => {
  const dateFrom = new Date(fecha_desde)
  const dateTo = new Date(fecha_hasta)
  const diffTime = Math.abs(dateTo - dateFrom)
  return Math.ceil(diffTime / (1000 * 60 * 60 * 24)) // Convert milliseconds to days
}

export default function ReservaVerDesgloseDePreciosDialog({
  openForm,
  setOpenForm,
  reservaId,
  reserva,
}) {
  const tableRows = useMemo(() => {
    if (!reserva.equipos_reservados) return []
    const rows = []

    reserva.equipos_reservados.forEach(equipo_reserva => {
      const equipo = equipo_reserva.equipo.descripcion
      const nombre = `${equipo_reserva.nombre ?? ''} ${equipo_reserva.apellido ?? ''}`

      equipo_reserva.precios.map(precio_item => {
        const precio = precio_item.precio
        const descuento =
          equipo_reserva.descuentos.length > 0
            ? equipo_reserva.descuentos[0].descuento
            : 0
        const dias = differenceInDays(
          precio_item.fecha_desde,
          precio_item.fecha_hasta,
        )
        const total = (precio - precio * (descuento / 100)) * dias

        rows.push({
          nombre,
          equipo,
          dias,
          precio,
          descuento,
          total,
        })
      })
    })

    return rows
  }, [reserva])

  const columnsPrecios = [
    {
      header: 'Equipo',
      accessorKey: 'equipo',
    },
    {
      header: 'Nombre',
      accessorKey: 'nombre',
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
    data: tableRows || [],
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
              filters={[]}
            />
          </div>
        </div>
      </DialogContent>
    </Dialog>
  )
}
