'use client'

import { convertToUTC } from '@/lib/utils'
import PagosTable from './PagosTable'

export default function PagosContainer({}) {
  const columns = [
    {
      accessorKey: 'reserva.id',
      id: 'reserva_id',
      header: 'Reserva',
    },
    {
      accessorKey: 'reserva',
      accessorFn: row => `${row.reserva.nombre} ${row.reserva.apellido}`,
      header: 'Nombre y Apellido',
    },
    {
      accessorKey: 'total',
      header: 'Monto',
      cell: ({ row }) => {
        const total = row.getValue('total')

        const formatted = new Intl.NumberFormat('es-AR', {
          style: 'currency',
          currency: 'ARS',
        }).format(total)

        return <div className="font-medium">{formatted}</div>
      },
    },
    {
      accessorKey: 'moneda.descripcion',
      id: 'moneda_id',
      header: 'Moneda',
    },
    {
      accessorKey: 'metodo_pago.descripcion',
      id: 'metodo_pago_id',
      header: 'Método de Pago',
    },
    {
      accessorKey: 'created_at',
      header: 'Fecha pago',
      cell: ({ row }) => {
        return (
          <span>
            {convertToUTC(row.original.created_at).toLocaleDateString()}
          </span>
        )
      },
    },
  ]

  return (
    <div>
      <PagosTable columns={columns} />
    </div>
  )
}
