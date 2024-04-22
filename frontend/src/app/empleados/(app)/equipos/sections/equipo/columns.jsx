'use client'

import { Check, X } from 'lucide-react'

export const columns = [
  {
    accessorKey: 'id',
    header: 'Id',
  },
  {
    accessorKey: 'descripcion',
    header: 'Descripción',
  },
  {
    accessorKey: 'precio',
    header: 'Precio',
    cell: ({ row }) => {
      const precio = parseFloat(row.getValue('precio'))
      const formatted = new Intl.NumberFormat('es-AR', {
        style: 'currency',
        currency: 'ARS',
      }).format(precio)

      return <div className="font-medium">{formatted}</div>
    },
  },
  {
    accessorKey: 'disponible',
    header: 'Visible',
    cell: ({ row }) => {
      const disponible = row.getValue('disponible')

      return (
        <div>
          {disponible ? (
            <Check className="h-6 w-6 text-emerald-600" />
          ) : (
            <X className="h-6 w-6 text-rose-600" />
          )}
        </div>
      )
    },
  },
  {
    accessorKey: 'equipo_tipo_articulo',
    header: 'Compuesto por',
    cell: ({ row }) => {
      const tipo_articulos = row.getValue('equipo_tipo_articulo')

      return (
        <ul>
          {tipo_articulos.map(tipo => (
            <li key={tipo.id} className="">
              {'❄️ '}
              {tipo.descripcion}
            </li>
          ))}
        </ul>
      )
    },
  },
  {
    accessorKey: 'descuentos',
    header: 'Descuentos',
  },
  {
    accessorKey: 'acciones',
    header: 'Acciones',
    cell: ({ row }) => {},
  },
]
