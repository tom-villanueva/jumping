import {
  Dialog,
  DialogContent,
  DialogDescription,
  DialogHeader,
  DialogTitle,
} from '@/components/ui/dialog'
import {
  getCoreRowModel,
  getPaginationRowModel,
  useReactTable,
} from '@tanstack/react-table'
import { DataTable } from '@/components/client-table/data-table'
import { useMemo, useState } from 'react'
import { convertToUTC } from '@/lib/utils'

export default function ReservaEquipoPrecios({
  open,
  onOpenChange = () => {},
  precios = [],
  descuentos = [],
}) {
  const tableRows = useMemo(() => {
    if (!precios || !descuentos) return []

    const rows = []
    precios.forEach(p => {
      rows.push({
        fecha_desde: p.fecha_desde,
        fecha_hasta: p.fecha_hasta,
        valor: p.precio,
        tipo: 'Precio',
      })
    })
    descuentos.forEach(d => {
      rows.push({
        fecha_desde: d.fecha_desde,
        fecha_hasta: d.fecha_hasta,
        valor: d.descuento,
        tipo: 'Descuento',
      })
    })
    return rows
  }, [precios, descuentos])

  const columns = [
    {
      header: 'Tipo',
      accessorKey: 'tipo',
    },
    {
      accessorKey: 'fecha_desde',
      id: 'fecha_desde_after',
      header: 'Fecha Inicio',
      accesorFn: row =>
        convertToUTC(row.original.fecha_desde).toLocaleDateString(),
      cell: ({ row }) => {
        return (
          <span>
            {convertToUTC(row.original.fecha_desde).toLocaleDateString()}
          </span>
        )
      },
    },
    {
      accessorKey: 'fecha_hasta',
      id: 'fecha_hasta_before',
      header: 'Fecha Fin',
      accesorFn: row => convertToUTC(row.fecha_hasta).toLocaleDateString(),
      cell: ({ row }) => {
        return (
          <span>
            {convertToUTC(row.original.fecha_hasta).toLocaleDateString()}
          </span>
        )
      },
    },
    {
      header: 'Valor',
      // accessorKey: 'valor',
      cell: ({ row }) => {
        return (
          <span>
            {row.original.tipo === 'Precio' ? (
              <>
                {new Intl.NumberFormat('es-AR', {
                  style: 'currency',
                  currency: 'ARS',
                }).format(row.original.valor)}
              </>
            ) : (
              <>{`${row.original.valor}%`}</>
            )}
          </span>
        )
      },
    },
  ]

  const table = useReactTable({
    data: tableRows || [],
    columns,
    getCoreRowModel: getCoreRowModel(),
    getPaginationRowModel: getPaginationRowModel(),
  })

  return (
    <Dialog open={open} onOpenChange={onOpenChange}>
      <DialogContent className="max-h-screen overflow-y-auto sm:max-w-2xl">
        <DialogHeader>
          <DialogTitle>{`Desglose del equipo`}</DialogTitle>
          <DialogDescription>
            Desglose de precios y descuentos.
          </DialogDescription>
        </DialogHeader>
        <div className="grid grid-cols-12">
          <div className="col-span-12">
            <DataTable table={table} columns={columns} filters={[]} />
          </div>
        </div>
      </DialogContent>
    </Dialog>
  )
}
