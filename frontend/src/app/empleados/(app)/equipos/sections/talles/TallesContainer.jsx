'use client'
import { useState } from 'react'
import DeleteEntityForm from '../../../../../../components/crud/DeleteEntityForm'
import { Button } from '@/components/ui/button'
import { Edit, Trash } from 'lucide-react'
import TalleFormContent from './TalleFormContent'
import CreateEditEntityModal from '../../../../../../components/crud/CreateEditEntityModal'
import TallesTable from './TallesTable'

const TALLE_DEFAULT_VALUES = {
  descripcion: '',
}

export default function TallesContainer({}) {
  const [editing, setEditing] = useState(false)
  const [openForm, setOpenForm] = useState(false)
  const [openDeleteForm, setOpenDeleteForm] = useState(false)
  const [selectedTalle, setSelectedTalle] = useState(TALLE_DEFAULT_VALUES)

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
        const talle = row.original
        return (
          <div className="flex flex-row gap-2">
            <Button
              variant="outline"
              type="button"
              onClick={() => {
                setSelectedTalle(talle)
                setEditing(true)
                setOpenForm(true)
              }}>
              <Edit className="h-4 w-4" />
            </Button>
            <Button
              variant="destructive"
              type="button"
              onClick={() => {
                setSelectedTalle(talle)
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
        entity={selectedTalle}
        apiKey="/api/talles"
        name="talle"
      />
      <div className="flex w-full justify-end pb-4">
        <Button
          onClick={() => {
            setSelectedTalle(TALLE_DEFAULT_VALUES)
            setEditing(false)
            setOpenForm(true)
          }}>
          Nuevo Talle
        </Button>
      </div>
      <CreateEditEntityModal
        open={openForm}
        onOpenChange={() => setOpenForm(!openForm)}
        editing={editing}
        name="talle">
        <TalleFormContent
          onFormSubmit={() => setOpenForm(!openForm)}
          talle={selectedTalle}
          editing={editing}
        />
      </CreateEditEntityModal>
      <TallesTable columns={columns} />
    </div>
  )
}
