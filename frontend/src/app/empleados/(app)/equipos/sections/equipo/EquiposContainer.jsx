'use client'
import { DataTable } from '../data-table'
import { useState } from 'react'
import { Button } from '@/components/ui/button'
import { Check, Edit, Trash, X } from 'lucide-react'
import CreateEditEquipoForm from './CreateEditEquipoForm'
import DeleteEntityForm from '../DeleteEntityForm'
import { removeEquipo } from '../../actions'

const EQUIPO_DEFAULT_VALUES = {
  descripcion: '',
  precio: 0,
  disponible: false,
}

export default function EquiposContainer({ equipos, tipoArticulos }) {
  const [editing, setEditing] = useState(false)
  const [openForm, setOpenForm] = useState(false)
  const [openDeleteForm, setOpenDeleteForm] = useState(false)
  const [selectedEquipo, setSelectedEquipo] = useState(EQUIPO_DEFAULT_VALUES)

  const columns = [
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
      cell: ({ row }) => {
        const equipo = row.original
        return (
          <div className="flex flex-row">
            <Button
              variant="outline"
              onClick={() => {
                setSelectedEquipo(equipo)
                setEditing(true)
                setOpenForm(true)
              }}>
              <Edit className="h-4 w-4" />
            </Button>
            <Button
              variant="outline"
              onClick={() => {
                setSelectedEquipo(equipo)
                setOpenDeleteForm(true)
              }}>
              <Trash className="h-4 w-4" />
            </Button>
          </div>
        )
      },
    },
  ]

  return (
    <div>
      <DeleteEntityForm
        openDeleteForm={openDeleteForm}
        setOpenDeleteForm={setOpenDeleteForm}
        entity={selectedEquipo}
        serverAction={removeEquipo}
        name="equipo"
      />
      <div className="flex w-full justify-end pb-4">
        <Button
          onClick={() => {
            setSelectedEquipo(EQUIPO_DEFAULT_VALUES)
            setEditing(false)
            setOpenForm(true)
          }}>
          Agregar Equipo
        </Button>
      </div>
      <CreateEditEquipoForm
        open={openForm}
        editing={editing}
        setOpen={setOpenForm}
        equipo={selectedEquipo}
        tipoArticulos={tipoArticulos}
      />
      <DataTable columns={columns} data={equipos} />
    </div>
  )
}
