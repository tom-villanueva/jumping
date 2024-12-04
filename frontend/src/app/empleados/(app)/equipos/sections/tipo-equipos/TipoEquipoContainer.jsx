'use client'
import { useState } from 'react'
import DeleteEntityForm from '../../../../../../components/crud/DeleteEntityForm'
import { Button } from '@/components/ui/button'
import CreateEditEntityModal from '../../../../../../components/crud/CreateEditEntityModal'
import { Edit, Trash } from 'lucide-react'
import TipoEquipoFormContent from './TipoEquipoFormContent'
import TipoEquiposTable from './TipoEquipoTable'

const TIPO_EQUIPO_DEFAULT_VALUES = {
  descripcion: '',
  descuento_id: '',
}

export default function TipoEquiposContainer({}) {
  const [editing, setEditing] = useState(false)
  const [openForm, setOpenForm] = useState(false)
  const [openDeleteForm, setOpenDeleteForm] = useState(false)
  const [selectedTipoEquipo, setSelectedTipoEquipo] = useState(
    TIPO_EQUIPO_DEFAULT_VALUES,
  )

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
      accessorKey: 'acciones',
      header: 'Acciones',
      cell: ({ row }) => {
        const metodo = row.original
        return (
          <div className="flex flex-row gap-2">
            <Button
              variant="outline"
              type="button"
              onClick={() => {
                setSelectedTipoEquipo(metodo)
                setEditing(true)
                setOpenForm(true)
              }}>
              <Edit className="h-4 w-4" />
            </Button>
            <Button
              variant="destructive"
              type="button"
              onClick={() => {
                setSelectedTipoEquipo(metodo)
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
        entity={selectedTipoEquipo}
        apiKey="/api/tipo-equipos"
        name="Tipo Equipo"
      />
      <div className="flex w-full justify-end pb-4">
        <Button
          onClick={() => {
            setSelectedTipoEquipo(TIPO_EQUIPO_DEFAULT_VALUES)
            setEditing(false)
            setOpenForm(true)
          }}>
          Nuevo Tipo de Equipo
        </Button>
      </div>
      <CreateEditEntityModal
        open={openForm}
        onOpenChange={() => setOpenForm(!openForm)}
        editing={editing}
        name="tipo equipo">
        <TipoEquipoFormContent
          onFormSubmit={() => setOpenForm(!openForm)}
          tipo={selectedTipoEquipo}
          editing={editing}
        />
      </CreateEditEntityModal>
      <TipoEquiposTable columns={columns} />
    </div>
  )
}
