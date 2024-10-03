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
import { useMemo } from 'react'
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
        precio: p.precio,
        descuento:
          descuentos && descuentos.length > 0 ? descuentos[0].descuento : null,
        precio_descontado:
          descuentos && descuentos.length > 0
            ? p.precio - p.precio * (descuentos[0].descuento / 100)
            : null,
      })
    })

    return rows
  }, [precios, descuentos])

  const columnsPrecios = [
    {
      accessorKey: 'fecha_desde',
      id: 'fecha_desde_after',
      header: 'Fecha Inicio',
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
      cell: ({ row }) => {
        return (
          <span>
            {convertToUTC(row.original.fecha_hasta).toLocaleDateString()}
          </span>
        )
      },
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
            {row.original.precio_descontado
              ? new Intl.NumberFormat('es-AR', {
                  style: 'currency',
                  currency: 'ARS',
                }).format(row.original.precio_descontado)
              : '-'}
          </span>
        )
      },
    },
  ]

  const tablePrecios = useReactTable({
    data: tableRows || [],
    columns: columnsPrecios,
    getCoreRowModel: getCoreRowModel(),
    getPaginationRowModel: getPaginationRowModel(),
  })

  return (
    <Dialog open={open} onOpenChange={onOpenChange}>
      <DialogContent className="max-h-screen overflow-y-auto sm:max-w-2xl">
        <DialogHeader>
          <DialogTitle>{`Desglose del equipo`}</DialogTitle>
          <DialogDescription>
            Desglose de precios y descuento.
          </DialogDescription>
        </DialogHeader>
        <div className="grid grid-cols-12">
          <div className="col-span-12">
            {descuentos && descuentos.length > 0 && (
              <span>{`Descuento de ${descuentos[0].descuento}% por reserva de ${descuentos[0].dias} días.`}</span>
            )}
          </div>
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
