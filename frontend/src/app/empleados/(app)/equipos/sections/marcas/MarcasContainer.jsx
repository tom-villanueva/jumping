'use client'
import { useState } from 'react'
import DeleteEntityForm from '../../../../../../components/crud/DeleteEntityForm'
import { DataTable } from '../data-table'
import { Button } from '@/components/ui/button'
import CreateEditEntityModal from '../../../../../../components/crud/CreateEditEntityModal'
import { Edit, Trash } from 'lucide-react'
import MarcaFormContent from './MarcaFormContent'

const MARCA_DEFAULT_VALUES = {
  descripcion: '',
}

export default function MarcasContainer({ marcas }) {
  const [editing, setEditing] = useState(false)
  const [openForm, setOpenForm] = useState(false)
  const [openDeleteForm, setOpenDeleteForm] = useState(false)
  const [selectedMarca, setSelectedMarca] = useState(MARCA_DEFAULT_VALUES)

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
        const marca = row.original
        return (
          <div className="flex flex-row gap-2">
            <Button
              variant="outline"
              type="button"
              onClick={() => {
                setSelectedMarca(marca)
                setEditing(true)
                setOpenForm(true)
              }}>
              <Edit className="h-4 w-4" />
            </Button>
            <Button
              variant="destructive"
              type="button"
              onClick={() => {
                setSelectedMarca(marca)
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
        entity={selectedMarca}
        apiKey="/api/marcas"
        name="marca"
      />
      <div className="flex w-full justify-end pb-4">
        <Button
          onClick={() => {
            setSelectedMarca(MARCA_DEFAULT_VALUES)
            setEditing(false)
            setOpenForm(true)
          }}>
          Nueva Marca
        </Button>
      </div>
      <CreateEditEntityModal
        open={openForm}
        onOpenChange={() => setOpenForm(!openForm)}
        editing={editing}
        name="marca">
        <MarcaFormContent
          onFormSubmit={() => setOpenForm(!openForm)}
          marca={selectedMarca}
          editing={editing}
        />
      </CreateEditEntityModal>
      <DataTable columns={columns} data={marcas} />
    </div>
  )
}
