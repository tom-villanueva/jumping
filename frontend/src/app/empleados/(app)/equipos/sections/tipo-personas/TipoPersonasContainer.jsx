'use client'
import { useState } from 'react'
import DeleteEntityForm from '../../../../../../components/crud/DeleteEntityForm'
import { Button } from '@/components/ui/button'
import CreateEditEntityModal from '../../../../../../components/crud/CreateEditEntityModal'
import { Edit, Trash } from 'lucide-react'
import TipoPersonaFormContent from './TipoPersonaFormContent'
import TipoPersonasTable from './TipoPersonasTable'

const TIPO_PERSONA_DEFAULT_VALUES = {
  descripcion: '',
  descuento_id: '',
}

export default function TipoPersonasContainer({}) {
  const [editing, setEditing] = useState(false)
  const [openForm, setOpenForm] = useState(false)
  const [openDeleteForm, setOpenDeleteForm] = useState(false)
  const [selectedTipoPersona, setSelectedTipoPersona] = useState(
    TIPO_PERSONA_DEFAULT_VALUES,
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
      accessorKey: 'descuento',
      header: 'Descuento',
      cell: ({ row }) => {
        const modelo = row.original
        return <span>{modelo.descuento?.descripcion ?? '-'}</span>
      },
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
                setSelectedTipoPersona(metodo)
                setEditing(true)
                setOpenForm(true)
              }}>
              <Edit className="h-4 w-4" />
            </Button>
            <Button
              variant="destructive"
              type="button"
              onClick={() => {
                setSelectedTipoPersona(metodo)
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
        entity={selectedTipoPersona}
        apiKey="/api/tipo-personas"
        name="Tipo Cliente"
      />
      <div className="flex w-full justify-end pb-4">
        <Button
          onClick={() => {
            setSelectedTipoPersona(TIPO_PERSONA_DEFAULT_VALUES)
            setEditing(false)
            setOpenForm(true)
          }}>
          Nuevo Tipo de Cliente
        </Button>
      </div>
      <CreateEditEntityModal
        open={openForm}
        onOpenChange={() => setOpenForm(!openForm)}
        editing={editing}
        name="tipo cliente">
        <TipoPersonaFormContent
          onFormSubmit={() => setOpenForm(!openForm)}
          tipo={selectedTipoPersona}
          editing={editing}
        />
      </CreateEditEntityModal>
      <TipoPersonasTable columns={columns} />
    </div>
  )
}
