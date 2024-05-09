'use client'
import { DataTable } from '../data-table'
import { useEffect, useState } from 'react'
import { Button } from '@/components/ui/button'
import { Check, Edit, Trash, X } from 'lucide-react'
import DeleteEntityForm from '../DeleteEntityForm'
import { editEquipo, removeEquipo, saveEquipo } from '../../equipos-actions'
import CreateEditEntityModal from '../CreateEditEntityModal'
import { SelectManyEntitiesContextProvider } from '../SelectManyEntitiesContext'
import EquipoFormContent from './EquipoFormContent'
import EquipoThumbnailUploadInput from './EquipoThumbnailUploadInput'

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
          <div className="flex flex-row gap-2">
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
              variant="destructive"
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

  useEffect(() => {
    // Esto lo hice para que se recargue la imagen al subirla
    // funciona, no sé si es la mejor solución
    if (selectedEquipo.hasOwnProperty('id')) {
      const newSelectedEquipo = equipos.find(
        equipo => equipo.id === selectedEquipo.id,
      )
      setSelectedEquipo(newSelectedEquipo)
    }
  }, [equipos])

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
          Nuevo Equipo
        </Button>
      </div>
      <CreateEditEntityModal
        open={openForm}
        onOpenChange={() => setOpenForm(!openForm)}
        editing={editing}
        name="equipo">
        {editing && <EquipoThumbnailUploadInput equipo={selectedEquipo} />}
        <SelectManyEntitiesContextProvider
          entities={tipoArticulos}
          defaultSelected={selectedEquipo?.equipo_tipo_articulo?.map(
            // Le saco el atributo pivot
            ({ pivot, ...rest }) => rest,
          )}>
          <EquipoFormContent
            onFormSubmit={() => setOpenForm(!openForm)}
            equipo={selectedEquipo}
            serverAction={editing ? editEquipo : saveEquipo}
          />
        </SelectManyEntitiesContextProvider>
      </CreateEditEntityModal>
      <DataTable columns={columns} data={equipos} />
    </div>
  )
}
