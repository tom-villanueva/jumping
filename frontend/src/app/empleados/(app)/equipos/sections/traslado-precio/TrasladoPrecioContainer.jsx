'use client'
import { useState } from 'react'
import { Button } from '@/components/ui/button'
import { Trash } from 'lucide-react'
import DeleteEntityForm from '../../../../../../components/crud/DeleteEntityForm'
import CreateEditEntityModal from '../../../../../../components/crud/CreateEditEntityModal'
import TrasladoPrecioFormContent from './TrasladoPrecioFormContent'
import TrasladoPrecioTable from './TrasladoPrecioTable'
import { convertToUTC } from '@/lib/utils'

const TRASLADO_PRECIO_DEFAULT_VALUES = {
  precio: 0,
  fecha_desde: '',
  fecha_hasta: '',
}

export default function TrasladoPrecioContainer({}) {
  const [editing, setEditing] = useState(false)
  const [openForm, setOpenForm] = useState(false)
  const [openDeleteForm, setOpenDeleteForm] = useState(false)
  const [selectedTrasladoPrecio, setSelectedTrasladoPrecio] = useState(
    TRASLADO_PRECIO_DEFAULT_VALUES,
  )

  const columns = [
    {
      accessorKey: 'id',
      header: 'Id',
    },
    {
      accessorKey: 'precio',
      header: 'Precio',
    },
    {
      accessorKey: 'fecha_desde',
      header: 'Fecha Inicio',
      cell: ({ row }) => {
        const precio = row.original
        return (
          <span>{convertToUTC(precio?.fecha_desde).toLocaleDateString()}</span>
        )
      },
    },
    {
      accessorKey: 'fecha_hasta',
      header: 'Fecha Fin',
      cell: ({ row }) => {
        const precio = row.original
        return (
          <span>
            {precio?.fecha_hasta &&
              convertToUTC(precio?.fecha_hasta).toLocaleDateString()}
          </span>
        )
      },
    },
    {
      accessorKey: 'acciones',
      header: 'Acciones',
      cell: ({ row }) => {
        const precio = row.original

        return (
          <div className="flex flex-row gap-2">
            <Button
              variant="destructive"
              type="button"
              onClick={() => {
                setSelectedTrasladoPrecio(precio)
                setOpenDeleteForm(!openDeleteForm)
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
        entity={selectedTrasladoPrecio}
        apiKey="/api/traslado-precios"
        name="traslado precio"
      />
      <div className="flex w-full justify-end pb-4">
        <Button
          onClick={() => {
            setSelectedTrasladoPrecio(TRASLADO_PRECIO_DEFAULT_VALUES)
            setEditing(false)
            setOpenForm(true)
          }}>
          Nuevo Traslado Precio
        </Button>
      </div>
      <CreateEditEntityModal
        open={openForm}
        onOpenChange={() => setOpenForm(!openForm)}
        editing={editing}
        name="traslado">
        <TrasladoPrecioFormContent
          onFormSubmit={() => setOpenForm(!openForm)}
        />
      </CreateEditEntityModal>
      <TrasladoPrecioTable columns={columns} />
    </div>
  )
}
