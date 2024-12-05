'use client'
import { useState } from 'react'
import { Button } from '@/components/ui/button'
import { Trash } from 'lucide-react'
import DeleteEntityForm from '../../../../../../components/crud/DeleteEntityForm'
import CreateEditEntityModal from '../../../../../../components/crud/CreateEditEntityModal'
import TrasladoAsientoTable from './TrasladoAsientoTable'
import TrasladoAsientoFormContent from './TrasladoAsientoFormContent'

const TRASLADO_ASIENTO_DEFAULT_VALUES = {
  cantidad: 0,
}

export default function TrasladoAsientoContainer({}) {
  const [editing, setEditing] = useState(false)
  const [openForm, setOpenForm] = useState(false)
  const [openDeleteForm, setOpenDeleteForm] = useState(false)
  const [selectedTrasladoAsiento, setSelectedTrasladoAsiento] = useState(
    TRASLADO_ASIENTO_DEFAULT_VALUES,
  )

  const columns = [
    {
      accessorKey: 'id',
      header: 'Id',
    },
    {
      accessorKey: 'cantidad',
      header: 'Cantidad de Asiento Max.',
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
                setSelectedTrasladoAsiento(precio)
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
    <div className="mt-10">
      <DeleteEntityForm
        openDeleteForm={openDeleteForm}
        setOpenDeleteForm={setOpenDeleteForm}
        entity={selectedTrasladoAsiento}
        apiKey="/api/traslado-precios"
        name="traslado asiento"
      />
      <div className="flex w-full justify-end pb-4">
        <Button
          onClick={() => {
            setSelectedTrasladoAsiento(TRASLADO_ASIENTO_DEFAULT_VALUES)
            setEditing(false)
            setOpenForm(true)
          }}>
          Actualizar Traslado Asientos
        </Button>
      </div>
      <CreateEditEntityModal
        open={openForm}
        onOpenChange={() => setOpenForm(!openForm)}
        editing={editing}
        name="traslado asientos">
        <TrasladoAsientoFormContent
          onFormSubmit={() => setOpenForm(!openForm)}
        />
      </CreateEditEntityModal>
      <TrasladoAsientoTable columns={columns} />
    </div>
  )
}
